@extends('layouts.main')

@section('content')
<!-- Page Title -->
<div class="page-title">
  <div class="heading">
    <div class="container">
      <div class="row d-flex justify-content-center text-center">
        <div class="col-lg-8">
          <h1 class="heading-title">Formulir Pendaftaran</h1>
          <p class="mb-0">Lengkapi data diri Anda untuk mendaftar sebagai calon siswa SMK Bakti Nusantara 666</p>
        </div>
      </div>
    </div>
  </div>
  <nav class="breadcrumbs">
    <div class="container">
      <ol>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('pendaftaran.index') }}">Pendaftaran</a></li>
        <li class="current">Formulir Pendaftaran</li>
      </ol>
    </div>
  </nav>
</div>

<!-- Registration Form Section -->
<section class="section">
  <div class="container">
    
    <!-- Progress Indicator -->
    <div class="progress-indicator mb-5" data-aos="fade-up">
      <div class="progress-step completed">
        <div class="step-number"><i class="bi bi-check"></i></div>
        <span>Registrasi Akun</span>
      </div>
      <div class="progress-line completed"></div>
      <div class="progress-step active">
        <div class="step-number">2</div>
        <span>Formulir Pendaftaran</span>
      </div>
      <div class="progress-line"></div>
      <div class="progress-step">
        <div class="step-number">3</div>
        <span>Upload Berkas</span>
      </div>
      <div class="progress-line"></div>
      <div class="progress-step">
        <div class="step-number">4</div>
        <span>Pembayaran</span>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-10">
        
        <!-- Wave Information -->
        @if($gelombangAktif)
          <div class="wave-info-card mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-center">
              <div class="col-md-8">
                <h5 class="mb-2">
                  <i class="bi bi-calendar-event me-2"></i>
                  {{ $gelombangAktif->nama }} Sedang Berlangsung
                </h5>
                <p class="mb-0 text-muted">
                  Periode: {{ \Carbon\Carbon::parse($gelombangAktif->tgl_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($gelombangAktif->tgl_selesai)->format('d M Y') }}
                </p>
              </div>
              <div class="col-md-4 text-md-end">
                <div class="price-tag">
                  <span class="price-label">Biaya Pendaftaran</span>
                  <span class="price-amount">Rp {{ number_format($gelombangAktif->biaya_daftar, 0, ',', '.') }}</span>
                </div>
              </div>
            </div>
          </div>
        @else
          @php
            $nextGelombang = $allGelombang->where('tgl_mulai', '>', now())->first();
          @endphp
          @if($nextGelombang)
            <div class="alert alert-warning mb-4" data-aos="fade-up" data-aos-delay="100">
              <i class="bi bi-exclamation-triangle me-2"></i>
              <strong>Pendaftaran sedang tidak dibuka.</strong><br>
              Gelombang berikutnya: <strong>{{ $nextGelombang->nama }}</strong> dimulai pada <strong>{{ \Carbon\Carbon::parse($nextGelombang->tgl_mulai)->format('d M Y') }}</strong>
            </div>
          @else
            <div class="alert alert-danger mb-4" data-aos="fade-up" data-aos-delay="100">
              <i class="bi bi-x-circle me-2"></i>
              <strong>Pendaftaran sudah ditutup.</strong> Tidak ada gelombang pendaftaran yang tersedia.
            </div>
          @endif
        @endif

        <!-- Form Container -->
        <div class="form-container" data-aos="fade-up" data-aos-delay="200">
          
          @if ($errors->any())
            <div class="alert alert-danger">
              <h6><i class="bi bi-exclamation-triangle me-2"></i>Terdapat kesalahan:</h6>
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('pendaftaran.form.store') }}" method="POST" enctype="multipart/form-data" class="registration-form">
            @csrf
            
            <!-- Data Pribadi -->
            <div class="form-section">
              <div class="section-header">
                <div class="section-icon">
                  <i class="bi bi-person"></i>
                </div>
                <div class="section-title">
                  <h4>Data Pribadi</h4>
                  <p>Lengkapi informasi identitas diri Anda</p>
                </div>
              </div>
              
              <div class="row gy-3">
                <div class="col-md-6">
                  <label class="form-label">NISN <span class="text-danger">*</span></label>
                  <input type="text" 
                         name="nisn" 
                         class="form-control @error('nisn') is-invalid @enderror" 
                         value="{{ old('nisn', $pendaftarSiswa->nik ?? '') }}"
                         placeholder="Nomor Induk Siswa Nasional" 
                         required>
                  @error('nisn')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="col-md-6">
                  <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                  <input type="text" 
                         name="tempat_lahir" 
                         class="form-control @error('tempat_lahir') is-invalid @enderror" 
                         value="{{ old('tempat_lahir', $pendaftarSiswa->tmp_lahir ?? '') }}"
                         placeholder="Kota/Kabupaten tempat lahir" 
                         required>
                  @error('tempat_lahir')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="col-md-6">
                  <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                  <input type="date" 
                         name="tanggal_lahir" 
                         class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                         value="{{ old('tanggal_lahir', $pendaftarSiswa ? \Carbon\Carbon::parse($pendaftarSiswa->tmp_lahir)->format('Y-m-d') : '') }}"
                         required>
                  @error('tanggal_lahir')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="col-md-6">
                  <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                  <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L" {{ old('jenis_kelamin', $pendaftarSiswa->jk ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin', $pendaftarSiswa->jk ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                  </select>
                  @error('jenis_kelamin')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="col-md-6">
                  <label class="form-label">Agama <span class="text-danger">*</span></label>
                  <select name="agama" class="form-select @error('agama') is-invalid @enderror" required>
                    <option value="">Pilih Agama</option>
                    <option value="Islam" {{ old('agama', $pendaftarSiswa->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Kristen" {{ old('agama', $pendaftarSiswa->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                    <option value="Katolik" {{ old('agama', $pendaftarSiswa->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                    <option value="Hindu" {{ old('agama', $pendaftarSiswa->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Buddha" {{ old('agama', $pendaftarSiswa->agama ?? '') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                    <option value="Konghucu" {{ old('agama', $pendaftarSiswa->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                  </select>
                  @error('agama')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="col-md-12">
                  <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                  <textarea name="alamat" 
                            id="alamat"
                            class="form-control @error('alamat') is-invalid @enderror" 
                            rows="3" 
                            placeholder="Jalan, RT/RW, Kelurahan, Kecamatan, Kota/Kabupaten" 
                            required>{{ old('alamat', $pendaftarSiswa->alamat ?? '') }}</textarea>
                  @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="col-md-12">
                  <label class="form-label">Pilih Lokasi di Peta <span class="text-muted">(Opsional)</span></label>
                  <div class="map-container">
                    <div id="map" style="height: 400px; border-radius: 8px; background: #f8f9fa;"></div>
                    <div class="map-info mt-2">
                      <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        Klik pada peta untuk menandai lokasi tempat tinggal Anda. Alamat akan otomatis terisi berdasarkan lokasi yang dipilih.
                      </small>
                    </div>
                  </div>
                  <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $pendaftarSiswa->lat ?? '') }}">
                  <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $pendaftarSiswa->lng ?? '') }}">
                </div>
              </div>
            </div>

            <!-- Data Sekolah Asal -->
            <div class="form-section">
              <div class="section-header">
                <div class="section-icon">
                  <i class="bi bi-building"></i>
                </div>
                <div class="section-title">
                  <h4>Data Sekolah Asal</h4>
                  <p>Informasi sekolah asal dan prestasi akademik</p>
                </div>
              </div>
              
              <div class="row gy-3">
                <div class="col-md-12">
                  <label class="form-label">Nama Sekolah Asal <span class="text-danger">*</span></label>
                  <input type="text" 
                         name="asal_sekolah" 
                         class="form-control @error('asal_sekolah') is-invalid @enderror" 
                         value="{{ old('asal_sekolah', $pendaftarSiswa->asal_sekolah ?? '') }}"
                         placeholder="Nama lengkap sekolah asal (SMP/MTs)" 
                         required>
                  @error('asal_sekolah')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="col-md-6">
                  <label class="form-label">Alamat Sekolah Asal</label>
                  <input type="text" 
                         name="alamat_sekolah" 
                         class="form-control @error('alamat_sekolah') is-invalid @enderror" 
                         value="{{ old('alamat_sekolah') }}"
                         placeholder="Alamat sekolah asal">
                  @error('alamat_sekolah')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="col-md-6">
                  <label class="form-label">Tahun Lulus</label>
                  <select name="tahun_lulus" class="form-select @error('tahun_lulus') is-invalid @enderror">
                    <option value="">Pilih Tahun Lulus</option>
                    @for($year = date('Y'); $year >= date('Y')-5; $year--)
                      <option value="{{ $year }}" {{ old('tahun_lulus') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                  </select>
                  @error('tahun_lulus')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            
            <!-- Pilihan Jurusan -->
            <div class="form-section">
              <div class="section-header">
                <div class="section-icon">
                  <i class="bi bi-mortarboard"></i>
                </div>
                <div class="section-title">
                  <h4>Pilihan Jurusan</h4>
                  <p>Pilih program keahlian yang diminati</p>
                </div>
              </div>
              
              <div class="row gy-3">
                <div class="col-md-6">
                  <label class="form-label">Jurusan Pilihan 1 <span class="text-danger">*</span></label>
                  <select name="jurusan_pilihan_1" class="form-select @error('jurusan_pilihan_1') is-invalid @enderror" required>
                    <option value="">Pilih Jurusan Utama</option>
                    <option value="RPL" {{ old('jurusan_pilihan_1') == 'RPL' ? 'selected' : '' }}>Pengembangan Perangkat Lunak dan Gim (PPLG)</option>
                    <option value="MM" {{ old('jurusan_pilihan_1') == 'MM' ? 'selected' : '' }}>Animasi</option>
                    <option value="DKV" {{ old('jurusan_pilihan_1') == 'DKV' ? 'selected' : '' }}>Desain Komunikasi Visual (DKV)</option>
                    <option value="OTKP" {{ old('jurusan_pilihan_1') == 'OTKP' ? 'selected' : '' }}>Bisnis Daring dan Pemasaran</option>
                    <option value="AKL" {{ old('jurusan_pilihan_1') == 'AKL' ? 'selected' : '' }}>Akuntansi dan Keuangan Lembaga</option>
                  </select>
                  @error('jurusan_pilihan_1')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="col-md-6">
                  <label class="form-label">Jurusan Pilihan 2 <span class="text-muted">(Opsional)</span></label>
                  <select name="jurusan_pilihan_2" class="form-select @error('jurusan_pilihan_2') is-invalid @enderror">
                    <option value="">Pilih Jurusan Cadangan</option>
                    <option value="RPL" {{ old('jurusan_pilihan_2') == 'RPL' ? 'selected' : '' }}>Pengembangan Perangkat Lunak dan Gim (PPLG)</option>
                    <option value="MM" {{ old('jurusan_pilihan_2') == 'MM' ? 'selected' : '' }}>Animasi</option>
                    <option value="DKV" {{ old('jurusan_pilihan_2') == 'DKV' ? 'selected' : '' }}>Desain Komunikasi Visual (DKV)</option>
                    <option value="OTKP" {{ old('jurusan_pilihan_2') == 'OTKP' ? 'selected' : '' }}>Bisnis Daring dan Pemasaran</option>
                    <option value="AKL" {{ old('jurusan_pilihan_2') == 'AKL' ? 'selected' : '' }}>Akuntansi dan Keuangan Lembaga</option>
                  </select>
                  @error('jurusan_pilihan_2')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            
            <!-- Data Orang Tua/Wali -->
            <div class="form-section">
              <div class="section-header">
                <div class="section-icon">
                  <i class="bi bi-people"></i>
                </div>
                <div class="section-title">
                  <h4>Data Orang Tua/Wali</h4>
                  <p>Informasi orang tua atau wali siswa</p>
                </div>
              </div>
              
              <div class="row gy-3">
                <div class="col-md-6">
                  <label class="form-label">Nama Ayah <span class="text-danger">*</span></label>
                  <input type="text" 
                         name="nama_ayah" 
                         class="form-control @error('nama_ayah') is-invalid @enderror" 
                         value="{{ old('nama_ayah', $pendaftarSiswa->nama_ayah ?? '') }}"
                         placeholder="Nama lengkap ayah" 
                         required>
                  @error('nama_ayah')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="col-md-6">
                  <label class="form-label">Nama Ibu <span class="text-danger">*</span></label>
                  <input type="text" 
                         name="nama_ibu" 
                         class="form-control @error('nama_ibu') is-invalid @enderror" 
                         value="{{ old('nama_ibu', $pendaftarSiswa->nama_ibu ?? '') }}"
                         placeholder="Nama lengkap ibu" 
                         required>
                  @error('nama_ibu')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="col-md-6">
                  <label class="form-label">Pekerjaan Ayah</label>
                  <input type="text" 
                         name="pekerjaan_ayah" 
                         class="form-control @error('pekerjaan_ayah') is-invalid @enderror" 
                         value="{{ old('pekerjaan_ayah', $pendaftarSiswa->pekerjaan_ayah ?? '') }}"
                         placeholder="Pekerjaan ayah">
                  @error('pekerjaan_ayah')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="col-md-6">
                  <label class="form-label">Pekerjaan Ibu</label>
                  <input type="text" 
                         name="pekerjaan_ibu" 
                         class="form-control @error('pekerjaan_ibu') is-invalid @enderror" 
                         value="{{ old('pekerjaan_ibu', $pendaftarSiswa->pekerjaan_ibu ?? '') }}"
                         placeholder="Pekerjaan ibu">
                  @error('pekerjaan_ibu')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="col-md-12">
                  <label class="form-label">No. HP Orang Tua/Wali <span class="text-danger">*</span></label>
                  <input type="tel" 
                         name="no_hp_ortu" 
                         class="form-control @error('no_hp_ortu') is-invalid @enderror" 
                         value="{{ old('no_hp_ortu', $pendaftarSiswa->no_ayah ?? '') }}"
                         placeholder="08xxxxxxxxxx" 
                         required>
                  @error('no_hp_ortu')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions text-center">
              <div class="row">
                <div class="col-md-6">
                  <a href="{{ route('pendaftaran.index') }}" class="btn btn-outline-secondary btn-lg w-100">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                  </a>
                </div>
                <div class="col-md-6">
                  @if($gelombangAktif)
                    <button type="submit" class="btn btn-primary btn-lg w-100">
                      <i class="bi bi-arrow-right me-2"></i>Lanjut ke Upload Berkas
                    </button>
                  @else
                    <button type="button" class="btn btn-secondary btn-lg w-100" disabled>
                      <i class="bi bi-x-circle me-2"></i>Pendaftaran Ditutup
                    </button>
                  @endif
                </div>
              </div>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
.wave-info-card {
  background: linear-gradient(135deg, #3F72AF 0%, #112D4E 100%);
  color: white;
  padding: 1.5rem 2rem;
  border-radius: 15px;
  box-shadow: 0 5px 15px rgba(63, 114, 175, 0.3);
}

.wave-info-card h5 {
  color: white;
  font-weight: 600;
}

.price-tag {
  text-align: center;
}

.price-label {
  display: block;
  font-size: 0.8rem;
  opacity: 0.9;
  margin-bottom: 0.25rem;
}

.price-amount {
  display: block;
  font-size: 1.5rem;
  font-weight: 700;
  color: #FFE5B4;
}

.progress-indicator {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 2rem;
}

.progress-step {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  flex: 1;
  max-width: 120px;
}

.progress-step .step-number {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: #e9ecef;
  color: #6c757d;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  margin-bottom: 0.5rem;
  transition: all 0.3s ease;
}

.progress-step.active .step-number {
  background: var(--accent-color);
  color: white;
}

.progress-step.completed .step-number {
  background: #28a745;
  color: white;
}

.progress-step span {
  font-size: 0.8rem;
  color: #6c757d;
  font-weight: 500;
}

.progress-step.active span {
  color: var(--accent-color);
  font-weight: 600;
}

.progress-step.completed span {
  color: #28a745;
  font-weight: 600;
}

.progress-line {
  height: 2px;
  background: #e9ecef;
  flex: 1;
  margin: 0 1rem;
  margin-top: -20px;
}

.progress-line.completed {
  background: #28a745;
}

.form-container {
  background: white;
  border-radius: 20px;
  padding: 2.5rem;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  border: 1px solid #f0f0f0;
}

.form-section {
  margin-bottom: 3rem;
  padding-bottom: 2rem;
  border-bottom: 1px solid #f0f0f0;
}

.form-section:last-of-type {
  border-bottom: none;
  margin-bottom: 2rem;
}

.section-header {
  display: flex;
  align-items: center;
  margin-bottom: 2rem;
}

.section-icon {
  width: 60px;
  height: 60px;
  background: linear-gradient(135deg, var(--accent-color) 0%, #0056b3 100%);
  color: white;
  border-radius: 15px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
  margin-right: 1rem;
}

.section-title h4 {
  color: var(--heading-color);
  font-weight: 600;
  margin-bottom: 0.25rem;
}

.section-title p {
  color: #6c757d;
  margin-bottom: 0;
  font-size: 0.9rem;
}

.registration-form .form-label {
  font-weight: 600;
  color: var(--heading-color);
  margin-bottom: 0.5rem;
}

.registration-form .form-control,
.registration-form .form-select {
  border: 1px solid #e9ecef;
  padding: 0.75rem 1rem;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.registration-form .form-control:focus,
.registration-form .form-select:focus {
  border-color: var(--accent-color);
  box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.form-actions {
  margin-top: 2rem;
  padding-top: 2rem;
  border-top: 1px solid #f0f0f0;
}

.form-actions .btn {
  padding: 0.75rem 2rem;
  border-radius: 50px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  transition: all 0.3s ease;
}

.form-actions .btn-primary {
  background: linear-gradient(135deg, var(--accent-color) 0%, #0056b3 100%);
  border: none;
}

.form-actions .btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.map-container {
  border: 1px solid #e9ecef;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.map-info {
  background: #f8f9fa;
  padding: 0.75rem;
  border-top: 1px solid #e9ecef;
  border-radius: 0 0 8px 8px;
}

@media (max-width: 768px) {
  .progress-indicator {
    flex-direction: column;
    gap: 1rem;
  }
  
  .progress-line {
    display: none;
  }
  
  .form-container {
    padding: 1.5rem;
    margin: 0 1rem;
  }
  
  .progress-step {
    flex-direction: row;
    max-width: none;
    width: 100%;
    justify-content: center;
    gap: 1rem;
  }
  
  .progress-step .step-number {
    margin-bottom: 0;
  }
  
  .section-header {
    flex-direction: column;
    text-align: center;
  }
  
  .section-icon {
    margin-right: 0;
    margin-bottom: 1rem;
  }
  
  .form-actions .btn {
    margin-bottom: 1rem;
  }
  
  #map {
    height: 300px !important;
  }
}
</style>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="{{ asset('css/maps-enhanced.css') }}" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
let leafletMap;
let leafletMarker;
let geocodingTimeout;

// Initialize Leaflet Map directly
function initLeafletMap() {
    try {
        // Initialize Leaflet map centered on Bandung
        leafletMap = L.map('map').setView([-6.9175, 107.6191], 13);
        
        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            maxZoom: 18
        }).addTo(leafletMap);
        
        // Add click event
        leafletMap.on('click', function(e) {
            placeMarker(e.latlng);
            // Debounce geocoding requests
            clearTimeout(geocodingTimeout);
            geocodingTimeout = setTimeout(() => {
                getDetailedAddress(e.latlng.lat, e.latlng.lng);
            }, 500);
        });
        
        // Try to get user location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    leafletMap.setView([lat, lng], 15);
                    placeMarker({lat: lat, lng: lng});
                    getDetailedAddress(lat, lng);
                },
                function(error) {
                    console.log('Geolocation error:', error);
                    // Fallback to Bandung center
                    leafletMap.setView([-6.9175, 107.6191], 13);
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 300000
                }
            );
        }
        
    } catch (error) {
        console.error('Error initializing map:', error);
        document.getElementById('map').innerHTML = '<div class="alert alert-info"><i class="bi bi-info-circle me-2"></i>Maps tidak dapat dimuat. Silakan isi alamat secara manual.</div>';
    }
}

function placeMarker(latlng) {
    if (leafletMarker) {
        leafletMap.removeLayer(leafletMarker);
    }
    
    // Custom marker icon
    const customIcon = L.divIcon({
        html: '<i class="bi bi-geo-alt-fill" style="color: #dc3545; font-size: 24px;"></i>',
        iconSize: [24, 24],
        iconAnchor: [12, 24],
        className: 'custom-marker'
    });
    
    leafletMarker = L.marker([latlng.lat, latlng.lng], {icon: customIcon}).addTo(leafletMap);
    
    document.getElementById('latitude').value = latlng.lat;
    document.getElementById('longitude').value = latlng.lng;
    
    // Show loading indicator
    showAddressLoading();
}

function showAddressLoading() {
    const alamatField = document.getElementById('alamat');
    alamatField.value = 'Mengambil alamat...';
    alamatField.style.color = '#6c757d';
}

function getDetailedAddress(lat, lng) {
    // Use Nominatim for reverse geocoding
    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&addressdetails=1&accept-language=id`)
        .then(response => response.json())
        .then(data => {
            if (data && data.address) {
                const address = data.address;
                let formattedAddress = '';
                
                // Build detailed address
                const components = [];
                
                if (address.house_number) components.push(address.house_number);
                if (address.road) components.push(address.road);
                if (address.neighbourhood) components.push(address.neighbourhood);
                if (address.suburb) components.push(address.suburb);
                if (address.village) components.push(address.village);
                if (address.subdistrict) components.push(address.subdistrict);
                if (address.city_district) components.push(address.city_district);
                if (address.city) components.push(address.city);
                if (address.county) components.push(address.county);
                if (address.state) components.push(address.state);
                if (address.country) components.push(address.country);
                if (address.postcode) components.push(address.postcode);
                
                formattedAddress = components.join(', ');
                
                if (!formattedAddress && data.display_name) {
                    formattedAddress = data.display_name;
                }
                
                const alamatField = document.getElementById('alamat');
                alamatField.value = formattedAddress;
                alamatField.style.color = '#495057';
                
                // Show success feedback
                showAddressSuccess();
                
            } else {
                handleGeocodingError();
            }
        })
        .catch(error => {
            console.log('Geocoding failed:', error);
            handleGeocodingError();
        });
}

function showAddressSuccess() {
    const mapInfo = document.querySelector('.map-info');
    mapInfo.innerHTML = `
        <small class="text-success">
            <i class="bi bi-check-circle me-1"></i>
            Alamat berhasil diambil dari lokasi yang dipilih. Data wilayah akan otomatis tersimpan ke database.
        </small>
    `;
    
    setTimeout(() => {
        mapInfo.innerHTML = `
            <small class="text-muted">
                <i class="bi bi-info-circle me-1"></i>
                Klik pada peta untuk menandai lokasi tempat tinggal Anda. Alamat akan otomatis terisi berdasarkan lokasi yang dipilih.
            </small>
        `;
    }, 3000);
}

function handleGeocodingError() {
    const alamatField = document.getElementById('alamat');
    alamatField.value = '';
    alamatField.style.color = '#495057';
    alamatField.placeholder = 'Alamat tidak dapat diambil otomatis, silakan isi manual';
    
    const mapInfo = document.querySelector('.map-info');
    mapInfo.innerHTML = `
        <small class="text-warning">
            <i class="bi bi-exclamation-triangle me-1"></i>
            Alamat tidak dapat diambil otomatis. Silakan isi alamat secara manual di kolom di atas.
        </small>
    `;
}

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Add some delay to ensure all elements are loaded
    setTimeout(initLeafletMap, 500);
    
    // Add manual address input handler
    const alamatField = document.getElementById('alamat');
    alamatField.addEventListener('input', function() {
        // Reset coordinates when manually typing
        if (this.value.length > 10) {
            document.getElementById('latitude').value = '';
            document.getElementById('longitude').value = '';
        }
    });
});

// Add custom CSS for marker
const style = document.createElement('style');
style.textContent = `
    .custom-marker {
        background: none;
        border: none;
    }
    .leaflet-popup-content-wrapper {
        border-radius: 8px;
    }
`;
document.head.appendChild(style);
</script>
@endsection
