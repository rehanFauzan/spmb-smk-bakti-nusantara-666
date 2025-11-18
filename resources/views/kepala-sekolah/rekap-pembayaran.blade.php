@extends('layouts.admin')

@section('title', 'Rekap Pembayaran')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Rekap Pembayaran</h1>
    </div>

    <!-- Rekap Harian -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rekap Pembayaran Harian</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jumlah Pembayaran</th>
                            <th>Total Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rekapHarian as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>Rp {{ number_format($item->total_nominal ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">Belum ada data pembayaran</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Rekap Bulanan -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rekap Pembayaran Bulanan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Bulan/Tahun</th>
                            <th>Jumlah Pembayaran</th>
                            <th>Total Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rekapBulanan as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::createFromDate($item->tahun, $item->bulan, 1)->format('F Y') }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>Rp {{ number_format($item->total_nominal ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">Belum ada data pembayaran</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection