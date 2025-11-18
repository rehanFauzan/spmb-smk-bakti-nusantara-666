@extends('layouts.main')

@section('content')
<!-- Page Title -->
<div class="page-title">
  <div class="heading">
    <div class="container">
      <div class="row d-flex justify-content-center text-center">
        <div class="col-lg-8">
          <h1 class="heading-title">Upload Berkas</h1>
          <p class="mb-0">Upload dokumen persyaratan pendaftaran Anda</p>
        </div>
      </div>
    </div>
  </div>
  <nav class="breadcrumbs">
    <div class="container">
      <ol>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('pendaftaran.index') }}">Pendaftaran</a></li>
        <li class="current">Upload Berkas</li>
      </ol>
    </div>
  </nav>
</div>

<!-- Upload Section -->
<section class="section">
  <div class="container">
    
    <!-- Progress Indicator -->
    <div class="progress-indicator mb-5" data-aos="fade-up">
      <div class="progress-step completed">
        <div class="step-number"><i class="bi bi-check"></i></div>
        <span>Registrasi Akun</span>
      </div>
      <div class="progress-line completed"></div>
      <div class="progress-step completed">
        <div class="step-number"><i class="bi bi-check"></i></div>
        <span>Formulir Pendaftaran</span>
      </div>
      <div class="progress-line completed"></div>
      <div class="progress-step active">
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
        
        <!-- Upload Container -->
        <div class="upload-container" data-aos="fade-up" data-aos-delay="200">
          
          <div class="upload-header text-center mb-4">
            <div class="upload-icon">
              <i class="bi bi-cloud-upload"></i>
            </div>
            <h3>Upload Dokumen Persyaratan</h3>
            <p class="text-muted">Pastikan semua dokumen dalam format PDF, JPG, atau PNG dengan ukuran maksimal 2MB</p>
          </div>

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

          @if (session('success'))
            <div class="alert alert-success">
              <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            </div>
          @endif

          <form action="{{ route('pendaftaran.upload.store') }}" method="POST" enctype="multipart/form-data" class="upload-form">
            @csrf
            
            <!-- Required Documents -->
            <div class="documents-section">
              <h5 class="section-title mb-4">
                <i class="bi bi-file-earmark-check me-2"></i>Dokumen Wajib
              </h5>
              
              <div class="row gy-4">
                <!-- Ijazah/Rapor -->
                <div class="col-md-6">
                  <div class="document-card">
                    <div class="document-header">
                      <div class="document-icon">
                        <i class="bi bi-file-earmark-text"></i>
                      </div>
                      <div class="document-info">
                        <h6>Ijazah/Rapor SMP <span class="text-danger">*</span></h6>
                        <p class="small text-muted">Upload ijazah atau rapor semester terakhir</p>
                      </div>
                    </div>
                    
                    <div class="upload-area" id="upload-ijazah">
                      <input type="file" 
                             name="berkas_ijazah" 
                             id="berkas_ijazah"
                             class="file-input @error('berkas_ijazah') is-invalid @enderror" 
                             accept=".pdf,.jpg,.jpeg,.png"
                             required>
                      <div class="upload-content">
                        <i class="bi bi-cloud-upload upload-icon"></i>
                        <p class="upload-text">Klik atau drag file ke sini</p>
                        <p class="upload-hint">PDF, JPG, PNG (Max: 2MB)</p>
                      </div>
                      <div class="file-preview" style="display: none;">
                        <i class="bi bi-file-earmark-check text-success"></i>
                        <span class="file-name"></span>
                        <button type="button" class="btn-remove">
                          <i class="bi bi-x"></i>
                        </button>
                      </div>
                    </div>
                    @error('berkas_ijazah')
                      <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <!-- Kartu Keluarga -->
                <div class="col-md-6">
                  <div class="document-card">
                    <div class="document-header">
                      <div class="document-icon">
                        <i class="bi bi-people"></i>
                      </div>
                      <div class="document-info">
                        <h6>Kartu Keluarga <span class="text-danger">*</span></h6>
                        <p class="small text-muted">Kartu Keluarga yang masih berlaku</p>
                      </div>
                    </div>
                    
                    <div class="upload-area" id="upload-kk">
                      <input type="file" 
                             name="berkas_kk" 
                             id="berkas_kk"
                             class="file-input @error('berkas_kk') is-invalid @enderror" 
                             accept=".pdf,.jpg,.jpeg,.png"
                             required>
                      <div class="upload-content">
                        <i class="bi bi-cloud-upload upload-icon"></i>
                        <p class="upload-text">Klik atau drag file ke sini</p>
                        <p class="upload-hint">PDF, JPG, PNG (Max: 2MB)</p>
                      </div>
                      <div class="file-preview" style="display: none;">
                        <i class="bi bi-file-earmark-check text-success"></i>
                        <span class="file-name"></span>
                        <button type="button" class="btn-remove">
                          <i class="bi bi-x"></i>
                        </button>
                      </div>
                    </div>
                    @error('berkas_kk')
                      <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <!-- Akta Kelahiran -->
                <div class="col-md-6">
                  <div class="document-card">
                    <div class="document-header">
                      <div class="document-icon">
                        <i class="bi bi-file-earmark-person"></i>
                      </div>
                      <div class="document-info">
                        <h6>Akta Kelahiran <span class="text-danger">*</span></h6>
                        <p class="small text-muted">Akta kelahiran asli atau fotokopi</p>
                      </div>
                    </div>
                    
                    <div class="upload-area" id="upload-akta">
                      <input type="file" 
                             name="berkas_akta" 
                             id="berkas_akta"
                             class="file-input @error('berkas_akta') is-invalid @enderror" 
                             accept=".pdf,.jpg,.jpeg,.png"
                             required>
                      <div class="upload-content">
                        <i class="bi bi-cloud-upload upload-icon"></i>
                        <p class="upload-text">Klik atau drag file ke sini</p>
                        <p class="upload-hint">PDF, JPG, PNG (Max: 2MB)</p>
                      </div>
                      <div class="file-preview" style="display: none;">
                        <i class="bi bi-file-earmark-check text-success"></i>
                        <span class="file-name"></span>
                        <button type="button" class="btn-remove">
                          <i class="bi bi-x"></i>
                        </button>
                      </div>
                    </div>
                    @error('berkas_akta')
                      <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <!-- Pas Foto -->
                <div class="col-md-6">
                  <div class="document-card">
                    <div class="document-header">
                      <div class="document-icon">
                        <i class="bi bi-person-square"></i>
                      </div>
                      <div class="document-info">
                        <h6>Pas Foto 3x4 <span class="text-danger">*</span></h6>
                        <p class="small text-muted">Foto terbaru dengan latar belakang merah</p>
                      </div>
                    </div>
                    
                    <div class="upload-area" id="upload-foto">
                      <input type="file" 
                             name="pas_foto" 
                             id="pas_foto"
                             class="file-input @error('pas_foto') is-invalid @enderror" 
                             accept=".jpg,.jpeg,.png"
                             required>
                      <div class="upload-content">
                        <i class="bi bi-cloud-upload upload-icon"></i>
                        <p class="upload-text">Klik atau drag file ke sini</p>
                        <p class="upload-hint">JPG, PNG (Max: 1MB)</p>
                      </div>
                      <div class="file-preview" style="display: none;">
                        <i class="bi bi-file-earmark-check text-success"></i>
                        <span class="file-name"></span>
                        <button type="button" class="btn-remove">
                          <i class="bi bi-x"></i>
                        </button>
                      </div>
                    </div>
                    @error('pas_foto')
                      <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
            </div>

            <!-- Optional Documents -->
            <div class="documents-section mt-5">
              <h5 class="section-title mb-4">
                <i class="bi bi-file-earmark-plus me-2"></i>Dokumen Tambahan <span class="text-muted">(Opsional)</span>
              </h5>
              
              <div class="row gy-4">
                <!-- Sertifikat Prestasi -->
                <div class="col-md-6">
                  <div class="document-card optional">
                    <div class="document-header">
                      <div class="document-icon">
                        <i class="bi bi-award"></i>
                      </div>
                      <div class="document-info">
                        <h6>Sertifikat Prestasi</h6>
                        <p class="small text-muted">Sertifikat prestasi akademik/non-akademik</p>
                      </div>
                    </div>
                    
                    <div class="upload-area" id="upload-prestasi">
                      <input type="file" 
                             name="sertifikat_prestasi" 
                             id="sertifikat_prestasi"
                             class="file-input" 
                             accept=".pdf,.jpg,.jpeg,.png">
                      <div class="upload-content">
                        <i class="bi bi-cloud-upload upload-icon"></i>
                        <p class="upload-text">Klik atau drag file ke sini</p>
                        <p class="upload-hint">PDF, JPG, PNG (Max: 2MB)</p>
                      </div>
                      <div class="file-preview" style="display: none;">
                        <i class="bi bi-file-earmark-check text-success"></i>
                        <span class="file-name"></span>
                        <button type="button" class="btn-remove">
                          <i class="bi bi-x"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Surat Keterangan Tidak Mampu -->
                <div class="col-md-6">
                  <div class="document-card optional">
                    <div class="document-header">
                      <div class="document-icon">
                        <i class="bi bi-file-earmark-medical"></i>
                      </div>
                      <div class="document-info">
                        <h6>SKTM</h6>
                        <p class="small text-muted">Surat Keterangan Tidak Mampu (jika ada)</p>
                      </div>
                    </div>
                    
                    <div class="upload-area" id="upload-sktm">
                      <input type="file" 
                             name="sktm" 
                             id="sktm"
                             class="file-input" 
                             accept=".pdf,.jpg,.jpeg,.png">
                      <div class="upload-content">
                        <i class="bi bi-cloud-upload upload-icon"></i>
                        <p class="upload-text">Klik atau drag file ke sini</p>
                        <p class="upload-hint">PDF, JPG, PNG (Max: 2MB)</p>
                      </div>
                      <div class="file-preview" style="display: none;">
                        <i class="bi bi-file-earmark-check text-success"></i>
                        <span class="file-name"></span>
                        <button type="button" class="btn-remove">
                          <i class="bi bi-x"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions text-center mt-5">
              <div class="row">
                <div class="col-md-6">
                  <a href="{{ route('pendaftaran.form') }}" class="btn btn-outline-secondary btn-lg w-100">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                  </a>
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-primary btn-lg w-100">
                    <i class="bi bi-arrow-right me-2"></i>Lanjut ke Pembayaran
                  </button>
                </div>
              </div>
            </div>
            
          </form>
        </div>

        <!-- Upload Guidelines -->
        <div class="upload-guidelines mt-4" data-aos="fade-up" data-aos-delay="400">
          <div class="guidelines-card">
            <h6><i class="bi bi-info-circle me-2"></i>Panduan Upload Dokumen</h6>
            <ul class="guidelines-list">
              <li>Pastikan dokumen dalam kondisi jelas dan dapat dibaca</li>
              <li>Format file yang diterima: PDF, JPG, JPEG, PNG</li>
              <li>Ukuran maksimal file: 2MB untuk dokumen, 1MB untuk foto</li>
              <li>Scan atau foto dokumen dengan pencahayaan yang cukup</li>
              <li>Hindari dokumen yang buram atau terpotong</li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<style>
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

