@extends('layouts.main')

@section('content')
<!-- Page Title -->
<div class="page-title">
  <div class="heading">
    <div class="container">
      <div class="row d-flex justify-content-center text-center">
        <div class="col-lg-8">
          <h1 class="heading-title">Verifikasi OTP</h1>
          <p class="mb-0">Masukkan kode OTP yang telah dikirim ke email Anda</p>
        </div>
      </div>
    </div>
  </div>
  <nav class="breadcrumbs">
    <div class="container">
      <ol>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('pendaftaran.index') }}">Pendaftaran</a></li>
        <li class="current">Verifikasi OTP</li>
      </ol>
    </div>
  </nav>
</div>

<!-- OTP Verification Section -->
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-7">
        
        <div class="otp-form-container" data-aos="fade-up">
          <div class="form-header text-center mb-4">
            <div class="form-icon">
              <i class="bi bi-shield-check"></i>
            </div>
            <h3>Verifikasi Email</h3>
            <p class="text-muted">Kode OTP telah dikirim ke:<br><strong>{{ $email }}</strong></p>
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

          @if (session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif

          <form action="{{ route('pendaftaran.verify-otp') }}" method="POST" class="otp-form">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            
            <div class="form-group mb-4">
              <label for="otp" class="form-label text-center d-block">Masukkan Kode OTP</label>
              <div class="otp-input-container">
                <input type="text" 
                       class="form-control otp-input @error('otp') is-invalid @enderror" 
                       id="otp" 
                       name="otp" 
                       maxlength="6"
                       placeholder="000000"
                       required
                       autocomplete="off">
              </div>
              @error('otp')
                <div class="invalid-feedback text-center">{{ $message }}</div>
              @enderror
              <div class="form-text text-center">Kode OTP berlaku selama 5 menit</div>
            </div>

            <div class="d-grid gap-2 mb-3">
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-check-circle me-2"></i>Verifikasi OTP
              </button>
            </div>

            <div class="text-center">
              <p class="mb-2">Tidak menerima kode OTP?</p>
              <form action="{{ route('pendaftaran.resend-otp') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <button type="submit" class="btn btn-link p-0" id="resendBtn">
                  Kirim Ulang OTP
                </button>
              </form>
              <div id="countdown" class="text-muted small mt-1" style="display: none;">
                Kirim ulang dalam <span id="timer">60</span> detik
              </div>
            </div>
          </form>
        </div>

        <!-- Help Info -->
        <div class="help-info mt-4" data-aos="fade-up" data-aos-delay="200">
          <div class="info-card">
            <div class="row align-items-center">
              <div class="col-auto">
                <div class="help-icon">
                  <i class="bi bi-info-circle"></i>
                </div>
              </div>
              <div class="col">
                <h6 class="mb-1">Bantuan</h6>
                <p class="mb-0 small text-muted">
                  Jika tidak menerima email, periksa folder spam/junk. 
                  Hubungi kami di (022) 8765-4321 jika masih bermasalah.
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
.otp-form-container {
  background: white;
  border-radius: 20px;
  padding: 2.5rem;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  border: 1px solid #f0f0f0;
}

.form-header .form-icon {
  width: 80px;
  height: 80px;
  background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
  color: white;
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2rem;
  margin: 0 auto 1rem;
}

.otp-input-container {
  display: flex;
  justify-content: center;
}

.otp-input {
  text-align: center;
  font-size: 2rem;
  font-weight: bold;
  letter-spacing: 0.5rem;
  max-width: 200px;
  border: 2px solid #e9ecef;
  border-radius: 15px;
  padding: 1rem;
  transition: all 0.3s ease;
}

.otp-input:focus {
  border-color: var(--accent-color);
  box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
  transform: scale(1.02);
}

.btn-primary {
  background: linear-gradient(135deg, var(--accent-color) 0%, #0056b3 100%);
  border: none;
  padding: 0.75rem 2rem;
  border-radius: 50px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  transition: all 0.3s ease;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.btn-link {
  color: var(--accent-color);
  text-decoration: none;
  font-weight: 600;
}

.btn-link:hover {
  color: #0056b3;
  text-decoration: underline;
}

.help-info .info-card {
  background: #f8f9fa;
  border-radius: 15px;
  padding: 1.5rem;
  border-left: 4px solid #28a745;
}

.help-icon {
  width: 50px;
  height: 50px;
  background: #28a745;
  color: white;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.2rem;
}

.help-info h6 {
  color: var(--heading-color);
  font-weight: 600;
}

@media (max-width: 768px) {
  .otp-form-container {
    padding: 1.5rem;
    margin: 0 1rem;
  }
  
  .otp-input {
    font-size: 1.5rem;
    letter-spacing: 0.3rem;
  }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const otpInput = document.getElementById('otp');
  const resendBtn = document.getElementById('resendBtn');
  const countdown = document.getElementById('countdown');
  const timer = document.getElementById('timer');
  
  // Format OTP input
  otpInput.addEventListener('input', function() {
    this.value = this.value.replace(/\D/g, '');
  });
  
  // Auto submit when 6 digits entered
  otpInput.addEventListener('input', function() {
    if (this.value.length === 6) {
      // Optional: auto submit form
      // this.form.submit();
    }
  });
  
  // Resend OTP countdown
  let countdownActive = false;
  
  resendBtn.addEventListener('click', function(e) {
    if (countdownActive) {
      e.preventDefault();
      return;
    }
    
    // Start countdown
    countdownActive = true;
    resendBtn.style.display = 'none';
    countdown.style.display = 'block';
    
    let timeLeft = 60;
    const countdownInterval = setInterval(function() {
      timeLeft--;
      timer.textContent = timeLeft;
      
      if (timeLeft <= 0) {
        clearInterval(countdownInterval);
        countdownActive = false;
        resendBtn.style.display = 'inline';
        countdown.style.display = 'none';
      }
    }, 1000);
  });
});
</script>
@endsection