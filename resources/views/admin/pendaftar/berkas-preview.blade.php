@extends('admin.layouts.app')

@section('title', 'Preview Berkas')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Preview Berkas</h1>
    <a href="{{ route('admin.pendaftar.show', $pendaftar->id) }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-file me-2"></i>{{ $berkas->tipe_ijazah }} - {{ $berkas->nama_file }}
                </h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    @php
                        $fileExtension = strtolower(pathinfo($berkas->nama_file, PATHINFO_EXTENSION));
                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
                        $pdfExtensions = ['pdf'];
                    @endphp
                    
                    @if(in_array($fileExtension, $imageExtensions))
                        <img src="{{ route('admin.pendaftar.view-berkas', [$pendaftar->id, $berkas->id]) }}" 
                             class="img-fluid" 
                             style="max-height: 600px; border: 1px solid #ddd; border-radius: 8px;">
                    @elseif(in_array($fileExtension, $pdfExtensions))
                        <iframe src="{{ route('admin.pendaftar.view-berkas', [$pendaftar->id, $berkas->id]) }}" 
                                width="100%" 
                                height="600px" 
                                style="border: 1px solid #ddd; border-radius: 8px;">
                        </iframe>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                            <h5>File tidak dapat di-preview</h5>
                            <p>Silakan download file untuk melihat isinya.</p>
                            <a href="{{ route('admin.pendaftar.view-berkas', [$pendaftar->id, $berkas->id]) }}" 
                               class="btn btn-primary" download>
                                <i class="fas fa-download"></i> Download File
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Berkas</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Jenis:</strong></td>
                        <td><span class="badge badge-secondary">{{ $berkas->tipe_ijazah }}</span></td>
                    </tr>
                    <tr>
                        <td><strong>Nama File:</strong></td>
                        <td>{{ $berkas->nama_file }}</td>
                    </tr>
                    <tr>
                        <td><strong>Ukuran:</strong></td>
                        <td>{{ number_format($berkas->ukuran_kb) }} KB</td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            @if($berkas->valid)
                                <span class="badge badge-success">Valid</span>
                            @else
                                <span class="badge badge-warning">Belum Diverifikasi</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Diupload:</strong></td>
                        <td>{{ $berkas->created_at->format('d F Y, H:i') }} WIB</td>
                    </tr>
                    @if($berkas->catatan)
                    <tr>
                        <td><strong>Catatan:</strong></td>
                        <td>{{ $berkas->catatan }}</td>
                    </tr>
                    @endif
                </table>
                
                <div class="mt-3">
                    <a href="{{ route('admin.pendaftar.view-berkas', [$pendaftar->id, $berkas->id]) }}" 
                       class="btn btn-primary btn-block" target="_blank">
                        <i class="fas fa-external-link-alt"></i> Buka di Tab Baru
                    </a>
                    <a href="{{ route('admin.pendaftar.view-berkas', [$pendaftar->id, $berkas->id]) }}" 
                       class="btn btn-success btn-block mt-2" download>
                        <i class="fas fa-download"></i> Download File
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Pendaftar</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Nama:</strong></td>
                        <td>{{ $pendaftar->dataSiswa->nama ?? ($pendaftar->user->name ?? 'Belum diisi') }}</td>
                    </tr>
                    <tr>
                        <td><strong>No. Pendaftaran:</strong></td>
                        <td>{{ $pendaftar->no_pendaftaran }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td>{{ $pendaftar->email ?? ($pendaftar->user->email ?? '-') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jurusan:</strong></td>
                        <td>
                            @if($pendaftar->jurusan)
                                <span class="badge badge-primary">{{ $pendaftar->jurusan->nama }}</span>
                            @else
                                <span class="text-muted">Belum dipilih</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection