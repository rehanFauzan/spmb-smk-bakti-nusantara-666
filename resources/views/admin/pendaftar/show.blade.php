@extends('admin.layouts.app')

@section('title', 'Detail Pendaftar')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Pendaftar</h1>
    <a href="{{ route('admin.pendaftar.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">
    <div class="col-lg-8">
        <!-- Header Info Card -->
        <div class="card shadow mb-4 border-left-primary">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="avatar-lg">
                            @if($pendaftar->dataSiswa && $pendaftar->dataSiswa->jk == 'L')
                                <i class="fas fa-user-tie fa-3x text-primary"></i>
                            @else
                                <i class="fas fa-user fa-3x text-primary"></i>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <h4 class="mb-1">{{ $pendaftar->dataSiswa->nama ?? ($pendaftar->user->name ?? 'Nama Belum Diisi') }}</h4>
                        <p class="text-muted mb-1">
                            <i class="fas fa-id-card me-2"></i>No. Pendaftaran: <strong>{{ $pendaftar->no_pendaftaran }}</strong>
                        </p>
                        <p class="text-muted mb-0">
                            <i class="fas fa-calendar me-2"></i>Tanggal Daftar: {{ $pendaftar->created_at->format('d F Y, H:i') }} WIB
                        </p>
                    </div>
                    <div class="col-auto">
                        @if($pendaftar->status_verifikasi == 'menunggu')
                            <span class="badge badge-warning badge-lg px-3 py-2">Menunggu Verifikasi</span>
                        @elseif($pendaftar->status_verifikasi == 'diterima')
                            <span class="badge badge-success badge-lg px-3 py-2">Diterima</span>
                        @else
                            <span class="badge badge-danger badge-lg px-3 py-2">Ditolak</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user me-2"></i>Data Pribadi</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th width="20%">Field</th>
                                <th width="80%">Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-weight-bold">Nama Lengkap</td>
                                <td>{{ $pendaftar->dataSiswa->nama ?? ($pendaftar->user->name ?? '-') }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">NIK</td>
                                <td>{{ $pendaftar->dataSiswa->nik ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Jenis Kelamin</td>
                                <td>
                                    @if($pendaftar->dataSiswa && $pendaftar->dataSiswa->jk)
                                        {{ $pendaftar->dataSiswa->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                        <i class="fas fa-{{ $pendaftar->dataSiswa->jk == 'L' ? 'mars' : 'venus' }} ms-2 text-{{ $pendaftar->dataSiswa->jk == 'L' ? 'primary' : 'danger' }}"></i>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tempat Lahir</td>
                                <td>{{ $pendaftar->dataSiswa->tmp_lahir ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tanggal Lahir</td>
                                <td>
                                    @if($pendaftar->dataSiswa && $pendaftar->dataSiswa->tmp_lahir)
                                        {{ \Carbon\Carbon::parse($pendaftar->dataSiswa->tmp_lahir)->format('d F Y') }}
                                        <small class="text-muted">({{ \Carbon\Carbon::parse($pendaftar->dataSiswa->tmp_lahir)->age }} tahun)</small>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Email</td>
                                <td>
                                    <a href="mailto:{{ $pendaftar->email ?? ($pendaftar->user->email ?? '') }}" class="text-decoration-none">
                                        {{ $pendaftar->email ?? ($pendaftar->user->email ?? '-') }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">No. HP</td>
                                <td>
                                    @if($pendaftar->hp)
                                        <a href="tel:{{ $pendaftar->hp }}" class="text-decoration-none">{{ $pendaftar->hp }}</a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Alamat</td>
                                <td>{{ $pendaftar->dataSiswa->alamat ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Wilayah</td>
                                <td>{{ $pendaftar->dataSiswa->wilayah->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Koordinat</td>
                                <td>
                                    @if($pendaftar->dataSiswa && $pendaftar->dataSiswa->lat && $pendaftar->dataSiswa->lng)
                                        {{ $pendaftar->dataSiswa->lat }}, {{ $pendaftar->dataSiswa->lng }}
                                        <a href="https://maps.google.com/?q={{ $pendaftar->dataSiswa->lat }},{{ $pendaftar->dataSiswa->lng }}" target="_blank" class="btn btn-sm btn-outline-primary ms-2">
                                            <i class="fas fa-map-marker-alt"></i> Lihat Map
                                        </a>
                                        <button type="button" class="btn btn-sm btn-primary ms-1" onclick="showLocationModal()">
                                            <i class="fas fa-map"></i> Lihat Lokasi
                                        </button>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-school me-2"></i>Data Sekolah Asal</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th width="20%">Field</th>
                                <th width="80%">Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-weight-bold">NPSN</td>
                                <td>{{ $pendaftar->asalSekolah->npsn ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Nama Sekolah</td>
                                <td>{{ $pendaftar->asalSekolah->nama_sekolah ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Kabupaten</td>
                                <td>{{ $pendaftar->asalSekolah->kabupaten ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Nilai Rata-rata</td>
                                <td>
                                    @if($pendaftar->asalSekolah && $pendaftar->asalSekolah->nilai_rata)
                                        <span class="badge badge-{{ $pendaftar->asalSekolah->nilai_rata >= 80 ? 'success' : ($pendaftar->asalSekolah->nilai_rata >= 70 ? 'warning' : 'danger') }} px-3 py-2">
                                            {{ number_format($pendaftar->asalSekolah->nilai_rata, 2) }}
                                        </span>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Data Orang Tua -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-users me-2"></i>Data Orang Tua / Wali</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th width="20%">Field</th>
                                <th width="80%">Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-weight-bold">Nama Ayah</td>
                                <td>{{ $pendaftar->dataOrtu->nama_ayah ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Pekerjaan Ayah</td>
                                <td>{{ $pendaftar->dataOrtu->pekerjaan_ayah ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">No. HP Ayah</td>
                                <td>
                                    @if($pendaftar->dataOrtu && $pendaftar->dataOrtu->no_ayah)
                                        <a href="tel:{{ $pendaftar->dataOrtu->no_ayah }}">{{ $pendaftar->dataOrtu->no_ayah }}</a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Nama Ibu</td>
                                <td>{{ $pendaftar->dataOrtu->nama_ibu ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Pekerjaan Ibu</td>
                                <td>{{ $pendaftar->dataOrtu->pekerjaan_ibu ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">No. HP Ibu</td>
                                <td>
                                    @if($pendaftar->dataOrtu && $pendaftar->dataOrtu->no_ibu)
                                        <a href="tel:{{ $pendaftar->dataOrtu->no_ibu }}">{{ $pendaftar->dataOrtu->no_ibu }}</a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Nama Wali</td>
                                <td>{{ $pendaftar->dataOrtu->nama_wali ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Pekerjaan Wali</td>
                                <td>{{ $pendaftar->dataOrtu->pekerjaan_wali ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">No. HP Wali</td>
                                <td>
                                    @if($pendaftar->dataOrtu && $pendaftar->dataOrtu->no_wali)
                                        <a href="tel:{{ $pendaftar->dataOrtu->no_wali }}">{{ $pendaftar->dataOrtu->no_wali }}</a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Data Berkas -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-folder-open me-2"></i>Berkas Pendaftaran</h6>
            </div>
            <div class="card-body">
                @if($pendaftar->berkas && $pendaftar->berkas->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>Jenis Berkas</th>
                                <th>Nama File</th>
                                <th>Ukuran</th>
                                <th>Status</th>
                                <th>Catatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendaftar->berkas as $berkas)
                            <tr>
                                <td>
                                    <span class="badge badge-secondary">{{ $berkas->tipe_ijazah }}</span>
                                </td>
                                <td>{{ $berkas->nama_file }}</td>
                                <td>{{ number_format($berkas->ukuran_kb) }} KB</td>
                                <td>
                                    @if($berkas->valid)
                                        <span class="badge badge-success">Valid</span>
                                    @else
                                        <span class="badge badge-warning">Belum Diverifikasi</span>
                                    @endif
                                </td>
                                <td>{{ $berkas->catatan ?? '-' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.pendaftar.preview-berkas', [$pendaftar->id, $berkas->id]) }}" 
                                           class="btn btn-sm btn-info">
                                            <i class="fas fa-search"></i> Preview
                                        </a>
                                        <a href="{{ route('admin.pendaftar.view-berkas', [$pendaftar->id, $berkas->id]) }}" 
                                           target="_blank" 
                                           class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center text-muted py-4">
                    <i class="fas fa-folder-open fa-3x mb-3"></i>
                    <p>Belum ada berkas yang diupload</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Status Verifikasi</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.pendaftar.update-status', $pendaftar->id) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label>Status Saat Ini</label>
                        <div>
                            @if($pendaftar->status_verifikasi == 'menunggu')
                                <span class="badge badge-warning badge-lg">Menunggu Verifikasi</span>
                            @elseif($pendaftar->status_verifikasi == 'diterima')
                                <span class="badge badge-success badge-lg">Diterima</span>
                            @else
                                <span class="badge badge-danger badge-lg">Ditolak</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Ubah Status</label>
                        <select name="status_verifikasi" class="form-control" required>
                            <option value="menunggu" {{ $pendaftar->status_verifikasi == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="diterima" {{ $pendaftar->status_verifikasi == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="ditolak" {{ $pendaftar->status_verifikasi == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Catatan verifikasi (opsional)">{{ $pendaftar->catatan_verifikasi }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-save"></i> Update Status
                    </button>
                </form>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Pendaftaran</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th width="20%">Field</th>
                                <th width="80%">Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-weight-bold">Jurusan Pilihan</td>
                                <td>
                                    @if($pendaftar->jurusan)
                                        <span class="badge badge-primary px-3 py-2">{{ $pendaftar->jurusan->nama }}</span>
                                    @else
                                        <span class="text-muted">Belum dipilih</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Gelombang</td>
                                <td>
                                    @if($pendaftar->gelombang)
                                        {{ $pendaftar->gelombang->nama }}
                                        <small class="text-muted">({{ $pendaftar->gelombang->tanggal_mulai }} - {{ $pendaftar->gelombang->tanggal_selesai }})</small>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tanggal Daftar</td>
                                <td>{{ $pendaftar->created_at->format('d F Y, H:i') }} WIB</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Status Pembayaran</td>
                                <td>
                                    @if($pendaftar->status_pembayaran == 'lunas')
                                        <span class="badge badge-success px-3 py-2">
                                            <i class="fas fa-check-circle me-1"></i>Lunas
                                        </span>
                                    @else
                                        <span class="badge badge-warning px-3 py-2">
                                            <i class="fas fa-clock me-1"></i>Belum Lunas
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Jumlah Bayar</td>
                                <td>
                                    @if($pendaftar->jumlah_bayar)
                                        Rp {{ number_format($pendaftar->jumlah_bayar, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tanggal Bayar</td>
                                <td>
                                    @if($pendaftar->tanggal_bayar)
                                        {{ \Carbon\Carbon::parse($pendaftar->tanggal_bayar)->format('d F Y, H:i') }} WIB
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            @if($pendaftar->catatan_verifikasi)
                            <tr>
                                <td class="font-weight-bold">Catatan Verifikasi</td>
                                <td>
                                    <div class="alert alert-info mb-0">
                                        <i class="fas fa-info-circle me-2"></i>{{ $pendaftar->catatan_verifikasi }}
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @if($pendaftar->catatan_pembayaran)
                            <tr>
                                <td class="font-weight-bold">Catatan Pembayaran</td>
                                <td>{{ $pendaftar->catatan_pembayaran }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Maps -->
@if($pendaftar->dataSiswa && $pendaftar->dataSiswa->lat && $pendaftar->dataSiswa->lng)
<div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="locationModalLabel">
                    <i class="fas fa-map-marker-alt me-2"></i>Lokasi Tempat Tinggal - {{ $pendaftar->dataSiswa->nama }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <strong>Alamat:</strong> {{ $pendaftar->dataSiswa->alamat }}<br>
                            <strong>Koordinat:</strong> {{ $pendaftar->dataSiswa->lat }}, {{ $pendaftar->dataSiswa->lng }}
                        </div>
                    </div>
                </div>
                <div id="adminMap" style="height: 400px; border-radius: 8px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <a href="https://maps.google.com/?q={{ $pendaftar->dataSiswa->lat }},{{ $pendaftar->dataSiswa->lng }}" target="_blank" class="btn btn-primary">
                    <i class="fas fa-external-link-alt me-1"></i>Buka di Google Maps
                </a>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/maps.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dw901SwHHqfeWM&libraries=places" async defer></script>
<script>
// Set data for admin map
document.addEventListener('DOMContentLoaded', function() {
    const adminMapElement = document.getElementById('adminMap');
    if (adminMapElement) {
        adminMapElement.dataset.lat = '{{ $pendaftar->dataSiswa->lat }}';
        adminMapElement.dataset.lng = '{{ $pendaftar->dataSiswa->lng }}';
        adminMapElement.dataset.nama = '{{ $pendaftar->dataSiswa->nama }}';
        adminMapElement.dataset.noPendaftaran = '{{ $pendaftar->no_pendaftaran }}';
        adminMapElement.dataset.alamat = '{{ $pendaftar->dataSiswa->alamat }}';
    }
});
</script>
@endif
@endsection