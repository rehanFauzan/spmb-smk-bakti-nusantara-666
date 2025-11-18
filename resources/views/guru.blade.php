@extends('layouts.main')
@section('content')

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Tenaga Pengajar</h1>
              <p class="mb-0">
                Temui guru-guru berpengalaman dan berkualitas di SMK BAKTI NUSANTARA 666. 
                Tim pengajar kami terdiri dari profesional bersertifikat yang siap membimbing 
                siswa menuju kesuksesan di berbagai program keahlian yang tersedia.
              </p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="current">Tenaga Pengajar</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Teachers Section -->
    <section id="doctors" class="doctors section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <!-- Teacher Directory -->
        <div class="doctor-directory mb-5">
          <div class="directory-bar p-3 p-md-4 rounded-3">
            <div class="row g-3 align-items-center">
              <div class="col-lg-4">
                <label for="teacher-search" class="form-label mb-1">Cari Guru</label>
                <div class="position-relative">
                  <i class="bi bi-search search-icon"></i>
                  <input id="teacher-search" type="text" class="form-control search-input" placeholder="Ketik nama atau kata kunci">
                </div>
              </div>
              <div class="col-lg-3">
                <label class="form-label mb-1">Program Keahlian</label>
                <select class="form-select">
                  <option value="*">Semua Program</option>
                  <option value=".filter-rpl">RPL</option>
                  <option value=".filter-tkj">TKJ</option>
                  <option value=".filter-multimedia">Multimedia</option>
                  <option value=".filter-akuntansi">Akuntansi</option>
                  <option value=".filter-adm">Adm. Perkantoran</option>
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
              <li data-filter=".filter-rpl">RPL</li>
              <li data-filter=".filter-tkj">TKJ</li>
              <li data-filter=".filter-multimedia">Multimedia</li>
              <li data-filter=".filter-akuntansi">Akuntansi</li>
              <li data-filter=".filter-adm">Adm. Perkantoran</li>
            </ul><!-- End Directory Filters -->

            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="300">

              <div class="col-lg-3 col-md-6 doctor-item isotope-item filter-rpl">
                <article class="doctor-card h-100">
                  <figure class="doctor-media">
                    <img src="{{ asset('assets/img/health/staff-3.webp') }}" class="img-fluid" alt="Pak Budi Santoso" loading="lazy">
                    <span class="tag">Guru Senior</span>
                  </figure>
                  <div class="doctor-content">
                    <h3 class="doctor-name">Pak Budi Santoso, S.Kom, M.T</h3>
                    <p class="doctor-title">Guru RPL • S.Kom, M.T</p>
                    <p class="doctor-desc">Spesialis dalam pengembangan aplikasi web dan mobile dengan pengalaman industri 15 tahun.</p>
                    <div class="doctor-meta">
                      <span class="badge dept">RPL</span>
                    </div>
                    <div class="doctor-actions">
                      <a href="#" class="btn btn-sm btn-appointment">Konsultasi</a>
                      <a href="#" class="btn btn-sm btn-soft">Lihat Profil</a>
                    </div>
                  </div>
                </article>
              </div><!-- End Directory Item -->

              <div class="col-lg-3 col-md-6 doctor-item isotope-item filter-tkj">
                <article class="doctor-card h-100">
                  <figure class="doctor-media">
                    <img src="{{ asset('assets/img/health/staff-7.webp') }}" class="img-fluid" alt="Bu Sari Indrawati" loading="lazy">
                  </figure>
                  <div class="doctor-content">
                    <h3 class="doctor-name">Bu Sari Indrawati, S.T, M.Kom</h3>
                    <p class="doctor-title">Guru TKJ • S.T, M.Kom</p>
                    <p class="doctor-desc">Ahli dalam jaringan komputer dan sistem administrasi server dengan sertifikasi internasional.</p>
                    <div class="doctor-meta">
                      <span class="badge dept">TKJ</span>
                    </div>
                    <div class="doctor-actions">
                      <a href="#" class="btn btn-sm btn-appointment">Konsultasi</a>
                      <a href="#" class="btn btn-sm btn-soft">Lihat Profil</a>
                    </div>
                  </div>
                </article>
              </div><!-- End Directory Item -->

              <div class="col-lg-3 col-md-6 doctor-item isotope-item filter-multimedia">
                <article class="doctor-card h-100">
                  <figure class="doctor-media">
                    <img src="{{ asset('assets/img/health/staff-12.webp') }}" class="img-fluid" alt="Pak Ahmad Fauzi" loading="lazy">
                    <span class="tag alt">Baru</span>
                  </figure>
                  <div class="doctor-content">
                    <h3 class="doctor-name">Pak Ahmad Fauzi, S.Sn, M.Ds</h3>
                    <p class="doctor-title">Guru Multimedia • S.Sn, M.Ds</p>
                    <p class="doctor-desc">Kreatif dalam desain grafis, video editing, dan animasi dengan portfolio internasional.</p>
                    <div class="doctor-meta">
                      <span class="badge dept">Multimedia</span>
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
                    <p class="doctor-title">Guru Akuntansi • S.E, M.Ak</p>
                    <p class="doctor-desc">Berpengalaman dalam akuntansi keuangan dan sistem informasi akuntansi modern.</p>
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

              <div class="col-lg-3 col-md-6 doctor-item isotope-item filter-adm">
                <article class="doctor-card h-100">
                  <figure class="doctor-media">
                    <img src="{{ asset('assets/img/health/staff-10.webp') }}" class="img-fluid" alt="Bu Dewi Sartika" loading="lazy">
                  </figure>
                  <div class="doctor-content">
                    <h3 class="doctor-name">Bu Dewi Sartika, S.Sos, M.AP</h3>
                    <p class="doctor-title">Guru Adm. Perkantoran • S.Sos, M.AP</p>
                    <p class="doctor-desc">Spesialis administrasi perkantoran modern dan manajemen kearsipan digital.</p>
                    <div class="doctor-meta">
                      <span class="badge dept">Adm. Perkantoran</span>
                    </div>
                    <div class="doctor-actions">
                      <a href="#" class="btn btn-sm btn-appointment">Konsultasi</a>
                      <a href="#" class="btn btn-sm btn-soft">Lihat Profil</a>
                    </div>
                  </div>
                </article>
              </div><!-- End Directory Item -->

              <div class="col-lg-3 col-md-6 doctor-item isotope-item filter-rpl">
                <article class="doctor-card h-100">
                  <figure class="doctor-media">
                    <img src="{{ asset('assets/img/health/staff-2.webp') }}" class="img-fluid" alt="Pak Joko Widodo" loading="lazy">
                  </figure>
                  <div class="doctor-content">
                    <h3 class="doctor-name">Pak Joko Widodo, S.Pd, M.Pd</h3>
                    <p class="doctor-title">Guru Bahasa Indonesia • S.Pd, M.Pd</p>
                    <p class="doctor-desc">Pengajar mata pelajaran umum dengan metode pembelajaran inovatif dan menyenangkan.</p>
                    <div class="doctor-meta">
                      <span class="badge dept">Mata Pelajaran Umum</span>
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

        <!-- Featured Teacher Profile -->
        <div class="single-profile mt-5">
          <div class="row align-items-center g-4">
            <div class="col-lg-5" data-aos="fade-right" data-aos-delay="150">
              <div class="profile-media">
                <img src="{{ asset('assets/img/health/staff-12.webp') }}" class="img-fluid" alt="Bu Ratna Sari">
                <div class="availability">
                  <i class="bi bi-circle-fill me-1"></i> Tersedia minggu ini
                </div>
              </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left" data-aos-delay="200">
              <div class="profile-content">
                <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                  <span class="badge role">Kepala Program RPL</span>
                  <span class="badge years">18+ Tahun Pengalaman</span>
                  <span class="badge cert">Sertifikat Profesional</span>
                </div>
                <h3 class="name mb-1">Bu Ratna Sari, S.Kom, M.T</h3>
                <p class="title mb-3">Kepala Program RPL • S.Kom, M.T</p>
                <p class="bio mb-3">Memiliki pengalaman luas dalam pengembangan software dan telah membimbing ratusan siswa untuk menjadi programmer profesional. Aktif dalam penelitian teknologi informasi dan pengembangan kurikulum.</p>
                <ul class="list-unstyled highlights mb-4">
                  <li><i class="bi bi-mortarboard"></i> Lulusan: Institut Teknologi Bandung</li>
                  <li><i class="bi bi-award"></i> Sertifikasi: Oracle Certified Professional</li>
                  <li><i class="bi bi-file-earmark-text"></i> Publikasi: 8 jurnal nasional dan internasional</li>
                </ul>
                <div class="d-flex flex-wrap gap-2">
                  <a href="#" class="btn btn-appointment"><i class="bi bi-calendar2-check me-1"></i> Jadwalkan Konsultasi</a>
                  <a href="#" class="btn btn-soft"><i class="bi bi-file-earmark-text me-1"></i> Lihat CV</a>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Featured Teacher Profile -->

      </div>

    </section><!-- /Teachers Section -->

@endsection