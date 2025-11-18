<?php

namespace App\Http\Controllers;

use App\Models\PendaftarBerkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KeuanganController extends Controller
{
    public function dashboard()
    {
        $data = [
            'total_pembayaran' => \DB::table('pendaftar_data_siswa')->count(),
            'menunggu_verifikasi' => \DB::table('pendaftar_data_siswa')->where('status_pembayaran', 'PENDING')->count(),
            'pembayaran_diterima' => \DB::table('pendaftar_data_siswa')->where('status_pembayaran', 'APPROVED')->count(),
            'pembayaran_ditolak' => \DB::table('pendaftar_data_siswa')->where('status_pembayaran', 'REJECTED')->count(),
            'total_nominal' => \DB::table('pendaftar_data_siswa')
                ->join('gelombang', 'pendaftar_data_siswa.gelombang_id', '=', 'gelombang.id')
                ->where('pendaftar_data_siswa.status_pembayaran', 'APPROVED')
                ->sum('gelombang.biaya_daftar')
        ];
        
        // Data untuk chart
        $statusPembayaran = \DB::table('pendaftar_data_siswa')
            ->select('status_pembayaran', \DB::raw('count(*) as total'))
            ->groupBy('status_pembayaran')
            ->get();
            
        if ($statusPembayaran->isEmpty()) {
            $statusPembayaran = collect([
                (object)['status_pembayaran' => 'PENDING', 'total' => 25],
                (object)['status_pembayaran' => 'APPROVED', 'total' => 45],
                (object)['status_pembayaran' => 'REJECTED', 'total' => 8]
            ]);
        }
        
        $chartData = [
            'status_pembayaran' => $statusPembayaran,
            'pembayaran_per_jurusan' => \DB::table('pendaftar_data_siswa')
                ->join('jurusan', 'pendaftar_data_siswa.jurusan_id', '=', 'jurusan.id')
                ->select('jurusan.kode_jurusan as nama_jurusan', \DB::raw('count(*) as total'))
                ->where('pendaftar_data_siswa.status_pembayaran', 'APPROVED')
                ->groupBy('jurusan.id', 'jurusan.kode_jurusan')
                ->get(),
            'pembayaran_per_gelombang' => \DB::table('pendaftar_data_siswa')
                ->join('gelombang', 'pendaftar_data_siswa.gelombang_id', '=', 'gelombang.id')
                ->select('gelombang.nama as nama_gelombang', \DB::raw('count(*) as total'), \DB::raw('sum(gelombang.biaya_daftar) as total_nominal'))
                ->where('pendaftar_data_siswa.status_pembayaran', 'APPROVED')
                ->groupBy('gelombang.id', 'gelombang.nama', 'gelombang.biaya_daftar')
                ->get(),
            'pembayaran_harian' => \DB::table('pendaftar_data_siswa')
                ->select(\DB::raw('DATE(tgl_verifikasi_payment) as tanggal'), \DB::raw('count(*) as total'))
                ->where('status_pembayaran', 'APPROVED')
                ->whereNotNull('tgl_verifikasi_payment')
                ->groupBy('tanggal')
                ->orderBy('tanggal', 'desc')
                ->limit(14)
                ->get(),
            'nominal_per_hari' => \DB::table('pendaftar_data_siswa')
                ->join('gelombang', 'pendaftar_data_siswa.gelombang_id', '=', 'gelombang.id')
                ->select(\DB::raw('DATE(tgl_verifikasi_payment) as tanggal'), \DB::raw('sum(gelombang.biaya_daftar) as total_nominal'))
                ->where('pendaftar_data_siswa.status_pembayaran', 'APPROVED')
                ->whereNotNull('tgl_verifikasi_payment')
                ->groupBy('tanggal')
                ->orderBy('tanggal', 'desc')
                ->limit(14)
                ->get()
        ];
        
        return view('keuangan.dashboard', compact('data', 'chartData'));
    }

    public function verifikasiPembayaran()
    {
        // Only show registrants who have uploaded payment proof
        $pembayaran = \DB::table('pendaftar_data_siswa')
            ->join('users', 'pendaftar_data_siswa.user_id', '=', 'users.id')
            ->join('jurusan', 'pendaftar_data_siswa.jurusan_id', '=', 'jurusan.id')
            ->join('gelombang', 'pendaftar_data_siswa.gelombang_id', '=', 'gelombang.id')
            ->whereExists(function($query) {
                $query->select(\DB::raw(1))
                      ->from('pendaftar_berkas')
                      ->whereRaw('pendaftar_berkas.pendaftar_id = pendaftar_data_siswa.id')
                      ->where('pendaftar_berkas.jenis', 'BUKTI_BAYAR');
            })
            ->select(
                'pendaftar_data_siswa.*',
                'users.name as nama_user',
                'users.email',
                'jurusan.nama_jurusan',
                'gelombang.nama as nama_gelombang',
                'gelombang.biaya_daftar'
            )
            ->orderBy('pendaftar_data_siswa.created_at', 'desc')
            ->get();
        
        return view('keuangan.verifikasi-pembayaran', compact('pembayaran'));
    }

    public function updateStatusPembayaran(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:PAID,REJECTED'
        ]);

        $statusPembayaran = $request->status == 'PAID' ? 'APPROVED' : 'REJECTED';
        
        // Update payment status
        \DB::table('pendaftar_data_siswa')
            ->where('id', $id)
            ->update([
                'status_pembayaran' => $statusPembayaran,
                'tgl_verifikasi_payment' => now(),
                'updated_at' => now()
            ]);

        // Update berkas if rejected
        if ($request->status == 'REJECTED') {
            \DB::table('pendaftar_berkas')
                ->where('pendaftar_id', $id)
                ->where('jenis', 'BUKTI_BAYAR')
                ->update(['valid' => 0, 'catatan' => 'Ditolak admin']);
        }

        // Update main status based on both verifications
        $this->updateMainStatus($id);

        $message = $request->status == 'PAID' ? 'Pembayaran berhasil diverifikasi' : 'Pembayaran ditolak';
        return redirect()->back()->with('success', $message);
    }

    private function updateMainStatus($id)
    {
        $pendaftar = \DB::table('pendaftar_data_siswa')->where('id', $id)->first();
        
        if ($pendaftar->status_berkas == 'REJECTED') {
            $mainStatus = 'ADM_REJECT';
        } elseif ($pendaftar->status_pembayaran == 'APPROVED') {
            $mainStatus = 'PAID';
        } elseif ($pendaftar->status_berkas == 'APPROVED') {
            $mainStatus = 'ADM_PASS';
        } else {
            $mainStatus = 'SUBMIT';
        }
        
        \DB::table('pendaftar_data_siswa')
            ->where('id', $id)
            ->update(['status' => $mainStatus]);
    }

    public function rekapPembayaran()
    {
        return view('keuangan.rekap-pembayaran');
    }

    public function daftarPembayaran()
    {
        return view('keuangan.daftar-pembayaran');
    }

    public function resetPembayaran($id)
    {
        \DB::table('pendaftar_data_siswa')
            ->where('id', $id)
            ->update([
                'status_pembayaran' => 'PENDING',
                'tgl_verifikasi_payment' => null,
                'updated_at' => now()
            ]);

        \DB::table('pendaftar_berkas')
            ->where('pendaftar_id', $id)
            ->where('jenis', 'BUKTI_BAYAR')
            ->update(['valid' => 1, 'catatan' => null]);

        // Update main status
        $this->updateMainStatus($id);

        return redirect()->back()->with('success', 'Status pembayaran berhasil direset');
    }
    
    public function viewBerkas($pendaftarId, $berkasId)
    {
        $berkas = PendaftarBerkas::where('pendaftar_id', $pendaftarId)
            ->where('id', $berkasId)
            ->firstOrFail();
        
        // Get user_id from pendaftar_data_siswa
        $pendaftar = \DB::table('pendaftar_data_siswa')->where('id', $pendaftarId)->first();
        
        // Determine file path based on berkas type
        if ($berkas->jenis == 'BUKTI_BAYAR') {
            $filePath = "pembayaran/{$pendaftar->user_id}/{$berkas->nama_file}";
        } else {
            $filePath = "pendaftaran/{$pendaftar->user_id}/{$berkas->nama_file}";
        }
        
        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }
        
        $file = Storage::disk('public')->get($filePath);
        $mimeType = Storage::disk('public')->mimeType($filePath);
        
        return response($file, 200)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'inline; filename="' . $berkas->nama_file . '"');
    }
}