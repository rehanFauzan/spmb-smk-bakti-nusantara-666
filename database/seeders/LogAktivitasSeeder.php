<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LogAktivitas;
use App\Models\User;

class LogAktivitasSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        
        if ($users->count() > 0) {
            $user = $users->first();
            
            // Contoh log aktivitas
            LogAktivitas::create([
                'user_id' => $user->id,
                'aksi' => 'LOGIN',
                'objek' => 'Sistem',
                'objek_data' => [
                    'email' => $user->email,
                    'role' => $user->role,
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
                ],
                'waktu' => now()->subHours(2),
                'ip' => '192.168.1.100'
            ]);
            
            LogAktivitas::create([
                'user_id' => $user->id,
                'aksi' => 'VIEW_DASHBOARD',
                'objek' => 'Dashboard',
                'objek_data' => [
                    'page' => 'admin.dashboard'
                ],
                'waktu' => now()->subHours(1),
                'ip' => '192.168.1.100'
            ]);
            
            LogAktivitas::create([
                'user_id' => $user->id,
                'aksi' => 'LOGOUT',
                'objek' => 'Sistem',
                'objek_data' => [
                    'email' => $user->email,
                    'role' => $user->role
                ],
                'waktu' => now()->subMinutes(30),
                'ip' => '192.168.1.100'
            ]);
        }
    }
}