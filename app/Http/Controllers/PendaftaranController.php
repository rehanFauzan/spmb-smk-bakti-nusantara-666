<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\User;
use App\Models\Gelombang;
use App\Models\Otp;
use App\Http\Controllers\WilayahController;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class PendaftaranController extends Controller
{
    /**
     * Halaman utama pendaftaran
     */
    public function index()
    {
        $gelombangAktif = Gelombang::getGelombangAktif();
        $allGelombang = Gelombang::getAllGelombang();
        
        return view('pendaftaran.index', compact('gelombangAktif', 'allGelombang'));
    }

    /**
     * Tampilkan halaman registrasi akun
     */
    public function showRegister()
    {
        return view('pendaftaran.register');
    }

    /**
     * Proses registrasi akun baru
     */
    public function storeRegister(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'no_hp' => 'required|string|max:15',
            'password' => ['required', 'confirmed', Password::min(8)],
            'terms' => 'required|accepted'
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'no_hp.required' => 'Nomor HP wajib diisi',
            'password.required' => 'Password wajib diisi',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'password.min' => 'Password minimal 8 karakter',
            'terms.required' => 'Anda harus menyetujui syarat dan ketentuan'
        ]);

        // Generate dan kirim OTP
        $otpRecord = Otp::generateOtp($request->email);
        
        try {
            Mail::to($request->email)->send(new OtpMail($otpRecord->otp, $request->nama_lengkap));
        } catch (\Exception $e) {
            \Log::error('Failed to send OTP email: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Gagal mengirim OTP: ' . $e->getMessage()]);
        }

        // Simpan data sementara di session
        session([
            'temp_registration' => [
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'password' => $request->password
            ]
        ]);

        return redirect()->route('pendaftaran.verify-otp', ['email' => $request->email])
            ->with('success', 'Kode OTP telah dikirim ke email Anda. Silakan periksa inbox atau folder spam.');
    }

    /**
     * Tampilkan halaman verifikasi OTP
     */
    public function showVerifyOtp(Request $request)
    {
        $email = $request->get('email');
        
        if (!$email || !session('temp_registration')) {
            return redirect()->route('pendaftaran.register')
                ->with('error', 'Silakan lakukan registrasi terlebih dahulu.');
        }

        return view('pendaftaran.verify-otp', compact('email'));
    }

    /**
     * Proses verifikasi OTP
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|size:6'
        ], [
            'otp.required' => 'Kode OTP wajib diisi',
            'otp.size' => 'Kode OTP harus 6 digit'
        ]);

        $tempData = session('temp_registration');
        if (!$tempData || $tempData['email'] !== $request->email) {
            return redirect()->route('pendaftaran.register')
                ->with('error', 'Data registrasi tidak valid. Silakan daftar ulang.');
        }

        if (!Otp::verifyOtp($request->email, $request->otp)) {
            return back()->withErrors(['otp' => 'Kode OTP tidak valid atau sudah kadaluarsa.']);
        }

        // Buat akun setelah OTP terverifikasi
        $user = User::create([
            'name' => $tempData['nama_lengkap'],
            'email' => $tempData['email'],
            'password' => Hash::make($tempData['password']),
        ]);

        // Hapus data sementara
        session()->forget('temp_registration');

        // Login otomatis setelah registrasi
        Auth::login($user);

        return redirect()->route('pendaftaran.form')
            ->with('success', 'Email berhasil diverifikasi! Akun Anda telah dibuat. Silakan lengkapi formulir pendaftaran.');
    }

    /**
     * Kirim ulang OTP
     */
    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $tempData = session('temp_registration');
        if (!$tempData || $tempData['email'] !== $request->email) {
            return redirect()->route('pendaftaran.register')
                ->with('error', 'Data registrasi tidak valid. Silakan daftar ulang.');
        }

        // Generate OTP baru
        $otpRecord = Otp::generateOtp($request->email);
        
        try {
            Mail::to($request->email)->send(new OtpMail($otpRecord->otp, $tempData['nama_lengkap']));
        } catch (\Exception $e) {
            \Log::error('Failed to resend OTP email: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Gagal mengirim OTP: ' . $e->getMessage()]);
        }

        return back()->with('success', 'Kode OTP baru telah dikirim ke email Anda.');
    }

    /**
     * Tampilkan halaman login
     */
    public function showLogin()
    {
        return view('pendaftaran.login');
    }

    /**
     * Proses login
     */
    public function storeLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi'
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            // Cek apakah user sudah mengisi formulir
            $pendaftar = Pendaftar::where('user_id', Auth::id())->first();
            
            if ($pendaftar) {
                return redirect()->route('pendaftaran.status')
                    ->with('success', 'Selamat datang kembali!');
            } else {
                return redirect()->route('pendaftaran.form')
                    ->with('success', 'Selamat datang! Silakan lengkapi formulir pendaftaran.');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    /**
     * Tampilkan formulir pendaftaran
     */
    public function showForm()
    {
        if (!Auth::check()) {
            return redirect()->route('pendaftaran.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $gelombangAktif = Gelombang::getGelombangAktif();
        $allGelombang = Gelombang::getAllGelombang();

        // Ambil data yang sudah ada jika user sudah pernah mengisi
        $pendaftarSiswa = \DB::table('pendaftar_data_siswa')
            ->leftJoin('pendaftar_data_ortu', 'pendaftar_data_siswa.id', '=', 'pendaftar_data_ortu.pendaftar_id')
            ->leftJoin('pendaftar_asal_sekolah', 'pendaftar_data_siswa.id', '=', 'pendaftar_asal_sekolah.pendaftar_id')
            ->where('pendaftar_data_siswa.user_id', Auth::id())
            ->select(
                'pendaftar_data_siswa.*',
                'pendaftar_data_ortu.nama_ayah',
                'pendaftar_data_ortu.nama_ibu',
                'pendaftar_data_ortu.pekerjaan_ayah',
                'pendaftar_data_ortu.pekerjaan_ibu',
                'pendaftar_data_ortu.no_ayah',
                'pendaftar_asal_sekolah.nama_sekolah as asal_sekolah'
            )
            ->first();

        return view('pendaftaran.create', compact('gelombangAktif', 'allGelombang', 'pendaftarSiswa'));
    }

    /**
     * Simpan data formulir pendaftaran
     */
    public function storeForm(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('pendaftaran.login');
        }

        $request->validate([
            'jurusan_pilihan_1' => 'required|string',
            'nama_ayah' => 'required|string',
            'nama_ibu' => 'required|string',
            'alamat' => 'required|string',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        // Mapping jurusan pilihan ke jurusan_id
        $jurusanMapping = [
            'RPL' => 1, // PPLG
            'MM' => 2,  // Animasi
            'DKV' => 3, // DKV
            'OTKP' => 4, // Pemasaran
            'AKL' => 5  // Akuntansi
        ];

        $jurusanId = $jurusanMapping[$request->jurusan_pilihan_1] ?? 1;

        // Tentukan gelombang berdasarkan tanggal pendaftaran
        $gelombangAktif = Gelombang::getGelombangAktif();
        if (!$gelombangAktif) {
            $allGelombang = Gelombang::getAllGelombang();
            $nextGelombang = $allGelombang->where('tgl_mulai', '>', now())->first();
            
            if ($nextGelombang) {
                return back()->withErrors(['error' => 'Pendaftaran sedang tidak dibuka. Gelombang berikutnya dimulai pada ' . \Carbon\Carbon::parse($nextGelombang->tgl_mulai)->format('d M Y')]);
            } else {
                return back()->withErrors(['error' => 'Pendaftaran sudah ditutup. Tidak ada gelombang pendaftaran yang tersedia.']);
            }
        }

        // Generate nomor pendaftaran
        $noPendaftaran = 'SPMB' . date('Y') . str_pad(Pendaftar::count() + 1, 4, '0', STR_PAD_LEFT);

        // Simpan data wilayah dari alamat maps
        $wilayahId = WilayahController::simpanWilayahDariAlamat(
            $request->alamat,
            $request->latitude,
            $request->longitude
        );

        // 1. Simpan ke tabel pendaftar_data_siswa (tabel utama)
        $pendaftarSiswaId = \DB::table('pendaftar_data_siswa')->insertGetId([
            'user_id' => Auth::id(),
            'tanggal_daftar' => now(),
            'no_pendaftaran' => $noPendaftaran,
            'gelombang_id' => $gelombangAktif->id,
            'jurusan_id' => $jurusanId,
            'status' => 'SUBMIT',
            'tgl_verifikasi_adm' => null,
            'tgl_verifikasi_payment' => null,
            'nik' => $request->nisn ?? '0000000000000000',
            'nama' => Auth::user()->name,
            'jk' => $request->jenis_kelamin ?? 'L',
            'agama' => $request->agama,
            'tmp_lahir' => $request->tanggal_lahir ?? now()->subYears(15),
            'alamat' => $request->alamat ?? '',
            'wilayah_id' => $wilayahId ?? 1,
            'lat' => $request->latitude ?? 0.0,
            'lng' => $request->longitude ?? 0.0,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // 2. Simpan data orang tua ke tabel pendaftar_data_ortu
        \DB::table('pendaftar_data_ortu')->insert([
            'pendaftar_id' => $pendaftarSiswaId,
            'nama_ayah' => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah ?? '',
            'no_ayah' => $request->no_hp_ortu ?? '',
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu ?? '',
            'no_ibu' => $request->no_hp_ortu ?? '',
            'nama_wali' => null,
            'pekerjaan_wali' => null,
            'no_wali' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // 3. Simpan data asal sekolah ke tabel pendaftar_asal_sekolah
        if ($request->filled('asal_sekolah')) {
            \DB::table('pendaftar_asal_sekolah')->insert([
                'pendaftar_id' => $pendaftarSiswaId,
                'npsn' => '',
                'nama_sekolah' => $request->asal_sekolah,
                'kabupaten' => '',
                'nilai_rata' => 0.0,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // 4. Simpan ke tabel pendaftar untuk kompatibilitas
        $pendaftar = Pendaftar::create([
            'user_id' => Auth::id(),
            'tanggal_daftar' => now(),
            'no_pendaftaran' => $noPendaftaran,
            'gelombang_id' => $gelombangAktif->id,
            'jurusan_id' => $jurusanId,
            'status' => 'SUBMIT'
        ]);



        return redirect()->route('pendaftaran.upload')
            ->with('success', 'Data formulir berhasil disimpan! Silakan upload berkas persyaratan.');
    }

    /**
     * Tampilkan halaman upload berkas
     */
    public function showUpload()
    {
        if (!Auth::check()) {
            return redirect()->route('pendaftaran.login');
        }

        $pendaftarSiswa = \DB::table('pendaftar_data_siswa')->where('user_id', Auth::id())->first();
        if (!$pendaftarSiswa) {
            return redirect()->route('pendaftaran.form')
                ->with('error', 'Silakan lengkapi formulir pendaftaran terlebih dahulu.');
        }

        // Ambil berkas yang sudah diupload
        $berkas = \DB::table('pendaftar_berkas')
            ->where('pendaftar_id', $pendaftarSiswa->id)
            ->where('jenis', '!=', 'BUKTI_BAYAR')
            ->get()
            ->keyBy('jenis');

        // Convert untuk kompatibilitas dengan view
        $pendaftar = (object) ['id' => $pendaftarSiswa->id];
        
        return view('pendaftaran.upload', compact('pendaftar', 'berkas'));
    }

    /**
     * Simpan berkas upload
     */
    public function storeUpload(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('pendaftaran.login');
        }

        $request->validate([
            'berkas_ijazah' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'berkas_kk' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'berkas_akta' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'pas_foto' => 'required|file|mimes:jpg,jpeg,png|max:1024',
            'sertifikat_prestasi' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'sktm' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            'berkas_ijazah.required' => 'Berkas ijazah/rapor wajib diupload',
            'berkas_kk.required' => 'Berkas kartu keluarga wajib diupload',
            'berkas_akta.required' => 'Berkas akta kelahiran wajib diupload',
            'pas_foto.required' => 'Pas foto wajib diupload',
            '*.mimes' => 'Format file tidak didukung',
            '*.max' => 'Ukuran file terlalu besar',
        ]);

        $request->validate([
            'berkas_ijazah' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'berkas_kk' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'berkas_akta' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'pas_foto' => 'required|file|mimes:jpg,jpeg,png|max:1024',
        ]);

        // Cari data siswa berdasarkan user_id
        $pendaftarSiswa = \DB::table('pendaftar_data_siswa')->where('user_id', Auth::id())->first();
        if (!$pendaftarSiswa) {
            return redirect()->route('pendaftaran.form');
        }

        // Simpan berkas ke tabel pendaftar_berkas
        $requiredFiles = ['berkas_ijazah', 'berkas_kk', 'berkas_akta', 'pas_foto'];
        
        foreach ($requiredFiles as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . $field . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('pendaftaran/' . Auth::id(), $filename, 'public');
                
                // Insert ke tabel pendaftar_berkas dengan pendaftar_data_siswa ID
                \DB::table('pendaftar_berkas')->insert([
                    'pendaftar_id' => $pendaftarSiswa->id,
                    'jenis' => strtoupper(str_replace('berkas_', '', $field)),
                    'tipe_ijazah' => 'IJAZAH', // Default value
                    'nama_file' => $filename,
                    'ukuran_kb' => round($file->getSize() / 1024),
                    'valid' => 1,
                    'catatan' => null,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        return redirect()->route('pendaftaran.pembayaran')
            ->with('success', 'Berkas berhasil diupload! Silakan lanjutkan ke pembayaran.');
    }

    /**
     * Tampilkan status pendaftaran
     */
    public function showStatus()
    {
        if (!Auth::check()) {
            return redirect()->route('pendaftaran.login');
        }

        // Ambil data dari pendaftar_data_siswa (tabel utama)
        $pendaftarSiswa = \DB::table('pendaftar_data_siswa')
            ->join('jurusan', 'pendaftar_data_siswa.jurusan_id', '=', 'jurusan.id')
            ->where('pendaftar_data_siswa.user_id', Auth::id())
            ->select('pendaftar_data_siswa.*', 'jurusan.nama_jurusan')
            ->first();
            
        if (!$pendaftarSiswa) {
            return redirect()->route('pendaftaran.form');
        }

        // Cek berkas yang sudah diupload
        $berkas = \DB::table('pendaftar_berkas')
            ->where('pendaftar_id', $pendaftarSiswa->id)
            ->get();
        
        $hasBerkas = $berkas->where('jenis', '!=', 'BUKTI_BAYAR')->count() > 0;
        $hasPembayaran = $berkas->where('jenis', 'BUKTI_BAYAR')->count() > 0;

        // Convert ke object untuk kompatibilitas dengan view
        $pendaftar = (object) [
            'id' => $pendaftarSiswa->id,
            'no_pendaftaran' => $pendaftarSiswa->no_pendaftaran,
            'tanggal_daftar' => \Carbon\Carbon::parse($pendaftarSiswa->tanggal_daftar),
            'status' => $pendaftarSiswa->status,
            'jurusan' => (object) ['nama_jurusan' => $pendaftarSiswa->nama_jurusan]
        ];

        return view('pendaftaran.status', compact('pendaftar', 'hasBerkas', 'hasPembayaran'));
    }

    /**
     * Tampilkan hasil pendaftaran
     */
    public function showHasil()
    {
        if (!Auth::check()) {
            return redirect()->route('pendaftaran.login');
        }

        $pendaftarSiswa = \DB::table('pendaftar_data_siswa')
            ->join('jurusan', 'pendaftar_data_siswa.jurusan_id', '=', 'jurusan.id')
            ->join('gelombang', 'pendaftar_data_siswa.gelombang_id', '=', 'gelombang.id')
            ->where('pendaftar_data_siswa.user_id', Auth::id())
            ->select('pendaftar_data_siswa.*', 'jurusan.nama_jurusan', 'gelombang.nama as nama_gelombang')
            ->first();
            
        if (!$pendaftarSiswa) {
            return redirect()->route('pendaftaran.form');
        }

        // Ambil pas foto
        $pasFoto = \DB::table('pendaftar_berkas')
            ->where('pendaftar_id', $pendaftarSiswa->id)
            ->where('jenis', 'PAS_FOTO')
            ->first();

        // Convert ke object untuk kompatibilitas dengan view
        $pendaftar = (object) [
            'id' => $pendaftarSiswa->id,
            'nama_lengkap' => $pendaftarSiswa->nama,
            'no_pendaftaran' => $pendaftarSiswa->no_pendaftaran,
            'hasil_seleksi' => $pendaftarSiswa->status === 'PAID' ? 'DITERIMA' : 'PROSES',
            'jurusan' => (object) ['nama_jurusan' => $pendaftarSiswa->nama_jurusan],
            'gelombang' => (object) ['nama' => $pendaftarSiswa->nama_gelombang],
            'alamat' => $pendaftarSiswa->alamat
        ];

        return view('pendaftaran.hasil', compact('pendaftar', 'pasFoto'));
    }

    /**
     * Tampilkan halaman pembayaran
     */
    public function showPembayaran()
    {
        if (!Auth::check()) {
            return redirect()->route('pendaftaran.login');
        }

        $pendaftarSiswa = \DB::table('pendaftar_data_siswa')
            ->join('gelombang', 'pendaftar_data_siswa.gelombang_id', '=', 'gelombang.id')
            ->where('pendaftar_data_siswa.user_id', Auth::id())
            ->select('pendaftar_data_siswa.*', 'gelombang.biaya_daftar')
            ->first();
            
        if (!$pendaftarSiswa) {
            return redirect()->route('pendaftaran.form');
        }

        // Ambil bukti pembayaran yang sudah diupload
        $buktiBayar = \DB::table('pendaftar_berkas')
            ->where('pendaftar_id', $pendaftarSiswa->id)
            ->where('jenis', 'BUKTI_BAYAR')
            ->first();

        return view('pendaftaran.pembayaran', compact('pendaftarSiswa', 'buktiBayar'));
    }

    /**
     * Proses pembayaran
     */
    public function storePembayaran(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('pendaftaran.login');
        }

        $request->validate([
            'bukti_bayar' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'nominal' => 'required|numeric|min:1',
        ], [
            'bukti_bayar.required' => 'Bukti pembayaran wajib diupload',
            'bukti_bayar.mimes' => 'Format file harus PDF, JPG, JPEG, atau PNG',
            'bukti_bayar.max' => 'Ukuran file maksimal 2MB',
            'nominal.required' => 'Nominal pembayaran wajib diisi',
            'nominal.numeric' => 'Nominal harus berupa angka',
        ]);

        $pendaftarSiswa = \DB::table('pendaftar_data_siswa')->where('user_id', Auth::id())->first();
        if (!$pendaftarSiswa) {
            return redirect()->route('pendaftaran.form');
        }

        // Upload bukti pembayaran
        if ($request->hasFile('bukti_bayar')) {
            $file = $request->file('bukti_bayar');
            $filename = time() . '_bukti_bayar.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('pembayaran/' . Auth::id(), $filename, 'public');
            
            // Simpan ke tabel pendaftar_berkas
            \DB::table('pendaftar_berkas')->insert([
                'pendaftar_id' => $pendaftarSiswa->id,
                'jenis' => 'BUKTI_BAYAR',
                'tipe_ijazah' => 'LAINNYA',
                'nama_file' => $filename,
                'ukuran_kb' => round($file->getSize() / 1024),
                'valid' => 0, // Belum diverifikasi
                'catatan' => 'Nominal: Rp ' . number_format($request->nominal, 0, ',', '.'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Status tetap SUBMIT, menunggu verifikasi admin
        // Tidak mengubah status otomatis ke PAID

        return redirect()->route('pendaftaran.status')
            ->with('success', 'Pembayaran berhasil diupload! Menunggu verifikasi admin.');
    }

    /**
     * Tampilkan halaman lupa password
     */
    public function showForgotPassword()
    {
        return view('pendaftaran.forgot-password');
    }

    /**
     * Kirim OTP reset password
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.exists' => 'Email tidak terdaftar dalam sistem'
        ]);

        $user = User::where('email', $request->email)->first();
        
        // Generate OTP untuk reset password
        $otpRecord = Otp::generateOtp($request->email);
        
        try {
            Mail::to($request->email)->send(new OtpMail($otpRecord->otp, $user->name, 'Reset Password'));
        } catch (\Exception $e) {
            \Log::error('Failed to send reset password OTP: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Gagal mengirim OTP reset password']);
        }

        // Simpan email di session untuk verifikasi OTP
        session(['reset_password_email' => $request->email]);

        return redirect()->route('pendaftaran.reset-password')
            ->with('success', 'Kode OTP untuk reset password telah dikirim ke email Anda');
    }

    /**
     * Tampilkan halaman reset password dengan OTP
     */
    public function showResetPassword()
    {
        $email = session('reset_password_email');
        
        if (!$email) {
            return redirect()->route('pendaftaran.forgot-password')
                ->with('error', 'Silakan request OTP reset password terlebih dahulu');
        }

        return view('pendaftaran.reset-password', compact('email'));
    }

    /**
     * Reset password dengan OTP
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
            'password' => ['required', 'confirmed', Password::min(8)]
        ], [
            'otp.required' => 'Kode OTP wajib diisi',
            'otp.size' => 'Kode OTP harus 6 digit',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'password.min' => 'Password minimal 8 karakter'
        ]);

        $email = session('reset_password_email');
        if (!$email) {
            return redirect()->route('pendaftaran.forgot-password')
                ->with('error', 'Session expired. Silakan request OTP baru');
        }

        // Verifikasi OTP
        if (!Otp::verifyOtp($email, $request->otp)) {
            return back()->withErrors(['otp' => 'Kode OTP tidak valid atau sudah kadaluarsa']);
        }

        // Update password
        User::where('email', $email)->update([
            'password' => Hash::make($request->password)
        ]);

        // Hapus session
        session()->forget('reset_password_email');

        return redirect()->route('pendaftaran.login')
            ->with('success', 'Password berhasil direset. Silakan login dengan password baru');
    }

    /**
     * Kirim ulang OTP reset password
     */
    public function resendResetOtp(Request $request)
    {
        $email = session('reset_password_email');
        if (!$email) {
            return redirect()->route('pendaftaran.forgot-password')
                ->with('error', 'Session expired. Silakan request OTP baru');
        }

        $user = User::where('email', $email)->first();
        $otpRecord = Otp::generateOtp($email);
        
        try {
            Mail::to($email)->send(new OtpMail($otpRecord->otp, $user->name, 'Reset Password'));
        } catch (\Exception $e) {
            \Log::error('Failed to resend reset password OTP: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Gagal mengirim OTP']);
        }

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Kode OTP baru telah dikirim ke email Anda']);
        }
        
        return back()->with('success', 'Kode OTP baru telah dikirim ke email Anda');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('pendaftaran.index')
            ->with('success', 'Anda telah logout.')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
}
