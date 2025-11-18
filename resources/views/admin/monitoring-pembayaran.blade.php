@extends('layouts.admin')

@section('title', 'Monitoring Pembayaran')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Monitoring Pembayaran</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Pendaftaran</th>
                            <th>Nama Lengkap</th>
                            <th>Jurusan</th>
                            <th>Gelombang</th>
                            <th>Biaya</th>
                            <th>Status Pembayaran</th>
                            <th>Tanggal Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse($pembayaran as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->no_pendaftaran ?? 'N/A' }}</td>
                            <td>{{ $item->nama ?? 'N/A' }}</td>
                            <td>{{ $item->nama_jurusan ?? 'N/A' }}</td>
                            <td>{{ $item->nama_gelombang ?? 'N/A' }}</td>
                            <td>Rp {{ number_format($item->biaya_daftar ?? 0, 0, ',', '.') }}</td>
                            <td>
                                @if($item->status == 'PAID')
                                    <span class="badge badge-success">Lunas</span>
                                @elseif($item->status == 'PENDING')
                                    <span class="badge badge-warning">Menunggu</span>
                                @else
                                    <span class="badge badge-secondary">Belum Bayar</span>
                                @endif
                            </td>
                            <td>{{ $item->tgl_verifikasi_payment ? \Carbon\Carbon::parse($item->tgl_verifikasi_payment)->format('d/m/Y H:i') : '-' }}</td>
                            <td>
                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailModal{{ $item->id }}">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Detail -->
                        <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Pembayaran</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Data Pendaftar:</h6>
                                                <p><strong>No. Pendaftaran:</strong> {{ $item->no_pendaftaran ?? 'N/A' }}</p>
                                                <p><strong>Nama:</strong> {{ $item->nama ?? 'N/A' }}</p>
                                                <p><strong>Email:</strong> {{ $item->email ?? 'N/A' }}</p>
                                                <p><strong>Jurusan:</strong> {{ $item->nama_jurusan ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Data Pembayaran:</h6>
                                                <p><strong>Gelombang:</strong> {{ $item->nama_gelombang ?? 'N/A' }}</p>
                                                <p><strong>Biaya:</strong> Rp {{ number_format($item->biaya_daftar ?? 0, 0, ',', '.') }}</p>
                                                <p><strong>Status:</strong> 
                                                    @if($item->status == 'PAID')
                                                        <span class="badge badge-success">Lunas</span>
                                                    @elseif($item->status == 'PENDING')
                                                        <span class="badge badge-warning">Menunggu</span>
                                                    @else
                                                        <span class="badge badge-secondary">Belum Bayar</span>
                                                    @endif
                                                </p>
                                                <p><strong>Tanggal Bayar:</strong> {{ $item->tgl_verifikasi_payment ? \Carbon\Carbon::parse($item->tgl_verifikasi_payment)->format('d/m/Y H:i') : '-' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">Belum ada data pembayaran</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection