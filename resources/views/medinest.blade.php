<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - MediNest Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto me-xl-0">
        <h1 class="sitename">Medi<span>Nest</span></h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ url('/') }}" class="active">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Departments</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Doctors</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="#">Appointment</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-5">
            <div class="hero-image" data-aos="fade-right" data-aos-delay="100">
              <img src="{{ asset('assets/img/health/staff-8.webp') }}" alt="Healthcare Professional" class="img-fluid main-image">
              <div class="floating-card emergency-card" data-aos="fade-up" data-aos-delay="300">
                <div class="card-content">
                  <i class="bi bi-telephone-fill"></i>
                  <div class="text">
                    <span class="label">24/7 Emergency</span>
                    <span class="number">+1 (555) 911-2468</span>
                  </div>
                </div>
              </div>
              <div class="floating-card stats-card" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-item">
                  <span class="number">25K+</span>
                  <span class="label">Patients Treated</span>
                </div>
                <div class="stat-item">
                  <span class="number">98%</span>
                  <span class="label">Satisfaction Rate</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-7">
            <div class="hero-content" data-aos="fade-left" data-aos-delay="200">
              <div class="badge-container">
                <span class="hero-badge">Trusted Healthcare Provider</span>
              </div>

              <h1 class="hero-title">Excellence in Medical Care Since 1985</h1>
              <p class="hero-description">Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Pellentesque in ipsum id orci porta dapibus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.</p>

              <div class="hero-stats">
                <div class="stat-group">
                  <div class="stat">
                    <i class="bi bi-award"></i>
                    <div class="stat-text">
                      <span class="number">35+</span>
                      <span class="label">Years Experience</span>
                    </div>
                  </div>
                  <div class="stat">
                    <i class="bi bi-people"></i>
                    <div class="stat-text">
                      <span class="number">150+</span>
                      <span class="label">Medical Specialists</span>
                    </div>
                  </div>
                  <div class="stat">
                    <i class="bi bi-geo-alt"></i>
                    <div class="stat-text">
                      <span class="number">12</span>
                      <span class="label">Clinic Locations</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="cta-section">
                <div class="cta-buttons">
                  <a href="#" class="btn btn-primary">Schedule Consultation</a>
                  <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="btn btn-secondary glightbox">
                    <i class="bi bi-play-circle"></i>
                    Watch Our Story
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="background-elements">
        <div class="bg-shape shape-1"></div>
        <div class="bg-shape shape-2"></div>
        <div class="bg-pattern"></div>
      </div>
    </section>

  </main>

  <footer id="footer" class="footer position-relative">
    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="{{ url('/') }}" class="logo d-flex align-items-center">
            <span class="sitename">MediNest</span>
          </a>
          <div class="footer-contact pt-3">
            <p>A108 Adam Street</p>
            <p>New York, NY 535022</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@example.com</span></p>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>