@extends('layouts.admin')

@section('title', 'Siswa Diterima')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Siswa Diterima</h1>
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
                            <th>Status</th>
                            <th>Tanggal Diterima</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswaDiterima as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama ?? $item->nama_user ?? 'N/A' }}</td>
                            <td>{{ $item->nama_jurusan ?? 'N/A' }}</td>
                            <td>{{ $item->nama_gelombang ?? 'N/A' }}</td>
                            <td>
                                <span class="badge badge-success">Diterima</span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_verifikasi_adm)->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection