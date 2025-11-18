@extends('layouts.admin')

@section('title', 'Log Aktivitas')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Log Aktivitas</h1>
    <div class="text-right">
        <small class="text-muted">Total: {{ $logAktivitas->total() }} aktivitas</small>
    </div>
</div>

<!-- Statistik Singkat -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Login Hari Ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ \App\Models\LogAktivitas::where('aksi', 'LOGIN')->whereDate('waktu', today())->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-sign-in-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Aktivitas Hari Ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ \App\Models\LogAktivitas::whereDate('waktu', today())->count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">User Aktif</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ \App\Models\LogAktivitas::whereDate('waktu', today())->distinct('user_id')->count('user_id') }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Log</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ \App\Models\LogAktivitas::count() }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-database fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Filter Log Aktivitas</h6>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('admin.log-aktivitas.index') }}" class="row">
            <div class="col-md-4">
                <label for="aksi">Aksi:</label>
                <select name="aksi" id="aksi" class="form-control">
                    <option value="">Semua Aksi</option>
                    @foreach($aksiList as $aksi)
                        <option value="{{ $aksi }}" {{ request('aksi') == $aksi ? 'selected' : '' }}>
                            {{ $aksi }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="tanggal">Tanggal:</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ request('tanggal') }}">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary mr-2">Filter</button>
                <a href="{{ route('admin.log-aktivitas.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Log Aktivitas</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Waktu</th>
                        <th>Pengguna</th>
                        <th>Aksi</th>
                        <th>Objek</th>
                        <th>IP Address</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logAktivitas as $index => $log)
                        <tr>
                            <td>{{ $logAktivitas->firstItem() + $index }}</td>
                            <td>{{ $log->waktu->format('d/m/Y H:i:s') }}</td>
                            <td>
                                @if($log->user)
                                    <strong>{{ $log->user->name }}</strong><br>
                                    <small class="text-muted">{{ $log->user->email }}</small>
                                @else
                                    <span class="text-muted">Pengguna tidak ditemukan</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $badgeClass = 'secondary';
                                    $aksiLower = strtolower($log->aksi);
                                    if(str_contains($aksiLower, 'login')) $badgeClass = 'success';
                                    elseif(str_contains($aksiLower, 'logout')) $badgeClass = 'warning';
                                    elseif(str_contains($aksiLower, 'create')) $badgeClass = 'primary';
                                    elseif(str_contains($aksiLower, 'update')) $badgeClass = 'info';
                                    elseif(str_contains($aksiLower, 'delete')) $badgeClass = 'danger';
                                    elseif(str_contains($aksiLower, 'view')) $badgeClass = 'light text-dark';
                                @endphp
                                <span class="badge badge-{{ $badgeClass }}">{{ $log->aksi }}</span>
                            </td>
                            <td>{{ $log->objek }}</td>
                            <td><code>{{ $log->ip }}</code></td>
                            <td>
                                @if($log->objek_data && is_array($log->objek_data))
                                    <button class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#detailModal{{ $log->id }}">
                                        <i class="fas fa-eye"></i> Lihat
                                    </button>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>

                        @if($log->objek_data && is_array($log->objek_data))
                        <!-- Modal Detail -->
                        <div class="modal fade" id="detailModal{{ $log->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Aktivitas</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong>Waktu:</strong> {{ $log->waktu->format('d/m/Y H:i:s') }}
                                            </div>
                                            <div class="col-md-6">
                                                <strong>IP Address:</strong> {{ $log->ip }}
                                            </div>
                                        </div>
                                        <hr>
                                        <h6>Data Objek:</h6>
                                        <pre class="bg-light p-3 rounded">{{ json_encode($log->objek_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data log aktivitas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        "paging": true,
        "searching": true,
        "info": true,
        "pageLength": 25,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        }
    });
});
</script>
@endpush