<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;

class VerifikasiController extends Controller
{
    public function index()
    {
        $pendaftar = Pendaftar::with(['dataSiswa', 'jurusan', 'user', 'berkas'])
            ->where('status_verifikasi', 'menunggu')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('admin.verifikasi.index', compact('pendaftar'));
    }
}