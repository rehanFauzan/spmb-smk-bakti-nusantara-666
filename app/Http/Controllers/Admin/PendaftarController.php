<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\PendaftarBerkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class PendaftarController extends Controller
{
    public function index()
    {
        $pendaftar = Pendaftar::with(['dataSiswa', 'jurusan', 'user', 'berkas'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('admin.pendaftar.index', compact('pendaftar'));
    }
    
    public function show($id)
    {
        $pendaftar = Pendaftar::with(['dataSiswa', 'jurusan', 'user', 'berkas'])
            ->findOrFail($id);
            
        return view('admin.pendaftar.show', compact('pendaftar'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:menunggu,diterima,ditolak',
            'catatan' => 'nullable|string'
        ]);
        
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->update([
            'status_verifikasi' => $request->status_verifikasi,
            'catatan_verifikasi' => $request->catatan
        ]);
        
        return redirect()->back()->with('success', 'Status berhasil diupdate');
    }
    
    public function viewBerkas($pendaftarId, $berkasId)
    {
        $berkas = PendaftarBerkas::where('pendaftar_id', $pendaftarId)
            ->where('id', $berkasId)
            ->firstOrFail();
        
        $filePath = "pendaftaran/{$pendaftarId}/{$berkas->nama_file}";
        
        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }
        
        $file = Storage::disk('public')->get($filePath);
        $mimeType = Storage::disk('public')->mimeType($filePath);
        
        return response($file, 200)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'inline; filename="' . $berkas->nama_file . '"');
    }
    
    public function previewBerkas($pendaftarId, $berkasId)
    {
        $berkas = PendaftarBerkas::where('pendaftar_id', $pendaftarId)
            ->where('id', $berkasId)
            ->firstOrFail();
            
        $pendaftar = Pendaftar::with(['dataSiswa', 'jurusan', 'user'])
            ->findOrFail($pendaftarId);
        
        return view('admin.pendaftar.berkas-preview', compact('berkas', 'pendaftar'));
    }
}