.upload-container {
  background: white;
  border-radius: 20px;
  padding: 2.5rem;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  border: 1px solid #f0f0f0;
}

.upload-header .upload-icon {
  width: 80px;
  height: 80px;
  background: linear-gradient(135deg, var(--accent-color) 0%, #0056b3 100%);
  color: white;
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2rem;
  margin: 0 auto 1rem;
}

.upload-header h3 {
  color: var(--heading-color);
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.documents-section {
  margin-bottom: 2rem;
}

.section-title {
  color: var(--heading-color);
  font-weight: 600;
  padding-bottom: 0.5rem;
  border-bottom: 2px solid var(--accent-color);
  display: inline-block;
}

.document-card {
  background: #f8f9fa;
  border-radius: 15px;
  padding: 1.5rem;
  border: 2px solid #e9ecef;
  transition: all 0.3s ease;
  height: 100%;
}

.document-card:hover {
  border-color: var(--accent-color);
  transform: translateY(-2px);
}

.document-card.optional {
  border-style: dashed;
  opacity: 0.8;
}

.document-header {
  display: flex;
  align-items: center;
  margin-bottom: 1rem;
}

.document-icon {
  width: 50px;
  height: 50px;
  background: var(--accent-color);
  color: white;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.2rem;
  margin-right: 1rem;
}

.document-info h6 {
  color: var(--heading-color);
  font-weight: 600;
  margin-bottom: 0.25rem;
}

.upload-area {
  position: relative;
  border: 2px dashed #dee2e6;
  border-radius: 12px;
  padding: 2rem 1rem;
  text-align: center;
  transition: all 0.3s ease;
  cursor: pointer;
}

.upload-area:hover {
  border-color: var(--accent-color);
  background: rgba(13, 110, 253, 0.05);
}

.upload-area.dragover {
  border-color: var(--accent-color);
  background: rgba(13, 110, 253, 0.1);
}

.file-input {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  opacity: 0;
  cursor: pointer;
}

.upload-content .upload-icon {
  font-size: 2rem;
  color: var(--accent-color);
  margin-bottom: 0.5rem;
}

.upload-text {
  font-weight: 600;
  color: var(--heading-color);
  margin-bottom: 0.25rem;
}

.upload-hint {
  font-size: 0.8rem;
  color: #6c757d;
  margin-bottom: 0;
}

.file-preview {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  padding: 1rem;
  background: #f8f9fa;
  border-radius: 8px;
  border: 1px solid #28a745;
}

.file-preview i {
  font-size: 1.5rem;
}

.file-name {
  font-weight: 600;
  color: var(--heading-color);
  flex: 1;
  text-align: left;
}

.btn-remove {
  background: #dc3545;
  color: white;
  border: none;
  border-radius: 50%;
  width: 30px;
  height: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
}

.btn-remove:hover {
  background: #c82333;
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

.upload-guidelines .guidelines-card {
  background: #f8f9fa;
  border-radius: 15px;
  padding: 1.5rem;
  border-left: 4px solid var(--accent-color);
}

.guidelines-card h6 {
  color: var(--heading-color);
  font-weight: 600;
  margin-bottom: 1rem;
}

.guidelines-list {
  margin-bottom: 0;
  padding-left: 1rem;
}

.guidelines-list li {
  color: #6c757d;
  margin-bottom: 0.5rem;
  font-size: 0.9rem;
}

@media (max-width: 768px) {
  .progress-indicator {
    flex-direction: column;
    gap: 1rem;
  }
  
  .progress-line {
    display: none;
  }
  
  .upload-container {
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
  
  .document-header {
    flex-direction: column;
    text-align: center;
  }
  
  .document-icon {
    margin-right: 0;
    margin-bottom: 1rem;
  }
  
  .form-actions .btn {
    margin-bottom: 1rem;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // File upload handling
  const fileInputs = document.querySelectorAll('.file-input');
  
  fileInputs.forEach(input => {
    const uploadArea = input.closest('.upload-area');
    const uploadContent = uploadArea.querySelector('.upload-content');
    const filePreview = uploadArea.querySelector('.file-preview');
    const fileName = filePreview.querySelector('.file-name');
    const removeBtn = filePreview.querySelector('.btn-remove');
    
    // File input change
    input.addEventListener('change', function() {
      if (this.files && this.files[0]) {
        showFilePreview(this.files[0]);
      }
    });
    
    // Drag and drop
    uploadArea.addEventListener('dragover', function(e) {
      e.preventDefault();
      this.classList.add('dragover');
    });
    
    uploadArea.addEventListener('dragleave', function(e) {
      e.preventDefault();
      this.classList.remove('dragover');
    });
    
    uploadArea.addEventListener('drop', function(e) {
      e.preventDefault();
      this.classList.remove('dragover');
      
      const files = e.dataTransfer.files;
      if (files.length > 0) {
        input.files = files;
        showFilePreview(files[0]);
      }
    });
    
    // Remove file
    removeBtn.addEventListener('click', function(e) {
      e.stopPropagation();
      input.value = '';
      hideFilePreview();
    });
    
    function showFilePreview(file) {
      fileName.textContent = file.name;
      uploadContent.style.display = 'none';
      filePreview.style.display = 'flex';
    }
    
    function hideFilePreview() {
      uploadContent.style.display = 'block';
      filePreview.style.display = 'none';
    }
  });
});
</script>
@endsection