<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WilayahController extends Controller
{
    public function index(Request $request)
    {
        // Lokasi sekolah (SMK Bakti Nusantara 666)
        $sekolahLat = -6.941352993058663;
        $sekolahLng = 107.73772907439879;
        
        // Statistik default jika tidak ada data
        $totalPendaftar = Pendaftar::count();
        $denganLokasi = 0;
        $radius10km = 0;
        $radius20km = 0;
        $pendaftarLokasi = collect();
        $statistikWilayah = collect();
        $statistikJurusan = collect();
        $allJurusan = Jurusan::all();
        
        // Coba ambil data jika ada
        try {
            // Query dasar
            $query = Pendaftar::with(['dataSiswa', 'jurusan', 'user'])
                ->whereHas('dataSiswa', function($q) {
                    $q->whereNotNull('lat')->whereNotNull('lng')
                      ->where('lat', '!=', 0)
                      ->where('lng', '!=', 0);
                });
            
            // Filter berdasarkan request - gunakan status dari dataSiswa
            if ($request->filled('status')) {
                $query->whereHas('dataSiswa', function($q) use ($request) {
                    $q->where('status', $request->status);
                });
            }
            
            if ($request->filled('jurusan')) {
                $query->where('jurusan_id', $request->jurusan);
            }
            
            // Ambil data pendaftar dengan lokasi
            $pendaftarLokasi = $query->get()->map(function($item) use ($sekolahLat, $sekolahLng) {
                $jarak = $this->calculateDistance(
                    $sekolahLat, $sekolahLng,
                    $item->dataSiswa->lat, $item->dataSiswa->lng
                );
                
                return (object) [
                    'lat' => $item->dataSiswa->lat,
                    'lng' => $item->dataSiswa->lng,
                    'nama' => $item->dataSiswa->nama ?? $item->user->name ?? 'Nama belum diisi',
                    'no_pendaftaran' => $item->no_pendaftaran,
                    'alamat' => $item->dataSiswa->alamat ?? '-',
                    'jurusan_nama' => $item->jurusan->nama ?? null,
                    'status_verifikasi' => $item->dataSiswa->status ?? 'SUBMIT',
                    'jarak' => $jarak
                ];
            });
            
            // Filter berdasarkan radius jika ada
            if ($request->filled('radius')) {
                $maxRadius = (float) $request->radius;
                $pendaftarLokasi = $pendaftarLokasi->filter(function($item) use ($maxRadius) {
                    return $item->jarak <= $maxRadius;
                });
            }
            
            // Statistik
            $denganLokasi = $pendaftarLokasi->count();
            $radius10km = $pendaftarLokasi->filter(function($item) { return $item->jarak <= 10; })->count();
            $radius20km = $pendaftarLokasi->filter(function($item) { return $item->jarak > 20; })->count();
            
            // Statistik per wilayah (berdasarkan alamat)
            $statistikWilayah = $this->getWilayahStatistics($pendaftarLokasi);
            
            // Statistik per jurusan
            $statistikJurusan = $allJurusan->map(function($item) {
                return (object) [
                    'nama' => $item->nama,
                    'total' => 0
                ];
            });
            
        } catch (\Exception $e) {
            // Jika ada error, gunakan data default
        }
        
        return view('admin.wilayah.index', compact(
            'pendaftarLokasi',
            'totalPendaftar',
            'denganLokasi',
            'radius10km',
            'radius20km',
            'statistikWilayah',
            'statistikJurusan',
            'allJurusan'
        ));
    }
    
    public function export(Request $request)
    {
        // Export data ke CSV/Excel
        $filename = 'wilayah_pendaftar_' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($request) {
            $file = fopen('php://output', 'w');
            
            // Header CSV
            fputcsv($file, [
                'No Pendaftaran',
                'Nama',
                'Alamat',
                'Latitude',
                'Longitude',
                'Jurusan',
                'Status',
                'Jarak dari Sekolah (km)'
            ]);
            
            // Data
            $sekolahLat = -6.941352993058663;
            $sekolahLng = 107.73772907439879;
            
            $query = Pendaftar::with(['dataSiswa', 'jurusan', 'user'])
                ->whereHas('dataSiswa', function($q) {
                    $q->whereNotNull('lat')->whereNotNull('lng')
                      ->where('lat', '!=', 0)
                      ->where('lng', '!=', 0);
                });
            
            if ($request->filled('status')) {
                $query->whereHas('dataSiswa', function($q) use ($request) {
                    $q->where('status', $request->status);
                });
            }
            
            if ($request->filled('jurusan')) {
                $query->where('jurusan_id', $request->jurusan);
            }
            
            $pendaftar = $query->get();
            
            foreach ($pendaftar as $item) {
                $jarak = $this->calculateDistance(
                    $sekolahLat, $sekolahLng,
                    $item->dataSiswa->lat, $item->dataSiswa->lng
                );
                
                fputcsv($file, [
                    $item->no_pendaftaran,
                    $item->dataSiswa->nama ?? $item->user->name ?? 'Nama belum diisi',
                    $item->dataSiswa->alamat ?? '-',
                    $item->dataSiswa->lat,
                    $item->dataSiswa->lng,
                    $item->jurusan->nama ?? 'Belum dipilih',
                    ucfirst($item->dataSiswa->status ?? 'SUBMIT'),
                    number_format($jarak, 2)
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    private function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371; // km
        
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);
        
        $a = sin($dLat/2) * sin($dLat/2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLng/2) * sin($dLng/2);
        
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        
        return $earthRadius * $c;
    }
    
    private function getWilayahStatistics($pendaftarLokasi)
    {
        // Ekstrak kecamatan dari alamat (sederhana)
        $wilayahCount = [];
        
        foreach ($pendaftarLokasi as $item) {
            $alamat = $item->alamat;
            $kecamatan = $this->extractKecamatan($alamat);
            
            if (!isset($wilayahCount[$kecamatan])) {
                $wilayahCount[$kecamatan] = 0;
            }
            $wilayahCount[$kecamatan]++;
        }
        
        // Convert ke collection
        $result = collect();
        foreach ($wilayahCount as $kecamatan => $total) {
            $result->push((object) [
                'kecamatan' => $kecamatan,
                'total' => $total
            ]);
        }
        
        return $result->sortByDesc('total')->take(10);
    }
    
    private function extractKecamatan($alamat)
    {
        // Ekstrak kecamatan dari alamat (implementasi sederhana)
        $kecamatanKeywords = [
            'Cileunyi', 'Bandung', 'Cimahi', 'Sumedang', 'Garut',
            'Rancaekek', 'Majalaya', 'Ciparay', 'Banjaran', 'Soreang'
        ];
        
        foreach ($kecamatanKeywords as $keyword) {
            if (stripos($alamat, $keyword) !== false) {
                return $keyword;
            }
        }
        
        return 'Lainnya';
    }
}