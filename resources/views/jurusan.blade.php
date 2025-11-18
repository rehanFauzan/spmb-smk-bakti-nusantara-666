@extends('layouts.main')

@section('title', 'Program Keahlian - SMK BAKTI NUSANTARA 666')

@push('styles')
<style>
.department-card {
    background: #fff;
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.department-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.department-icon {
    font-size: 3rem;
    color: #007bff;
    margin-bottom: 20px;
}

.department-stats {
    display: flex;
    gap: 20px;
    margin: 20px 0;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 2rem;
    font-weight: bold;
    color: #007bff;
}

.stat-label {
    font-size: 0.9rem;
    color: #6c757d;
}

.cta-section {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    padding: 50px;
    border-radius: 15px;
    text-align: center;
}

.cta-buttons {
    margin-top: 30px;
}

.cta-buttons .btn {
    margin: 0 10px;
}
</style>
@endpush

@section('content')

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Program Keahlian</h1>
              <p class="mb-0">
                Pilih program keahlian yang sesuai dengan minat dan bakat Anda. 
                SMK BAKTI NUSANTARA 666 menyediakan 5 program keahlian unggulan 
                yang siap mempersiapkan Anda untuk dunia kerja dan industri.
              </p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="current">Program Keahlian</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Jurusan Section -->
    <section id="jurusan" class="departments section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="department-item">
              <div class="department-content">
                <div class="department-header">
                  <div class="department-icon">
                    <img src="{{ asset('assets/img/baknus/pplg.jpeg') }}" alt="PPLG" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                  </div>
                  <div class="department-info">
                    <h3>Pengembangan Perangkat Lunak dan Gim (PPLG)</h3>
                    <span class="department-category">Mempersiapkan siswa menjadi programmer dan developer handal</span>
                  </div>
                </div>
                <p>Program keahlian yang mempersiapkan siswa menjadi programmer dan developer handal dengan kurikulum terkini dan praktik langsung menggunakan teknologi modern.</p>
                <div class="department-features">
                  <span class="feature-badge">Web Development</span>
                  <span class="feature-badge">Mobile App</span>
                  <span class="feature-badge">Game Development</span>
                </div>
              </div>
              <div class="department-image">
                <img src="{{ asset('assets/img/baknus/bannerpplg.webp') }}" alt="PPLG" class="img-fluid" style="object-fit: cover; height: 200px; width: 100%;">
                <div class="department-overlay">
                  <a href="#" class="department-link">
                    <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="300">
            <div class="department-item">
              <div class="department-content">
                <div class="department-header">
                  <div class="department-icon">
                    <img src="{{ asset('assets/img/baknus/dkv.jpeg') }}" alt="DKV" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                  </div>
                  <div class="department-info">
                    <h3>Desain Komunikasi Visual (DKV)</h3>
                    <span class="department-category">Mengembangkan kreativitas dalam desain grafis dan komunikasi visual</span>
                  </div>
                </div>
                <p>Program keahlian yang mengembangkan kreativitas dalam bidang desain grafis, branding, dan komunikasi visual dengan teknologi terkini.</p>
                <div class="department-features">
                  <span class="feature-badge">Desain Grafis</span>
                  <span class="feature-badge">Branding</span>
                  <span class="feature-badge">UI/UX Design</span>
                </div>
              </div>
              <div class="department-image">
                <img src="{{ asset('assets/img/baknus/bannerdkv.jpg') }}" alt="DKV" class="img-fluid" style="object-fit: cover; height: 200px; width: 100%; transform: rotate(180deg);">
                <div class="department-overlay">
                  <a href="#" class="department-link">
                    <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="400">
            <div class="department-item">
              <div class="department-content">
                <div class="department-header">
                  <div class="department-icon">
                    <img src="{{ asset('assets/img/baknus/anm.jpeg') }}" alt="Animasi" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                  </div>
                  <div class="department-info">
                    <h3>Animasi (ANM)</h3>
                    <span class="department-category">Fokus pada pembuatan animasi 2D/3D dan visual effects</span>
                  </div>
                </div>
                <p>Program keahlian yang fokus pada pembuatan animasi 2D/3D, motion graphics, dan visual effects dengan teknologi terdepan.</p>
                <div class="department-features">
                  <span class="feature-badge">Animasi 2D/3D</span>
                  <span class="feature-badge">Motion Graphics</span>
                  <span class="feature-badge">Visual Effects</span>
                </div>
              </div>
              <div class="department-image">
                <img src="{{ asset('assets/img/baknus/banneranimasi.jpeg') }}" alt="Animasi" class="img-fluid" style="object-fit: cover; height: 200px; width: 100%;">
                <div class="department-overlay">
                  <a href="#" class="department-link">
                    <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="500">
            <div class="department-item">
              <div class="department-content">
                <div class="department-header">
                  <div class="department-icon">
                    <img src="{{ asset('assets/img/baknus/bdp.jpeg') }}" alt="Broadcasting" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                  </div>
                  <div class="department-info">
                    <h3>Broadcasting dan Perfilman (BDP)</h3>
                    <span class="department-category">Mempersiapkan tenaga ahli di bidang produksi media dan perfilman</span>
                  </div>
                </div>
                <p>Program keahlian yang mempersiapkan tenaga ahli di bidang produksi media, broadcasting, dan perfilman dengan teknologi modern.</p>
                <div class="department-features">
                  <span class="feature-badge">Video Production</span>
                  <span class="feature-badge">Broadcasting</span>
                  <span class="feature-badge">Film Making</span>
                </div>
              </div>
              <div class="department-image">
                <img src="{{ asset('assets/img/baknus/bannerbdp.jpeg') }}" alt="Broadcasting" class="img-fluid" style="object-fit: cover; height: 200px; width: 100%;">
                <div class="department-overlay">
                  <a href="#" class="department-link">
                    <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="600">
            <div class="department-item">
              <div class="department-content">
                <div class="department-header">
                  <div class="department-icon">
                    <img src="{{ asset('assets/img/baknus/akt.jpeg') }}" alt="Akuntansi" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                  </div>
                  <div class="department-info">
                    <h3>Akuntansi dan Keuangan Lembaga (AKT)</h3>
                    <span class="department-category">Mempersiapkan tenaga ahli di bidang keuangan dan akuntansi</span>
                  </div>
                </div>
                <p>Program keahlian yang mempersiapkan tenaga ahli di bidang keuangan dan akuntansi dengan pemahaman sistem akuntansi modern dan teknologi terkini.</p>
                <div class="department-features">
                  <span class="feature-badge">Akuntansi Keuangan</span>
                  <span class="feature-badge">Perpajakan</span>
                  <span class="feature-badge">Audit</span>
                  <span class="feature-badge">Software Akuntansi</span>
                </div>
              </div>
              <div class="department-image">
                <img src="{{ asset('assets/img/baknus/bannerakt.jpg') }}" alt="Akuntansi" class="img-fluid" style="object-fit: cover; height: 200px; width: 100%;">
                <div class="department-overlay">
                  <a href="#" class="department-link">
                    <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>

        </div>

        <!-- Call to Action -->
        

      </div>

    </section><!-- /Jurusan Section -->

@endsection

@push('scripts')
<script>
    AOS.init({
        duration: 1000,
        once: true
    });
</script>
@endpush