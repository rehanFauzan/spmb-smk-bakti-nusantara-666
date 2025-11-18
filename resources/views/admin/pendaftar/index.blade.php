@extends('admin.layouts.app')

@section('title', 'Data Pendaftar')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Pendaftar</h1>
    <button class="btn btn-primary" onclick="showLocationMapModal()">
        <i class="fas fa-map-marked-alt me-2"></i>Peta Sebaran Lokasi
    </button>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Calon Siswa</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="10%">No. Pendaftaran</th>
                        <th width="15%">Nama</th>
                        <th width="8%">Gender</th>
                        <th width="12%">Email</th>
                        <th width="8%">HP</th>
                        <th width="10%">Jurusan</th>
                        <th width="7%">Nilai</th>
                        <th width="8%">Status Verifikasi</th>
                        <th width="8%">Status Pembayaran</th>
                        <th width="4%">Berkas</th>
                        <th width="5%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendaftar as $index => $item)
                    <tr>
                        <td class="text-center">{{ $pendaftar->firstItem() + $index }}</td>
                        <td class="text-center">
                            <strong>{{ $item->no_pendaftaran }}</strong>
                        </td>
                        <td>
                            <strong>{{ $item->dataSiswa->nama ?? ($item->user->name ?? 'Belum diisi') }}</strong>
                        </td>
                        <td class="text-center">
                            @if($item->dataSiswa && $item->dataSiswa->jk)
                                {{ $item->dataSiswa->jk == 'L' ? 'L' : 'P' }}
                            @else
                                -
                            @endif
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
                            @if($item->asalSekolah && $item->asalSekolah->nilai_rata)
                                <span class="badge badge-{{ $item->asalSekolah->nilai_rata >= 80 ? 'success' : ($item->asalSekolah->nilai_rata >= 70 ? 'warning' : 'danger') }}">
                                    {{ number_format($item->asalSekolah->nilai_rata, 1) }}
                                </span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($item->status_verifikasi == 'menunggu')
                                <span class="badge badge-warning">Menunggu</span>
                            @elseif($item->status_verifikasi == 'diterima')
                                <span class="badge badge-success">Diterima</span>
                            @else
                                <span class="badge badge-danger">Ditolak</span>
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
                            @if($item->berkas && $item->berkas->count() > 0)
                                <span class="badge badge-success">{{ $item->berkas->count() }}</span>
                            @else
                                <span class="badge badge-secondary">0</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group-vertical" role="group">
                                <a href="{{ route('admin.pendaftar.show', $item->id) }}" class="btn btn-info btn-sm mb-1">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                @if($item->berkas && $item->berkas->count() > 0)
                                <button class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#berkasModal{{ $item->id }}">
                                    <i class="fas fa-folder-open"></i> Berkas
                                </button>
                                @endif
                                @if($item->status_verifikasi == 'menunggu')
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#quickVerifyModal{{ $item->id }}">
                                    <i class="fas fa-check"></i> Verifikasi
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>

                    @if($item->berkas && $item->berkas->count() > 0)
                    <!-- Berkas Modal -->
                    <div class="modal fade" id="berkasModal{{ $item->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title">
                                        <i class="fas fa-folder-open me-2"></i>Berkas - {{ $item->dataSiswa->nama ?? ($item->user->name ?? 'Nama belum diisi') }}
                                    </h6>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-sm">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Jenis</th>
                                                    <th>File</th>
                                                    <th>Ukuran</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($item->berkas as $berkas)
                                                <tr>
                                                    <td><span class="badge badge-secondary">{{ $berkas->tipe_ijazah }}</span></td>
                                                    <td>{{ Str::limit($berkas->nama_file, 30) }}</td>
                                                    <td>{{ number_format($berkas->ukuran_kb) }} KB</td>
                                                    <td>
                                                        @if($berkas->valid)
                                                            <span class="badge badge-success">Valid</span>
                                                        @else
                                                            <span class="badge badge-warning">Belum Diverifikasi</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('admin.pendaftar.preview-berkas', [$item->id, $berkas->id]) }}" 
                                                               class="btn btn-sm btn-info">
                                                                <i class="fas fa-search"></i>
                                                            </a>
                                                            <a href="{{ route('admin.pendaftar.view-berkas', [$item->id, $berkas->id]) }}" 
                                                               target="_blank" 
                                                               class="btn btn-sm btn-primary">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($item->status_verifikasi == 'menunggu')
                    <!-- Quick Verify Modal -->
                    <div class="modal fade" id="quickVerifyModal{{ $item->id }}" tabindex="-1">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title">Verifikasi Cepat</h6>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="{{ route('admin.pendaftar.update-status', $item->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <p class="mb-2"><strong>{{ $item->dataSiswa->nama ?? ($item->user->name ?? 'Nama belum diisi') }}</strong></p>
                                        <div class="form-group">
                                            <select name="status_verifikasi" class="form-control" required>
                                                <option value="diterima">Terima</option>
                                                <option value="ditolak">Tolak</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="catatan" class="form-control" rows="2" placeholder="Catatan (opsional)"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif

                    @empty
                    <tr>
                        <td colspan="12" class="text-center py-4">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada data pendaftar</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{ $pendaftar->links() }}
    </div>
</div>

<!-- Modal Peta Sebaran Lokasi -->
<div class="modal fade" id="locationMapModal" tabindex="-1" role="dialog" aria-labelledby="locationMapModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="locationMapModalLabel">
                    <i class="fas fa-map-marked-alt me-2"></i>Peta Sebaran Lokasi Pendaftar
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Total Pendaftar dengan Lokasi:</strong> <span id="totalWithLocation">0</span> dari {{ $pendaftar->total() }} pendaftar
                        </div>
                    </div>
                </div>
                <div id="aggregateMap" style="height: 500px; border-radius: 8px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
let aggregateMap;
let markers = [];

// Data lokasi pendaftar
window.pendaftarLocations = [
    @foreach($pendaftar as $item)
        @if($item->dataSiswa && $item->dataSiswa->lat && $item->dataSiswa->lng)
        {
            lat: {{ $item->dataSiswa->lat }},
            lng: {{ $item->dataSiswa->lng }},
            nama: '{{ addslashes($item->dataSiswa->nama ?? ($item->user->name ?? "Nama belum diisi")) }}',
            no_pendaftaran: '{{ $item->no_pendaftaran }}',
            alamat: '{{ addslashes($item->dataSiswa->alamat ?? "-") }}',
            jurusan: '{{ addslashes($item->jurusan->nama ?? "Belum dipilih") }}',
            status: '{{ $item->status_verifikasi }}'
        },
        @endif
    @endforeach
];

function showLocationMapModal() {
    $('#locationMapModal').modal('show');
    $('#locationMapModal').on('shown.bs.modal', function () {
        initAggregateMap();
    });
}

function initAggregateMap() {
    if (aggregateMap) {
        aggregateMap.remove();
    }
    
    // Initialize map
    aggregateMap = L.map('aggregateMap').setView([-6.9175, 107.6191], 11);
    
    // Add tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(aggregateMap);
    
    // Clear existing markers
    markers.forEach(marker => aggregateMap.removeLayer(marker));
    markers = [];
    
    if (window.pendaftarLocations && window.pendaftarLocations.length > 0) {
        document.getElementById('totalWithLocation').textContent = window.pendaftarLocations.length;
        
        const bounds = L.latLngBounds();
        
        window.pendaftarLocations.forEach((location) => {
            const markerColor = getMarkerColor(location.status);
            
            const marker = L.circleMarker([location.lat, location.lng], {
                color: markerColor.border,
                fillColor: markerColor.fill,
                fillOpacity: 0.8,
                radius: 8,
                weight: 2
            }).addTo(aggregateMap);
            
            const popupContent = `
                <div style="min-width: 200px;">
                    <h6><strong>${location.nama}</strong></h6>
                    <p><strong>No:</strong> ${location.no_pendaftaran}</p>
                    <p><strong>Jurusan:</strong> ${location.jurusan}</p>
                    <p><strong>Status:</strong> <span class="badge badge-${getStatusBadge(location.status)}">${getStatusText(location.status)}</span></p>
                    <p><strong>Alamat:</strong> ${location.alamat}</p>
                </div>
            `;
            
            marker.bindPopup(popupContent);
            markers.push(marker);
            bounds.extend([location.lat, location.lng]);
        });
        
        // Fit map to show all markers
        if (bounds.isValid()) {
            aggregateMap.fitBounds(bounds, { padding: [20, 20] });
        }
        
        // Add legend
        addMapLegend();
    } else {
        document.getElementById('totalWithLocation').textContent = '0';
    }
}

function getMarkerColor(status) {
    switch(status) {
        case 'diterima': 
            return { fill: '#28a745', border: '#1e7e34' };
        case 'ditolak': 
            return { fill: '#dc3545', border: '#c82333' };
        default: 
            return { fill: '#ffc107', border: '#e0a800' };
    }
}

function getStatusBadge(status) {
    switch(status) {
        case 'diterima': return 'success';
        case 'ditolak': return 'danger';
        default: return 'warning';
    }
}

function getStatusText(status) {
    switch(status) {
        case 'diterima': return 'Diterima';
        case 'ditolak': return 'Ditolak';
        default: return 'Menunggu';
    }
}

function addMapLegend() {
    const legend = L.control({ position: 'bottomright' });
    
    legend.onAdd = function(map) {
        const div = L.DomUtil.create('div', 'legend');
        div.style.backgroundColor = 'white';
        div.style.padding = '10px';
        div.style.border = '2px solid #ccc';
        div.style.borderRadius = '5px';
        div.style.fontSize = '12px';
        
        div.innerHTML = `
            <h6><strong>Status Pendaftar</strong></h6>
            <div><span style="color: #28a745;">●</span> Diterima</div>
            <div><span style="color: #ffc107;">●</span> Menunggu</div>
            <div><span style="color: #dc3545;">●</span> Ditolak</div>
        `;
        
        return div;
    };
    
    legend.addTo(aggregateMap);
}
</script>
@endsection