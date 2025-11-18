@extends('layouts.main')

@section('content')
<!-- Page Title -->
<div class="page-title">
  <div class="heading">
    <div class="container">
      <div class="row d-flex justify-content-center text-center">
        <div class="col-lg-8">
          <h1 class="heading-title">Login Admin SPMB</h1>
          <p class="mb-0">Masuk ke sistem pengelolaan SPMB SMK Bakti Nusantara 666</p>
        </div>
      </div>
    </div>
  </div>
  <nav class="breadcrumbs">
    <div class="container">
      <ol>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="current">Login Admin</li>
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
              <i class="bi bi-shield-lock"></i>
            </div>
            <h3>Admin Dashboard</h3>
            <p class="text-muted">Masuk ke sistem pengelolaan SPMB</p>
          </div>

          @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
          @endif

          <form action="{{ route('admin.login.store') }}" method="POST" class="login-form">
            @csrf
            
            <div class="form-group mb-3">
              <label for="email" class="form-label">Email</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" 
                       class="form-control" 
                       id="email" 
                       name="email" 
                       placeholder="Masukkan email admin" 
                       required>
              </div>
            </div>

            <div class="form-group mb-3">
              <label for="password" class="form-label">Password</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" 
                       class="form-control" 
                       id="password" 
                       name="password" 
                       placeholder="Masukkan password" 
                       required>
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-box-arrow-in-right me-2"></i>Login
              </button>
            </div>
          </form>
        </div>

        <!-- Demo Accounts -->
        <div class="quick-access mt-4" data-aos="fade-up" data-aos-delay="200">
          <div class="info-card">
            <div class="row align-items-center">
              <div class="col-auto">
                <div class="access-icon">
                  <i class="bi bi-info-circle"></i>
                </div>
              </div>
              <div class="col">
                <h6 class="mb-1">Demo Accounts</h6>
                <p class="mb-0 small text-muted">
                  <strong>Admin:</strong> admin@smk.com / password<br>
                  <strong>Panitia:</strong> panitia@smk.com / password<br>
                  <strong>Keuangan:</strong> keuangan@smk.com / password<br>
                  <strong>Kepala Sekolah:</strong> kepala@smk.com / password
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
            <h4>Sistem Pengelolaan SPMB</h4>
            <p>Akses dashboard sesuai role Anda:</p>
          </div>
          
          <div class="feature-list">
            <div class="feature-item">
              <div class="feature-icon">
                <i class="bi bi-gear"></i>
              </div>
              <div class="feature-content">
                <h6>Admin</h6>
                <p>Kelola data master dan monitoring calon siswa</p>
              </div>
            </div>
            
            <div class="feature-item">
              <div class="feature-icon">
                <i class="bi bi-file-check"></i>
              </div>
              <div class="feature-content">
                <h6>Panitia</h6>
                <p>Verifikasi berkas dan melihat pendaftaran</p>
              </div>
            </div>
            
            <div class="feature-item">
              <div class="feature-icon">
                <i class="bi bi-cash-coin"></i>
              </div>
              <div class="feature-content">
                <h6>Keuangan</h6>
                <p>Verifikasi pembayaran dan rekap keuangan</p>
              </div>
            </div>
            
            <div class="feature-item">
              <div class="feature-icon">
                <i class="bi bi-graph-up"></i>
              </div>
              <div class="feature-content">
                <h6>Kepala Sekolah</h6>
                <p>Monitoring dan laporan keseluruhan</p>
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
  
  if (togglePassword && password) {
    togglePassword.addEventListener('click', function() {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      
      const icon = this.querySelector('i');
      icon.classList.toggle('bi-eye');
      icon.classList.toggle('bi-eye-slash');
    });
  }
});
</script>
@endsection