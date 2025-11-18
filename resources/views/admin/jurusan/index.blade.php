@extends('layouts.admin')

@section('title', 'Kelola Jurusan')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Jurusan</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahJurusanModal">
            <i class="fas fa-plus"></i> Tambah Jurusan
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Jurusan</th>
                            <th>Nama Jurusan</th>
                            <th>Kuota Total</th>
                            <th>Jumlah Pendaftar</th>
                            <th>Sisa Kuota</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jurusan as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->kode_jurusan }}</td>
                            <td>{{ $item->nama_jurusan }}</td>
                            <td>{{ $item->kuota }}</td>
                            <td>{{ $item->pendaftar_data_siswa_count }}</td>
                            <td>
                                @php $sisaKuota = $item->kuota - $item->pendaftar_data_siswa_count @endphp
                                <span class="badge badge-{{ $sisaKuota > 50 ? 'success' : ($sisaKuota > 20 ? 'warning' : 'danger') }}">
                                    {{ $sisaKuota }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal{{ $item->id }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form action="{{ route('admin.jurusan.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modals -->
@foreach($jurusan as $item)
<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.jurusan.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Jurusan</label>
                        <input type="text" name="kode_jurusan" class="form-control" value="{{ $item->kode_jurusan }}" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Jurusan</label>
                        <input type="text" name="nama_jurusan" class="form-control" value="{{ $item->nama_jurusan }}" required>
                    </div>
                    <div class="form-group">
                        <label>Kuota</label>
                        <input type="number" name="kuota" class="form-control" value="{{ $item->kuota }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Tambah Jurusan -->
<div class="modal fade" id="tambahJurusanModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.jurusan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Jurusan</label>
                        <input type="text" name="kode_jurusan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Jurusan</label>
                        <input type="text" name="nama_jurusan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Kuota</label>
                        <input type="number" name="kuota" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection