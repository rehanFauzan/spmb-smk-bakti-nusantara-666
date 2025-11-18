@extends('layouts.main')

@section('content')
<!-- Page Title -->
<div class="page-title">
  <div class="heading">
    <div class="container">
      <div class="row d-flex justify-content-center text-center">
        <div class="col-lg-8">
          <h1 class="heading-title">Lupa Password</h1>
          <p class="mb-0">Masukkan email Anda untuk mendapatkan link reset password</p>
        </div>
      </div>
    </div>
  </div>
  <nav class="breadcrumbs">
    <div class="container">
      <ol>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('pendaftaran.index') }}">Pendaftaran</a></li>
        <li class="current">Lupa Password</li>
      </ol>
    </div>
  </nav>
</div>

<!-- Forgot Password Section -->
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-7">
        
        <!-- Forgot Password Form -->\n        <div class="forgot-password-container" data-aos="fade-up">
          <div class="form-header text-center mb-4">
            <div class="form-icon">
              <i class="bi bi-key"></i>
            </div>
            <h3>Reset Password</h3>
            <p class="text-muted">Masukkan email yang terdaftar untuk mendapatkan link reset password</p>
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

          <form action="{{ route('pendaftaran.forgot-password.send') }}" method="POST" class="forgot-password-form">
            @csrf
            
            <div class="form-group mb-4">
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

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-send me-2"></i>Kirim Link Reset
              </button>
            </div>

            <div class="text-center mt-3">
              <p class="mb-0">Ingat password Anda? 
                <a href="{{ route('pendaftaran.login') }}" class="text-decoration-none">Login di sini</a>
              </p>
            </div>
          </form>
        </div>

        <!-- Info Card -->
        <div class="info-card mt-4" data-aos="fade-up" data-aos-delay="200">
          <div class="row align-items-center">
            <div class="col-auto">
              <div class="info-icon">
                <i class="bi bi-info-circle"></i>
              </div>
            </div>
            <div class="col">
              <h6 class="mb-1">Butuh Bantuan?</h6>
              <p class="mb-0 small text-muted">
                Hubungi admin di <strong>(022) 8765-4321</strong> atau 
                <strong>WhatsApp: 0812-3456-7890</strong>
              </p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<style>
.forgot-password-container {
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

.forgot-password-form .form-label {
  font-weight: 600;
  color: var(--heading-color);
  margin-bottom: 0.5rem;
}

.forgot-password-form .input-group-text {
  background: #f8f9fa;
  border: 1px solid #e9ecef;
  color: var(--accent-color);
}

.forgot-password-form .form-control {
  border: 1px solid #e9ecef;
  padding: 0.75rem 1rem;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.forgot-password-form .form-control:focus {
  border-color: var(--accent-color);
  box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.forgot-password-form .btn-primary {
  background: #3F72AF;
  border: none;
  padding: 0.75rem 2rem;
  border-radius: 50px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  transition: all 0.3s ease;
}

.forgot-password-form .btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.info-card {
  background: #f8f9fa;
  border-radius: 15px;
  padding: 1.5rem;
  border-left: 4px solid var(--accent-color);
}

.info-icon {
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

.info-card h6 {
  color: var(--heading-color);
  font-weight: 600;
}

@media (max-width: 768px) {
  .forgot-password-container {
    padding: 1.5rem;
    margin: 0 1rem;
  }
}
</style>
@endsection