@extends('layouts.main')
@section('content')

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1 class="heading-title">Jurusan</h1>
              <p class="mb-0">
                Pilih jurusan yang sesuai dengan minat dan bakat Anda. Setiap jurusan memiliki
                kurikulum yang dirancang untuk mempersiapkan siswa menghadapi dunia kerja
                dan melanjutkan pendidikan ke jenjang yang lebih tinggi.
              </p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="current">Jurusan</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Jurusan Section -->
    <section id="departments" class="departments section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          @foreach($jurusan as $index => $item)
          <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="{{ ($index + 1) * 100 }}">
            <div class="department-item">
              <div class="department-content">
                <div class="department-header">
                  <div class="department-icon">
                    @if($item['id'] == 'pplg')
                      <img src="{{ asset('assets/img/baknus/pplg.jpeg') }}" alt="{{ $item['nama'] }}" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                    @elseif($item['id'] == 'animasi')
                      <img src="{{ asset('assets/img/baknus/anm.jpeg') }}" alt="{{ $item['nama'] }}" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                    @elseif($item['id'] == 'dkv')
                      <img src="{{ asset('assets/img/baknus/dkv.jpeg') }}" alt="{{ $item['nama'] }}" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                    @elseif($item['id'] == 'pemasaran')
                      <img src="{{ asset('assets/img/baknus/bdp.jpeg') }}" alt="{{ $item['nama'] }}" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                    @elseif($item['id'] == 'akuntansi')
                      <img src="{{ asset('assets/img/baknus/akt.jpeg') }}" alt="{{ $item['nama'] }}" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                    @else
                      <img src="{{ asset('assets/img/baknus/baknus.jpeg') }}" alt="{{ $item['nama'] }}" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                    @endif
                  </div>
                  <div class="department-info">
                    <h3>{{ $item['nama'] }}</h3>
                    <span class="department-category">{{ $item['nama_lengkap'] }}</span>
                  </div>
                </div>
                <p>{{ $item['deskripsi'] }}</p>
                <div class="department-features">
                  @foreach($item['keahlian'] as $keahlian)
                  <span class="feature-badge">{{ $keahlian }}</span>
                  @endforeach
                </div>
              </div>
              <div class="department-image">
                @if($item['id'] == 'pplg')
                  <img src="{{ asset('assets/img/baknus/bannerpplg.webp') }}" alt="{{ $item['nama'] }}" class="img-fluid" style="object-fit: cover; height: 200px; width: 100%;">
                @elseif($item['id'] == 'animasi')
                  <img src="{{ asset('assets/img/baknus/banneranimasi.jpeg') }}" alt="{{ $item['nama'] }}" class="img-fluid" style="object-fit: cover; height: 200px; width: 100%;">
                @elseif($item['id'] == 'dkv')
                  <img src="{{ asset('assets/img/baknus/bannerdkv.jpg') }}" alt="{{ $item['nama'] }}" class="img-fluid" style="object-fit: cover; height: 200px; width: 100%; transform: rotate(180deg);">
                @elseif($item['id'] == 'pemasaran')
                  <img src="{{ asset('assets/img/baknus/bannerbdp.jpeg') }}" alt="{{ $item['nama'] }}" class="img-fluid" style="object-fit: cover; height: 200px; width: 100%;">
                @elseif($item['id'] == 'akuntansi')
                  <img src="{{ asset('assets/img/baknus/bannerakt.jpg') }}" alt="{{ $item['nama'] }}" class="img-fluid" style="object-fit: cover; height: 200px; width: 100%;">
                @else
                  <img src="{{ asset('assets/img/baknus/baknus.jpeg') }}" alt="{{ $item['nama'] }}" class="img-fluid" style="object-fit: cover; height: 200px; width: 100%;">
                @endif
                <div class="department-overlay">
                  <a href="#" class="department-link">
                    <i class="fas fa-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          @endforeach

        </div>

      </div>

        </div>

      </div>

    </section><!-- /Jurusan Section -->

@endsection
