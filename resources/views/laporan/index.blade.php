@extends('layouts.admin')

@section('title', 'Cetak Laporan')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cetak Laporan</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Filter Laporan Pendaftar</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('laporan.export') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jurusan</label>
                                    <select name="jurusan" class="form-control">
                                        <option value="">Semua Jurusan</option>
                                        @foreach(\App\Models\Jurusan::all() as $jurusan)
                                        <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gelombang</label>
                                    <select name="gelombang" class="form-control">
                                        <option value="">Semua Gelombang</option>
                                        @foreach(\App\Models\Gelombang::all() as $gelombang)
                                        <option value="{{ $gelombang->id }}">{{ $gelombang->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="">Semua Status</option>
                                        <option value="SUBMIT">Baru Submit</option>
                                        <option value="ADM_PASS">Berkas Diterima</option>
                                        <option value="PAID">Sudah Bayar</option>
                                        <option value="ADM_REJECT">Ditolak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Format</label>
                                    <select name="format" class="form-control" required>
                                        <option value="excel">Excel (.csv)</option>
                                        <option value="pdf">PDF</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Periode Dari</label>
                                    <input type="date" name="periode_dari" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Periode Sampai</label>
                                    <input type="date" name="periode_sampai" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-download"></i> Export Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection