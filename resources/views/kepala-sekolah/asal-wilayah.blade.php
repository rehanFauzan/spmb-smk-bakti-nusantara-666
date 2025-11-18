@extends('layouts.admin')

@section('title', 'Data Asal Wilayah')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Asal Wilayah Calon Siswa</h1>
        <small class="text-muted">Data wilayah otomatis tersimpan dari lokasi maps yang dipilih calon siswa</small>
    </div>

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Provinsi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dataProvinsi->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-map-marked-alt fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Kabupaten/Kota</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dataKabupaten->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-city fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Kecamatan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $asalWilayah->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-map-marker-alt fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Pendaftar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $asalWilayah->sum('jumlah_pendaftar') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <!-- Grafik Provinsi -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-primary">Sebaran Pendaftar per Provinsi</h6>
                </div>
                <div class="card-body" style="height: 250px;">
                    <canvas id="chartProvinsi" width="300" height="150"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Grafik Kabupaten -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-primary">Top 10 Kabupaten/Kota</h6>
                </div>
                <div class="card-body" style="height: 250px;">
                    <canvas id="chartKabupaten" width="300" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Detail -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Data Asal Wilayah</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Provinsi</th>
                            <th>Kabupaten/Kota</th>
                            <th>Kecamatan</th>
                            <th>Kode Pos</th>
                            <th>Jumlah Pendaftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($asalWilayah as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->provinsi }}</td>
                            <td>{{ $item->kabupaten }}</td>
                            <td>{{ $item->kecamatan }}</td>
                            <td>{{ $item->kodepos }}</td>
                            <td>
                                <span class="badge badge-primary">{{ $item->jumlah_pendaftar }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data asal wilayah</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Chart Provinsi
const ctxProvinsi = document.getElementById('chartProvinsi').getContext('2d');
const chartProvinsi = new Chart(ctxProvinsi, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($dataProvinsi->pluck('provinsi')) !!},
        datasets: [{
            data: {!! json_encode($dataProvinsi->pluck('jumlah')) !!},
            backgroundColor: [
                '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b',
                '#858796', '#5a5c69', '#6f42c1', '#e83e8c', '#fd7e14'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    boxWidth: 12,
                    fontSize: 10
                }
            }
        }
    }
});

// Chart Kabupaten
const ctxKabupaten = document.getElementById('chartKabupaten').getContext('2d');
const chartKabupaten = new Chart(ctxKabupaten, {
    type: 'bar',
    data: {
        labels: {!! json_encode($dataKabupaten->pluck('kabupaten')) !!},
        datasets: [{
            label: 'Jumlah Pendaftar',
            data: {!! json_encode($dataKabupaten->pluck('jumlah')) !!},
            backgroundColor: '#4e73df',
            borderColor: '#4e73df',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    fontSize: 10
                }
            },
            x: {
                ticks: {
                    fontSize: 10
                }
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
</script>
@endsection