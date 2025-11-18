<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    /**
     * Simpan data wilayah dari alamat maps
     */
    public static function simpanWilayahDariAlamat($alamat, $latitude = null, $longitude = null)
    {
        if (empty($alamat)) {
            return null;
        }

        // Parse alamat untuk mendapatkan komponen wilayah
        $wilayahData = self::parseAlamat($alamat);
        
        // Cek apakah wilayah sudah ada
        $wilayah = Wilayah::where('provinsi', $wilayahData['provinsi'])
                         ->where('kabupaten', $wilayahData['kabupaten'])
                         ->where('kecamatan', $wilayahData['kecamatan'])
                         ->first();

        if (!$wilayah) {
            // Buat wilayah baru
            $wilayah = Wilayah::create([
                'provinsi' => $wilayahData['provinsi'],
                'kabupaten' => $wilayahData['kabupaten'],
                'kecamatan' => $wilayahData['kecamatan'],
                'kodepos' => $wilayahData['kodepos']
            ]);
        }

        return $wilayah->id;
    }

    /**
     * Parse alamat untuk mendapatkan komponen wilayah
     * Format: Jalan/Kelurahan, Kecamatan, Kota/Kabupaten, Provinsi, Negara, Kode Pos
     * Contoh: Pasirjati, Ujungberung, Kota Bandung, Jawa Barat, Indonesia, 40617
     */
    private static function parseAlamat($alamat)
    {
        // Split alamat berdasarkan koma
        $parts = array_map('trim', explode(',', $alamat));
        $count = count($parts);
        
        // Default values
        $provinsi = 'Tidak Diketahui';
        $kabupaten = 'Tidak Diketahui';
        $kecamatan = 'Tidak Diketahui';
        $kodepos = '00000';

        // Extract kode pos dari bagian terakhir
        if ($count > 0) {
            $lastPart = $parts[$count - 1];
            if (preg_match('/\b\d{5}\b/', $lastPart, $matches)) {
                $kodepos = $matches[0];
            }
        }

        // Parse berdasarkan struktur standar Indonesia
        // Format: [Jalan], Kecamatan, Kota/Kabupaten, Provinsi, [Negara], [Kode Pos]
        if ($count >= 4) {
            // Cari posisi "Indonesia" jika ada
            $indonesiaIndex = -1;
            for ($i = 0; $i < $count; $i++) {
                if (stripos($parts[$i], 'Indonesia') !== false) {
                    $indonesiaIndex = $i;
                    break;
                }
            }
            
            if ($indonesiaIndex > 0) {
                // Ada "Indonesia" dalam alamat
                $provinsi = trim($parts[$indonesiaIndex - 1]);
                if ($indonesiaIndex >= 2) {
                    $kabupaten = trim($parts[$indonesiaIndex - 2]);
                }
                if ($indonesiaIndex >= 3) {
                    $kecamatan = trim($parts[$indonesiaIndex - 3]);
                }
            } else {
                // Tidak ada "Indonesia", ambil dari belakang
                // Skip kode pos jika ada di akhir
                $endIndex = preg_match('/\b\d{5}\b/', $parts[$count - 1]) ? $count - 2 : $count - 1;
                
                if ($endIndex >= 0) $provinsi = trim($parts[$endIndex]);
                if ($endIndex >= 1) $kabupaten = trim($parts[$endIndex - 1]);
                if ($endIndex >= 2) $kecamatan = trim($parts[$endIndex - 2]);
            }
        } elseif ($count == 3) {
            $provinsi = trim($parts[2]);
            $kabupaten = trim($parts[1]);
            $kecamatan = trim($parts[0]);
        } elseif ($count == 2) {
            $provinsi = trim($parts[1]);
            $kabupaten = trim($parts[0]);
        } elseif ($count == 1) {
            $provinsi = trim($parts[0]);
        }

        // Bersihkan dari kata-kata yang tidak perlu
        $provinsi = self::bersihkanNamaWilayah($provinsi);
        $kabupaten = self::bersihkanNamaWilayah($kabupaten);
        $kecamatan = self::bersihkanNamaWilayah($kecamatan);

        return [
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kodepos' => $kodepos
        ];
    }

    /**
     * Bersihkan nama wilayah dari kata-kata yang tidak perlu
     */
    private static function bersihkanNamaWilayah($nama)
    {
        // Hapus kata-kata yang tidak perlu tapi pertahankan "Kota" untuk membedakan
        $kataTidakPerlu = [
            'Provinsi', 'Prov.', 'Kecamatan', 'Kec.', 'Kelurahan', 'Kel.', 'Desa',
            'Indonesia', 'ID', 'West Java', 'East Java', 'Central Java',
            '\d{5}' // Hapus kode pos jika tercampur
        ];

        foreach ($kataTidakPerlu as $kata) {
            $nama = preg_replace('/\b' . $kata . '\b/i', '', $nama);
        }

        // Bersihkan spasi berlebih dan karakter khusus
        $nama = preg_replace('/\s+/', ' ', $nama);
        $nama = trim($nama, ' ,-');

        return $nama ?: 'Tidak Diketahui';
    }

    /**
     * Get data wilayah untuk API
     */
    public function getWilayahData(Request $request)
    {
        $wilayah = Wilayah::select('provinsi', 'kabupaten', 'kecamatan')
                         ->distinct()
                         ->get()
                         ->groupBy('provinsi');

        return response()->json($wilayah);
    }
}