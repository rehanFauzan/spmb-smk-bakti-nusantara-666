@extends('admin.layouts.app')

@section('title', 'Dashboard Kepala Sekolah')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Kepala Sekolah</h1>
    <div class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Generate Laporan
    </div>
</div>

<!-- Statistics Cards -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Pendaftar
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_pendaftar'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Diterima
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pendaftar_diterima'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
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
                            Menunggu Verifikasi
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pendaftar_verifikasi'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
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
                            Pembayaran Lunas
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pembayaran_lunas'] ?? 0 }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts and Reports -->
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ringkasan Pendaftaran</h6>
            </div>
            <div class="card-body">
                <h4 class="small font-weight-bold">Target Pendaftar <span class="float-right">{{ $stats['total_pendaftar'] }}/500</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: {{ ($stats['total_pendaftar']/500)*100 }}%" 
                         aria-valuenow="{{ $stats['total_pendaftar'] }}" aria-valuemin="0" aria-valuemax="500"></div>
                </div>
                
                <h4 class="small font-weight-bold">Verifikasi Selesai <span class="float-right">{{ $stats['pendaftar_diterima'] }}/{{ $stats['total_pendaftar'] }}</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $stats['total_pendaftar'] > 0 ? ($stats['pendaftar_diterima']/$stats['total_pendaftar'])*100 : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Akses Cepat</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6 mb-3">
                        <a href="{{ route('admin.pendaftar.index') }}" class="btn btn-primary btn-block">
                            <i class="fas fa-users"></i><br>Data Pendaftar
                        </a>
                    </div>
                    <div class="col-6 mb-3">
                        <a href="{{ route('admin.verifikasi.index') }}" class="btn btn-warning btn-block">
                            <i class="fas fa-check-circle"></i><br>Verifikasi
                        </a>
                    </div>
                    <div class="col-6 mb-3">
                        <a href="{{ route('admin.keuangan.pembayaran') }}" class="btn btn-success btn-block">
                            <i class="fas fa-money-bill"></i><br>Pembayaran
                        </a>
                    </div>
                    <div class="col-6 mb-3">
                        <a href="#" class="btn btn-info btn-block">
                            <i class="fas fa-chart-bar"></i><br>Laporan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection