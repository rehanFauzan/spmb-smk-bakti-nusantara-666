@extends('layouts.admin')

@section('title', 'Rekap Pembayaran')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Rekap Pembayaran</h1>
    </div>

    <!-- Summary Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Pembayaran Lunas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @php
                                    $lunas = \DB::table('pendaftar_data_siswa')
                                        ->join('gelombang', 'pendaftar_data_siswa.gelombang_id', '=', 'gelombang.id')
                                        ->where('pendaftar_data_siswa.status', 'PAID')
                                        ->sum('gelombang.biaya_daftar');
                                @endphp
                                Rp {{ number_format($lunas, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Jumlah Siswa Lunas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ \DB::table('pendaftar_data_siswa')->where('status', 'PAID')->count() }} Siswa
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Menunggu Verifikasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @php
                                    $menunggu = \DB::table('pendaftar_data_siswa')
                                        ->whereExists(function($query) {
                                            $query->select(\DB::raw(1))
                                                  ->from('pendaftar_berkas')
                                                  ->whereRaw('pendaftar_berkas.pendaftar_id = pendaftar_data_siswa.id')
                                                  ->where('pendaftar_berkas.jenis', 'BUKTI_BAYAR');
                                        })
                                        ->where('status', '!=', 'PAID')
                                        ->count();
                                @endphp
                                {{ $menunggu }} Siswa
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Belum Bayar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @php
                                    $belumBayar = \DB::table('pendaftar_data_siswa')
                                        ->whereNotExists(function($query) {
                                            $query->select(\DB::raw(1))
                                                  ->from('pendaftar_berkas')
                                                  ->whereRaw('pendaftar_berkas.pendaftar_id = pendaftar_data_siswa.id')
                                                  ->where('pendaftar_berkas.jenis', 'BUKTI_BAYAR');
                                        })
                                        ->count();
                                @endphp
                                {{ $belumBayar }} Siswa
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rekap per Gelombang -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rekap Pembayaran per Gelombang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Gelombang</th>
                            <th>Biaya per Siswa</th>
                            <th>Jumlah Lunas</th>
                            <th>Total Pembayaran</th>
                            <th>Menunggu</th>
                            <th>Belum Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $gelombangData = \DB::table('gelombang')
                                ->leftJoin('pendaftar_data_siswa', 'gelombang.id', '=', 'pendaftar_data_siswa.gelombang_id')
                                ->select(
                                    'gelombang.id',
                                    'gelombang.nama',
                                    'gelombang.biaya_daftar',
                                    \DB::raw('COUNT(CASE WHEN pendaftar_data_siswa.status = "PAID" THEN 1 END) as lunas'),
                                    \DB::raw('COUNT(CASE WHEN pendaftar_data_siswa.status != "PAID" AND EXISTS(SELECT 1 FROM pendaftar_berkas WHERE pendaftar_berkas.pendaftar_id = pendaftar_data_siswa.id AND pendaftar_berkas.jenis = "BUKTI_BAYAR") THEN 1 END) as menunggu'),
                                    \DB::raw('COUNT(CASE WHEN NOT EXISTS(SELECT 1 FROM pendaftar_berkas WHERE pendaftar_berkas.pendaftar_id = pendaftar_data_siswa.id AND pendaftar_berkas.jenis = "BUKTI_BAYAR") THEN 1 END) as belum_bayar')
                                )
                                ->groupBy('gelombang.id', 'gelombang.nama', 'gelombang.biaya_daftar')
                                ->get();
                        @endphp
                        @foreach($gelombangData as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td>Rp {{ number_format($item->biaya_daftar, 0, ',', '.') }}</td>
                            <td>{{ $item->lunas }} siswa</td>
                            <td>Rp {{ number_format($item->lunas * $item->biaya_daftar, 0, ',', '.') }}</td>
                            <td>{{ $item->menunggu }} siswa</td>
                            <td>{{ $item->belum_bayar }} siswa</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection