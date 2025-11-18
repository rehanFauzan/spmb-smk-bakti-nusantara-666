<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function exportPendaftar(Request $request)
    {
        $jurusan = $request->jurusan;
        $gelombang = $request->gelombang;
        $status = $request->status;
        $periode_dari = $request->periode_dari;
        $periode_sampai = $request->periode_sampai;

        $query = DB::table('pendaftar_data_siswa')
            ->join('users', 'pendaftar_data_siswa.user_id', '=', 'users.id')
            ->join('jurusan', 'pendaftar_data_siswa.jurusan_id', '=', 'jurusan.id')
            ->join('gelombang', 'pendaftar_data_siswa.gelombang_id', '=', 'gelombang.id')
            ->select(
                'pendaftar_data_siswa.*',
                'users.name as nama_user',
                'users.email',
                'jurusan.nama_jurusan',
                'gelombang.nama as nama_gelombang'
            );

        if ($jurusan) {
            $query->where('pendaftar_data_siswa.jurusan_id', $jurusan);
        }
        if ($gelombang) {
            $query->where('pendaftar_data_siswa.gelombang_id', $gelombang);
        }
        if ($status) {
            $query->where('pendaftar_data_siswa.status', $status);
        }
        if ($periode_dari && $periode_sampai) {
            $query->whereBetween('pendaftar_data_siswa.created_at', [$periode_dari, $periode_sampai]);
        }

        $data = $query->orderBy('pendaftar_data_siswa.created_at', 'desc')->get();
        
        // Translate status for all records
        foreach ($data as $item) {
            $item->status_translated = $this->translateStatus($item->status);
        }

        if ($request->format == 'pdf') {
            return $this->exportPDF($data, 'Laporan Pendaftar');
        } else {
            return $this->exportExcel($data, 'Laporan Pendaftar');
        }
    }

    private function exportPDF($data, $title)
    {
        $pdf = Pdf::loadView('laporan.pdf', compact('data', 'title'));
        
        $filename = $title . '_' . date('Y-m-d_H-i-s') . '.pdf';
        
        return $pdf->download($filename);
    }

    private function exportExcel($data, $title)
    {
        $filename = $title . '_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['No', 'Nama', 'Email', 'Jurusan', 'Gelombang', 'Status', 'Tanggal Daftar']);
            
            $no = 1;
            foreach ($data as $row) {
                fputcsv($file, [
                    $no++,
                    $row->nama_user,
                    $row->email,
                    $row->nama_jurusan,
                    $row->nama_gelombang,
                    $row->status_translated ?? $row->status,
                    date('d/m/Y H:i', strtotime($row->created_at))
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function translateStatus($status)
    {
        $statusMap = [
            'SUBMIT' => 'Baru Submit',
            'ADM_PASS' => 'Berkas Diterima',
            'PAID' => 'Sudah Bayar',
            'ADM_REJECT' => 'Ditolak'
        ];
        
        return $statusMap[$status] ?? $status;
    }

    // Kepala Sekolah - Export all data
    public function kepalaSekolahExportPDF()
    {
        $data = DB::table('pendaftar_data_siswa')
            ->join('users', 'pendaftar_data_siswa.user_id', '=', 'users.id')
            ->join('jurusan', 'pendaftar_data_siswa.jurusan_id', '=', 'jurusan.id')
            ->join('gelombang', 'pendaftar_data_siswa.gelombang_id', '=', 'gelombang.id')
            ->select('pendaftar_data_siswa.*', 'users.name as nama_user', 'users.email', 'jurusan.nama_jurusan', 'gelombang.nama as nama_gelombang')
            ->orderBy('pendaftar_data_siswa.created_at', 'desc')
            ->get();
        
        foreach ($data as $item) {
            $item->status_translated = $this->translateStatus($item->status);
        }
        
        return $this->exportPDF($data, 'Laporan Lengkap Pendaftar');
    }

    public function kepalaSekolahExportExcel()
    {
        $data = DB::table('pendaftar_data_siswa')
            ->join('users', 'pendaftar_data_siswa.user_id', '=', 'users.id')
            ->join('jurusan', 'pendaftar_data_siswa.jurusan_id', '=', 'jurusan.id')
            ->join('gelombang', 'pendaftar_data_siswa.gelombang_id', '=', 'gelombang.id')
            ->select('pendaftar_data_siswa.*', 'users.name as nama_user', 'users.email', 'jurusan.nama_jurusan', 'gelombang.nama as nama_gelombang')
            ->orderBy('pendaftar_data_siswa.created_at', 'desc')
            ->get();
        
        foreach ($data as $item) {
            $item->status_translated = $this->translateStatus($item->status);
        }
        
        return $this->exportExcel($data, 'Laporan Lengkap Pendaftar');
    }

    // Panitia - Export verification data only
    public function panitiaExportPDF()
    {
        $data = DB::table('pendaftar_data_siswa')
            ->join('users', 'pendaftar_data_siswa.user_id', '=', 'users.id')
            ->join('jurusan', 'pendaftar_data_siswa.jurusan_id', '=', 'jurusan.id')
            ->join('gelombang', 'pendaftar_data_siswa.gelombang_id', '=', 'gelombang.id')
            ->select('pendaftar_data_siswa.*', 'users.name as nama_user', 'users.email', 'jurusan.nama_jurusan', 'gelombang.nama as nama_gelombang')
            ->orderBy('pendaftar_data_siswa.created_at', 'desc')
            ->get();
        
        foreach ($data as $item) {
            $item->status_translated = $this->translateStatus($item->status);
        }
        
        return $this->exportPDF($data, 'Laporan Verifikasi Berkas');
    }

    public function panitiaExportExcel()
    {
        $data = DB::table('pendaftar_data_siswa')
            ->join('users', 'pendaftar_data_siswa.user_id', '=', 'users.id')
            ->join('jurusan', 'pendaftar_data_siswa.jurusan_id', '=', 'jurusan.id')
            ->join('gelombang', 'pendaftar_data_siswa.gelombang_id', '=', 'gelombang.id')
            ->select('pendaftar_data_siswa.*', 'users.name as nama_user', 'users.email', 'jurusan.nama_jurusan', 'gelombang.nama as nama_gelombang')
            ->orderBy('pendaftar_data_siswa.created_at', 'desc')
            ->get();
        
        foreach ($data as $item) {
            $item->status_translated = $this->translateStatus($item->status);
        }
        
        return $this->exportExcel($data, 'Laporan Verifikasi Berkas');
    }

    // Keuangan - Export payment data only
    public function keuanganExportPDF()
    {
        $data = DB::table('pendaftar_data_siswa')
            ->join('users', 'pendaftar_data_siswa.user_id', '=', 'users.id')
            ->join('jurusan', 'pendaftar_data_siswa.jurusan_id', '=', 'jurusan.id')
            ->join('gelombang', 'pendaftar_data_siswa.gelombang_id', '=', 'gelombang.id')
            ->select('pendaftar_data_siswa.*', 'users.name as nama_user', 'users.email', 'jurusan.nama_jurusan', 'gelombang.nama as nama_gelombang')
            ->whereIn('pendaftar_data_siswa.status', ['ADM_PASS', 'PAID'])
            ->orderBy('pendaftar_data_siswa.created_at', 'desc')
            ->get();
        
        foreach ($data as $item) {
            $item->status_translated = $this->translateStatus($item->status);
        }
        
        return $this->exportPDF($data, 'Laporan Pembayaran');
    }

    public function keuanganExportExcel()
    {
        $data = DB::table('pendaftar_data_siswa')
            ->join('users', 'pendaftar_data_siswa.user_id', '=', 'users.id')
            ->join('jurusan', 'pendaftar_data_siswa.jurusan_id', '=', 'jurusan.id')
            ->join('gelombang', 'pendaftar_data_siswa.gelombang_id', '=', 'gelombang.id')
            ->select('pendaftar_data_siswa.*', 'users.name as nama_user', 'users.email', 'jurusan.nama_jurusan', 'gelombang.nama as nama_gelombang')
            ->whereIn('pendaftar_data_siswa.status', ['ADM_PASS', 'PAID'])
            ->orderBy('pendaftar_data_siswa.created_at', 'desc')
            ->get();
        
        foreach ($data as $item) {
            $item->status_translated = $this->translateStatus($item->status);
        }
        
        return $this->exportExcel($data, 'Laporan Pembayaran');
    }
}