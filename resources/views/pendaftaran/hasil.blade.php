@extends('layouts.main')

@section('content')
<!-- Page Title -->
<div class="page-title">
  <div class="heading">
    <div class="container">
      <div class="row d-flex justify-content-center text-center">
        <div class="col-lg-8">
          <h1 class="heading-title">Hasil Pendaftaran</h1>
          <p class="mb-0">Pengumuman hasil seleksi SPMB SMK Bakti Nusantara 666</p>
        </div>
      </div>
    </div>
  </div>
  <nav class="breadcrumbs">
    <div class="container">
      <ol>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('pendaftaran.index') }}">Pendaftaran</a></li>
        <li class="current">Hasil Pendaftaran</li>
      </ol>
    </div>
  </nav>
</div>

<!-- Result Section -->
<section class="section">
  <div class="container">
    
    <!-- Result Card -->
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="result-card" data-aos="fade-up">
          
          <!-- Header -->
          <div class="result-header text-center">
            <div class="result-icon {{ $pendaftar->hasil_seleksi === 'DITERIMA' ? 'accepted' : 'pending' }}">
              @if($pendaftar->hasil_seleksi === 'DITERIMA')
                <i class="bi bi-check-circle"></i>
              @else
                <i class="bi bi-clock-history"></i>
              @endif
            </div>
            
            <h2 class="result-title">
              @if($pendaftar->hasil_seleksi === 'DITERIMA')
                Selamat! Anda DITERIMA
              @else
                Hasil Sedang Diproses
              @endif
            </h2>
            
            <p class="result-subtitle">
              @if($pendaftar->hasil_seleksi === 'DITERIMA')
                Anda telah diterima sebagai calon siswa SMK Bakti Nusantara 666
              @else
                Hasil seleksi akan diumumkan setelah proses evaluasi selesai
              @endif
            </p>
          </div>

          <!-- Student Info -->
          <div class="student-info">
            <div class="row">
              <div class="col-md-6">
                <div class="info-item">
                  <label>Nama Lengkap</label>
                  <span>{{ $pendaftar->nama_lengkap }}</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-item">
                  <label>No. Pendaftaran</label>
                  <span>{{ $pendaftar->no_pendaftaran }}</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-item">
                  <label>Jurusan Pilihan</label>
                  <span>{{ $pendaftar->jurusan->nama_jurusan ?? '-' }}</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-item">
                  <label>Gelombang</label>
                  <span>{{ $pendaftar->gelombang->nama ?? '-' }}</span>
                </div>
              </div>
            </div>
          </div>

          @if($pendaftar->hasil_seleksi === 'DITERIMA')
            <!-- Next Steps -->
            <div class="next-steps">
              <h5><i class="bi bi-list-check me-2"></i>Langkah Selanjutnya</h5>
              <div class="steps-list">
                <div class="step-item">
                  <div class="step-number">1</div>
                  <div class="step-content">
                    <h6>Daftar Ulang</h6>
                    <p>Lakukan daftar ulang paling lambat 7 hari setelah pengumuman</p>
                  </div>
                </div>
                <div class="step-item">
                  <div class="step-number">2</div>
                  <div class="step-content">
                    <h6>Melengkapi Berkas</h6>
                    <p>Siapkan dokumen asli untuk verifikasi ulang</p>
                  </div>
                </div>
                <div class="step-item">
                  <div class="step-number">3</div>
                  <div class="step-content">
                    <h6>Orientasi Siswa</h6>
                    <p>Mengikuti masa orientasi siswa baru (MOSB)</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Contact Info -->
            <div class="contact-section">
              <h6><i class="bi bi-telephone me-2"></i>Informasi Lebih Lanjut</h6>
              <div class="contact-grid">
                <div class="contact-item">
                  <i class="bi bi-geo-alt text-primary"></i>
                  <div>
                    <strong>Alamat Sekolah</strong>
                    <p>Jl. Percobaan, Cileunyi, Bandung</p>
                  </div>
                </div>
                <div class="contact-item">
                  <i class="bi bi-telephone text-success"></i>
                  <div>
                    <strong>Telepon</strong>
                    <p>(022) 8765-4321</p>
                  </div>
                </div>
              </div>
            </div>
          @endif

          <!-- Action Buttons -->
          <div class="action-buttons text-center">
            <a href="{{ route('pendaftaran.status') }}" class="btn btn-outline-primary">
              <i class="bi bi-arrow-left me-2"></i>Kembali ke Status
            </a>
            @if($pendaftar->hasil_seleksi === 'DITERIMA')
              <button class="btn btn-success" onclick="window.print()">
                <i class="bi bi-printer me-2"></i>Cetak Hasil
              </button>
            @endif
          </div>

        </div>
      </div>
    </div>
    
    <!-- Print Card (Hidden, only visible when printing) -->
    <div class="print-card" style="display: none;">
      <div class="print-header">
        <div class="print-logo">
          <img src="{{ asset('assets/img/baknus/bn2.png') }}" alt="Logo" style="width: 100%; height: 100%;">
        </div>
        <div class="print-title">SMK BAKTI NUSANTARA 666</div>
        <div class="print-subtitle">KARTU HASIL SELEKSI PENERIMAAN PESERTA DIDIK BARU</div>
        <div class="print-subtitle">TAHUN AJARAN 2026/2027</div>
      </div>
      
      <div class="print-body">
        <div class="print-info">
          <div class="print-row">
            <div class="print-label">No. Pendaftaran</div>
            <div class="print-value">: {{ $pendaftar->no_pendaftaran }}</div>
          </div>
          <div class="print-row">
            <div class="print-label">Nama Lengkap</div>
            <div class="print-value">: {{ strtoupper($pendaftar->nama_lengkap) }}</div>
          </div>
          <div class="print-row">
            <div class="print-label">Jurusan Pilihan</div>
            <div class="print-value">: {{ $pendaftar->jurusan->nama_jurusan ?? '-' }}</div>
          </div>
          <div class="print-row">
            <div class="print-label">Gelombang</div>
            <div class="print-value">: {{ $pendaftar->gelombang->nama ?? '-' }}</div>
          </div>
          <div class="print-row">
            <div class="print-label">Alamat</div>
            <div class="print-value">: {{ $pendaftar->alamat ?? '-' }}</div>
          </div>
          <div class="print-row">
            <div class="print-label">Status Seleksi</div>
            <div class="print-value">: 
              @if($pendaftar->hasil_seleksi === 'DITERIMA')
                <span class="print-status">DITERIMA</span>
              @else
                <span style="color: #ffc107; font-weight: bold;">DALAM PROSES</span>
              @endif
            </div>
          </div>
          
          @if($pendaftar->hasil_seleksi === 'DITERIMA')
            <div style="margin-top: 20px; padding: 10px; background: #f8f9fa; border-radius: 8px;">
              <div style="font-weight: bold; margin-bottom: 8px;">PETUNJUK DAFTAR ULANG:</div>
              <div style="font-size: 12px; line-height: 1.4;">
                1. Lakukan daftar ulang paling lambat 7 hari setelah pengumuman<br>
                2. Bawa dokumen asli untuk verifikasi ulang<br>
                3. Datang ke sekolah pada jam kerja (08.00 - 15.00 WIB)
              </div>
            </div>
          @endif
        </div>
        
        <div class="print-photo">
          @if(isset($pasFoto) && $pasFoto->nama_file)
            <img src="{{ asset('storage/pendaftaran/' . Auth::id() . '/' . $pasFoto->nama_file) }}" 
                 alt="Pas Foto" 
                 style="width: 100%; height: 100%; object-fit: cover; border-radius: 4px;">
          @else
            PAS FOTO<br>3 x 4
          @endif
        </div>
      </div>
      
      <div class="print-footer">
        <div>Alamat: Jl. Percobaan, Cileunyi, Bandung, Jawa Barat 40393</div>
        <div>Telepon: (022) 8765-4321 | Email: info@smkbn666.sch.id</div>
        <div style="margin-top: 10px;">Dicetak pada: {{ date('d F Y, H:i') }} WIB</div>
      </div>
    </div>

        </div>
      </div>
    </div>
  </div>
</section>

<style>
.result-card {
  background: white;
  border-radius: 20px;
  padding: 3rem;
  box-shadow: 0 15px 35px rgba(0,0,0,0.1);
  border: 1px solid #f0f0f0;
}

.result-header {
  margin-bottom: 2rem;
  padding-bottom: 2rem;
  border-bottom: 2px solid #f8f9fa;
}

.result-icon {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 3rem;
  color: white;
  margin-bottom: 1.5rem;
}

.result-icon.accepted {
  background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
  animation: successPulse 2s ease-in-out;
}

.result-icon.pending {
  background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
}

.result-title {
  color: var(--heading-color);
  font-weight: 700;
  margin-bottom: 0.5rem;
}

.result-subtitle {
  color: #6c757d;
  font-size: 1.1rem;
  margin-bottom: 0;
}

.student-info {
  background: #f8f9fa;
  border-radius: 15px;
  padding: 2rem;
  margin-bottom: 2rem;
}

.info-item {
  margin-bottom: 1rem;
}

.info-item label {
  display: block;
  font-weight: 600;
  color: #6c757d;
  font-size: 0.9rem;
  margin-bottom: 0.25rem;
}

.info-item span {
  display: block;
  font-weight: 600;
  color: var(--heading-color);
  font-size: 1rem;
}

