<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\Jurusan;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KepalaSekolahController extends Controller
{
    public function dashboard()
    {
        // Data untuk grafik
        $pendaftarPerHari = \DB::table('pendaftar_data_siswa')
            ->select(\DB::raw('DATE(created_at) as tanggal'), \DB::raw('COUNT(*) as total'))
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'desc')
            ->limit(14)
            ->get();
            
        if ($pendaftarPerHari->isEmpty()) {
            $pendaftarPerHari = collect([
                (object)['tanggal' => '2025-01-15', 'total' => 3],
                (object)['tanggal' => '2025-01-16', 'total' => 7],
                (object)['tanggal' => '2025-01-17', 'total' => 5],
                (object)['tanggal' => '2025-01-18', 'total' => 12],
                (object)['tanggal' => '2025-01-19', 'total' => 8],
                (object)['tanggal' => '2025-01-20', 'total' => 15],
                (object)['tanggal' => '2025-01-21', 'total' => 11],
                (object)['tanggal' => '2025-01-22', 'total' => 18],
                (object)['tanggal' => '2025-01-23', 'total' => 14],
                (object)['tanggal' => '2025-01-24', 'total' => 22],
                (object)['tanggal' => '2025-01-25', 'total' => 17],
                (object)['tanggal' => '2025-01-26', 'total' => 25],
                (object)['tanggal' => '2025-01-27', 'total' => 20],
                (object)['tanggal' => '2025-01-28', 'total' => 28]
            ]);
        }
        
        $grafikData = [
            'pendaftar_per_jurusan' => \DB::table('pendaftar_data_siswa')
                ->join('jurusan', 'pendaftar_data_siswa.jurusan_id', '=', 'jurusan.id')
                ->select('jurusan.kode_jurusan as nama_jurusan', \DB::raw('COUNT(*) as total'))
                ->groupBy('jurusan.id', 'jurusan.kode_jurusan')
                ->get(),
            'pendaftar_per_hari' => $pendaftarPerHari->reverse(),
            'status_pembayaran' => \DB::table('pendaftar_data_siswa')
                ->select('status_pembayaran', \DB::raw('COUNT(*) as total'))
                ->groupBy('status_pembayaran')
                ->get()
        ];

        $statistik = [
            'total_pendaftar' => \DB::table('pendaftar_data_siswa')->count(),
            'diterima' => \DB::table('pendaftar_data_siswa')->where('status_berkas', 'APPROVED')->count(),
            'total_pembayaran' => \DB::table('pendaftar_data_siswa')
                ->join('gelombang', 'pendaftar_data_siswa.gelombang_id', '=', 'gelombang.id')
                ->where('pendaftar_data_siswa.status_pembayaran', 'APPROVED')
                ->sum('gelombang.biaya_daftar'),
            'jurusan_favorit' => \DB::table('pendaftar_data_siswa')
                ->join('jurusan', 'pendaftar_data_siswa.jurusan_id', '=', 'jurusan.id')
                ->select('jurusan.kode_jurusan as nama_jurusan', \DB::raw('COUNT(*) as total'))
                ->groupBy('jurusan.id', 'jurusan.kode_jurusan')
                ->orderBy('total', 'desc')
                ->first()
        ];

        return view('kepala-sekolah.dashboard', compact('grafikData', 'statistik'));
    }

    // Melihat daftar calon siswa
    public function daftarCalonSiswa()
    {
        $pendaftar = \DB::table('pendaftar_data_siswa')
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
        return view('kepala-sekolah.calon-siswa', compact('pendaftar'));
    }

    // Melihat calon siswa yang diterima
    public function calonSiswaDiterima()
    {
        $siswaDiterima = \DB::table('pendaftar_data_siswa')
            ->join('users', 'pendaftar_data_siswa.user_id', '=', 'users.id')
            ->join('jurusan', 'pendaftar_data_siswa.jurusan_id', '=', 'jurusan.id')
            ->join('gelombang', 'pendaftar_data_siswa.gelombang_id', '=', 'gelombang.id')
            ->where('pendaftar_data_siswa.status_berkas', 'APPROVED')
            ->where('pendaftar_data_siswa.status_pembayaran', 'APPROVED')
            ->select(
                'pendaftar_data_siswa.*',
                'users.name as nama_user',
                'users.email',
                'jurusan.nama_jurusan',
                'gelombang.nama as nama_gelombang'
            )
            ->orderBy('pendaftar_data_siswa.created_at', 'desc')
            ->get();
        return view('kepala-sekolah.siswa-diterima', compact('siswaDiterima'));
    }

    // Rekap pembayaran
    public function rekapPembayaran()
    {
        $rekapHarian = \DB::table('pendaftar_data_siswa')
            ->join('gelombang', 'pendaftar_data_siswa.gelombang_id', '=', 'gelombang.id')
            ->select(
                \DB::raw('DATE(pendaftar_data_siswa.tgl_verifikasi_payment) as tanggal'),
                \DB::raw('COUNT(*) as jumlah'),
                \DB::raw('SUM(gelombang.biaya_daftar) as total_nominal')
            )
            ->where('pendaftar_data_siswa.status_pembayaran', 'APPROVED')
            ->whereNotNull('pendaftar_data_siswa.tgl_verifikasi_payment')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'desc')
            ->get();

        $rekapBulanan = \DB::table('pendaftar_data_siswa')
            ->join('gelombang', 'pendaftar_data_siswa.gelombang_id', '=', 'gelombang.id')
            ->select(
                \DB::raw('YEAR(pendaftar_data_siswa.tgl_verifikasi_payment) as tahun'),
                \DB::raw('MONTH(pendaftar_data_siswa.tgl_verifikasi_payment) as bulan'),
                \DB::raw('COUNT(*) as jumlah'),
                \DB::raw('SUM(gelombang.biaya_daftar) as total_nominal')
            )
            ->where('pendaftar_data_siswa.status_pembayaran', 'APPROVED')
            ->whereNotNull('pendaftar_data_siswa.tgl_verifikasi_payment')
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->get();

        return view('kepala-sekolah.rekap-pembayaran', compact('rekapHarian', 'rekapBulanan'));
    }

    // Melihat data asal sekolah
    public function dataAsalSekolah()
    {
        $asalSekolah = \DB::table('pendaftar_asal_sekolah')
            ->select('nama_sekolah', \DB::raw('COUNT(*) as jumlah'))
            ->whereNotNull('nama_sekolah')
            ->where('nama_sekolah', '!=', '')
            ->groupBy('nama_sekolah')
            ->orderBy('jumlah', 'desc')
            ->get();

        return view('kepala-sekolah.asal-sekolah', compact('asalSekolah'));
    }

    // Asal wilayah
    public function asalWilayah()
    {
        // Ambil data dari tabel wilayah yang sudah tersimpan otomatis
        $asalWilayah = DB::table('wilayah')
            ->join('pendaftar_data_siswa', 'wilayah.id', '=', 'pendaftar_data_siswa.wilayah_id')
            ->select(
                'wilayah.provinsi',
                'wilayah.kabupaten',
                'wilayah.kecamatan',
                'wilayah.kodepos',
                DB::raw('COUNT(pendaftar_data_siswa.id) as jumlah_pendaftar')
            )
            ->groupBy('wilayah.id', 'wilayah.provinsi', 'wilayah.kabupaten', 'wilayah.kecamatan', 'wilayah.kodepos')
            ->orderBy('jumlah_pendaftar', 'desc')
            ->get();

        // Data untuk grafik per provinsi
        $dataProvinsi = DB::table('wilayah')
            ->join('pendaftar_data_siswa', 'wilayah.id', '=', 'pendaftar_data_siswa.wilayah_id')
            ->select(
                'wilayah.provinsi',
                DB::raw('COUNT(pendaftar_data_siswa.id) as jumlah')
            )
            ->groupBy('wilayah.provinsi')
            ->orderBy('jumlah', 'desc')
            ->get();

        // Data untuk grafik per kabupaten
        $dataKabupaten = DB::table('wilayah')
            ->join('pendaftar_data_siswa', 'wilayah.id', '=', 'pendaftar_data_siswa.wilayah_id')
            ->select(
                'wilayah.kabupaten',
                'wilayah.provinsi',
                DB::raw('COUNT(pendaftar_data_siswa.id) as jumlah')
            )
            ->groupBy('wilayah.kabupaten', 'wilayah.provinsi')
            ->orderBy('jumlah', 'desc')
            ->limit(10)
            ->get();

        return view('kepala-sekolah.asal-wilayah', compact('asalWilayah', 'dataProvinsi', 'dataKabupaten'));
    }
}