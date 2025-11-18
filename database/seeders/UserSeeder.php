<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Admin SPMB',
                'email' => 'admin@smk.com',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ],
            [
                'name' => 'Panitia SPMB',
                'email' => 'panitia@smk.com',
                'password' => Hash::make('password'),
                'role' => 'panitia'
            ],
            [
                'name' => 'Keuangan SPMB',
                'email' => 'keuangan@smk.com',
                'password' => Hash::make('password'),
                'role' => 'keuangan'
            ],
            [
                'name' => 'Kepala Sekolah',
                'email' => 'kepala@smk.com',
                'password' => Hash::make('password'),
                'role' => 'kepala_sekolah'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}