@extends('layouts.main')

@section('content')
<!-- Page Title -->
<div class="page-title">
  <div class="heading">
    <div class="container">
      <div class="row d-flex justify-content-center text-center">
        <div class="col-lg-8">
          <h1 class="heading-title">Status Pendaftaran</h1>
          <p class="mb-0">Pantau progress dan status pendaftaran Anda</p>
        </div>
      </div>
    </div>
  </div>
  <nav class="breadcrumbs">
    <div class="container">
      <ol>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('pendaftaran.index') }}">Pendaftaran</a></li>
        <li class="current">Status Pendaftaran</li>
      </ol>
    </div>
  </nav>
</div>

<!-- Status Section -->
<section class="section">
  <div class="container">
    
    <!-- User Info Header -->
    <div class="user-header mb-4" data-aos="fade-up">
      <div class="row align-items-center">
        <div class="col-md-8">
          <div class="user-info">
            <h4>Selamat datang, {{ Auth::user()->name }}!</h4>
            <p class="text-muted mb-0">
              <i class="bi bi-envelope me-2"></i>{{ Auth::user()->email }}
              @if($pendaftar->no_pendaftaran)
                <span class="ms-3"><i class="bi bi-card-text me-2"></i>No. Pendaftaran: {{ $pendaftar->no_pendaftaran }}</span>
              @endif
            </p>
          </div>
        </div>
        <div class="col-md-4 text-md-end">
          <form action="{{ route('pendaftaran.logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-secondary">
              <i class="bi bi-box-arrow-right me-2"></i>Logout
            </button>
          </form>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Status Timeline -->
      <div class="col-lg-8">
        
        <!-- Current Status Card -->
        <div class="status-card mb-4" data-aos="fade-up">
          <div class="status-header">
            <div class="status-icon {{ $pendaftar->status === 'SUBMIT' ? 'submitted' : ($pendaftar->status === 'ADM_PASS' ? 'verified' : ($pendaftar->status === 'VERIFY' ? 'accepted' : 'draft')) }}">
              @if($pendaftar->status === 'SUBMIT')
                <i class="bi bi-clock-history"></i>
              @elseif($pendaftar->status === 'ADM_PASS')
                <i class="bi bi-check-circle"></i>
              @elseif($pendaftar->status === 'VERIFY')
                <i class="bi bi-trophy"></i>
              @else
                <i class="bi bi-file-text"></i>
              @endif
            </div>
            <div class="status-info">
              <h5>Status Saat Ini</h5>
              <h3 class="status-text {{ strtolower($pendaftar->status) }}">
                @if($pendaftar->status === 'SUBMIT')
                  Menunggu Verifikasi
                @elseif($pendaftar->status === 'ADM_PASS')
                  Terverifikasi
                @elseif($pendaftar->status === 'VERIFY')
                  Diterima
                @elseif($pendaftar->status === 'ADM_REJECT')
                  Ditolak
                @endif
              </h3>
              <p class="text-muted mb-0">
                @if($pendaftar->status === 'SUBMIT')
                  Dokumen Anda sedang dalam proses verifikasi oleh admin
                @elseif($pendaftar->status === 'ADM_PASS')
                  Dokumen telah diverifikasi, menunggu pengumuman hasil
                @elseif($pendaftar->status === 'VERIFY')
                  Selamat! Anda diterima di SMK Bakti Nusantara 666
                @elseif($pendaftar->status === 'ADM_REJECT')
                  Mohon maaf, pendaftaran Anda belum dapat diterima
                @endif
              </p>
            </div>
          </div>
          
          @if($pendaftar->tanggal_daftar)
            <div class="status-meta">
              <small class="text-muted">
                <i class="bi bi-calendar me-1"></i>
                Tanggal Pendaftaran: {{ $pendaftar->tanggal_daftar->format('d F Y, H:i') }}
              </small>
            </div>
          @endif
        </div>

        <!-- Progress Timeline -->
        <div class="timeline-card" data-aos="fade-up" data-aos-delay="200">
          <h5 class="mb-4"><i class="bi bi-list-check me-2"></i>Progress Pendaftaran</h5>
          
          <div class="timeline">
            <!-- Step 1: Registrasi -->
            <div class="timeline-item completed">
              <div class="timeline-marker">
                <i class="bi bi-check"></i>
              </div>
              <div class="timeline-content">
                <h6>Registrasi Akun</h6>
                <p class="text-muted">Akun berhasil dibuat</p>
                <small class="text-success">Selesai</small>
              </div>
            </div>
            
            <!-- Step 2: Formulir -->
            <div class="timeline-item completed">
              <div class="timeline-marker">
                <i class="bi bi-check"></i>
              </div>
              <div class="timeline-content">
                <h6>Formulir Pendaftaran</h6>
                <p class="text-muted">Mengisi data pribadi dan pilihan jurusan</p>
                <small class="text-success">Selesai</small>
              </div>
            </div>
            
            <!-- Step 3: Upload Berkas -->
            <div class="timeline-item {{ $hasBerkas ? 'completed' : 'pending' }}">
              <div class="timeline-marker">
                @if($hasBerkas)
                  <i class="bi bi-check"></i>
                @else
                  <i class="bi bi-circle"></i>
                @endif
              </div>
              <div class="timeline-content">
                <h6>Upload Berkas</h6>
                <p class="text-muted">Upload dokumen persyaratan</p>
                @if($hasBerkas)
                  <small class="text-success">Selesai</small>
                @else
                  <small class="text-warning">Belum Upload</small>
                @endif
              </div>
            </div>
            
            <!-- Step 4: Pembayaran -->
            <div class="timeline-item {{ in_array($pendaftar->status, ['PAID', 'ADM_PASS', 'VERIFY']) ? 'completed' : ($hasBerkas ? 'active' : 'pending') }}">
              <div class="timeline-marker">
                @if(in_array($pendaftar->status, ['PAID', 'ADM_PASS', 'VERIFY']))
                  <i class="bi bi-check"></i>
                @elseif($hasBerkas)
                  <i class="bi bi-credit-card"></i>
                @else
                  <i class="bi bi-circle"></i>
                @endif
              </div>
              <div class="timeline-content">
                <h6>Pembayaran</h6>
                <p class="text-muted">Upload bukti pembayaran biaya pendaftaran</p>
                @if(in_array($pendaftar->status, ['PAID', 'ADM_PASS', 'VERIFY']))
                  <small class="text-success">Sudah Bayar</small>
                @elseif($hasBerkas)
                  <small class="text-warning">Belum Bayar</small>
                @else
                  <small class="text-muted">Menunggu</small>
                @endif
              </div>
            </div>

            <!-- Step 5: Verifikasi -->
            <div class="timeline-item {{ in_array($pendaftar->status, ['PAID', 'ADM_PASS', 'VERIFY']) ? 'completed' : 'pending' }}">
              <div class="timeline-marker">
                @if(in_array($pendaftar->status, ['PAID', 'ADM_PASS', 'VERIFY']))
                  <i class="bi bi-check"></i>
                @else
                  <i class="bi bi-circle"></i>
                @endif
              </div>
              <div class="timeline-content">
                <h6>Verifikasi Administrasi</h6>
                <p class="text-muted">Pemeriksaan dokumen dan pembayaran oleh admin</p>
                @if(in_array($pendaftar->status, ['PAID', 'ADM_PASS', 'VERIFY']))
                  <small class="text-success">Terverifikasi</small>
                @else
                  <small class="text-muted">Menunggu</small>
                @endif
              </div>
            </div>
            
            <!-- Step 6: Pengumuman -->
            <div class="timeline-item {{ in_array($pendaftar->status, ['PAID', 'VERIFY']) ? 'completed' : 'pending' }}">
              <div class="timeline-marker">
                @if(in_array($pendaftar->status, ['PAID', 'VERIFY']))
                  <i class="bi bi-trophy"></i>
                @else
                  <i class="bi bi-circle"></i>
                @endif
              </div>
              <div class="timeline-content">
                <h6>Pengumuman Hasil</h6>
                <p class="text-muted">Pengumuman kelulusan seleksi</p>
                @if($pendaftar->status === 'PAID')
                  <small class="text-success">Hasil Tersedia</small>
                @elseif($pendaftar->status === 'VERIFY')
                  <small class="text-success">Diterima</small>
                @else
                  <small class="text-muted">Menunggu</small>
                @endif
              </div>
              @if($pendaftar->status === 'PAID')
                <div class="mt-3">
                  <div class="alert alert-info alert-sm">
                    <i class="bi bi-megaphone me-2"></i>
                    <strong>Pengumuman Hasil Tersedia!</strong>
                    <p class="mb-2">Berkas dan pembayaran Anda telah diterima. Silakan lihat hasil pendaftaran Anda.</p>
                    <a href="{{ route('pendaftaran.hasil') }}" class="btn btn-primary btn-sm">
                      <i class="bi bi-eye me-2"></i>Lihat Hasil
                    </a>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>

      </div>
      
      <!-- Sidebar Info -->
      <div class="col-lg-4">
        
        <!-- Quick Actions -->
        <div class="info-card mb-4" data-aos="fade-left" data-aos-delay="300">
          <h6><i class="bi bi-lightning me-2"></i>Aksi Cepat</h6>
          
          <div class="action-buttons">
            @if(!$hasBerkas)
              <a href="{{ route('pendaftaran.upload') }}" class="btn btn-primary btn-sm w-100 mb-2">
                <i class="bi bi-cloud-upload me-2"></i>Upload Berkas
              </a>
            @elseif($hasBerkas && !$hasPembayaran)
              <a href="{{ route('pendaftaran.pembayaran') }}" class="btn btn-success btn-sm w-100 mb-2">
                <i class="bi bi-credit-card me-2"></i>Lakukan Pembayaran
              </a>
            @endif
            
            @if($pendaftar->status === 'PAID')
              <a href="{{ route('pendaftaran.hasil') }}" class="btn btn-info btn-sm w-100 mb-2">
                <i class="bi bi-eye me-2"></i>Lihat Hasil Pendaftaran
              </a>
            @elseif($pendaftar->status === 'VERIFY')
              <button class="btn btn-success btn-sm w-100 mb-2">
                <i class="bi bi-download me-2"></i>Download Kartu Pendaftaran
              </button>
            @endif
            
            <button class="btn btn-outline-secondary btn-sm w-100" onclick="window.print()">
              <i class="bi bi-printer me-2"></i>Cetak Status
            </button>
          </div>
        </div>

        <!-- Data Summary -->
        <div class="info-card mb-4" data-aos="fade-left" data-aos-delay="400">
          <h6><i class="bi bi-info-circle me-2"></i>Ringkasan Data</h6>
          
          <div class="data-summary">
            @if($pendaftar->jurusan)
              <div class="summary-item">
                <span class="label">Jurusan:</span>
                <span class="value">{{ $pendaftar->jurusan->nama_jurusan }}</span>
              </div>
            @endif
            
            <div class="summary-item">
              <span class="label">No. Pendaftaran:</span>
              <span class="value">{{ $pendaftar->no_pendaftaran }}</span>
            </div>
            
            <div class="summary-item">
              <span class="label">Status:</span>
              <span class="value">{{ $pendaftar->status }}</span>
            </div>
          </div>
        </div>

        <!-- Contact Info -->
        <div class="info-card" data-aos="fade-left" data-aos-delay="500">
          <h6><i class="bi bi-headset me-2"></i>Butuh Bantuan?</h6>
          
          <div class="contact-info">
            <div class="contact-item">
              <i class="bi bi-telephone text-primary"></i>
              <div>
                <strong>Telepon</strong>
                <p>(021) 123-4567</p>
              </div>
            </div>
            
            <div class="contact-item">
              <i class="bi bi-whatsapp text-success"></i>
              <div>
                <strong>WhatsApp</strong>
                <p>0812-3456-7890</p>
              </div>
            </div>
            
            <div class="contact-item">
              <i class="bi bi-envelope text-info"></i>
              <div>
                <strong>Email</strong>
                <p>info@smkbn666.sch.id</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<style>
