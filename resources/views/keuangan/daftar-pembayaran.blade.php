@extends('layouts.admin')

@section('title', 'Daftar Pembayaran')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Pembayaran</h1>
    </div>

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
                            <th>Gelombang</th>
                            <th>Biaya</th>
                            <th>Status Pembayaran</th>
                            <th>Tanggal Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $pembayaran = \DB::table('pendaftar_data_siswa')
                                ->join('users', 'pendaftar_data_siswa.user_id', '=', 'users.id')
                                ->join('jurusan', 'pendaftar_data_siswa.jurusan_id', '=', 'jurusan.id')
                                ->join('gelombang', 'pendaftar_data_siswa.gelombang_id', '=', 'gelombang.id')
                                ->select(
                                    'pendaftar_data_siswa.*',
                                    'users.name as nama_user',
                                    'jurusan.nama_jurusan',
                                    'gelombang.nama as nama_gelombang',
                                    'gelombang.biaya_daftar'
                                )
                                ->orderBy('pendaftar_data_siswa.created_at', 'desc')
                                ->get();
                        @endphp
                        @foreach($pembayaran as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->no_pendaftaran ?? 'N/A' }}</td>
                            <td>{{ $item->nama ?? $item->nama_user ?? 'N/A' }}</td>
                            <td>{{ $item->nama_jurusan ?? 'N/A' }}</td>
                            <td>{{ $item->nama_gelombang ?? 'N/A' }}</td>
                            <td>Rp {{ number_format($item->biaya_daftar ?? 0, 0, ',', '.') }}</td>
                            <td>
                                @php
                                    $buktiBayar = \DB::table('pendaftar_berkas')
                                        ->where('pendaftar_id', $item->id)
                                        ->where('jenis', 'BUKTI_BAYAR')
                                        ->first();
                                @endphp
                                @if($item->status == 'PAID')
                                    <span class="badge badge-success">Lunas</span>
                                @elseif($buktiBayar && $item->tgl_verifikasi_payment && $item->status != 'PAID')
                                    <span class="badge badge-danger">Ditolak</span>
                                @elseif($buktiBayar)
                                    <span class="badge badge-warning">Menunggu Verifikasi</span>
                                @else
                                    <span class="badge badge-secondary">Belum Bayar</span>
                                @endif
                            </td>
                            <td>
                                @if($item->status == 'PAID' && $item->tgl_verifikasi_payment)
                                    {{ \Carbon\Carbon::parse($item->tgl_verifikasi_payment)->format('d/m/Y H:i') }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection