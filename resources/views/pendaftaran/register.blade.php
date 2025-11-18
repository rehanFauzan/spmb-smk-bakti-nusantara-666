@extends('layouts.main')

@section('content')
<!-- Page Title -->
<div class="page-title">
  <div class="heading">
    <div class="container">
      <div class="row d-flex justify-content-center text-center">
        <div class="col-lg-8">
          <h1 class="heading-title">Registrasi Akun</h1>
          <p class="mb-0">Buat akun untuk memulai proses pendaftaran sebagai calon siswa</p>
        </div>
      </div>
    </div>
  </div>
  <nav class="breadcrumbs">
    <div class="container">
      <ol>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('pendaftaran.index') }}">Pendaftaran</a></li>
        <li class="current">Registrasi Akun</li>
      </ol>
    </div>
  </nav>
</div>

<!-- Registration Section -->
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">
        
        <!-- Progress Indicator -->
        <div class="progress-indicator mb-4" data-aos="fade-up">
          <div class="progress-step active">
            <div class="step-number">1</div>
            <span>Registrasi Akun</span>
          </div>
          <div class="progress-line"></div>
          <div class="progress-step">
            <div class="step-number">2</div>
            <span>Formulir Pendaftaran</span>
          </div>
          <div class="progress-line"></div>
          <div class="progress-step">
            <div class="step-number">3</div>
            <span>Upload Berkas</span>
          </div>
        </div>

        <!-- Registration Form -->
        <div class="registration-form-container" data-aos="fade-up" data-aos-delay="200">
          <div class="form-header text-center mb-4">
            <div class="form-icon">
              <i class="bi bi-person-plus"></i>
            </div>
            <h3>Buat Akun Baru</h3>
            <p class="text-muted">Lengkapi informasi dasar untuk membuat akun pendaftaran</p>
          </div>

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('pendaftaran.register.store') }}" method="POST" class="registration-form">
            @csrf
            
            <div class="form-group mb-3">
              <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" 
                       class="form-control @error('nama_lengkap') is-invalid @enderror" 
                       id="nama_lengkap" 
                       name="nama_lengkap" 
                       value="{{ old('nama_lengkap') }}"
                       placeholder="Masukkan nama lengkap Anda" 
                       required>
              </div>
              @error('nama_lengkap')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group mb-3">
              <label for="email" class="form-label">Email</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       placeholder="contoh@email.com" 
                       required>
              </div>
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              <div class="form-text">Email akan digunakan untuk login dan verifikasi akun</div>
            </div>

            <div class="form-group mb-3">
              <label for="no_hp" class="form-label">Nomor HP/WhatsApp</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-phone"></i></span>
                <input type="tel" 
                       class="form-control @error('no_hp') is-invalid @enderror" 
                       id="no_hp" 
                       name="no_hp" 
                       value="{{ old('no_hp') }}"
                       placeholder="08xxxxxxxxxx" 
                       required>
              </div>
              @error('no_hp')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group mb-3">
              <label for="password" class="form-label">Password</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       id="password" 
                       name="password" 
                       placeholder="Minimal 8 karakter" 
                       required>
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group mb-4">
              <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <input type="password" 
                       class="form-control" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       placeholder="Ulangi password" 
                       required>
                <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
            </div>

            <div class="form-check mb-4">
              <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
              <label class="form-check-label" for="terms">
                Saya menyetujui <a href="{{ route('syarat-ketentuan') }}" target="_blank">Syarat dan Ketentuan</a> 
                serta <a href="{{ route('kebijakan-privasi') }}" target="_blank">Kebijakan Privasi</a>
              </label>
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-person-plus me-2"></i>Buat Akun
              </button>
            </div>

            <div class="text-center mt-3">
              <p class="mb-0">Sudah punya akun? 
                <a href="{{ route('pendaftaran.login') }}" class="text-decoration-none">Login di sini</a>
              </p>
            </div>
          </form>
        </div>

        <!-- Security Info -->
        <div class="security-info mt-4" data-aos="fade-up" data-aos-delay="400">
          <div class="info-card">
            <div class="row align-items-center">
              <div class="col-auto">
                <div class="security-icon">
                  <i class="bi bi-shield-check"></i>
                </div>
              </div>
              <div class="col">
                <h6 class="mb-1">Keamanan Data Terjamin</h6>
                <p class="mb-0 small text-muted">Data pribadi Anda akan dienkripsi dan disimpan dengan aman sesuai standar keamanan internasional.</p>
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

.progress-step span {
  font-size: 0.8rem;
  color: #6c757d;
  font-weight: 500;
}

.progress-step.active span {
  color: var(--accent-color);
  font-weight: 600;
}

.progress-line {
  height: 2px;
  background: #e9ecef;
  flex: 1;
  margin: 0 1rem;
  margin-top: -20px;
}

.registration-form-container {
  background: white;
  border-radius: 20px;
  padding: 2.5rem;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  border: 1px solid #f0f0f0;
}

.form-header .form-icon {
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

.form-header h3 {
  color: var(--heading-color);
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.registration-form .form-label {
  font-weight: 600;
  color: var(--heading-color);
  margin-bottom: 0.5rem;
}

.registration-form .input-group-text {
  background: #f8f9fa;
  border: 1px solid #e9ecef;
  color: var(--accent-color);
}

.registration-form .form-control {
  border: 1px solid #e9ecef;
  padding: 0.75rem 1rem;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.registration-form .form-control:focus {
  border-color: var(--accent-color);
  box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.registration-form .btn-primary {
  background: linear-gradient(135deg, var(--accent-color) 0%, #0056b3 100%);
  border: none;
  padding: 0.75rem 2rem;
  border-radius: 50px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  transition: all 0.3s ease;
}

.registration-form .btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.form-check-input:checked {
  background-color: var(--accent-color);
  border-color: var(--accent-color);
}

.security-info .info-card {
  background: #f8f9fa;
  border-radius: 15px;
  padding: 1.5rem;
  border-left: 4px solid var(--accent-color);
}

.security-icon {
  width: 50px;
  height: 50px;
  background: var(--accent-color);
  color: white;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.2rem;
}

.security-info h6 {
  color: var(--heading-color);
  font-weight: 600;
}

@media (max-width: 768px) {
  .progress-indicator {
    flex-direction: column;
    gap: 1rem;
  }
  
  .progress-line {
    display: none;
  }
  
  .registration-form-container {
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
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Toggle password visibility
  const togglePassword = document.getElementById('togglePassword');
  const password = document.getElementById('password');
  
  togglePassword.addEventListener('click', function() {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    
    const icon = this.querySelector('i');
    icon.classList.toggle('bi-eye');
    icon.classList.toggle('bi-eye-slash');
  });
  
  // Toggle password confirmation visibility
  const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
  const passwordConfirm = document.getElementById('password_confirmation');
  
  togglePasswordConfirm.addEventListener('click', function() {
    const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordConfirm.setAttribute('type', type);
    
    const icon = this.querySelector('i');
    icon.classList.toggle('bi-eye');
    icon.classList.toggle('bi-eye-slash');
  });
  
  // Phone number formatting
  const phoneInput = document.getElementById('no_hp');
  phoneInput.addEventListener('input', function() {
    let value = this.value.replace(/\D/g, '');
    if (value.startsWith('0')) {
      this.value = value;
    } else if (value.startsWith('62')) {
      this.value = '0' + value.substring(2);
    }
  });
});
</script>
@endsection