.user-header {
  background: white;
  border-radius: 15px;
  padding: 1.5rem;
  box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.user-info h4 {
  color: var(--heading-color);
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.status-card {
  background: white;
  border-radius: 20px;
  padding: 2rem;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  border: 1px solid #f0f0f0;
}

.status-header {
  display: flex;
  align-items: center;
  margin-bottom: 1rem;
}

.status-icon {
  width: 80px;
  height: 80px;
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2rem;
  margin-right: 1.5rem;
  color: white;
}

.status-icon.draft {
  background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
}

.status-icon.submitted {
  background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
}

.status-icon.verified {
  background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
}

.status-icon.accepted {
  background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
}

.status-info h5 {
  color: #6c757d;
  font-size: 0.9rem;
  font-weight: 500;
  margin-bottom: 0.25rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.status-text {
  font-weight: 700;
  margin-bottom: 0.5rem;
}

.status-text.draft {
  color: #6c757d;
}

.status-text.submitted {
  color: #ffc107;
}

.status-text.verified {
  color: #17a2b8;
}

.status-text.accepted {
  color: #28a745;
}

.status-text.rejected {
  color: #dc3545;
}

.status-meta {
  margin-top: 1rem;
  padding-top: 1rem;
  border-top: 1px solid #f0f0f0;
}

.timeline-card {
  background: white;
  border-radius: 20px;
  padding: 2rem;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  border: 1px solid #f0f0f0;
}

.timeline {
  position: relative;
  padding-left: 2rem;
}

.timeline::before {
  content: '';
  position: absolute;
  left: 15px;
  top: 0;
  bottom: 0;
  width: 2px;
  background: #e9ecef;
}

.timeline-item {
  position: relative;
  margin-bottom: 2rem;
}

.timeline-item:last-child {
  margin-bottom: 0;
}

.timeline-marker {
  position: absolute;
  left: -2rem;
  top: 0;
  width: 30px;
  height: 30px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.8rem;
  font-weight: 700;
  background: #e9ecef;
  color: #6c757d;
  border: 3px solid white;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.timeline-item.completed .timeline-marker {
  background: #28a745;
  color: white;
}

.timeline-item.active .timeline-marker {
  background: var(--accent-color);
  color: white;
  animation: pulse 2s infinite;
}

.timeline-content h6 {
  color: var(--heading-color);
  font-weight: 600;
  margin-bottom: 0.25rem;
}

.timeline-content p {
  margin-bottom: 0.5rem;
  font-size: 0.9rem;
}

.info-card {
  background: white;
  border-radius: 15px;
  padding: 1.5rem;
  box-shadow: 0 5px 15px rgba(0,0,0,0.08);
  border: 1px solid #f0f0f0;
}

.info-card h6 {
  color: var(--heading-color);
  font-weight: 600;
  margin-bottom: 1rem;
}

.action-buttons .btn {
  border-radius: 8px;
  font-weight: 500;
}

.data-summary .summary-item {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 0.75rem;
  padding-bottom: 0.75rem;
  border-bottom: 1px solid #f0f0f0;
}

.data-summary .summary-item:last-child {
  margin-bottom: 0;
  padding-bottom: 0;
  border-bottom: none;
}

.summary-item .label {
  font-weight: 500;
  color: #6c757d;
  font-size: 0.9rem;
  flex: 1;
}

.summary-item .value {
  font-weight: 600;
  color: var(--heading-color);
  font-size: 0.9rem;
  text-align: right;
  flex: 1;
}

.contact-info .contact-item {
  display: flex;
  align-items: center;
  margin-bottom: 1rem;
}

.contact-info .contact-item:last-child {
  margin-bottom: 0;
}

.contact-item i {
  font-size: 1.2rem;
  margin-right: 1rem;
  width: 20px;
}

.contact-item div strong {
  display: block;
  font-size: 0.9rem;
  font-weight: 600;
  color: var(--heading-color);
}

.contact-item div p {
  margin-bottom: 0;
  font-size: 0.8rem;
  color: #6c757d;
}

@keyframes pulse {
  0% {
    box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.7);
  }
  70% {
    box-shadow: 0 0 0 10px rgba(13, 110, 253, 0);
  }
  100% {
    box-shadow: 0 0 0 0 rgba(13, 110, 253, 0);
  }
}

@media (max-width: 768px) {
  .status-header {
    flex-direction: column;
    text-align: center;
  }
  
  .status-icon {
    margin-right: 0;
    margin-bottom: 1rem;
  }
  
  .timeline {
    padding-left: 1.5rem;
  }
  
  .timeline-marker {
    left: -1.5rem;
  }
  
  .user-header .row {
    text-align: center;
  }
  
  .user-header .col-md-4 {
    margin-top: 1rem;
  }
}

@media print {
  .btn, .breadcrumbs, .action-buttons {
    display: none !important;
  }
  
  .status-card, .timeline-card, .info-card {
    box-shadow: none !important;
    border: 1px solid #ddd !important;
  }
}
</style>
@endsection