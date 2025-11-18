@extends('layouts.admin')

@section('title', 'Data Calon Siswa')

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
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection