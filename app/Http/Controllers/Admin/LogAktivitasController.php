<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index(Request $request)
    {
        $query = LogAktivitas::with('user')
            ->orderBy('waktu', 'desc');

        // Filter berdasarkan aksi jika ada
        if ($request->filled('aksi')) {
            $query->where('aksi', $request->aksi);
        }

        // Filter berdasarkan tanggal jika ada
        if ($request->filled('tanggal')) {
            $query->whereDate('waktu', $request->tanggal);
        }

        $logAktivitas = $query->paginate(20);
        
        // Ambil daftar aksi unik untuk filter
        $aksiList = LogAktivitas::select('aksi')
            ->distinct()
            ->orderBy('aksi')
            ->pluck('aksi');

        return view('admin.log-aktivitas.index', compact('logAktivitas', 'aksiList'));
    }
}