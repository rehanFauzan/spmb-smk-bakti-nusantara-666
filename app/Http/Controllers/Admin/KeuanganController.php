<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;

class KeuanganController extends Controller
{
    public function pembayaran()
    {
        $pendaftar = Pendaftar::with(['dataSiswa', 'jurusan', 'user'])
            ->whereNotNull('bukti_pembayaran')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('admin.keuangan.pembayaran', compact('pendaftar'));
    }
}