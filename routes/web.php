<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\PendaftarController as AdminPendaftarController;
use App\Http\Controllers\Admin\VerifikasiController;
use App\Http\Controllers\Admin\KeuanganController as AdminKeuanganController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\PanitiaController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\KepalaSekolahController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\WilayahController;
use App\Http\Controllers\Admin\LogAktivitasController;
use App\Http\Controllers\WilayahController as PublicWilayahController;

// Auth Routes
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.store');
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', function () { return view('about'); });
Route::get('/contact', function () { return view('contact'); });
Route::get('/jurusan', function () { return view('jurusan'); });
Route::get('/syarat-ketentuan', function () { return view('syarat-ketentuan'); })->name('syarat-ketentuan');
Route::get('/kebijakan-privasi', function () { return view('kebijakan-privasi'); })->name('kebijakan-privasi');
// Pendaftaran Routes
Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
Route::get('/pendaftaran/register', [PendaftaranController::class, 'showRegister'])->name('pendaftaran.register');
Route::post('/pendaftaran/register', [PendaftaranController::class, 'storeRegister'])->name('pendaftaran.register.store');
Route::get('/pendaftaran/verify-otp', [PendaftaranController::class, 'showVerifyOtp'])->name('pendaftaran.verify-otp');
Route::post('/pendaftaran/verify-otp', [PendaftaranController::class, 'verifyOtp'])->name('pendaftaran.verify-otp');
Route::post('/pendaftaran/resend-otp', [PendaftaranController::class, 'resendOtp'])->name('pendaftaran.resend-otp');
Route::get('/pendaftaran/login', [PendaftaranController::class, 'showLogin'])->name('pendaftaran.login');
Route::post('/pendaftaran/login', [PendaftaranController::class, 'storeLogin'])->name('pendaftaran.login.store');
Route::get('/pendaftaran/forgot-password', [PendaftaranController::class, 'showForgotPassword'])->name('pendaftaran.forgot-password');
Route::post('/pendaftaran/forgot-password', [PendaftaranController::class, 'sendResetLink'])->name('pendaftaran.forgot-password.send');
Route::get('/pendaftaran/reset-password', [PendaftaranController::class, 'showResetPassword'])->name('pendaftaran.reset-password');
Route::post('/pendaftaran/reset-password', [PendaftaranController::class, 'resetPassword'])->name('pendaftaran.reset-password.store');
Route::post('/pendaftaran/resend-reset-otp', [PendaftaranController::class, 'resendResetOtp'])->name('pendaftaran.resend-reset-otp');
Route::get('/pendaftaran/form', [PendaftaranController::class, 'showForm'])->name('pendaftaran.form')->middleware('gelombang.aktif');
Route::post('/pendaftaran/form', [PendaftaranController::class, 'storeForm'])->name('pendaftaran.form.store')->middleware('gelombang.aktif');
Route::get('/pendaftaran/upload', [PendaftaranController::class, 'showUpload'])->name('pendaftaran.upload');
Route::post('/pendaftaran/upload', [PendaftaranController::class, 'storeUpload'])->name('pendaftaran.upload.store');
Route::get('/pendaftaran/status', [PendaftaranController::class, 'showStatus'])->name('pendaftaran.status');
Route::get('/pendaftaran/hasil', [PendaftaranController::class, 'showHasil'])->name('pendaftaran.hasil');
Route::get('/pendaftaran/pembayaran', [PendaftaranController::class, 'showPembayaran'])->name('pendaftaran.pembayaran');
Route::post('/pendaftaran/pembayaran', [PendaftaranController::class, 'storePembayaran'])->name('pendaftaran.pembayaran.store');
Route::post('/pendaftaran/logout', [PendaftaranController::class, 'logout'])->name('pendaftaran.logout');

// Admin Routes
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Data Master
    Route::get('/jurusan', [AdminController::class, 'jurusan'])->name('admin.jurusan');
    Route::post('/jurusan', [AdminController::class, 'jurusanStore'])->name('admin.jurusan.store');
    Route::put('/jurusan/{id}', [AdminController::class, 'jurusanUpdate'])->name('admin.jurusan.update');
    Route::delete('/jurusan/{id}', [AdminController::class, 'jurusanDestroy'])->name('admin.jurusan.destroy');
    Route::get('/gelombang', [AdminController::class, 'gelombang'])->name('admin.gelombang');
    Route::post('/gelombang', [AdminController::class, 'gelombangStore'])->name('admin.gelombang.store');
    Route::put('/gelombang/{id}', [AdminController::class, 'gelombangUpdate'])->name('admin.gelombang.update');
    Route::delete('/gelombang/{id}', [AdminController::class, 'gelombangDestroy'])->name('admin.gelombang.destroy');
    Route::get('/wilayah-analisis', [WilayahController::class, 'index'])->name('admin.wilayah.index');
    Route::get('/wilayah-analisis/export', [WilayahController::class, 'export'])->name('admin.wilayah.export');
    Route::post('/wilayah', [AdminController::class, 'wilayahStore'])->name('admin.wilayah.store');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users', [AdminController::class, 'userStore'])->name('admin.users.store');
    Route::put('/users/{id}', [AdminController::class, 'userUpdate'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminController::class, 'userDestroy'])->name('admin.users.destroy');
    
    // Pendaftar Management
    Route::get('/pendaftar', [AdminPendaftarController::class, 'index'])->name('admin.pendaftar.index');
    Route::get('/pendaftar/{id}', [AdminPendaftarController::class, 'show'])->name('admin.pendaftar.show');
    Route::put('/pendaftar/{id}/status', [AdminPendaftarController::class, 'updateStatus'])->name('admin.pendaftar.update-status');
    Route::get('/pendaftar/{pendaftarId}/berkas/{berkasId}', [AdminPendaftarController::class, 'viewBerkas'])->name('admin.pendaftar.view-berkas');
    Route::get('/pendaftar/{pendaftarId}/berkas/{berkasId}/preview', [AdminPendaftarController::class, 'previewBerkas'])->name('admin.pendaftar.preview-berkas');
    
    // Verifikasi
    Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('admin.verifikasi.index');
    Route::post('/verifikasi/{id}', [AdminController::class, 'verifikasiStore'])->name('admin.verifikasi.store');
    
    // Keuangan
    Route::get('/keuangan/pembayaran', [AdminKeuanganController::class, 'pembayaran'])->name('admin.keuangan.pembayaran');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('admin.profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    
    // Log Aktivitas
    Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])->name('admin.log-aktivitas.index');
    
    // Monitoring
    Route::get('/calon-siswa', [AdminController::class, 'calonSiswa'])->name('admin.calon-siswa');
    Route::get('/monitoring-pembayaran', [AdminController::class, 'monitoringPembayaran'])->name('admin.monitoring-pembayaran');
});

