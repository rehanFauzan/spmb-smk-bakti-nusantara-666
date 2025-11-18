<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jurusan = [
            ['kode' => 'PPLG', 'nama_jurusan' => 'Pengembangan Perangkat Lunak dan Gim', 'kuota' => 72],
            ['kode' => 'ANI', 'nama_jurusan' => 'Animasi', 'kuota' => 36],
            ['kode' => 'DKV', 'nama_jurusan' => 'Desain Komunikasi Visual', 'kuota' => 36],
            ['kode' => 'BDP', 'nama_jurusan' => 'Bisnis Daring dan Pemasaran', 'kuota' => 36],
            ['kode' => 'AKL', 'nama_jurusan' => 'Akuntansi dan Keuangan Lembaga', 'kuota' => 36]
        ];

        foreach ($jurusan as $item) {
            Jurusan::create($item);
        }
    }
}
