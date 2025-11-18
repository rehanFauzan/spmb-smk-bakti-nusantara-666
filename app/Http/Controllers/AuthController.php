<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('admin_user', $user);
            Session::put('user_id', $user->id);
            Session::put('user_role', $user->role);
            Session::put('user_name', $user->name);

            // Log aktivitas login
            LogAktivitas::create([
                'user_id' => $user->id,
                'aksi' => 'LOGIN',
                'objek' => 'Sistem',
                'objek_data' => [
                    'email' => $user->email,
                    'role' => $user->role,
                    'user_agent' => $request->userAgent()
                ],
                'waktu' => now(),
                'ip' => $request->ip()
            ]);

            // Redirect berdasarkan role
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'panitia':
                    return redirect()->route('panitia.dashboard');
                case 'keuangan':
                    return redirect()->route('keuangan.dashboard');
                case 'kepala_sekolah':
                    return redirect()->route('kepala-sekolah.dashboard');
                default:
                    return redirect()->route('admin.dashboard');
            }
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function logout(Request $request)
    {
        $user = Session::get('admin_user');
        
        // Log aktivitas logout jika user ada
        if ($user) {
            LogAktivitas::create([
                'user_id' => $user->id,
                'aksi' => 'LOGOUT',
                'objek' => 'Sistem',
                'objek_data' => [
                    'email' => $user->email,
                    'role' => $user->role
                ],
                'waktu' => now(),
                'ip' => $request->ip()
            ]);
        }
        
        Session::flush();
        return redirect()->route('admin.login');
    }
}