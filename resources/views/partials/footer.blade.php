<footer id="footer" class="footer position-relative">

  <div class="container footer-top">
    <div class="row gy-4">
      <div class="col-lg-4 col-md-6 footer-about">
        <a href="{{ url('/') }}" class="logo d-flex align-items-center">
          <span class="sitename">SMK BAKTI NUSANTARA 666</span>
        </a>
        <div class="footer-contact pt-3">
          <p>Jl. Percobaan, Cileunyi</p>
          <p>Bandung, Jawa Barat 40393</p>
          <p class="mt-3"><strong>Telepon:</strong> <span>(022) 8765-4321</span></p>
          <p><strong>Email:</strong> <span>info@smkbn666.sch.id</span></p>
        </div>
        <div class="social-links d-flex mt-4">
          <a href=""><i class="bi bi-twitter-x"></i></a>
          <a href=""><i class="bi bi-facebook"></i></a>
          <a href=""><i class="bi bi-instagram"></i></a>
          <a href=""><i class="bi bi-youtube"></i></a>
        </div>
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Menu</h4>
        <ul>
          <li><a href="{{ url('/') }}">Beranda</a></li>
          <li><a href="{{ url('/about') }}">Tentang Kami</a></li>
          <li><a href="{{ url('/jurusan') }}">Jurusan</a></li>
          <li><a href="{{ url('/pendaftaran') }}">Pendaftaran</a></li>
          <li><a href="{{ url('/contact') }}">Kontak</a></li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-3 footer-links">
        <h4>Jurusan</h4>
        <ul>
          <li><a href="#">Rekayasa Perangkat Lunak</a></li>
          <li><a href="#">Teknik Komputer & Jaringan</a></li>
          <li><a href="#">Multimedia</a></li>
          <li><a href="#">Akuntansi</a></li>
          <li><a href="#">Administrasi Perkantoran</a></li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-3 footer-links">
        <h4>Informasi</h4>
        <ul>
          <li><a href="#">Berita & Pengumuman</a></li>
          <li><a href="#">Galeri</a></li>
          <li><a href="#">Prestasi</a></li>
          <li><a href="#">Fasilitas</a></li>
          <li><a href="#">Alumni</a></li>
        </ul>
      </div>

    </div>
  </div>

  <div class="container copyright text-center mt-4">
    <p>© <span>Copyright</span> <strong>SMK BAKTI NUSANTARA 666</strong>&nbsp;<span>All Rights Reserved</span></p>
    <div class="credits">
      SPMB {{ date('Y') }}
    </div>
  </div>

</footer>