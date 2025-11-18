<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GelombangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('gelombang')->insert([
            [
                'id' => 1,
                'nama' => 'Gelombang 1',
                'tgl_mulai' => '2025-07-10',
                'tgl_selesai' => '2025-09-10',
                'biaya_daftar' => 2000000.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'nama' => 'Gelombang 2',
                'tgl_mulai' => '2025-10-10',
                'tgl_selesai' => '2025-12-10',
                'biaya_daftar' => 2500000.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'nama' => 'Gelombang 3',
                'tgl_mulai' => '2026-01-10',
                'tgl_selesai' => '2026-03-10',
                'biaya_daftar' => 3500000.00,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
