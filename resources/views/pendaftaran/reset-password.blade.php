@extends('layouts.main')

@section('content')
<!-- Page Title -->
<div class="page-title">
  <div class="heading">
    <div class="container">
      <div class="row d-flex justify-content-center text-center">
        <div class="col-lg-8">
          <h1 class="heading-title">Reset Password</h1>
          <p class="mb-0">Buat password baru untuk akun Anda</p>
        </div>
      </div>
    </div>
  </div>
  <nav class="breadcrumbs">
    <div class="container">
      <ol>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('pendaftaran.index') }}">Pendaftaran</a></li>
        <li class="current">Reset Password</li>
      </ol>
    </div>
  </nav>
</div>

<!-- Reset Password Section -->
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-7">
        
        <!-- Reset Password Form -->
        <div class="reset-password-container" data-aos="fade-up">
          <div class="form-header text-center mb-4">
            <div class="form-icon">
              <i class="bi bi-shield-lock"></i>
            </div>
            <h3>Password Baru</h3>
            <p class="text-muted">Masukkan password baru yang aman untuk akun Anda</p>
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

          <form action="{{ route('pendaftaran.reset-password.store') }}" method="POST" class="reset-password-form">
            @csrf
            
            <div class="form-group mb-3">
              <label for="otp" class="form-label">Kode OTP</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-shield-check"></i></span>
                <input type="text" 
                       class="form-control @error('otp') is-invalid @enderror" 
                       id="otp" 
                       name="otp" 
                       placeholder="Masukkan 6 digit kode OTP" 
                       maxlength="6"
                       required>
              </div>
              @error('otp')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              <div class="form-text">Kode OTP telah dikirim ke {{ $email }}</div>
            </div>

            <div class="form-group mb-3">
              <label for="password" class="form-label">Password Baru</label>
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
                       placeholder="Ulangi password baru" 
                       required>
                <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-check-circle me-2"></i>Reset Password
              </button>
            </div>

            <div class="text-center mt-3">
              <p class="mb-2">
                <button type="button" class="btn btn-link p-0" onclick="resendOtp()">Kirim ulang OTP</button>
              </p>
              <p class="mb-0">Kembali ke 
                <a href="{{ route('pendaftaran.login') }}" class="text-decoration-none">halaman login</a>
              </p>
            </div>
          </form>
        </div>

        <!-- Security Info -->
        <div class="security-info mt-4" data-aos="fade-up" data-aos-delay="200">
          <div class="info-card">
            <div class="row align-items-center">
              <div class="col-auto">
                <div class="security-icon">
                  <i class="bi bi-shield-check"></i>
                </div>
              </div>
              <div class="col">
                <h6 class="mb-1">Tips Password Aman</h6>
                <p class="mb-0 small text-muted">
                  Gunakan kombinasi huruf besar, kecil, angka, dan simbol. 
                  Minimal 8 karakter untuk keamanan optimal.
                </p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<style>
.reset-password-container {
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

.reset-password-form .form-label {
  font-weight: 600;
  color: var(--heading-color);
  margin-bottom: 0.5rem;
}

.reset-password-form .input-group-text {
  background: #f8f9fa;
  border: 1px solid #e9ecef;
  color: var(--accent-color);
}

.reset-password-form .form-control {
  border: 1px solid #e9ecef;
  padding: 0.75rem 1rem;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.reset-password-form .form-control:focus {
  border-color: var(--accent-color);
  box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.reset-password-form .btn-primary {
  background: #3F72AF;
  border: none;
  padding: 0.75rem 2rem;
  border-radius: 50px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  transition: all 0.3s ease;
}

.reset-password-form .btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
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
  .reset-password-container {
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
});
  
  // Resend OTP function
  function resendOtp() {
    fetch('{{ route('pendaftaran.resend-reset-otp') }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert('OTP baru telah dikirim ke email Anda');
      } else {
        alert('Gagal mengirim OTP. Silakan coba lagi.');
      }
    })
    .catch(error => {
      alert('Terjadi kesalahan. Silakan refresh halaman dan coba lagi.');
    });
  }
});
</script>
@endsection