.next-steps {
  margin-bottom: 2rem;
}

.next-steps h5 {
  color: var(--heading-color);
  font-weight: 600;
  margin-bottom: 1.5rem;
}

.steps-list {
  background: #f8f9fa;
  border-radius: 15px;
  padding: 1.5rem;
}

.step-item {
  display: flex;
  align-items: flex-start;
  margin-bottom: 1.5rem;
}

.step-item:last-child {
  margin-bottom: 0;
}

.step-number {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: var(--accent-color);
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  margin-right: 1rem;
  flex-shrink: 0;
}

.step-content h6 {
  color: var(--heading-color);
  font-weight: 600;
  margin-bottom: 0.25rem;
}

.step-content p {
  color: #6c757d;
  margin-bottom: 0;
  font-size: 0.9rem;
}

.contact-section {
  background: #f8f9fa;
  border-radius: 15px;
  padding: 1.5rem;
  margin-bottom: 2rem;
}

.contact-section h6 {
  color: var(--heading-color);
  font-weight: 600;
  margin-bottom: 1rem;
}

.contact-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1rem;
}

.contact-item {
  display: flex;
  align-items: center;
}

.contact-item i {
  font-size: 1.5rem;
  margin-right: 1rem;
  width: 30px;
}

.contact-item strong {
  display: block;
  font-weight: 600;
  color: var(--heading-color);
  margin-bottom: 0.25rem;
}

.contact-item p {
  margin-bottom: 0;
  color: #6c757d;
  font-size: 0.9rem;
}

.action-buttons {
  padding-top: 2rem;
  border-top: 2px solid #f8f9fa;
}

.action-buttons .btn {
  margin: 0 0.5rem;
  border-radius: 10px;
  font-weight: 600;
  padding: 0.75rem 2rem;
}

@keyframes successPulse {
  0% {
    transform: scale(0.8);
    opacity: 0.5;
  }
  50% {
    transform: scale(1.1);
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}

@media (max-width: 768px) {
  .result-card {
    padding: 2rem 1.5rem;
  }
  
  .result-icon {
    width: 80px;
    height: 80px;
    font-size: 2.5rem;
  }
  
  .contact-grid {
    grid-template-columns: 1fr;
  }
  
  .action-buttons .btn {
    display: block;
    width: 100%;
    margin: 0.5rem 0;
  }
}

@media print {
  body * {
    visibility: hidden;
  }
  
  .print-card, .print-card * {
    visibility: visible;
  }
  
  .print-card {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    background: white;
    padding: 20px;
    border: 2px solid #333;
    border-radius: 15px;
    font-family: Arial, sans-serif;
  }
  
  .print-header {
    text-align: center;
    border-bottom: 2px solid #333;
    padding-bottom: 15px;
    margin-bottom: 20px;
  }
  
  .print-logo {
    width: 60px;
    height: 60px;
    margin: 0 auto 10px;
  }
  
  .print-title {
    font-size: 18px;
    font-weight: bold;
    margin: 5px 0;
    color: #333;
  }
  
  .print-subtitle {
    font-size: 14px;
    color: #666;
    margin: 0;
  }
  
  .print-body {
    display: flex;
    gap: 20px;
  }
  
  .print-info {
    flex: 1;
  }
  
  .print-photo {
    width: 120px;
    height: 160px;
    border: 2px solid #333;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    font-size: 12px;
    color: #666;
    text-align: center;
  }
  
  .print-row {
    display: flex;
    margin-bottom: 8px;
    font-size: 14px;
  }
  
  .print-label {
    width: 140px;
    font-weight: bold;
    color: #333;
  }
  
  .print-value {
    flex: 1;
    color: #333;
  }
  
  .print-footer {
    margin-top: 20px;
    padding-top: 15px;
    border-top: 1px solid #333;
    text-align: center;
    font-size: 12px;
    color: #666;
  }
  
  .print-status {
    background: #28a745;
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: bold;
    display: inline-block;
    margin: 10px 0;
  }
}
</style>

<script>
// Show print card when printing
window.addEventListener('beforeprint', function() {
  document.querySelector('.print-card').style.display = 'block';
});

window.addEventListener('afterprint', function() {
  document.querySelector('.print-card').style.display = 'none';
});
</script>
@endsection