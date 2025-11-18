@extends('layouts.main')
@section('content')

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Tentang Kami</h1>
              <p class="mb-0">
                SMK BAKTI NUSANTARA 666 adalah lembaga pendidikan kejuruan yang berkomitmen 
                memberikan pendidikan berkualitas tinggi sejak tahun 1985. Berlokasi di 
                Jl. Percobaan, Cileunyi, Bandung, kami mempersiapkan siswa dengan keterampilan 
                dan pengetahuan yang dibutuhkan untuk sukses di dunia kerja.
              </p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="current">About</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="intro-section">
          <div class="row justify-content-center">
            <div class="col-lg-8 text-center" data-aos="fade-up" data-aos-delay="100">
              <h2>Keunggulan Pendidikan Sejak 1985</h2>
              <p class="lead">Kami percaya bahwa pendidikan berkualitas dimulai dari pemahaman yang mendalam. Tim pengajar profesional kami menggabungkan teknologi terdepan dengan pendekatan personal yang penuh dedikasi untuk memastikan setiap siswa mendapatkan standar pendidikan terbaik.</p>
            </div>
          </div>
        </div>

        <div class="image-stats-section">
          <div class="row align-items-center">
            <div class="col-lg-7" data-aos="fade-right" data-aos-delay="200">
              <div class="image-gallery">
                <div class="main-image-container">
                  <img src="{{ asset('assets/img/baknus/bnlapang.jpeg') }}" class="img-fluid main-image" alt="Fasilitas Sekolah">
                </div>
                <div class="secondary-images">
                  <img src="{{  asset('assets/img/baknus/bnpk.jpeg')  }}" class="img-fluid secondary-image" alt="Tim Pengajar" data-aos="zoom-in" data-aos-delay="400">
                  <img src="{{  asset('assets/img/baknus/bnpk3.jpeg') }}" class="img-fluid secondary-image" alt="Konsultasi Siswa" data-aos="zoom-in" data-aos-delay="500">
                </div>
              </div>
            </div>

            <div class="col-lg-5" data-aos="fade-left" data-aos-delay="300">
              <div class="stats-content">
                <h3>Lembaga Pendidikan Terpercaya</h3>
                <p>SMK BAKTI NUSANTARA 666 telah menjadi pilihan utama untuk pendidikan kejuruan berkualitas. Dengan pengalaman lebih dari 39 tahun, kami terus berinovasi dalam memberikan pendidikan yang relevan dengan kebutuhan industri.</p>

                <div class="stats-list">
                  <div class="stat-row">
                    <div class="stat-number">
                      <span data-purecounter-start="0" data-purecounter-end="2500" data-purecounter-duration="0" class="purecounter">2500</span>
                    </div>
                    <div class="stat-info">
                      <h5>Alumni Sukses</h5>
                      <p>Lulusan yang berhasil berkarir di berbagai bidang</p>
                    </div>
                  </div>

                  <div class="stat-row">
                    <div class="stat-number">
                      <span data-purecounter-start="0" data-purecounter-end="95" data-purecounter-duration="0" class="purecounter">95</span><span>%</span>
                    </div>
                    <div class="stat-info">
                      <h5>Tingkat Kelulusan</h5>
                      <p>Berdasarkan data kelulusan 5 tahun terakhir</p>
                    </div>
                  </div>

                  <div class="stat-row">
                    <div class="stat-number">
                      <span data-purecounter-start="0" data-purecounter-end="5" data-purecounter-duration="0" class="purecounter">5</span>
                    </div>
                    <div class="stat-info">
                      <h5>Kepala Program Jurusan</h5>
                      <p>Kepala program jurusan yang berpengalaman</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="mission-section" data-aos="fade-up" data-aos-delay="400">
          <div class="row">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
              <div class="mission-item">
                <div class="mission-icon">
                  <i class="bi bi-mortarboard"></i>
                </div>
                <h4>Misi Kami</h4>
                <p>Memberikan pendidikan kejuruan yang komprehensif dan berpusat pada siswa, menggabungkan keunggulan akademik dengan pendekatan yang penuh perhatian, memastikan setiap individu mendapat pendidikan personal sesuai kebutuhan unik mereka.</p>
              </div>
            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
              <div class="mission-item">
                <div class="mission-icon">
                  <i class="bi bi-eye"></i>
                </div>
                <h4>Visi Kami</h4>
                <p>Menjadi lembaga pendidikan kejuruan terdepan di wilayah kami, diakui karena inovasi pembelajaran, hasil yang luar biasa, dan komitmen teguh untuk meningkatkan kualitas hidup masyarakat.</p>
              </div>
            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
              <div class="mission-item">
                <div class="mission-icon">
                  <i class="bi bi-star"></i>
                </div>
                <h4>Komitmen Kami</h4>
                <p>Setiap siswa akan mendapatkan pendidikan berkualitas tinggi dalam lingkungan yang nyaman dan mendukung, di mana prestasi akademik, karakter, dan kesejahteraan mereka adalah prioritas utama kami.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="specialties-section" data-aos="fade-up" data-aos-delay="500">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h3>Program Keahlian Unggulan</h3>
              <p class="section-description">Program keahlian kami bekerja sama untuk memberikan pendidikan komprehensif di berbagai bidang kejuruan</p>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="100">
              <div class="specialty-item">
                <i class="bi bi-laptop"></i>
                <span>RPL</span>
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="150">
              <div class="specialty-item">
                <i class="bi bi-router"></i>
                <span>TKJ</span>
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="200">
              <div class="specialty-item">
                <i class="bi bi-camera-video"></i>
                <span>Multimedia</span>
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="250">
              <div class="specialty-item">
                <i class="bi bi-calculator"></i>
                <span>Akuntansi</span>
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="300">
              <div class="specialty-item">
                <i class="bi bi-file-text"></i>
                <span>Adm. Perkantoran</span>
              </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="350">
              <div class="specialty-item">
                <i class="bi bi-book"></i>
                <span>Mata Pelajaran Umum</span>
              </div>
            </div>
          </div>
        </div>

       

        <!-- Section Title -->
        <div class="section-title" data-aos="fade-up" data-aos-delay="100">
          <h2>Kepala Program Jurusan</h2>
          <p>Temui kepala program jurusan berpengalaman di SMK BAKTI NUSANTARA 666. Tim kepala program kami terdiri dari profesional bersertifikat yang memimpin dan mengembangkan program keahlian unggulan sekolah.</p>
        </div>

    <!-- Teachers Section -->
    <section id="doctors" class="doctors section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <!-- Teacher Directory -->
        <div class="doctor-directory mb-5">
          <div class="directory-bar p-3 p-md-4 rounded-3">
            <div class="row g-3 align-items-center">
              <div class="col-lg-4">
                <label for="teacher-search" class="form-label mb-1">Cari Kepala Program</label>
                <div class="position-relative">
                  <i class="bi bi-search search-icon"></i>
                  <input id="teacher-search" type="text" class="form-control search-input" placeholder="Ketik nama atau kata kunci">
                </div>
              </div>
              <div class="col-lg-3">
                <label class="form-label mb-1">Program Keahlian</label>
                <select class="form-select">
                  <option value="*">Semua Program</option>
                  <option value=".filter-pplg">PPLG</option>
                  <option value=".filter-akuntansi">Akuntansi</option>
                  <option value=".filter-dkv">DKV</option>
                  <option value=".filter-animasi">Animasi</option>
                  <option value=".filter-pemasaran">Pemasaran</option>
                </select>
              </div>
              <div class="col-lg-3">
                <label class="form-label mb-1">Status</label>
                <select class="form-select">
                  <option>Semua Status</option>
                  <option>Guru Tetap</option>
                  <option>Guru Honorer</option>
                  <option>Guru Tamu</option>
                </select>
              </div>
              <div class="col-lg-2 d-grid">
                <button class="btn btn-appointment">Terapkan Filter</button>
              </div>
            </div>
          </div>

          <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
            <ul class="directory-filters isotope-filters" data-aos="fade-up" data-aos-delay="200">
              <li data-filter="*" class="filter-active">Semua</li>
              <li data-filter=".filter-pplg">PPLG</li>
              <li data-filter=".filter-akuntansi">Akuntansi</li>
              <li data-filter=".filter-dkv">DKV</li>
              <li data-filter=".filter-animasi">Animasi</li>
              <li data-filter=".filter-pemasaran">Pemasaran</li>
            </ul><!-- End Directory Filters -->

            <div class="row gy-4 isotope-container justify-content-start" data-aos="fade-up" data-aos-delay="300">

              <div class="col-lg-3 col-md-6 doctor-item isotope-item filter-pplg">
                <article class="doctor-card h-100">
                  <figure class="doctor-media">
                    <img src="{{ asset('assets/img/health/staff-3.webp') }}" class="img-fluid" alt="Pak Budi Santoso" loading="lazy">
                    <span class="tag">Kepala Program</span>
                  </figure>
                  <div class="doctor-content">
                    <h3 class="doctor-name">Pak Budi Santoso, S.Kom, M.T</h3>
                    <p class="doctor-title">Kepala Program PPLG • S.Kom, M.T</p>
                    <p class="doctor-desc">Memimpin program Pengembangan Perangkat Lunak dan Gim dengan pengalaman industri 15 tahun.</p>
                    <div class="doctor-meta">
                      <span class="badge dept">PPLG</span>
                    </div>
                    <div class="doctor-actions">
                      <a href="#" class="btn btn-sm btn-appointment">Konsultasi</a>
                      <a href="#" class="btn btn-sm btn-soft">Lihat Profil</a>
                    </div>
                  </div>
                </article>
              </div><!-- End Directory Item -->

              <div class="col-lg-3 col-md-6 doctor-item isotope-item filter-akuntansi">
                <article class="doctor-card h-100">
                  <figure class="doctor-media">
                    <img src="{{ asset('assets/img/health/staff-5.webp') }}" class="img-fluid" alt="Bu Rina Kartika" loading="lazy">
                  </figure>
                  <div class="doctor-content">
                    <h3 class="doctor-name">Bu Rina Kartika, S.E, M.Ak</h3>
                    <p class="doctor-title">Kepala Program Akuntansi • S.E, M.Ak</p>
                    <p class="doctor-desc">Memimpin program Akuntansi dan Keuangan Lembaga dengan keahlian sistem informasi akuntansi.</p>
                    <div class="doctor-meta">
                      <span class="badge dept">Akuntansi</span>
                    </div>
                    <div class="doctor-actions">
                      <a href="#" class="btn btn-sm btn-appointment">Konsultasi</a>
                      <a href="#" class="btn btn-sm btn-soft">Lihat Profil</a>
                    </div>
                  </div>
                </article>
              </div><!-- End Directory Item -->

              <div class="col-lg-3 col-md-6 doctor-item isotope-item filter-dkv">
                <article class="doctor-card h-100">
                  <figure class="doctor-media">
                    <img src="{{ asset('assets/img/health/staff-12.webp') }}" class="img-fluid" alt="Pak Ahmad Fauzi" loading="lazy">
                  </figure>
                  <div class="doctor-content">
                    <h3 class="doctor-name">Pak Ahmad Fauzi, S.Sn, M.Ds</h3>
                    <p class="doctor-title">Kepala Program DKV • S.Sn, M.Ds</p>
                    <p class="doctor-desc">Memimpin program Desain Komunikasi Visual dengan portfolio desain internasional.</p>
                    <div class="doctor-meta">
                      <span class="badge dept">DKV</span>
                    </div>
                    <div class="doctor-actions">
                      <a href="#" class="btn btn-sm btn-appointment">Konsultasi</a>
                      <a href="#" class="btn btn-sm btn-soft">Lihat Profil</a>
                    </div>
                  </div>
                </article>
              </div><!-- End Directory Item -->

              <div class="col-lg-3 col-md-6 doctor-item isotope-item filter-animasi">
                <article class="doctor-card h-100">
                  <figure class="doctor-media">
                    <img src="{{ asset('assets/img/health/staff-7.webp') }}" class="img-fluid" alt="Bu Sari Indrawati" loading="lazy">
                  </figure>
                  <div class="doctor-content">
                    <h3 class="doctor-name">Bu Sari Indrawati, S.Sn, M.Ds</h3>
                    <p class="doctor-title">Kepala Program Animasi • S.Sn, M.Ds</p>
                    <p class="doctor-desc">Memimpin program Animasi dengan keahlian dalam 2D/3D animation dan motion graphics.</p>
                    <div class="doctor-meta">
                      <span class="badge dept">Animasi</span>
                    </div>
                    <div class="doctor-actions">
                      <a href="#" class="btn btn-sm btn-appointment">Konsultasi</a>
                      <a href="#" class="btn btn-sm btn-soft">Lihat Profil</a>
                    </div>
                  </div>
                </article>
              </div><!-- End Directory Item -->

              <div class="col-lg-3 col-md-6 doctor-item isotope-item filter-pemasaran">
                <article class="doctor-card h-100">
                  <figure class="doctor-media">
                    <img src="{{ asset('assets/img/health/staff-10.webp') }}" class="img-fluid" alt="Bu Dewi Sartika" loading="lazy">
                  </figure>
                  <div class="doctor-content">
                    <h3 class="doctor-name">Bu Dewi Sartika, S.E, M.M</h3>
                    <p class="doctor-title">Kepala Program Pemasaran • S.E, M.M</p>
                    <p class="doctor-desc">Memimpin program Pemasaran dengan keahlian digital marketing dan strategi bisnis modern.</p>
                    <div class="doctor-meta">
                      <span class="badge dept">Pemasaran</span>
                    </div>
                    <div class="doctor-actions">
                      <a href="#" class="btn btn-sm btn-appointment">Konsultasi</a>
                      <a href="#" class="btn btn-sm btn-soft">Lihat Profil</a>
                    </div>
                  </div>
                </article>
              </div><!-- End Directory Item -->

            </div><!-- End Directory Items Container -->
          </div>
        </div><!-- End Teacher Directory -->

       
      </div>

    </section><!-- /Teachers Section -->

    <style>
    .teacher-profile {
      text-align: center;
      padding: 2rem 1rem;
      margin-bottom: 2rem;
    }
    .teacher-profile img {
      width: 120px;
      height: 120px;
      object-fit: cover;
      margin-bottom: 1rem;
    }
    .teacher-profile h5 {
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: #112D4E;
    }
    .teacher-subject {
      color: #3F72AF;
      font-weight: 500;
      margin-bottom: 0.25rem;
    }
    .teacher-experience {
      color: #112D4E;
      font-size: 0.9rem;
    }
    
    /* Fix untuk isotope layout agar card tetap di kiri */
    .isotope-container {
      justify-content: flex-start !important;
    }
    
    .isotope-container .doctor-item {
      margin-right: auto;
    }
    
    /* Pastikan saat filter hanya menampilkan 1 item, tetap di kiri */
    .isotope-container.isotope {
      justify-content: flex-start !important;
    }
    </style>

@endsection
