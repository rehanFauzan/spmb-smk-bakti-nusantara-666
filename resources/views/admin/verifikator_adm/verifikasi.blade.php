@extends('admin.layouts.app')

@section('title', 'Verifikasi Berkas')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Verifikasi Berkas</h1>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Pendaftar Menunggu Verifikasi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Nama & Email</th>
                        <th width="15%">Sekolah Asal</th>
                        <th width="10%">Nilai</th>
                        <th width="12%">Jurusan</th>
                        <th width="10%">Berkas</th>
                        <th width="12%">Tanggal Daftar</th>
                        <th width="16%">Aksi</th>
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
                                    <br><small class="text-muted">{{ Str::limit($item->email ?? ($item->user->email ?? '-'), 25) }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($item->asalSekolah)
                                <div>
                                    <strong>{{ Str::limit($item->asalSekolah->nama_sekolah, 25) }}</strong>
                                    <br><small class="text-muted">{{ $item->asalSekolah->kabupaten }}</small>
                                </div>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($item->asalSekolah && $item->asalSekolah->nilai_rata)
                                <span class="badge badge-{{ $item->asalSekolah->nilai_rata >= 80 ? 'success' : ($item->asalSekolah->nilai_rata >= 70 ? 'warning' : 'danger') }}">
                                    {{ number_format($item->asalSekolah->nilai_rata, 1) }}
                                </span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($item->jurusan)
                                <span class="badge badge-primary">{{ $item->jurusan->nama }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($item->berkas && $item->berkas->count() > 0)
                                <span class="badge badge-success">{{ $item->berkas->count() }}</span>
                                <br><small class="text-muted">{{ $item->berkas->where('valid', 1)->count() }} valid</small>
                            @else
                                <span class="badge badge-secondary">0</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <small>{{ $item->created_at->format('d/m/Y') }}</small>
                            <br><small class="text-muted">{{ $item->created_at->format('H:i') }}</small>
                        </td>
                        <td>
                            <div class="btn-group-vertical" role="group">
                                <a href="{{ route('admin.pendaftar.show', $item->id) }}" class="btn btn-info btn-sm mb-1">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#verifikasiModal{{ $item->id }}">
                                    <i class="fas fa-check"></i> Verifikasi
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Verifikasi -->
                    <div class="modal fade" id="verifikasiModal{{ $item->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Verifikasi Pendaftar</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="{{ route('admin.verifikasi.store', $item->id) }}">
                                    @csrf
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

                                        @if($item->asalSekolah)
                                        <div class="mb-3">
                                            <strong>Sekolah Asal:</strong> {{ $item->asalSekolah->nama_sekolah }}<br>
                                            @if($item->asalSekolah->nilai_rata)
                                            <strong>Nilai Rata-rata:</strong> 
                                            <span class="badge badge-{{ $item->asalSekolah->nilai_rata >= 80 ? 'success' : ($item->asalSekolah->nilai_rata >= 70 ? 'warning' : 'danger') }}">
                                                {{ number_format($item->asalSekolah->nilai_rata, 2) }}
                                            </span>
                                            @endif
                                        </div>
                                        @endif

                                        @if($item->berkas && $item->berkas->count() > 0)
                                        <div class="mb-3">
                                            <strong>Berkas ({{ $item->berkas->count() }}):</strong>
                                            <div class="mt-2">
                                                @foreach($item->berkas as $berkas)
                                                <span class="badge badge-{{ $berkas->valid ? 'success' : 'secondary' }} me-1 mb-1">
                                                    {{ $berkas->tipe_ijazah }}
                                                </span>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                        
                                        <div class="form-group">
                                            <label class="font-weight-bold">Status Verifikasi</label>
                                            <select name="status" class="form-control" required>
                                                <option value="">Pilih Status</option>
                                                <option value="diterima" class="text-success">✓ Diterima</option>
                                                <option value="ditolak" class="text-danger">✗ Ditolak</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="font-weight-bold">Catatan Verifikasi</label>
                                            <textarea name="catatan" class="form-control" rows="3" placeholder="Berikan catatan atau alasan verifikasi..."></textarea>
                                            <small class="text-muted">Catatan akan dilihat oleh pendaftar</small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan Verifikasi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada pendaftar yang menunggu verifikasi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{ $pendaftar->links() }}
    </div>
</div>
@endsection