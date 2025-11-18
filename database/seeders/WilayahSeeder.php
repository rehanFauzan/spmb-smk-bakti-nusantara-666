<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WilayahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('wilayah')->insert([
            [
                'id' => 1,
                'provinsi' => 'DKI Jakarta',
                'kabupaten' => 'Jakarta Pusat',
                'kecamatan' => 'Menteng',
                'kodepos' => '10310',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
