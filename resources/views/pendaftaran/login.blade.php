@extends('layouts.main')

@section('content')
<!-- Page Title -->
<div class="page-title">
  <div class="heading">
    <div class="container">
      <div class="row d-flex justify-content-center text-center">
        <div class="col-lg-8">
          <h1 class="heading-title">Login Akun</h1>
          <p class="mb-0">Masuk ke akun Anda untuk melanjutkan proses pendaftaran</p>
        </div>
      </div>
    </div>
  </div>
  <nav class="breadcrumbs">
    <div class="container">
      <ol>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('pendaftaran.index') }}">Pendaftaran</a></li>
        <li class="current">Login</li>
      </ol>
    </div>
  </nav>
</div>

<!-- Login Section -->
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-7">
        
        <!-- Login Form -->
        <div class="login-form-container" data-aos="fade-up">
          <div class="form-header text-center mb-4">
            <div class="form-icon">
              <i class="bi bi-box-arrow-in-right"></i>
            </div>
            <h3>Selamat Datang Kembali</h3>
            <p class="text-muted">Masuk ke akun Anda untuk melanjutkan pendaftaran</p>
          </div>

          @if (session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('pendaftaran.login.store') }}" method="POST" class="login-form">
            @csrf
            
            <div class="form-group mb-3">
              <label for="email" class="form-label">Email</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}"
                       placeholder="Masukkan email Anda" 
                       required>
              </div>
              @error('email')
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
                       placeholder="Masukkan password Anda" 
                       required>
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-check mb-4">
              <input class="form-check-input" type="checkbox" id="remember" name="remember">
              <label class="form-check-label" for="remember">
                Ingat saya
              </label>
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
              </button>
            </div>

            <div class="text-center mt-3">
              <p class="mb-2">
                <a href="{{ route('pendaftaran.forgot-password') }}" class="text-decoration-none">Lupa password?</a>
              </p>
              <p class="mb-2">Belum punya akun? 
                <a href="{{ route('pendaftaran.register') }}" class="text-decoration-none">Daftar di sini</a>
              </p>
              <p class="mb-0 small text-muted">
                Dengan masuk, Anda menyetujui 
                <a href="{{ route('syarat-ketentuan') }}" class="text-decoration-none" target="_blank">Syarat & Ketentuan</a> 
                dan 
                <a href="{{ route('kebijakan-privasi') }}" class="text-decoration-none" target="_blank">Kebijakan Privasi</a>
              </p>
            </div>
          </form>
        </div>

        <!-- Quick Access -->
        <div class="quick-access mt-4" data-aos="fade-up" data-aos-delay="200">
          <div class="info-card">
            <div class="row align-items-center">
              <div class="col-auto">
                <div class="access-icon">
                  <i class="bi bi-info-circle"></i>
                </div>
              </div>
              <div class="col">
                <h6 class="mb-1">Butuh Bantuan?</h6>
                <p class="mb-0 small text-muted">
                  Hubungi admin di <strong>(021) 123-4567</strong> atau 
                  <strong>WhatsApp: 0812-3456-7890</strong>
                </p>
              </div>
            </div>
          </div>
        </div>

      </div>
      
      <!-- Side Information -->
      <div class="col-lg-4 col-md-5 d-none d-md-block">
        <div class="login-info" data-aos="fade-left" data-aos-delay="300">
          <div class="info-header">
            <h4>Akses Dashboard Anda</h4>
            <p>Setelah login, Anda dapat:</p>
          </div>
          
          <div class="feature-list">
            <div class="feature-item">
              <div class="feature-icon">
                <i class="bi bi-file-text"></i>
              </div>
              <div class="feature-content">
                <h6>Melengkapi Formulir</h6>
                <p>Isi data pribadi dan pilih jurusan yang diinginkan</p>
              </div>
            </div>
            
            <div class="feature-item">
              <div class="feature-icon">
                <i class="bi bi-cloud-upload"></i>
              </div>
              <div class="feature-content">
                <h6>Upload Dokumen</h6>
                <p>Unggah berkas persyaratan pendaftaran</p>
              </div>
            </div>
            
            <div class="feature-item">
              <div class="feature-icon">
                <i class="bi bi-graph-up"></i>
              </div>
              <div class="feature-content">
                <h6>Pantau Status</h6>
                <p>Lihat progress dan status pendaftaran Anda</p>
              </div>
            </div>
            
            <div class="feature-item">
              <div class="feature-icon">
                <i class="bi bi-download"></i>
              </div>
              <div class="feature-content">
                <h6>Cetak Kartu</h6>
                <p>Download kartu pendaftaran setelah verifikasi</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
.login-form-container {
  background: white;
  border-radius: 20px;
  padding: 2.5rem;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  border: 1px solid #f0f0f0;
}

.form-header .form-icon {
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

.form-header h3 {
  color: var(--heading-color);
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.login-form .form-label {
  font-weight: 600;
  color: var(--heading-color);
  margin-bottom: 0.5rem;
}

.login-form .input-group-text {
  background: #f8f9fa;
  border: 1px solid #e9ecef;
  color: var(--accent-color);
}

.login-form .form-control {
  border: 1px solid #e9ecef;
  padding: 0.75rem 1rem;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.login-form .form-control:focus {
  border-color: var(--accent-color);
  box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.login-form .btn-primary {
  background: #3F72AF;
  border: none;
  padding: 0.75rem 2rem;
  border-radius: 50px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  transition: all 0.3s ease;
}

.login-form .btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.form-check-input:checked {
  background-color: var(--accent-color);
  border-color: var(--accent-color);
}

.quick-access .info-card {
  background: #f8f9fa;
  border-radius: 15px;
  padding: 1.5rem;
  border-left: 4px solid var(--accent-color);
}

.access-icon {
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

.quick-access h6 {
  color: var(--heading-color);
  font-weight: 600;
}

.login-info {
  background: white;
  border-radius: 20px;
  padding: 2rem;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  border: 1px solid #f0f0f0;
  height: fit-content;
  position: sticky;
  top: 2rem;
}

.info-header h4 {
  color: var(--heading-color);
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.info-header p {
  color: #6c757d;
  margin-bottom: 1.5rem;
}

.feature-item {
  display: flex;
  align-items: flex-start;
  margin-bottom: 1.5rem;
  padding-bottom: 1.5rem;
  border-bottom: 1px solid #f0f0f0;
}

.feature-item:last-child {
  margin-bottom: 0;
  padding-bottom: 0;
  border-bottom: none;
}

.feature-icon {
  width: 45px;
  height: 45px;
  background: #3F72AF;
  color: white;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.1rem;
  margin-right: 1rem;
  flex-shrink: 0;
}

.feature-content h6 {
  color: var(--heading-color);
  font-weight: 600;
  margin-bottom: 0.25rem;
  font-size: 0.9rem;
}

.feature-content p {
  color: #6c757d;
  font-size: 0.8rem;
  margin-bottom: 0;
  line-height: 1.4;
}

@media (max-width: 768px) {
  .login-form-container {
    padding: 1.5rem;
    margin: 0 1rem;
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
});
</script>
@endsection