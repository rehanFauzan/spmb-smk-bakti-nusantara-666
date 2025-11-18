@extends('layouts.main')

@section('content')
<!-- Page Title -->
<div class="page-title">
  <div class="heading">
    <div class="container">
      <div class="row d-flex justify-content-center text-center">
        <div class="col-lg-8">
          <h1 class="heading-title">Syarat dan Ketentuan</h1>
          <p class="mb-0">Ketentuan penggunaan sistem SPMB SMK Bakti Nusantara 666</p>
        </div>
      </div>
    </div>
  </div>
  <nav class="breadcrumbs">
    <div class="container">
      <ol>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="current">Syarat dan Ketentuan</li>
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
          
          <div class="terms-header mb-4">
            <h2>Syarat dan Ketentuan Penggunaan</h2>
            <p class="text-muted">Terakhir diperbarui: {{ date('d F Y') }}</p>
          </div>

          <div class="terms-content">
            
            <div class="section-item">
              <h3>1. Ketentuan Umum</h3>
              <p>Dengan mengakses dan menggunakan sistem Penerimaan Peserta Didik Baru (SPMB) SMK Bakti Nusantara 666, Anda menyetujui untuk terikat dengan syarat dan ketentuan berikut:</p>
              <ul>
                <li>Sistem ini hanya digunakan untuk keperluan pendaftaran siswa baru</li>
                <li>Pengguna wajib memberikan informasi yang akurat dan benar</li>
                <li>Setiap penyalahgunaan sistem akan dikenakan sanksi sesuai ketentuan yang berlaku</li>
              </ul>
            </div>

            <div class="section-item">
              <h3>2. Persyaratan Pendaftaran</h3>
              <p>Calon siswa yang mendaftar harus memenuhi persyaratan berikut:</p>
              <ul>
                <li>Lulusan SMP/MTs atau sederajat</li>
                <li>Berusia maksimal 21 tahun pada saat pendaftaran</li>
                <li>Memiliki dokumen persyaratan yang lengkap dan sah</li>
                <li>Membayar biaya pendaftaran sesuai ketentuan</li>
              </ul>
            </div>

            <div class="section-item">
              <h3>3. Dokumen Persyaratan</h3>
              <p>Dokumen yang harus disiapkan untuk pendaftaran:</p>
              <ul>
                <li>Ijazah SMP/MTs atau Surat Keterangan Lulus (SKL)</li>
                <li>Kartu Keluarga (KK)</li>
                <li>Akta Kelahiran</li>
                <li>Pas foto terbaru ukuran 3x4 (2 lembar)</li>
                <li>Surat Keterangan Sehat dari dokter</li>
              </ul>
            </div>

            <div class="section-item">
              <h3>4. Proses Seleksi</h3>
              <p>Proses seleksi dilakukan berdasarkan:</p>
              <ul>
                <li>Kelengkapan dan keabsahan dokumen</li>
                <li>Nilai rapor SMP/MTs</li>
                <li>Kuota yang tersedia untuk setiap jurusan</li>
                <li>Urutan waktu pendaftaran (first come, first served)</li>
              </ul>
            </div>

            <div class="section-item">
              <h3>5. Biaya Pendaftaran</h3>
              <p>Ketentuan biaya pendaftaran:</p>
              <ul>
                <li>Biaya pendaftaran sebesar Rp 150.000</li>
                <li>Biaya tidak dapat dikembalikan dalam kondisi apapun</li>
                <li>Pembayaran dilakukan melalui transfer bank yang telah ditentukan</li>
                <li>Bukti pembayaran harus diupload ke sistem</li>
              </ul>
            </div>

            <div class="section-item">
              <h3>6. Kewajiban Pengguna</h3>
              <p>Pengguna sistem wajib:</p>
              <ul>
                <li>Menjaga kerahasiaan akun dan password</li>
                <li>Memberikan informasi yang benar dan akurat</li>
                <li>Mengupload dokumen yang asli dan tidak dipalsukan</li>
                <li>Mengikuti jadwal dan prosedur yang telah ditetapkan</li>
                <li>Bertanggung jawab atas segala aktivitas yang dilakukan dengan akun mereka</li>
              </ul>
            </div>

            <div class="section-item">
              <h3>7. Larangan</h3>
              <p>Pengguna dilarang:</p>
              <ul>
                <li>Memalsukan dokumen atau informasi</li>
                <li>Menggunakan akun orang lain</li>
                <li>Melakukan tindakan yang dapat merusak sistem</li>
                <li>Mendaftar lebih dari satu kali dengan identitas yang sama</li>
                <li>Menyebarkan informasi login kepada pihak lain</li>
              </ul>
            </div>

            <div class="section-item">
              <h3>8. Sanksi</h3>
              <p>Pelanggaran terhadap syarat dan ketentuan dapat dikenakan sanksi:</p>
              <ul>
                <li>Pembatalan pendaftaran</li>
                <li>Pemblokiran akun</li>
                <li>Tidak dapat mendaftar pada periode berikutnya</li>
                <li>Tindakan hukum sesuai peraturan yang berlaku</li>
              </ul>
            </div>

            <div class="section-item">
              <h3>9. Perubahan Syarat dan Ketentuan</h3>
              <p>SMK Bakti Nusantara 666 berhak mengubah syarat dan ketentuan ini sewaktu-waktu tanpa pemberitahuan sebelumnya. Perubahan akan berlaku efektif setelah dipublikasikan di website resmi sekolah.</p>
            </div>

            <div class="section-item">
              <h3>10. Kontak</h3>
              <p>Untuk pertanyaan mengenai syarat dan ketentuan ini, silakan hubungi:</p>
              <div class="contact-info">
                <p><strong>SMK Bakti Nusantara 666</strong></p>
                <p>📍 Jl. Percobaan, Cileunyi, Bandung, Jawa Barat 40393</p>
                <p>📞 (022) 8765-4321</p>
                <p>📧 info@smkbn666.sch.id</p>
              </div>
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

.terms-header h2 {
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