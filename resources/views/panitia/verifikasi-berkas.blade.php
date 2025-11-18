@extends('layouts.admin')

@section('title', 'Verifikasi Berkas')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Verifikasi Berkas</h1>
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
                            <th>No. Pendaftaran</th>
                            <th>Nama Lengkap</th>
                            <th>Jurusan</th>
                            <th>Status Pembayaran</th>
                            <th>Status Berkas</th>
                            <th>Tanggal Upload</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendaftar as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->no_pendaftaran ?? 'N/A' }}</td>
                            <td>{{ $item->nama ?? $item->nama_user ?? 'N/A' }}</td>
                            <td>{{ $item->nama_jurusan ?? 'N/A' }}</td>
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
                                    <span class="badge badge-warning">Menunggu Verifikasi</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#verifikasiModal{{ $item->id }}">
                                        <i class="fas fa-check"></i> Verifikasi
                                    </button>
                                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#berkasModal{{ $item->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Verifikasi -->
                        <div class="modal fade" id="verifikasiModal{{ $item->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Verifikasi Berkas - {{ $item->nama ?? $item->nama_user }}</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('panitia.update-status-berkas', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Status Verifikasi</label>
                                                <select name="status_verifikasi" class="form-control" required>
                                                    <option value="">Pilih Status</option>
                                                    <option value="diterima" {{ $item->status_berkas == 'APPROVED' ? 'selected' : '' }}>Diterima</option>
                                                    <option value="ditolak" {{ $item->status_berkas == 'REJECTED' ? 'selected' : '' }}>Ditolak</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Catatan Verifikasi</label>
                                                <textarea name="catatan_verifikasi" class="form-control" rows="3" placeholder="Berikan catatan jika diperlukan"></textarea>
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

                        <!-- Modal Lihat Berkas -->
                        <div class="modal fade" id="berkasModal{{ $item->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Berkas Pendaftaran - {{ $item->nama ?? $item->nama_user }}</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Data Pendaftar:</h6>
                                                <p><strong>No. Pendaftaran:</strong> {{ $item->no_pendaftaran }}</p>
                                                <p><strong>Nama:</strong> {{ $item->nama ?? $item->nama_user }}</p>
                                                <p><strong>Jurusan:</strong> {{ $item->nama_jurusan }}</p>
                                                <p><strong>NIK:</strong> {{ $item->nik ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Status Berkas:</h6>
                                                <p><strong>Status:</strong> 
                                                    @if($item->status_berkas == 'APPROVED')
                                                        <span class="badge badge-success">Diterima</span>
                                                    @elseif($item->status_berkas == 'REJECTED')
                                                        <span class="badge badge-danger">Ditolak</span>
                                                    @else
                                                        <span class="badge badge-warning">Menunggu</span>
                                                    @endif
                                                </p>
                                                <p><strong>Tanggal Verifikasi:</strong> {{ $item->tgl_verifikasi_adm ? \Carbon\Carbon::parse($item->tgl_verifikasi_adm)->format('d/m/Y H:i') : 'Belum diverifikasi' }}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <h6>Berkas yang Diupload:</h6>
                                        <div class="row">
                                            @php
                                                $berkas = \DB::table('pendaftar_berkas')->where('pendaftar_id', $item->id)->get();
                                            @endphp
                                            @forelse($berkas as $file)
                                                <div class="col-md-6 mb-3">
                                                    <div class="card">
                                                        <div class="card-header p-2">
                                                            <small><strong>{{ ucfirst(strtolower($file->jenis)) }}</strong></small>
                                                        </div>
                                                        <div class="card-body p-2 text-center">
                                                            @php
                                                                $filePath = 'pendaftaran/' . $item->user_id . '/' . $file->nama_file;
                                                            @endphp
                                                            @if(file_exists(storage_path('app/public/' . $filePath)))
                                                                <img src="{{ asset('storage/' . $filePath) }}" 
                                                                     alt="{{ ucfirst(strtolower($file->jenis)) }}" 
                                                                     class="img-fluid" 
                                                                     style="max-height: 200px; cursor: pointer;"
                                                                     onclick="window.open('{{ asset('storage/' . $filePath) }}', '_blank')">
                                                            @else
                                                                <div class="text-muted p-3">
                                                                    <i class="fas fa-file-image fa-3x"></i><br>
                                                                    <small>File tidak ditemukan</small>
                                                                </div>
                                                            @endif
                                                            <div class="mt-2">
                                                                <small class="text-muted">{{ $file->ukuran_kb }} KB</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12">
                                                    <p class="text-muted">Belum ada berkas yang diupload</p>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada data yang perlu diverifikasi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection