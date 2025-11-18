@extends('layouts.admin')

@section('title', 'Calon Siswa')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Calon Siswa</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Jurusan</th>
                            <th>Gelombang</th>
                            <th>Status Pembayaran</th>
                            <th>Status Berkas</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendaftar as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama ?? $item->nama_user ?? 'N/A' }}</td>
                            <td>{{ $item->nama_jurusan ?? 'N/A' }}</td>
                            <td>{{ $item->nama_gelombang ?? 'N/A' }}</td>
                            <td>
                                @if($item->status_pembayaran == 'APPROVED')
                                    <span class="badge badge-success">Lunas</span>
                                @elseif($item->status_pembayaran == 'REJECTED')
                                    <span class="badge badge-danger">Ditolak</span>
                                @else
                                    <span class="badge badge-warning">Menunggu</span>
                                @endif
                            </td>
                            <td>
                                @if($item->status_berkas == 'APPROVED')
                                    <span class="badge badge-success">Diterima</span>
                                @elseif($item->status_berkas == 'REJECTED')
                                    <span class="badge badge-danger">Ditolak</span>
                                @else
                                    <span class="badge badge-warning">Pending</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                            <td>
                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailModal{{ $item->id }}">
                                    Detail
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Detail -->
                        <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Calon Siswa</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Data Pribadi:</h6>
                                                <p><strong>Nama:</strong> {{ $item->nama ?? $item->nama_user ?? 'N/A' }}</p>
                                                <p><strong>NIK:</strong> {{ $item->nik ?? 'N/A' }}</p>
                                                <p><strong>Tempat, Tanggal Lahir:</strong> {{ $item->tmp_lahir ?? 'N/A' }}, {{ $item->tmp_lahir ?? 'N/A' }}</p>
                                                <p><strong>Jenis Kelamin:</strong> {{ $item->jk == 'L' ? 'Laki-laki' : ($item->jk == 'P' ? 'Perempuan' : 'N/A') }}</p>
                                                <p><strong>Email:</strong> {{ $item->email ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Data Pendaftaran:</h6>
                                                <p><strong>No. Pendaftaran:</strong> {{ $item->no_pendaftaran ?? 'N/A' }}</p>
                                                <p><strong>Jurusan:</strong> {{ $item->nama_jurusan ?? 'N/A' }}</p>
                                                <p><strong>Gelombang:</strong> {{ $item->nama_gelombang ?? 'N/A' }}</p>
                                                <p><strong>Status:</strong> 
                                                    <span class="badge badge-{{ $item->status == 'PAID' ? 'success' : ($item->status == 'REJECTED' ? 'danger' : 'warning') }}">
                                                        {{ $item->status ?? 'Pending' }}
                                                    </span>
                                                </p>
                                                <p><strong>Tanggal Daftar:</strong> {{ \Carbon\Carbon::parse($item->tanggal_daftar)->format('d/m/Y H:i') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection