<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wilayah;

class WilayahSeederUpdate extends Seeder
{
    public function run()
    {
        $wilayahData = [
            [
                'provinsi' => 'Jawa Barat',
                'kabupaten' => 'Kota Bandung',
                'kecamatan' => 'Ujungberung',
                'kodepos' => '40617'
            ],
            [
                'provinsi' => 'Jawa Barat',
                'kabupaten' => 'Kabupaten Bandung',
                'kecamatan' => 'Cileunyi',
                'kodepos' => '40393'
            ],
            [
                'provinsi' => 'Jawa Barat',
                'kabupaten' => 'Kabupaten Bandung',
                'kecamatan' => 'Rancaekek',
                'kodepos' => '40394'
            ],
            [
                'provinsi' => 'Jawa Barat',
                'kabupaten' => 'Kabupaten Bandung',
                'kecamatan' => 'Majalaya',
                'kodepos' => '40382'
            ],
            [
                'provinsi' => 'Jawa Barat',
                'kabupaten' => 'Kabupaten Sumedang',
                'kecamatan' => 'Sumedang Utara',
                'kodepos' => '45311'
            ],
            [
                'provinsi' => 'Jawa Barat',
                'kabupaten' => 'Kabupaten Sumedang',
                'kecamatan' => 'Jatinangor',
                'kodepos' => '45363'
            ],
            [
                'provinsi' => 'Jawa Barat',
                'kabupaten' => 'Kabupaten Garut',
                'kecamatan' => 'Garut Kota',
                'kodepos' => '44111'
            ],
            [
                'provinsi' => 'Jawa Barat',
                'kabupaten' => 'Kota Tasikmalaya',
                'kecamatan' => 'Tasikmalaya',
                'kodepos' => '46111'
            ],
            [
                'provinsi' => 'Jawa Tengah',
                'kabupaten' => 'Kota Semarang',
                'kecamatan' => 'Semarang Tengah',
                'kodepos' => '50132'
            ],
            [
                'provinsi' => 'Jawa Timur',
                'kabupaten' => 'Kota Surabaya',
                'kecamatan' => 'Surabaya Pusat',
                'kodepos' => '60271'
            ],
            [
                'provinsi' => 'DKI Jakarta',
                'kabupaten' => 'Jakarta Selatan',
                'kecamatan' => 'Kebayoran Baru',
                'kodepos' => '12110'
            ]
        ];

        foreach ($wilayahData as $data) {
            Wilayah::firstOrCreate(
                [
                    'provinsi' => $data['provinsi'],
                    'kabupaten' => $data['kabupaten'],
                    'kecamatan' => $data['kecamatan']
                ],
                $data
            );
        }
    }
}