@extends('layouts.main')
@section('content')

    <!-- Hero Section -->
    <section id="hero" class="hero section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-5">
            <div class="hero-image" data-aos="fade-right" data-aos-delay="100">
              <img src="{{ asset('assets/img/baknus/bnorang.jpg') }}" alt="SMK BAKTI NUSANTARA 666" class="img-fluid main-image">
              <div class="floating-card emergency-card" data-aos="fade-up" data-aos-delay="300">
                <div class="card-content">
                  <i class="bi bi-telephone-fill"></i>
                  <div class="text">
                    <span class="label">Info Pendaftaran</span>
                    <span class="number">(022) 8765-4321</span>
                  </div>
                </div>
              </div>
              <div class="floating-card stats-card" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-item">
                  <span class="number">1500+</span>
                  <span class="label">Siswa tolol</span>
                </div>
                <div class="stat-item">
                  <span class="number">95%</span>
                  <span class="label">Tingkat Kelulusan</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-7">
            <div class="hero-content" data-aos="fade-left" data-aos-delay="200">
              <div class="badge-container">
                <span class="hero-badge">Pendidikan Berkualitas Sejak 1985</span>
              </div>

              <h1 class="hero-title">Selamat Datang di SPMB SMK BAKTI NUSANTARA 666</h1>
              <p class="hero-description">Bergabunglah dengan SMK BAKTI NUSANTARA 666 dan wujudkan masa depan cemerlang Anda. Kami menyediakan pendidikan berkualitas dengan fasilitas modern dan tenaga pengajar profesional di Jl. Percobaan, Cileunyi, Bandung.</p>

              <div class="hero-stats">
                <div class="stat-group">
                  <div class="stat">
                    <i class="bi bi-award"></i>
                    <div class="stat-text">
                      <span class="number">39+</span>
                      <span class="label">Tahun Pengalaman</span>
                    </div>
                  </div>
                  <div class="stat">
                    <i class="bi bi-people"></i>
                    <div class="stat-text">
                      <span class="number">85+</span>
                      <span class="label">Tenaga Pengajar</span>
                    </div>
                  </div>
                  <div class="stat">
                    <i class="bi bi-mortarboard"></i>
                    <div class="stat-text">
                      <span class="number">5</span>
                      <span class="label">Program Keahlian</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="cta-section">
                <div class="cta-buttons">
                  <a href="{{ url('/pendaftaran') }}" class="btn btn-primary">Daftar Sekarang</a>
                  <a href="https://youtu.be/mAZfnQBrFqI?si=3_icbRRn9GkmVzuG" class="btn btn-secondary glightbox">
                    <i class="bi bi-play-circle"></i>
                    Tonton Video Profil
                  </a>
                </div>

                <div class="quick-actions">
                  <a href="{{ url('/jurusan') }}" class="action-link">
                    <i class="bi bi-mortarboard"></i>
                    <span>Lihat Program Keahlian</span>
                  </a>
                  <a href="{{ url('/contact') }}" class="action-link">
                    <i class="bi bi-chat-dots"></i>
                    <span>Hubungi Kami</span>
                  </a>
                  <a href="{{ url('/pendaftaran') }}" class="action-link">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Portal Pendaftaran</span>
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
    </section><!-- /Hero Section -->

    <!-- Home About Section -->
    <section id="home-about" class="home-about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-8 mx-auto text-center mb-5" data-aos="fade-up" data-aos-delay="150">
            <h2 class="section-heading">Keunggulan Pendidikan Sejak 1985</h2>
            <p class="lead-description">Kami berkomitmen memberikan pendidikan berkualitas tinggi melalui inovasi pembelajaran, dedikasi guru, dan fasilitas modern untuk mempersiapkan siswa menghadapi tantangan masa depan.</p>
          </div>
        </div>

        <div class="row align-items-center gy-5">
          <div class="col-lg-7" data-aos="fade-right" data-aos-delay="200">
            <div class="image-grid">
              <div class="primary-image">
                <img src="{{ asset('assets/img/baknus/bnpk.webp') }}" alt="Modern hospital facility" class="img-fluid">
                <div class="certification-badge">
                  <i class="bi bi-award"></i>
                  <span>Terakreditasi A</span>
                </div>
              </div>
              <div class="secondary-images">
                <div class="small-image">
                  <img src="{{ asset('assets/img/baknus/bnlapang4.jpg') }}" alt="Doctor consultation" class="img-fluid">
                </div>
                <div class="small-image">
                  <img src="{{ asset('assets/img/baknus/bnorang.jpg') }}" alt="Medical procedure" class="img-fluid">
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-5" data-aos="fade-left" data-aos-delay="300">
            <div class="content-wrapper">
              <div class="highlight-box">
                <div class="highlight-icon">
                  <i class="bi bi-mortarboard-fill"></i>
                </div>
                <div class="highlight-content">
                  <h4>Pendekatan Student-Centered</h4>
                  <p>Setiap program pembelajaran dirancang khusus untuk mengembangkan potensi dan minat individual siswa.</p>
                </div>
              </div>

              <div class="feature-list">
                <div class="feature-item">
                  <div class="feature-icon">
                    <i class="bi bi-check-circle-fill"></i>
                  </div>
                  <div class="feature-text">Laboratorium komputer dan multimedia modern</div>
                </div>
                <div class="feature-item">
                  <div class="feature-icon">
                    <i class="bi bi-check-circle-fill"></i>
                  </div>
                  <div class="feature-text">Guru bersertifikat dan berpengalaman</div>
                </div>
                <div class="feature-item">
                  <div class="feature-icon">
                    <i class="bi bi-check-circle-fill"></i>
                  </div>
                  <div class="feature-text">Program magang dan kerjasama industri</div>
                </div>
                <div class="feature-item">
                  <div class="feature-icon">
                    <i class="bi bi-check-circle-fill"></i>
                  </div>
                  <div class="feature-text">Bimbingan karir dan konseling siswa</div>
                </div>
              </div>

              <div class="metrics-row">
                <div class="metric-box">
                  <div class="metric-number">
                    <span class="purecounter" data-purecounter-start="0" data-purecounter-end="95" data-purecounter-duration="0">95</span>%
                  </div>
                  <div class="metric-label">Tingkat Kelulusan</div>
                </div>
                <div class="metric-box">
                  <div class="metric-number">
                    <span class="purecounter" data-purecounter-start="0" data-purecounter-end="2500" data-purecounter-duration="0">2500</span>+
                  </div>
                  <div class="metric-label">Alumni Sukses</div>
                </div>
              </div>

              <div class="action-buttons">
                <a href="{{ url('/about') }}" class="btn-explore">Jelajahi Program Kami</a>
                <a href="{{ url('/contact') }}" class="btn-contact">
                  <i class="bi bi-telephone"></i>
                  Konsultasi Pendaftaran
                </a>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Home About Section -->

    <!-- Featured Departments Section -->
    <section id="featured-departments" class="featured-departments section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Program Keahlian Unggulan</h2>
        <p>Pilih program keahlian yang sesuai dengan minat dan bakat Anda untuk masa depan yang cerah</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="departments-showcase">

          <div class="featured-department" data-aos="fade-up" data-aos-delay="200">
            <div class="row align-items-center">
              <div class="col-lg-6 order-lg-1">
                <div class="department-content">
                  <div class="department-category">Rekayasa Perangkat Lunak</div>
                  <h2 class="department-title">Program Unggulan Teknologi Informasi</h2>
                  <p class="department-description">Program keahlian yang mempersiapkan siswa menjadi programmer dan developer handal dengan kurikulum terkini dan praktik langsung menggunakan teknologi modern seperti web development, mobile app, dan database management.</p>
                  <div class="department-features">
                    <div class="feature-item">
                      <i class="fas fa-check-circle"></i>
                      <span>Pembelajaran Coding Intensif</span>
                    </div>
                    <div class="feature-item">
                      <i class="fas fa-check-circle"></i>
                      <span>Praktik Project-Based Learning</span>
                    </div>
                    <div class="feature-item">
                      <i class="fas fa-check-circle"></i>
                      <span>Sertifikasi Industri</span>
                    </div>
                  </div>
                  <a href="{{ url('/jurusan') }}" class="cta-link">Pelajari Lebih Lanjut <i class="fas fa-arrow-right"></i></a>
                </div>
              </div>
              <div class="col-lg-6 order-lg-2">
                <div class="department-visual">
                  <div class="image-wrapper">
                    <img src="{{ asset('assets/img/baknus/bnpk.webp') }}" alt="Lab Komputer RPL" class="img-fluid">
                  </div>
                </div>
              </div>
            </div>
          </div>

          

          <div class="departments-cta" data-aos="fade-up" data-aos-delay="600">
            <div class="cta-content">
              <h3 class="cta-title">Jelajahi Semua Program Keahlian Kami</h3>
              <p class="cta-description">Temukan program keahlian yang sesuai dengan minat dan bakat Anda untuk membangun karir yang sukses di masa depan.</p>
              <a href="{{ url('/jurusan') }}" class="btn btn-primary">Lihat Semua Program</a>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Featured Departments Section -->

    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Fasilitas Unggulan</h2>
        <p>Fasilitas modern dan lengkap untuk mendukung proses pembelajaran yang optimal</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-card">
              <div class="service-icon">
                <i class="fas fa-laptop"></i>
              </div>
              <div class="service-image">
                <img src="{{ asset('assets/img/baknus/labkomputer.jpg') }}" alt="Lab Komputer" class="img-fluid" loading="lazy">
              </div>
              <div class="service-content">
                <h3>Laboratorium Komputer</h3>
                <p>Laboratorium komputer modern dengan perangkat terkini untuk mendukung pembelajaran praktik programming dan desain.</p>
                <a href="#" class="service-link">Pelajari Lebih Lanjut <i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Card -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-card">
              <div class="service-icon">
                <i class="fas fa-book"></i>
              </div>
              <div class="service-image">
                <img src="{{ asset('assets/img/baknus/perpustakaan.jpg') }}" alt="Perpustakaan" class="img-fluid" loading="lazy">
              </div>
              <div class="service-content">
                <h3>Perpustakaan Digital</h3>
                <p>Perpustakaan modern dengan koleksi buku digital dan fisik yang lengkap untuk mendukung pembelajaran siswa.</p>
                <a href="#" class="service-link">Pelajari Lebih Lanjut <i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Card -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-card">
              <div class="service-icon">
                <i class="fas fa-wifi"></i>
              </div>
              <div class="service-image">
                <img src="{{ asset('assets/img/baknus/bnpk3.jpeg') }}" alt="Jaringan Internet" class="img-fluid" loading="lazy">
              </div>
              <div class="service-content">
                <h3>Jaringan Internet Cepat</h3>
                <p>Akses internet berkecepatan tinggi di seluruh area sekolah untuk mendukung pembelajaran digital dan riset online.</p>
                <a href="#" class="service-link">Pelajari Lebih Lanjut <i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Card -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-card">
              <div class="service-icon">
                <i class="fas fa-dumbbell"></i>
              </div>
              <div class="service-image">
                <img src="{{ asset('assets/img/baknus/bnlapang.jpeg') }}" alt="Fasilitas Olahraga" class="img-fluid" loading="lazy">
              </div>
              <div class="service-content">
                <h3>Fasilitas Olahraga</h3>
                <p>Lapangan olahraga dan gymnasium untuk mendukung aktivitas fisik dan pengembangan bakat olahraga siswa.</p>
                <a href="#" class="service-link">Pelajari Lebih Lanjut <i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Card -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-card">
              <div class="service-icon">
                <i class="fas fa-utensils"></i>
              </div>
              <div class="service-image">
                <img src="{{ asset('assets/img/baknus/kantin.webp') }}" alt="Kantin Sekolah" class="img-fluid" loading="lazy">
              </div>
              <div class="service-content">
                <h3>Kantin & Cafeteria</h3>
                <p>Kantin sekolah dengan menu sehat dan bergizi untuk memenuhi kebutuhan nutrisi siswa selama di sekolah.</p>
                <a href="#" class="service-link">Pelajari Lebih Lanjut <i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Card -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-card">
              <div class="service-icon">
                <i class="fas fa-mosque"></i>
              </div>
              <div class="service-image">
                <img src="{{ asset('assets/img/baknus/masjid.jpg') }}" alt="Mushola" class="img-fluid" loading="lazy">
              </div>
              <div class="service-content">
                <h3>Mushola & Tempat Ibadah</h3>
                <p>Fasilitas ibadah yang nyaman dan bersih untuk mendukung kegiatan spiritual siswa dan guru di lingkungan sekolah.</p>
                <a href="#" class="service-link">Pelajari Lebih Lanjut <i class="fas fa-arrow-right"></i></a>
              </div>
            </div>
          </div><!-- End Service Card -->

        </div>

      </div>

    </section><!-- /Featured Services Section -->

    

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <div class="content-wrapper">
                <h2>Pendidikan Berkualitas untuk Masa Depan Cerah</h2>
                <p>Temukan program pendidikan komprehensif yang disampaikan dengan dedikasi dan keahlian. Tim pengajar kami berkomitmen memberikan pendidikan personal yang mengutamakan kesuksesan siswa.</p>

                <div class="action-buttons">
                  <a href="{{ url('/pendaftaran') }}" class="primary-btn">Daftar Sekarang</a>
                  <a href="{{ url('/jurusan') }}" class="secondary-link">
                    <span>Jelajahi Program</span>
                    <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="hero-image" data-aos="zoom-in" data-aos-delay="300">
                <img src="{{ asset('assets/img/health/showcase-2.webp') }}" alt="Keunggulan Pendidikan" class="img-fluid">
              </div>
            </div>
          </div>
        </div>

        <div class="stats-section" data-aos="fade-up" data-aos-delay="400">
          <div class="row">
            <div class="col-lg-3 col-md-6">
              <div class="stat-item">
                <div class="stat-number">39+</div>
                <div class="stat-label">Tahun Pengalaman</div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="stat-item">
                <div class="stat-number">2500+</div>
                <div class="stat-label">Alumni Sukses</div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="stat-item">
                <div class="stat-number">85+</div>
                <div class="stat-label">Tenaga Pengajar</div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="stat-item">
                <div class="stat-number">5</div>
                <div class="stat-label">Program Keahlian</div>
              </div>
            </div>
          </div>
        </div>

        <div class="services-grid" data-aos="fade-up" data-aos-delay="500">
          <div class="row">

            <div class="col-lg-4 col-md-6">
              <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                <div class="service-icon">
                  <i class="fas fa-laptop-code"></i>
                </div>
                <h4>Teknologi Terdepan</h4>
                <p>Pembelajaran dengan teknologi terkini menggunakan perangkat modern dan software industri untuk mempersiapkan siswa menghadapi dunia kerja.</p>
                <a href="#" class="service-link">Pelajari Lebih Lanjut</a>
              </div>
            </div>

            <div class="col-lg-4 col-md-6">
              <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                <div class="service-icon">
                  <i class="fas fa-users"></i>
                </div>
                <h4>Bimbingan Karir</h4>
                <p>Program bimbingan karir komprehensif termasuk konseling, pelatihan soft skill, dan penempatan kerja untuk masa depan siswa.</p>
                <a href="#" class="service-link">Pelajari Lebih Lanjut</a>
              </div>
            </div>

            <div class="col-lg-4 col-md-6">
              <div class="service-card" data-aos="fade-up" data-aos-delay="300">
                <div class="service-icon">
                  <i class="fas fa-certificate"></i>
                </div>
                <h4>Sertifikasi Industri</h4>
                <p>Program sertifikasi dari industri dan lembaga resmi untuk meningkatkan kompetensi dan daya saing lulusan di dunia kerja.</p>
                <a href="#" class="service-link">Pelajari Lebih Lanjut</a>
              </div>
            </div>

          </div>
        </div>

        <div class="contact-banner" data-aos="zoom-in" data-aos-delay="600">
          <div class="banner-content">
            <div class="contact-info">
              <div class="contact-icon">
                <i class="fas fa-phone"></i>
              </div>
              <div class="contact-text">
                <h5>Butuh Bantuan Informasi?</h5>
                <p>Tim kami siap membantu Anda dengan informasi pendaftaran dan konsultasi program keahlian yang tersedia.</p>
              </div>
            </div>
            <div class="contact-actions">
              <a href="tel:+622287654321" class="call-btn">
                <i class="fas fa-phone"></i>
                (022) 8765-4321
              </a>
              <a href="{{ url('/contact') }}" class="contact-link">Lihat Lokasi</a>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Call To Action Section -->

@endsection
