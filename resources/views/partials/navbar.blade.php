<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container position-relative d-flex align-items-center justify-content-between">

    <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto me-xl-0">
      <img src="{{ asset('assets/img/baknus/bn2.png') }}" alt="SMK BAKTI NUSANTARA 666" class="logo-img">
      <h1 class="sitename">SMK <span>BAKTI NUSANTARA 666</span></h1>
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="/" class="{{ Request::is('/') ? 'active' : '' }}">Beranda</a></li>
        <li><a href="/about" class="{{ Request::is('about') ? 'active' : '' }}">Tentang</a></li>
        <li><a href="/jurusan" class="{{ Request::is('jurusan') ? 'active' : '' }}">Jurusan</a></li>
        <li><a href="/pendaftaran" class="{{ Request::is('pendaftaran') ? 'active' : '' }}">Pendaftaran</a></li>
        <li><a href="/contact" class="{{ Request::is('contact') ? 'active' : '' }}">Kontak</a></li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    @auth
      <div class="dropdown">
        <a class="btn-getstarted dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li><a class="dropdown-item" href="{{ route('pendaftaran.status') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
          <li><a class="dropdown-item" href="{{ route('pendaftaran.form') }}"><i class="bi bi-file-earmark-text me-2"></i>Formulir</a></li>
          <li><a class="dropdown-item" href="{{ route('pendaftaran.upload') }}"><i class="bi bi-cloud-upload me-2"></i>Upload Berkas</a></li>
          <li><a class="dropdown-item" href="{{ route('pendaftaran.pembayaran') }}"><i class="bi bi-credit-card me-2"></i>Pembayaran</a></li>
          <li><hr class="dropdown-divider"></li>
          <li>
            <form action="{{ route('pendaftaran.logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
            </form>
          </li>
        </ul>
      </div>
    @else
      <a class="btn-getstarted" href="{{ route('pendaftaran.login') }}">Login</a>
    @endauth

  </div>
</header>