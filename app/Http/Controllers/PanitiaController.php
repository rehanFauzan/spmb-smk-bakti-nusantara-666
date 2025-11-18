<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\PendaftarBerkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PanitiaController extends Controller
{
    public function dashboard()
    {
        $data = [
            'total_pendaftar' => \DB::table('pendaftar_data_siswa')->count(),
            'menunggu_verifikasi' => \DB::table('pendaftar_data_siswa')->where('status', 'SUBMIT')->count(),
            'berkas_diterima' => \DB::table('pendaftar_data_siswa')->where('status_berkas', 'APPROVED')->count(),
            'berkas_ditolak' => \DB::table('pendaftar_data_siswa')->where('status_berkas', 'REJECTED')->count()
        ];
        
        // Data untuk chart
        $chartData = [
            'status_berkas' => \DB::table('pendaftar_data_siswa')
                ->select('status_berkas', \DB::raw('count(*) as total'))
                ->groupBy('status_berkas')
                ->get(),
            'pendaftar_per_jurusan' => \DB::table('pendaftar_data_siswa')
                ->join('jurusan', 'pendaftar_data_siswa.jurusan_id', '=', 'jurusan.id')
                ->select('jurusan.kode_jurusan as nama_jurusan', \DB::raw('count(*) as total'))
                ->groupBy('jurusan.id', 'jurusan.kode_jurusan')
                ->get(),
            'verifikasi_harian' => \DB::table('pendaftar_data_siswa')
                ->select(\DB::raw('DATE(tgl_verifikasi_adm) as tanggal'), \DB::raw('count(*) as total'))
                ->whereNotNull('tgl_verifikasi_adm')
                ->groupBy('tanggal')
                ->orderBy('tanggal', 'desc')
                ->limit(14)
                ->get()
        ];
        
        return view('panitia.dashboard', compact('data', 'chartData'));
    }

    // Melihat pendaftaran secara keseluruhan
    public function pendaftaran()
    {
        $pendaftaran = \DB::table('pendaftar_data_siswa')
            ->join('users', 'pendaftar_data_siswa.user_id', '=', 'users.id')
            ->join('jurusan', 'pendaftar_data_siswa.jurusan_id', '=', 'jurusan.id')
            ->join('gelombang', 'pendaftar_data_siswa.gelombang_id', '=', 'gelombang.id')
            ->select(
                'pendaftar_data_siswa.*',
                'users.name as nama_user',
                'users.email',
                'jurusan.nama_jurusan',
                'gelombang.nama as nama_gelombang'
            )
            ->orderBy('pendaftar_data_siswa.created_at', 'desc')
            ->get();
        return view('panitia.pendaftaran.index', compact('pendaftaran'));
    }

    // Verifikasi berkas
    public function verifikasiBerkas()
    {
        $pendaftar = \DB::table('pendaftar_data_siswa')
            ->join('users', 'pendaftar_data_siswa.user_id', '=', 'users.id')
            ->join('jurusan', 'pendaftar_data_siswa.jurusan_id', '=', 'jurusan.id')
            ->join('gelombang', 'pendaftar_data_siswa.gelombang_id', '=', 'gelombang.id')
            ->whereExists(function($query) {
                $query->select(\DB::raw(1))
                      ->from('pendaftar_berkas')
                      ->whereRaw('pendaftar_berkas.pendaftar_id = pendaftar_data_siswa.id');
            })
            ->select(
                'pendaftar_data_siswa.*',
                'users.name as nama_user',
                'users.email',
                'jurusan.nama_jurusan',
                'gelombang.nama as nama_gelombang'
            )
            ->orderBy('pendaftar_data_siswa.created_at', 'desc')
            ->get();
        return view('panitia.verifikasi-berkas', compact('pendaftar'));
    }

    public function updateStatusBerkas(Request $request, $id)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:diterima,ditolak',
            'catatan_verifikasi' => 'nullable|string'
        ]);

        $statusBerkas = $request->status_verifikasi == 'diterima' ? 'APPROVED' : 'REJECTED';
        
        // Update berkas status
        \DB::table('pendaftar_data_siswa')
            ->where('id', $id)
            ->update([
                'status_berkas' => $statusBerkas,
                'tgl_verifikasi_adm' => now(),
                'updated_at' => now()
            ]);

        // Update main status based on both verifications
        $this->updateMainStatus($id);

        return redirect()->back()->with('success', 'Status berkas berhasil diupdate');
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
    
    public function viewBerkas($pendaftarId, $berkasId)
    {
        $berkas = PendaftarBerkas::where('pendaftar_id', $pendaftarId)
            ->where('id', $berkasId)
            ->firstOrFail();
        
        $filePath = "pendaftaran/{$pendaftarId}/{$berkas->nama_file}";
        
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