// Panitia Routes
Route::prefix('panitia')->group(function () {
    Route::get('/dashboard', [PanitiaController::class, 'dashboard'])->name('panitia.dashboard');
    Route::get('/pendaftaran', [PanitiaController::class, 'pendaftaran'])->name('panitia.pendaftaran');
    Route::get('/verifikasi-berkas', [PanitiaController::class, 'verifikasiBerkas'])->name('panitia.verifikasi-berkas');
    Route::put('/verifikasi-berkas/{id}', [PanitiaController::class, 'updateStatusBerkas'])->name('panitia.update-status-berkas');
    Route::get('/pendaftar/{pendaftarId}/berkas/{berkasId}', [PanitiaController::class, 'viewBerkas'])->name('panitia.view-berkas');
});

// Keuangan Routes
Route::prefix('keuangan')->group(function () {
    Route::get('/dashboard', [KeuanganController::class, 'dashboard'])->name('keuangan.dashboard');
    Route::get('/verifikasi-pembayaran', [KeuanganController::class, 'verifikasiPembayaran'])->name('keuangan.verifikasi-pembayaran');
    Route::put('/verifikasi-pembayaran/{id}', [KeuanganController::class, 'updateStatusPembayaran'])->name('keuangan.update-status-pembayaran');
    Route::post('/reset-pembayaran/{id}', [KeuanganController::class, 'resetPembayaran'])->name('keuangan.reset-pembayaran');
    Route::get('/rekap-pembayaran', [KeuanganController::class, 'rekapPembayaran'])->name('keuangan.rekap-pembayaran');
    Route::get('/daftar-pembayaran', [KeuanganController::class, 'daftarPembayaran'])->name('keuangan.daftar-pembayaran');
    Route::get('/pendaftar/{pendaftarId}/berkas/{berkasId}', [KeuanganController::class, 'viewBerkas'])->name('keuangan.view-berkas');
});

// Kepala Sekolah Routes
Route::prefix('kepala-sekolah')->group(function () {
    Route::get('/dashboard', [KepalaSekolahController::class, 'dashboard'])->name('kepala-sekolah.dashboard');
    Route::get('/calon-siswa', [KepalaSekolahController::class, 'daftarCalonSiswa'])->name('kepala-sekolah.calon-siswa');
    Route::get('/siswa-diterima', [KepalaSekolahController::class, 'calonSiswaDiterima'])->name('kepala-sekolah.siswa-diterima');
    Route::get('/rekap-pembayaran', [KepalaSekolahController::class, 'rekapPembayaran'])->name('kepala-sekolah.rekap-pembayaran');
    Route::get('/asal-sekolah', [KepalaSekolahController::class, 'dataAsalSekolah'])->name('kepala-sekolah.asal-sekolah');
    Route::get('/asal-wilayah', [KepalaSekolahController::class, 'asalWilayah'])->name('kepala-sekolah.asal-wilayah');
});

// Laporan Routes
Route::prefix('laporan')->group(function () {
    Route::get('/', [\App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');
    Route::post('/export', [\App\Http\Controllers\LaporanController::class, 'exportPendaftar'])->name('laporan.export');
    
    // Role-specific export routes
    Route::get('/kepala-sekolah/pdf', [\App\Http\Controllers\LaporanController::class, 'kepalaSekolahExportPDF'])->name('laporan.kepala-sekolah.pdf');
    Route::get('/kepala-sekolah/excel', [\App\Http\Controllers\LaporanController::class, 'kepalaSekolahExportExcel'])->name('laporan.kepala-sekolah.excel');
    Route::get('/panitia/pdf', [\App\Http\Controllers\LaporanController::class, 'panitiaExportPDF'])->name('laporan.panitia.pdf');
    Route::get('/panitia/excel', [\App\Http\Controllers\LaporanController::class, 'panitiaExportExcel'])->name('laporan.panitia.excel');
    Route::get('/keuangan/pdf', [\App\Http\Controllers\LaporanController::class, 'keuanganExportPDF'])->name('laporan.keuangan.pdf');
    Route::get('/keuangan/excel', [\App\Http\Controllers\LaporanController::class, 'keuanganExportExcel'])->name('laporan.keuangan.excel');
});



// API Routes
Route::get('/api/wilayah', [PublicWilayahController::class, 'getWilayahData'])->name('api.wilayah');
