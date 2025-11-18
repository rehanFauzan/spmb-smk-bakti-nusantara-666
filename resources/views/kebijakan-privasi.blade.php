@extends('layouts.main')

@section('content')
<!-- Page Title -->
<div class="page-title">
  <div class="heading">
    <div class="container">
      <div class="row d-flex justify-content-center text-center">
        <div class="col-lg-8">
          <h1 class="heading-title">Kebijakan Privasi</h1>
          <p class="mb-0">Perlindungan data pribadi dalam sistem SPMB SMK Bakti Nusantara 666</p>
        </div>
      </div>
    </div>
  </div>
  <nav class="breadcrumbs">
    <div class="container">
      <ol>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="current">Kebijakan Privasi</li>
      </ol>
    </div>
  </nav>
</div>

<!-- Content Section -->
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="content-wrapper" data-aos="fade-up">
          
          <div class="privacy-header mb-4">
            <h2>Kebijakan Privasi</h2>
            <p class="text-muted">Terakhir diperbarui: {{ date('d F Y') }}</p>
          </div>

          <div class="privacy-content">
            
            <div class="section-item">
              <h3>1. Pendahuluan</h3>
              <p>SMK Bakti Nusantara 666 berkomitmen untuk melindungi privasi dan keamanan data pribadi Anda. Kebijakan privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda saat menggunakan sistem Penerimaan Peserta Didik Baru (SPMB).</p>
            </div>

            <div class="section-item">
              <h3>2. Informasi yang Kami Kumpulkan</h3>
              <p>Kami mengumpulkan informasi berikut dari calon siswa:</p>
              <ul>
                <li><strong>Data Pribadi:</strong> Nama lengkap, tempat tanggal lahir, jenis kelamin, agama, kewarganegaraan</li>
                <li><strong>Data Kontak:</strong> Alamat, nomor telepon, email</li>
                <li><strong>Data Keluarga:</strong> Nama orang tua/wali, pekerjaan, penghasilan</li>
                <li><strong>Data Pendidikan:</strong> Asal sekolah, nilai rapor, prestasi</li>
                <li><strong>Dokumen:</strong> Ijazah, kartu keluarga, akta kelahiran, foto</li>
                <li><strong>Data Teknis:</strong> Alamat IP, browser, waktu akses sistem</li>
              </ul>
            </div>

            <div class="section-item">
              <h3>3. Tujuan Pengumpulan Data</h3>
              <p>Data pribadi yang kami kumpulkan digunakan untuk:</p>
              <ul>
                <li>Proses pendaftaran dan seleksi calon siswa</li>
                <li>Verifikasi identitas dan dokumen</li>
                <li>Komunikasi terkait proses pendaftaran</li>
                <li>Pembuatan laporan dan statistik pendaftaran</li>
                <li>Kepatuhan terhadap peraturan pendidikan</li>
                <li>Peningkatan layanan sistem SPMB</li>
              </ul>
            </div>

            <div class="section-item">
              <h3>4. Dasar Hukum Pemrosesan Data</h3>
              <p>Pemrosesan data pribadi Anda didasarkan pada:</p>
              <ul>
                <li>Persetujuan yang Anda berikan saat mendaftar</li>
                <li>Kepentingan sah sekolah dalam proses seleksi siswa</li>
                <li>Kewajiban hukum sesuai peraturan pendidikan</li>
                <li>Undang-Undang No. 27 Tahun 2022 tentang Pelindungan Data Pribadi</li>
              </ul>
            </div>

            <div class="section-item">
              <h3>5. Pembagian Data</h3>
              <p>Kami tidak akan membagikan data pribadi Anda kepada pihak ketiga, kecuali:</p>
              <ul>
                <li>Dengan persetujuan eksplisit dari Anda</li>
                <li>Kepada Dinas Pendidikan untuk keperluan pelaporan</li>
                <li>Kepada pihak berwenang jika diwajibkan oleh hukum</li>
                <li>Kepada penyedia layanan teknis dengan perjanjian kerahasiaan</li>
              </ul>
            </div>

            <div class="section-item">
              <h3>6. Keamanan Data</h3>
              <p>Kami menerapkan langkah-langkah keamanan untuk melindungi data Anda:</p>
              <ul>
                <li>Enkripsi data saat transmisi dan penyimpanan</li>
                <li>Akses terbatas hanya untuk petugas yang berwenang</li>
                <li>Sistem autentikasi berlapis untuk akses admin</li>
                <li>Backup data secara berkala</li>
                <li>Monitoring aktivitas sistem 24/7</li>
                <li>Update keamanan sistem secara rutin</li>
              </ul>
            </div>

            <div class="section-item">
              <h3>7. Penyimpanan Data</h3>
              <p>Ketentuan penyimpanan data pribadi:</p>
              <ul>
                <li>Data disimpan selama proses pendaftaran berlangsung</li>
                <li>Data calon siswa yang diterima disimpan sesuai ketentuan sekolah</li>
                <li>Data calon siswa yang tidak diterima dihapus setelah 1 tahun</li>
                <li>Data dapat disimpan lebih lama jika diperlukan untuk kepentingan hukum</li>
              </ul>
            </div>

            <div class="section-item">
              <h3>8. Hak-Hak Anda</h3>
              <p>Sebagai pemilik data, Anda memiliki hak untuk:</p>
              <ul>
                <li><strong>Akses:</strong> Meminta salinan data pribadi yang kami miliki</li>
                <li><strong>Koreksi:</strong> Meminta perbaikan data yang tidak akurat</li>
                <li><strong>Penghapusan:</strong> Meminta penghapusan data dalam kondisi tertentu</li>
                <li><strong>Pembatasan:</strong> Meminta pembatasan pemrosesan data</li>
                <li><strong>Portabilitas:</strong> Meminta transfer data ke pihak lain</li>
                <li><strong>Keberatan:</strong> Menolak pemrosesan data untuk tujuan tertentu</li>
              </ul>
            </div>

            <div class="section-item">
              <h3>9. Cookies dan Teknologi Pelacakan</h3>
              <p>Sistem kami menggunakan cookies untuk:</p>
              <ul>
                <li>Menjaga sesi login Anda</li>
                <li>Mengingat preferensi pengguna</li>
                <li>Menganalisis penggunaan sistem</li>
                <li>Meningkatkan keamanan sistem</li>
              </ul>
              <p>Anda dapat mengatur browser untuk menolak cookies, namun hal ini dapat mempengaruhi fungsi sistem.</p>
            </div>

            <div class="section-item">
              <h3>10. Perubahan Kebijakan</h3>
              <p>Kami dapat memperbarui kebijakan privasi ini sewaktu-waktu. Perubahan akan diberitahukan melalui:</p>
              <ul>
                <li>Publikasi di website resmi sekolah</li>
                <li>Notifikasi dalam sistem SPMB</li>
                <li>Email kepada pengguna terdaftar</li>
              </ul>
            </div>

            <div class="section-item">
              <h3>11. Kontak Data Protection Officer</h3>
              <p>Untuk pertanyaan, keluhan, atau permintaan terkait data pribadi, hubungi:</p>
              <div class="contact-info">
                <p><strong>Data Protection Officer</strong></p>
                <p><strong>SMK Bakti Nusantara 666</strong></p>
                <p>📍 Jl. Percobaan, Cileunyi, Bandung, Jawa Barat 40393</p>
                <p>📞 (022) 8765-4321</p>
                <p>📧 privacy@smkbn666.sch.id</p>
                <p>📧 dpo@smkbn666.sch.id</p>
              </div>
            </div>

            <div class="section-item">
              <h3>12. Pengaduan</h3>
              <p>Jika Anda tidak puas dengan penanganan data pribadi Anda, Anda dapat mengajukan pengaduan kepada:</p>
              <ul>
                <li>Data Protection Officer sekolah</li>
                <li>Komite Sekolah</li>
                <li>Dinas Pendidikan setempat</li>
                <li>Otoritas pengawas data pribadi yang berwenang</li>
              </ul>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
.content-wrapper {
  background: white;
  border-radius: 20px;
  padding: 3rem;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  border: 1px solid #f0f0f0;
}

.privacy-header h2 {
  color: var(--heading-color);
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.section-item {
  margin-bottom: 2.5rem;
  padding-bottom: 2rem;
  border-bottom: 1px solid #f0f0f0;
}

.section-item:last-child {
  border-bottom: none;
  margin-bottom: 0;
  padding-bottom: 0;
}

.section-item h3 {
  color: var(--accent-color);
  font-weight: 600;
  margin-bottom: 1rem;
  font-size: 1.2rem;
}

.section-item p {
  color: #6c757d;
  line-height: 1.6;
  margin-bottom: 1rem;
}

.section-item ul {
  color: #6c757d;
  line-height: 1.6;
}

.section-item ul li {
  margin-bottom: 0.5rem;
}

.section-item ul li strong {
  color: var(--heading-color);
}

.contact-info {
  background: #f8f9fa;
  padding: 1.5rem;
  border-radius: 10px;
  border-left: 4px solid var(--accent-color);
}

.contact-info p {
  margin-bottom: 0.5rem;
}

.contact-info p:last-child {
  margin-bottom: 0;
}

@media (max-width: 768px) {
  .content-wrapper {
    padding: 1.5rem;
    margin: 0 1rem;
  }
}
</style>
@endsection