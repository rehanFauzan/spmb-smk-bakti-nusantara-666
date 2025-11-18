@extends('layouts.admin')

@section('title', 'Verifikasi Pembayaran')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Verifikasi Pembayaran</h1>
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
                            <th>Nominal</th>
                            <th>Bukti Bayar</th>
                            <th>Tanggal Upload</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pembayaran as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->no_pendaftaran ?? 'N/A' }}</td>
                            <td>{{ $item->nama ?? $item->nama_user ?? 'N/A' }}</td>
                            <td>Rp {{ number_format($item->biaya_daftar ?? 0, 0, ',', '.') }}</td>
                            <td>
                                @php
                                    $buktiBayar = \DB::table('pendaftar_berkas')
                                        ->where('pendaftar_id', $item->id)
                                        ->where('jenis', 'BUKTI_BAYAR')
                                        ->first();
                                @endphp
                                @if($buktiBayar)
                                    <a href="{{ route('keuangan.view-berkas', [$item->id, $buktiBayar->id]) }}" target="_blank" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                @else
                                    <span class="text-muted">Belum upload</span>
                                @endif
                            </td>
                            <td>{{ $buktiBayar ? \Carbon\Carbon::parse($buktiBayar->created_at)->format('d/m/Y H:i') : '-' }}</td>
                            <td>
                                @if($item->status_pembayaran == 'APPROVED')
                                    <span class="badge badge-success">Terverifikasi</span>
                                @elseif($item->status_pembayaran == 'REJECTED')
                                    <span class="badge badge-danger">Ditolak</span>
                                @elseif($buktiBayar)
                                    <span class="badge badge-warning">Menunggu Verifikasi</span>
                                @else
                                    <span class="badge badge-secondary">Belum Bayar</span>
                                @endif
                            </td>
                            <td>
                                @if($buktiBayar && $item->status_pembayaran == 'PENDING')
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#verifikasiModal{{ $item->id }}">
                                        <i class="fas fa-check"></i> Verifikasi
                                    </button>
                                @elseif($item->status_pembayaran == 'APPROVED')
                                    <form action="{{ route('keuangan.reset-pembayaran', $item->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Reset status pembayaran?')">
                                            <i class="fas fa-undo"></i> Reset
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>

                        <!-- Modal Verifikasi -->
                        @if($buktiBayar && $item->status_pembayaran == 'PENDING')
                        <div class="modal fade" id="verifikasiModal{{ $item->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Verifikasi Pembayaran - {{ $item->nama ?? $item->nama_user }}</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Data Pembayaran:</h6>
                                                <p><strong>No. Pendaftaran:</strong> {{ $item->no_pendaftaran }}</p>
                                                <p><strong>Nama:</strong> {{ $item->nama ?? $item->nama_user }}</p>
                                                <p><strong>Jurusan:</strong> {{ $item->nama_jurusan }}</p>
                                                <p><strong>Gelombang:</strong> {{ $item->nama_gelombang }}</p>
                                                <p><strong>Biaya:</strong> Rp {{ number_format($item->biaya_daftar, 0, ',', '.') }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Bukti Pembayaran:</h6>
                                                <div class="text-center">
                                                    @php
                                                        $filePath = 'pembayaran/' . $item->user_id . '/' . $buktiBayar->nama_file;
                                                    @endphp
                                                    @if(file_exists(storage_path('app/public/' . $filePath)))
                                                        <img src="{{ asset('storage/' . $filePath) }}" 
                                                             class="img-fluid" style="max-height: 300px; cursor: pointer;" 
                                                             alt="Bukti Bayar"
                                                             onclick="window.open('{{ asset('storage/' . $filePath) }}', '_blank')">
                                                    @else
                                                        <div class="text-muted p-3">
                                                            <i class="fas fa-file-image fa-3x"></i><br>
                                                            <small>File tidak ditemukan</small>
                                                        </div>
                                                    @endif
                                                </div>
                                                <p class="mt-2"><strong>Catatan:</strong> {{ $buktiBayar->catatan ?? 'Tidak ada catatan' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('keuangan.update-status-pembayaran', $item->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="PAID">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-check"></i> Terima Pembayaran
                                            </button>
                                        </form>
                                        <form action="{{ route('keuangan.update-status-pembayaran', $item->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="REJECTED">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menolak pembayaran ini?')">
                                                <i class="fas fa-times"></i> Tolak Pembayaran
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada data pembayaran yang perlu diverifikasi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection