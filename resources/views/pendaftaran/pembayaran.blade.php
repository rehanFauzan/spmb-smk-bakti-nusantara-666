@extends('layouts.main')

@section('content')
<!-- Page Title -->
<div class="page-title">
  <div class="heading">
    <div class="container">
      <div class="row d-flex justify-content-center text-center">
        <div class="col-lg-8">
          <h1 class="heading-title">Pembayaran</h1>
          <p class="mb-0">Lakukan pembayaran biaya pendaftaran untuk menyelesaikan proses pendaftaran Anda</p>
        </div>
      </div>
    </div>
  </div>
  <nav class="breadcrumbs">
    <div class="container">
      <ol>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('pendaftaran.index') }}">Pendaftaran</a></li>
        <li class="current">Pembayaran</li>
      </ol>
    </div>
  </nav>
</div>

<!-- Payment Section -->
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
      <div class="progress-step completed">
        <div class="step-number"><i class="bi bi-check"></i></div>
        <span>Upload Berkas</span>
      </div>
      <div class="progress-line completed"></div>
      <div class="progress-step active">
        <div class="step-number">4</div>
        <span>Pembayaran</span>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-10">
        
        <!-- Payment Container -->
        <div class="payment-container" data-aos="fade-up" data-aos-delay="200">
          
          <div class="row">
            <!-- Payment Info -->
            <div class="col-lg-6">
              <div class="payment-info">
                <div class="payment-header">
                  <div class="payment-icon">
                    <i class="bi bi-credit-card"></i>
                  </div>
                  <h3>Informasi Pembayaran</h3>
                  <p class="text-muted">Silakan lakukan pembayaran sesuai dengan nominal yang tertera</p>
                </div>

                <!-- Payment Details -->
                <div class="payment-details">
                  <div class="detail-card">
                    <div class="detail-header">
                      <i class="bi bi-receipt text-primary"></i>
                      <h5>Rincian Biaya</h5>
                    </div>
                    <div class="detail-content">
                      <div class="detail-item">
                        <span class="label">Biaya Pendaftaran:</span>
                        <span class="value">Rp {{ number_format($pendaftarSiswa->biaya_daftar, 0, ',', '.') }}</span>
                      </div>
                      <div class="detail-item">
                        <span class="label">No. Pendaftaran:</span>
                        <span class="value">{{ $pendaftarSiswa->no_pendaftaran }}</span>
                      </div>
                      <div class="detail-item total">
                        <span class="label">Total Pembayaran:</span>
                        <span class="value">Rp {{ number_format($pendaftarSiswa->biaya_daftar, 0, ',', '.') }}</span>
                      </div>
                    </div>
                  </div>

                  <!-- Bank Account Info -->
                  <div class="bank-info">
                    <div class="bank-header">
                      <i class="bi bi-bank text-success"></i>
                      <h5>Rekening Pembayaran</h5>
                    </div>
                    <div class="bank-accounts">
                      <div class="bank-account">
                        <div class="bank-logo">
                          <i class="bi bi-bank2"></i>
                        </div>
                        <div class="bank-details">
                          <h6>Bank BCA</h6>
                          <p class="account-number">1234567890</p>
                          <p class="account-name">SMK Bakti Nusantara 666</p>
                        </div>
                        <button class="btn-copy" onclick="copyToClipboard('1234567890')">
                          <i class="bi bi-copy"></i>
                        </button>
                      </div>
                      
                      <div class="bank-account">
                        <div class="bank-logo">
                          <i class="bi bi-bank2"></i>
                        </div>
                        <div class="bank-details">
                          <h6>Bank Mandiri</h6>
                          <p class="account-number">0987654321</p>
                          <p class="account-name">SMK Bakti Nusantara 666</p>
                        </div>
                        <button class="btn-copy" onclick="copyToClipboard('0987654321')">
                          <i class="bi bi-copy"></i>
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- Payment Instructions -->
                  <div class="payment-instructions">
                    <h6><i class="bi bi-info-circle me-2"></i>Petunjuk Pembayaran</h6>
                    <ol>
                      <li>Transfer sesuai nominal yang tertera</li>
                      <li>Simpan bukti transfer/struk ATM</li>
                      <li>Upload bukti pembayaran di form sebelah</li>
                      <li>Tunggu verifikasi dari admin (1x24 jam)</li>
                    </ol>
                  </div>
                </div>
              </div>
            </div>

            <!-- Payment Form -->
            <div class="col-lg-6">
              <div class="payment-form-wrapper">
                
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

                <form action="{{ route('pendaftaran.pembayaran.store') }}" method="POST" enctype="multipart/form-data" class="payment-form">
                  @csrf
                  
                  <div class="form-header">
                    <div class="form-icon">
                      <i class="bi bi-cloud-upload"></i>
                    </div>
                    <h4>Upload Bukti Pembayaran</h4>
                    <p class="text-muted">Upload bukti transfer atau struk ATM Anda</p>
                  </div>

                  <!-- Nominal Input -->
                  <div class="form-group mb-4">
                    <label class="form-label">Nominal yang Dibayar <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-text">Rp</span>
                      <input type="number" 
                             name="nominal" 
                             class="form-control @error('nominal') is-invalid @enderror" 
                             value="{{ old('nominal', $pendaftarSiswa->biaya_daftar) }}"
                             placeholder="Masukkan nominal yang dibayar"
                             required>
                      @error('nominal')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <small class="form-text text-muted">Pastikan nominal sesuai dengan yang tertera di rincian biaya</small>
                  </div>

                  <!-- File Upload -->
                  <div class="form-group mb-4">
                    <label class="form-label">Bukti Pembayaran <span class="text-danger">*</span></label>
                    <div class="upload-area" id="upload-bukti">
                      <input type="file" 
                             name="bukti_bayar" 
                             id="bukti_bayar"
                             class="file-input @error('bukti_bayar') is-invalid @enderror" 
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
                    @error('bukti_bayar')
                      <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                  </div>

                  <!-- Form Actions -->
                  <div class="form-actions">
                    <div class="row">
                      <div class="col-md-6">
                        <a href="{{ route('pendaftaran.upload') }}" class="btn btn-outline-secondary btn-lg w-100">
                          <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                      </div>
                      <div class="col-md-6">
                        <button type="submit" class="btn btn-primary w-100">
                          <i class="bi bi-check-circle me-2"></i>Konfirmasi Pembayaran
                        </button>
                      </div>
                    </div>
                  </div>
                  
                </form>
              </div>
            </div>
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

