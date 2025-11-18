<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Session::get('admin_user');
        return view('admin.profile.show', compact('user'));
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|min:8|confirmed'
        ]);

        $user = Session::get('admin_user');
        $data = $request->only(['name', 'email']);
        
        if ($request->filled('password')) {
            $data['password_hash'] = Hash::make($request->password);
        }
        
        Pengguna::where('id', $user->id)->update($data);
        
        return redirect()->route('admin.profile.show')->with('success', 'Profile berhasil diupdate');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'Password lama wajib diisi',
            'new_password.required' => 'Password baru wajib diisi',
            'new_password.min' => 'Password baru minimal 8 karakter',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        $user = Session::get('admin_user');
        $pengguna = Pengguna::find($user->id);

        if (!Hash::check($request->current_password, $pengguna->password_hash)) {
            return back()->withErrors(['current_password' => 'Password lama tidak benar']);
        }

        $pengguna->update([
            'password_hash' => Hash::make($request->new_password)
        ]);

        // Update session
        Session::put('admin_user', $pengguna);

        return back()->with('success', 'Password berhasil diubah');
    }
}