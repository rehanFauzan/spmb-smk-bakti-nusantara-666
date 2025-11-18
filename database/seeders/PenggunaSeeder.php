<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;

class PenggunaSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'nama' => 'Super Admin',
                'email' => 'admin@smkbn666.sch.id',
                'hp' => '081234567890',
                'password_hash' => Hash::make('admin123'),
                'role' => 'admin',
                'aktif' => 1
            ],
            [
                'nama' => 'Kepala Sekolah',
                'email' => 'kepala@smkbn666.sch.id',
                'hp' => '081234567891',
                'password_hash' => Hash::make('kepala123'),
                'role' => 'kepala',
                'aktif' => 1
            ],
            [
                'nama' => 'Verifikator Administrasi',
                'email' => 'verifikator@smkbn666.sch.id',
                'hp' => '081234567892',
                'password_hash' => Hash::make('verifikator123'),
                'role' => 'verifikator_adm',
                'aktif' => 1
            ],
            [
                'nama' => 'Staff Keuangan',
                'email' => 'keuangan@smkbn666.sch.id',
                'hp' => '081234567893',
                'password_hash' => Hash::make('keuangan123'),
                'role' => 'keuangan',
                'aktif' => 1
            ]
        ];

        foreach ($users as $user) {
            Pengguna::create($user);
        }
    }
}