.payment-container {
  background: white;
  border-radius: 20px;
  padding: 2.5rem;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  border: 1px solid #f0f0f0;
}

.payment-info {
  padding-right: 2rem;
}

.payment-header {
  text-align: center;
  margin-bottom: 2rem;
}

.payment-icon {
  width: 80px;
  height: 80px;
  background: #3F72AF;
  color: white;
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2rem;
  margin: 0 auto 1rem;
}

.payment-header h3 {
  color: var(--heading-color);
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.detail-card {
  background: #f8f9fa;
  border-radius: 15px;
  padding: 1.5rem;
  margin-bottom: 2rem;
  border: 1px solid #e9ecef;
}

.detail-header {
  display: flex;
  align-items: center;
  margin-bottom: 1rem;
}

.detail-header i {
  font-size: 1.5rem;
  margin-right: 0.5rem;
}

.detail-header h5 {
  color: var(--heading-color);
  font-weight: 600;
  margin: 0;
}

.detail-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.75rem 0;
  border-bottom: 1px solid #e9ecef;
}

.detail-item:last-child {
  border-bottom: none;
}

.detail-item.total {
  background: var(--accent-color);
  color: white;
  margin: 1rem -1.5rem -1.5rem;
  padding: 1rem 1.5rem;
  border-radius: 0 0 15px 15px;
  font-weight: 600;
  font-size: 1.1rem;
}

.detail-item .label {
  font-weight: 500;
}

.detail-item .value {
  font-weight: 600;
}

.bank-info {
  margin-bottom: 2rem;
}

.bank-header {
  display: flex;
  align-items: center;
  margin-bottom: 1rem;
}

.bank-header i {
  font-size: 1.5rem;
  margin-right: 0.5rem;
}

.bank-header h5 {
  color: var(--heading-color);
  font-weight: 600;
  margin: 0;
}

.bank-account {
  display: flex;
  align-items: center;
  background: white;
  border: 2px solid #e9ecef;
  border-radius: 12px;
  padding: 1rem;
  margin-bottom: 1rem;
  transition: all 0.3s ease;
}

.bank-account:hover {
  border-color: var(--accent-color);
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.bank-logo {
  width: 50px;
  height: 50px;
  background: #f8f9fa;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 1rem;
}

.bank-logo i {
  font-size: 1.5rem;
  color: var(--accent-color);
}

.bank-details {
  flex: 1;
}

.bank-details h6 {
  color: var(--heading-color);
  font-weight: 600;
  margin-bottom: 0.25rem;
}

.account-number {
  font-size: 1.1rem;
  font-weight: 700;
  color: var(--accent-color);
  margin-bottom: 0.25rem;
  font-family: 'Courier New', monospace;
}

.account-name {
  font-size: 0.9rem;
  color: #6c757d;
  margin: 0;
}

.btn-copy {
  background: var(--accent-color);
  color: white;
  border: none;
  border-radius: 8px;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
}

.btn-copy:hover {
  background: #0056b3;
  transform: scale(1.1);
}

.payment-instructions {
  background: #e3f2fd;
  border-radius: 12px;
  padding: 1.5rem;
  border-left: 4px solid var(--accent-color);
}

.payment-instructions h6 {
  color: var(--heading-color);
  font-weight: 600;
  margin-bottom: 1rem;
}

.payment-instructions ol {
  margin: 0;
  padding-left: 1.2rem;
}

.payment-instructions li {
  color: #6c757d;
  margin-bottom: 0.5rem;
  font-size: 0.9rem;
}

.payment-form-wrapper {
  background: #f8f9fa;
  border-radius: 15px;
  padding: 2rem;
  height: fit-content;
}

.form-header {
  text-align: center;
  margin-bottom: 2rem;
}

.form-icon {
  width: 60px;
  height: 60px;
  background: #3F72AF;
  color: white;
  border-radius: 15px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
  margin: 0 auto 1rem;
}

.form-header h4 {
  color: var(--heading-color);
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.form-group .form-label {
  font-weight: 600;
  color: var(--heading-color);
  margin-bottom: 0.5rem;
}

.input-group-text {
  background: var(--accent-color);
  color: white;
  border: 1px solid var(--accent-color);
  font-weight: 600;
}

.form-control {
  border: 1px solid #e9ecef;
  padding: 0.75rem 1rem;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.form-control:focus {
  border-color: var(--accent-color);
  box-shadow: 0 0 0 0.2rem rgba(63, 114, 175, 0.25);
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
  border-top: 1px solid #e9ecef;
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
  background: #3F72AF;
  border: none;
}

.form-actions .btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

@media (max-width: 768px) {
  .progress-indicator {
    flex-direction: column;
    gap: 1rem;
  }
  
  .progress-line {
    display: none;
  }
  
  .payment-container {
    padding: 1.5rem;
    margin: 0 1rem;
  }
  
  .payment-info {
    padding-right: 0;
    margin-bottom: 2rem;
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
  
  .form-actions .btn {
    margin-bottom: 1rem;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // File upload handling
  const fileInput = document.getElementById('bukti_bayar');
  const uploadArea = document.getElementById('upload-bukti');
  const uploadContent = uploadArea.querySelector('.upload-content');
  const filePreview = uploadArea.querySelector('.file-preview');
  const fileName = filePreview.querySelector('.file-name');
  const removeBtn = filePreview.querySelector('.btn-remove');
  
  // File input change
  fileInput.addEventListener('change', function() {
    if (this.files && this.files[0]) {
      showFilePreview(this.files[0]);
    }
  });
  
  // Drag and drop
  uploadArea.addEventListener('dragover', function(e) {
    e.preventDefault();
    this.style.borderColor = 'var(--accent-color)';
    this.style.background = 'rgba(13, 110, 253, 0.1)';
  });
  
  uploadArea.addEventListener('dragleave', function(e) {
    e.preventDefault();
    this.style.borderColor = '#dee2e6';
    this.style.background = 'transparent';
  });
  
  uploadArea.addEventListener('drop', function(e) {
    e.preventDefault();
    this.style.borderColor = '#dee2e6';
    this.style.background = 'transparent';
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
      fileInput.files = files;
      showFilePreview(files[0]);
    }
  });
  
  // Remove file
  removeBtn.addEventListener('click', function(e) {
    e.stopPropagation();
    fileInput.value = '';
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

// Copy to clipboard function
function copyToClipboard(text) {
  navigator.clipboard.writeText(text).then(function() {
    // Show success message
    const toast = document.createElement('div');
    toast.className = 'toast-message';
    toast.textContent = 'Nomor rekening berhasil disalin!';
    toast.style.cssText = `
      position: fixed;
      top: 20px;
      right: 20px;
      background: #28a745;
      color: white;
      padding: 1rem 1.5rem;
      border-radius: 8px;
      z-index: 9999;
      animation: slideIn 0.3s ease;
    `;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
      toast.remove();
    }, 3000);
  });
}

// Add CSS for toast animation
const style = document.createElement('style');
style.textContent = `
  @keyframes slideIn {
    from {
      transform: translateX(100%);
      opacity: 0;
    }
    to {
      transform: translateX(0);
      opacity: 1;
    }
  }
`;
document.head.appendChild(style);
</script>
@endsection