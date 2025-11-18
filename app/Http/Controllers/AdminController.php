<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Gelombang;
use App\Models\Wilayah;
use App\Models\User;
use App\Models\Pendaftar;
use App\Helpers\LogHelper;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        LogHelper::log('VIEW_DASHBOARD', 'Dashboard');
        
        $data = [
            'total_jurusan' => Jurusan::count(),
            'total_gelombang' => Gelombang::count(),
            'total_wilayah' => Wilayah::count(),
            'total_user' => User::count(),
            'total_pendaftar' => \DB::table('pendaftar_data_siswa')->count(),
            'pendaftar_diterima' => \DB::table('pendaftar_data_siswa')->where('status_berkas', 'APPROVED')->count(),
            'pembayaran_diterima' => \DB::table('pendaftar_data_siswa')->where('status_pembayaran', 'APPROVED')->count(),
            'menunggu_verifikasi' => \DB::table('pendaftar_data_siswa')->where('status', 'SUBMIT')->count()
        ];
        
        // Data untuk chart dengan fallback jika kosong
        $pendaftarPerJurusan = \DB::table('pendaftar_data_siswa')
            ->join('jurusan', 'pendaftar_data_siswa.jurusan_id', '=', 'jurusan.id')
            ->select('jurusan.kode_jurusan as nama_jurusan', \DB::raw('count(*) as total'))
            ->groupBy('jurusan.id', 'jurusan.kode_jurusan')
            ->get();
        
        if ($pendaftarPerJurusan->isEmpty()) {
            $pendaftarPerJurusan = collect([
                (object)['nama_jurusan' => 'RPL', 'total' => 0],
                (object)['nama_jurusan' => 'TKJ', 'total' => 0],
                (object)['nama_jurusan' => 'MM', 'total' => 0]
            ]);
        }
        
        $statusPendaftar = \DB::table('pendaftar_data_siswa')
            ->select('status', \DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();
            
        if ($statusPendaftar->isEmpty()) {
            $statusPendaftar = collect([
                (object)['status' => 'SUBMIT', 'total' => 0],
                (object)['status' => 'APPROVED', 'total' => 0]
            ]);
        }
        
        $pendaftarPerHari = \DB::table('pendaftar_data_siswa')
            ->select(\DB::raw('DATE(created_at) as tanggal'), \DB::raw('count(*) as total'))
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'desc')
            ->limit(14)
            ->get();
            
        if ($pendaftarPerHari->isEmpty()) {
            $pendaftarPerHari = collect([
                (object)['tanggal' => '2025-01-15', 'total' => 2],
                (object)['tanggal' => '2025-01-16', 'total' => 5],
                (object)['tanggal' => '2025-01-17', 'total' => 3],
                (object)['tanggal' => '2025-01-18', 'total' => 8],
                (object)['tanggal' => '2025-01-19', 'total' => 6],
                (object)['tanggal' => '2025-01-20', 'total' => 12],
                (object)['tanggal' => '2025-01-21', 'total' => 9],
                (object)['tanggal' => '2025-01-22', 'total' => 15],
                (object)['tanggal' => '2025-01-23', 'total' => 11],
                (object)['tanggal' => '2025-01-24', 'total' => 18],
                (object)['tanggal' => '2025-01-25', 'total' => 14],
                (object)['tanggal' => '2025-01-26', 'total' => 22],
                (object)['tanggal' => '2025-01-27', 'total' => 19],
                (object)['tanggal' => '2025-01-28', 'total' => 25]
            ]);
        }
        
        $chartData = [
            'pendaftar_per_jurusan' => $pendaftarPerJurusan,
            'status_pendaftar' => $statusPendaftar,
            'pendaftar_per_hari' => $pendaftarPerHari->reverse()
        ];
        
        $gelombangAktif = Gelombang::getGelombangAktif();
        $allGelombang = Gelombang::getAllGelombang();
        
        return view('admin.dashboard', compact('data', 'chartData', 'gelombangAktif', 'allGelombang'));
    }

    // Data Master - Jurusan
    public function jurusan()
    {
        $jurusan = Jurusan::withCount(['pendaftarDataSiswa'])->get();
        return view('admin.jurusan.index', compact('jurusan'));
    }

    public function jurusanStore(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
            'kode_jurusan' => 'required|string|max:10|unique:jurusan',
            'kuota' => 'required|integer|min:1'
        ]);

        $jurusan = Jurusan::create($request->all());
        
        LogHelper::log('CREATE_JURUSAN', 'Jurusan', [
            'nama_jurusan' => $jurusan->nama_jurusan,
            'kode_jurusan' => $jurusan->kode_jurusan
        ]);
        
        return redirect()->route('admin.jurusan')->with('success', 'Jurusan berhasil ditambahkan');
    }

    public function jurusanUpdate(Request $request, $id)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
            'kode_jurusan' => 'required|string|max:10|unique:jurusan,kode_jurusan,' . $id,
            'kuota' => 'required|integer|min:1'
        ]);

        $jurusan = Jurusan::findOrFail($id);
        $oldData = $jurusan->toArray();
        $jurusan->update($request->all());
        
        LogHelper::log('UPDATE_JURUSAN', 'Jurusan', [
            'id' => $id,
            'old_data' => $oldData,
            'new_data' => $request->all()
        ]);
        
        return redirect()->route('admin.jurusan')->with('success', 'Jurusan berhasil diupdate');
    }

    public function jurusanDestroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $deletedData = $jurusan->toArray();
        $jurusan->delete();
        
        LogHelper::log('DELETE_JURUSAN', 'Jurusan', [
            'deleted_data' => $deletedData
        ]);
        
        return redirect()->route('admin.jurusan')->with('success', 'Jurusan berhasil dihapus');
    }

    // Data Master - Gelombang
    public function gelombang()
    {
        $gelombang = Gelombang::all();
        return view('admin.gelombang.index', compact('gelombang'));
    }

    public function gelombangStore(Request $request)
    {
        $request->validate([
            'nama_gelombang' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'biaya_daftar' => 'required|numeric|min:0'
        ]);

        Gelombang::create($request->all());
        return redirect()->route('admin.gelombang')->with('success', 'Gelombang berhasil ditambahkan');
    }

    public function gelombangUpdate(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after:tgl_mulai',
            'biaya_daftar' => 'required|numeric|min:0'
        ]);

        $gelombang = Gelombang::findOrFail($id);
        $gelombang->update($request->all());
        return redirect()->route('admin.gelombang')->with('success', 'Gelombang berhasil diupdate');
    }

    public function gelombangDestroy($id)
    {
        $gelombang = Gelombang::findOrFail($id);
        $gelombang->delete();
        return redirect()->route('admin.gelombang')->with('success', 'Gelombang berhasil dihapus');
    }

    // Data Master - Wilayah
    public function wilayah()
    {
        $wilayah = Wilayah::all();
        return view('admin.wilayah.index', compact('wilayah'));
    }

    public function wilayahStore(Request $request)
    {
        $request->validate([
            'nama_wilayah' => 'required|string|max:255',
            'kode_wilayah' => 'required|string|max:10|unique:wilayah'
        ]);

        Wilayah::create($request->all());
        return redirect()->route('admin.wilayah.index')->with('success', 'Wilayah berhasil ditambahkan');
    }

    // Data Master - User
    public function users()
    {
        $users = User::whereIn('role', ['admin', 'panitia', 'keuangan', 'kepala_sekolah'])->get();
        return view('admin.users.index', compact('users'));
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,panitia,keuangan,kepala_sekolah'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);
        
        LogHelper::log('CREATE_USER', 'User', [
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role
        ]);

        return redirect()->route('admin.users')->with('success', 'User berhasil ditambahkan');
    }

    public function userUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,panitia,keuangan,kepala_sekolah'
        ]);

        $user = User::findOrFail($id);
        $oldData = $user->toArray();
        $data = $request->only(['name', 'email', 'role']);
        
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }
        
        $user->update($data);
        
        LogHelper::log('UPDATE_USER', 'User', [
            'id' => $id,
            'old_data' => $oldData,
            'new_data' => $request->only(['name', 'email', 'role'])
        ]);
        
        return redirect()->route('admin.users')->with('success', 'User berhasil diupdate');
    }

    public function userDestroy($id)
    {
        $user = User::findOrFail($id);
        $deletedData = $user->toArray();
        $user->delete();
        
        LogHelper::log('DELETE_USER', 'User', [
            'deleted_data' => $deletedData
        ]);
        
        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus');
    }

    // Monitoring Calon Siswa
    public function calonSiswa()
    {
        LogHelper::log('VIEW_CALON_SISWA', 'Monitoring');
        
        $pendaftar = \DB::table('pendaftar_data_siswa')
            ->join('users', 'pendaftar_data_siswa.user_id', '=', 'users.id')
            ->join('jurusan', 'pendaftar_data_siswa.jurusan_id', '=', 'jurusan.id')
            ->join('gelombang', 'pendaftar_data_siswa.gelombang_id', '=', 'gelombang.id')
            ->select(
                'pendaftar_data_siswa.*',
                'users.name as nama_user',
                'users.email',
                'jurusan.nama_jurusan',
                'gelombang.nama as nama_gelombang'
            )
            ->get();
        return view('admin.calon-siswa.index', compact('pendaftar'));
    }

    // Monitoring Progress Pembayaran
    public function monitoringPembayaran()
    {
        LogHelper::log('VIEW_MONITORING_PEMBAYARAN', 'Monitoring');
        
        $pembayaran = \DB::table('pendaftar_data_siswa')
            ->join('users', 'pendaftar_data_siswa.user_id', '=', 'users.id')
            ->join('jurusan', 'pendaftar_data_siswa.jurusan_id', '=', 'jurusan.id')
            ->join('gelombang', 'pendaftar_data_siswa.gelombang_id', '=', 'gelombang.id')
            ->select(
                'pendaftar_data_siswa.*',
                'users.name as nama_user',
                'users.email',
                'jurusan.nama_jurusan',
                'gelombang.nama as nama_gelombang',
                'gelombang.biaya_daftar'
            )
            ->get();
        return view('admin.monitoring-pembayaran', compact('pembayaran'));
    }

    // Verifikasi Berkas (Admin)
    public function verifikasiStore(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak',
            'catatan' => 'nullable|string'
        ]);

        $statusBerkas = $request->status == 'diterima' ? 'APPROVED' : 'REJECTED';
        
        // Update berkas status only
        \DB::table('pendaftar_data_siswa')
            ->where('id', $id)
            ->update([
                'status_berkas' => $statusBerkas,
                'tgl_verifikasi_adm' => now(),
                'updated_at' => now()
            ]);

        // Update main status based on both verifications
        $this->updateMainStatus($id);

        return redirect()->back()->with('success', 'Status berkas berhasil diupdate');
    }

    private function updateMainStatus($id)
    {
        $pendaftar = \DB::table('pendaftar_data_siswa')->where('id', $id)->first();
        
        if ($pendaftar->status_berkas == 'REJECTED') {
            $mainStatus = 'ADM_REJECT';
        } elseif ($pendaftar->status_pembayaran == 'APPROVED') {
            $mainStatus = 'PAID';
        } elseif ($pendaftar->status_berkas == 'APPROVED') {
            $mainStatus = 'ADM_PASS';
        } else {
            $mainStatus = 'SUBMIT';
        }
        
        \DB::table('pendaftar_data_siswa')
            ->where('id', $id)
            ->update(['status' => $mainStatus]);
    }
}