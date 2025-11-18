@extends('admin.layouts.app')

@section('title', 'Manajemen Pembayaran')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen Pembayaran</h1>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Pembayaran Pendaftar</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="18%">Nama & No. Pendaftaran</th>
                        <th width="15%">Email</th>
                        <th width="10%">HP</th>
                        <th width="10%">Jurusan</th>
                        <th width="10%">Status</th>
                        <th width="10%">Jumlah</th>
                        <th width="10%">Tanggal</th>
                        <th width="12%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendaftar as $index => $item)
                    <tr>
                        <td class="text-center">{{ $pendaftar->firstItem() + $index }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="me-2">
                                    @if($item->dataSiswa && $item->dataSiswa->jk == 'L')
                                        <i class="fas fa-user-tie text-primary"></i>
                                    @else
                                        <i class="fas fa-user text-danger"></i>
                                    @endif
                                </div>
                                <div>
                                    <strong>{{ $item->dataSiswa->nama ?? ($item->user->name ?? 'Belum diisi') }}</strong>
                                    <br><small class="text-muted">{{ $item->no_pendaftaran }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <small>{{ Str::limit($item->email ?? ($item->user->email ?? '-'), 25) }}</small>
                        </td>
                        <td>
                            {{ $item->hp ?? '-' }}
                        </td>
                        <td>
                            @if($item->jurusan)
                                <span class="badge badge-primary">{{ $item->jurusan->nama }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($item->status_pembayaran == 'lunas')
                                <span class="badge badge-success">Lunas</span>
                            @else
                                <span class="badge badge-warning">Belum Bayar</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <strong>Rp {{ number_format($item->jumlah_bayar ?? 0, 0, ',', '.') }}</strong>
                        </td>
                        <td class="text-center">
                            @if($item->tanggal_bayar)
                                <small>{{ \Carbon\Carbon::parse($item->tanggal_bayar)->format('d/m/Y') }}</small>
                                <br><small class="text-muted">{{ \Carbon\Carbon::parse($item->tanggal_bayar)->format('H:i') }}</small>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group-vertical" role="group">
                                <a href="{{ route('admin.pendaftar.show', $item->id) }}" class="btn btn-info btn-sm mb-1">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <button class="btn btn-{{ $item->status_pembayaran == 'lunas' ? 'success' : 'warning' }} btn-sm" data-toggle="modal" data-target="#pembayaranModal{{ $item->id }}">
                                    <i class="fas fa-money-bill"></i> 
                                    {{ $item->status_pembayaran == 'lunas' ? 'Edit' : 'Bayar' }}
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Pembayaran -->
                    <div class="modal fade" id="pembayaranModal{{ $item->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Update Pembayaran</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="{{ route('admin.keuangan.update-pembayaran', $item->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="candidate-info mb-3 p-3 bg-light rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    @if($item->dataSiswa && $item->dataSiswa->jk == 'L')
                                                        <i class="fas fa-user-tie fa-2x text-primary"></i>
                                                    @else
                                                        <i class="fas fa-user fa-2x text-danger"></i>
                                                    @endif
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">{{ $item->dataSiswa->nama ?? ($item->user->name ?? 'Nama belum diisi') }}</h6>
                                                    <small class="text-muted d-block">{{ $item->no_pendaftaran }}</small>
                                                    <small class="text-muted">{{ $item->email ?? ($item->user->email ?? 'Email belum diisi') }}</small>
                                                </div>
                                            </div>
                                        </div>

                                        @if($item->jurusan)
                                        <div class="mb-3">
                                            <strong>Jurusan:</strong> <span class="badge badge-primary">{{ $item->jurusan->nama }}</span>
                                        </div>
                                        @endif

                                        <div class="current-status mb-3 p-2 border rounded">
                                            <strong>Status Saat Ini:</strong>
                                            @if($item->status_pembayaran == 'lunas')
                                                <span class="badge badge-success">Lunas</span>
                                                @if($item->jumlah_bayar)
                                                <br><small>Jumlah: Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</small>
                                                @endif
                                                @if($item->tanggal_bayar)
                                                <br><small>Tanggal: {{ \Carbon\Carbon::parse($item->tanggal_bayar)->format('d/m/Y H:i') }}</small>
                                                @endif
                                            @else
                                                <span class="badge badge-warning">Belum Bayar</span>
                                            @endif
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="font-weight-bold">Status Pembayaran</label>
                                            <select name="status_pembayaran" class="form-control" required>
                                                <option value="belum_bayar" {{ $item->status_pembayaran == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                                                <option value="lunas" {{ $item->status_pembayaran == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="font-weight-bold">Jumlah Bayar</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="number" name="jumlah_bayar" class="form-control" value="{{ $item->jumlah_bayar }}" placeholder="0" min="0">
                                            </div>
                                            <small class="text-muted">Biaya pendaftaran standar: Rp 500.000</small>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="font-weight-bold">Catatan Pembayaran</label>
                                            <textarea name="catatan_pembayaran" class="form-control" rows="3" placeholder="Metode pembayaran, nomor referensi, dll...">{{ $item->catatan_pembayaran }}</textarea>
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
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">Belum ada data pembayaran</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{ $pendaftar->links() }}
    </div>
</div>
@endsection