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

    <a class="btn-getstarted" href="{{ route('pendaftaran.login') }}">Login</a>

  </div>
</header>