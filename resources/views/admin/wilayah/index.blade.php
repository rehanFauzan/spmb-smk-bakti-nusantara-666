@extends('layouts.admin')

@section('title', 'Analisis Wilayah Pendaftar')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Analisis Wilayah Pendaftar</h1>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pendaftar</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPendaftar }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Dengan Lokasi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $denganLokasi }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-map-marker-alt fa-2x text-gray-300"></i>
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
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Radius 10km</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $radius10km }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-circle fa-2x text-gray-300"></i>
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
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Radius >20km</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $radius20km }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Peta Utama -->
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Peta Sebaran Pendaftar</h6>
                <div class="dropdown no-arrow">
                    <button class="btn btn-sm btn-outline-primary" onclick="toggleHeatmap()">
                        <i class="fas fa-fire"></i> Toggle Heatmap
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div id="mainMap" style="height: 500px; border-radius: 8px;"></div>
            </div>
        </div>
    </div>

    <!-- Statistik Wilayah -->
    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Statistik per Wilayah</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Kecamatan</th>
                                <th class="text-center">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($statistikWilayah as $wilayah)
                            <tr>
                                <td>{{ $wilayah->kecamatan ?? 'Tidak Diketahui' }}</td>
                                <td class="text-center">
                                    <span class="badge badge-primary">{{ $wilayah->total }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Statistik per Jurusan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Jurusan</th>
                                <th class="text-center">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($statistikJurusan as $jurusan)
                            <tr>
                                <td>{{ $jurusan->nama ?? 'Belum Dipilih' }}</td>
                                <td class="text-center">
                                    <span class="badge badge-success">{{ $jurusan->total }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter dan Export -->
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Filter dan Export Data</h6>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.wilayah.index') }}" class="row">
                    <div class="col-md-3">
                        <label class="form-label">Status Verifikasi</label>
                        <select name="status" class="form-control">
                            <option value="">Semua Status</option>
                            <option value="SUBMIT" {{ request('status') == 'SUBMIT' ? 'selected' : '' }}>Baru Submit</option>
                            <option value="ADM_PASS" {{ request('status') == 'ADM_PASS' ? 'selected' : '' }}>Berkas Diterima</option>
                            <option value="ADM_REJECT" {{ request('status') == 'ADM_REJECT' ? 'selected' : '' }}>Berkas Ditolak</option>
                            <option value="VERIFY" {{ request('status') == 'VERIFY' ? 'selected' : '' }}>Sudah Bayar</option>
                            <option value="PAID" {{ request('status') == 'PAID' ? 'selected' : '' }}>Sudah Bayar (PAID)</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Jurusan</label>
                        <select name="jurusan" class="form-control">
                            <option value="">Semua Jurusan</option>
                            @foreach($allJurusan as $j)
                            <option value="{{ $j->id }}" {{ request('jurusan') == $j->id ? 'selected' : '' }}>{{ $j->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Radius dari Sekolah</label>
                        <select name="radius" class="form-control">
                            <option value="">Semua Jarak</option>
                            <option value="5" {{ request('radius') == '5' ? 'selected' : '' }}>< 5 km</option>
                            <option value="10" {{ request('radius') == '10' ? 'selected' : '' }}>< 10 km</option>
                            <option value="20" {{ request('radius') == '20' ? 'selected' : '' }}>< 20 km</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                            <a href="{{ route('admin.wilayah.export') }}" class="btn btn-success">
                                <i class="fas fa-download"></i> Export
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
let mainMap;
let markers = [];
let heatmapLayer;
let showingHeatmap = false;

// Data lokasi pendaftar
const pendaftarData = [
    @foreach($pendaftarLokasi as $item)
    {
        lat: {{ $item->lat }},
        lng: {{ $item->lng }},
        nama: '{{ addslashes($item->nama) }}',
        no_pendaftaran: '{{ $item->no_pendaftaran }}',
        alamat: '{{ addslashes($item->alamat) }}',
        jurusan: '{{ addslashes($item->jurusan_nama ?? "Belum dipilih") }}',
        status: '{{ $item->status_verifikasi }}',
        jarak: {{ $item->jarak ?? 0 }}
    },
    @endforeach
];

// Lokasi sekolah
const sekolahLocation = [-6.941352993058663, 107.73772907439879];

function initMainMap() {
    // Initialize map
    mainMap = L.map('mainMap').setView(sekolahLocation, 12);
    
    // Add tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(mainMap);
    
    // Add school marker
    const schoolIcon = L.divIcon({
        html: '<i class="fas fa-school" style="color: #007bff; font-size: 20px;"></i>',
        iconSize: [30, 30],
        className: 'custom-div-icon'
    });
    
    L.marker(sekolahLocation, { icon: schoolIcon })
        .addTo(mainMap)
        .bindPopup('<strong>SMK Bakti Nusantara 666</strong><br>Lokasi Sekolah')
        .openPopup();
    
    // Add radius circles
    L.circle(sekolahLocation, { radius: 5000, color: 'blue', fillOpacity: 0.1 }).addTo(mainMap);
    L.circle(sekolahLocation, { radius: 10000, color: 'orange', fillOpacity: 0.1 }).addTo(mainMap);
    L.circle(sekolahLocation, { radius: 20000, color: 'red', fillOpacity: 0.1 }).addTo(mainMap);
    
    // Add student markers
    addStudentMarkers();
    
    // Add legend
    addLegend();
}

function addStudentMarkers() {
    pendaftarData.forEach(student => {
        const markerColor = getMarkerColor(student.status);
        
        const marker = L.circleMarker([student.lat, student.lng], {
            color: markerColor.border,
            fillColor: markerColor.fill,
            fillOpacity: 0.8,
            radius: 6,
            weight: 2
        }).addTo(mainMap);
        
        const popupContent = `
            <div style="min-width: 200px;">
                <h6><strong>${student.nama}</strong></h6>
                <p><strong>No:</strong> ${student.no_pendaftaran}</p>
                <p><strong>Jurusan:</strong> ${student.jurusan}</p>
                <p><strong>Status:</strong> <span class="badge badge-${getStatusBadge(student.status)}">${getStatusText(student.status)}</span></p>
                <p><strong>Jarak:</strong> ${student.jarak.toFixed(1)} km dari sekolah</p>
                <p><strong>Alamat:</strong> ${student.alamat}</p>
            </div>
        `;
        
        marker.bindPopup(popupContent);
        markers.push(marker);
    });
}

function getMarkerColor(status) {
    switch(status) {
        case 'ADM_PASS': return { fill: '#28a745', border: '#1e7e34' }; // Hijau - Berkas Diterima
        case 'VERIFY':
        case 'PAID': return { fill: '#17a2b8', border: '#138496' }; // Biru - Sudah Bayar
        case 'ADM_REJECT': return { fill: '#dc3545', border: '#c82333' }; // Merah - Ditolak
        case 'SUBMIT': return { fill: '#ffc107', border: '#e0a800' }; // Kuning - Baru Submit
        default: return { fill: '#6c757d', border: '#545b62' }; // Abu-abu - Status lain
    }
}

function getStatusBadge(status) {
    switch(status) {
        case 'ADM_PASS': return 'success';
        case 'VERIFY':
        case 'PAID': return 'info';
        case 'ADM_REJECT': return 'danger';
        case 'SUBMIT': return 'warning';
        default: return 'secondary';
    }
}

function getStatusText(status) {
    switch(status) {
        case 'ADM_PASS': return 'Berkas Diterima';
        case 'VERIFY':
        case 'PAID': return 'Sudah Bayar';
        case 'ADM_REJECT': return 'Berkas Ditolak';
        case 'SUBMIT': return 'Baru Submit';
        default: return 'Status Tidak Diketahui';
    }
}

function addLegend() {
    const legend = L.control({ position: 'bottomright' });
    
    legend.onAdd = function(map) {
        const div = L.DomUtil.create('div', 'legend');
        div.style.backgroundColor = 'white';
        div.style.padding = '10px';
        div.style.border = '2px solid #ccc';
        div.style.borderRadius = '5px';
        div.style.fontSize = '12px';
        
        div.innerHTML = `
            <h6><strong>Keterangan</strong></h6>
            <div><i class="fas fa-school" style="color: #007bff;"></i> Sekolah</div>
            <div><span style="color: #ffc107;">●</span> Baru Submit</div>
            <div><span style="color: #28a745;">●</span> Berkas Diterima</div>
            <div><span style="color: #17a2b8;">●</span> Sudah Bayar</div>
            <div><span style="color: #dc3545;">●</span> Berkas Ditolak</div>
            <hr>
            <div><span style="color: blue;">○</span> Radius 5km</div>
            <div><span style="color: orange;">○</span> Radius 10km</div>
            <div><span style="color: red;">○</span> Radius 20km</div>
        `;
        
        return div;
    };
    
    legend.addTo(mainMap);
}

function toggleHeatmap() {
    // Placeholder for heatmap functionality
    alert('Fitur heatmap akan segera tersedia!');
}

// Initialize map when page loads
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(initMainMap, 500);
});
</script>

<style>
.custom-div-icon {
    background: transparent;
    border: none;
}
</style>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
.custom-div-icon {
    background: transparent;
    border: none;
}
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>