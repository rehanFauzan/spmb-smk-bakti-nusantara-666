<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gelombang extends Model
{
    protected $table = 'gelombang';
    
    protected $fillable = [
        'nama',
        'tgl_mulai',
        'tgl_selesai',
        'biaya_daftar'
    ];

    protected $casts = [
        'tgl_mulai' => 'date',
        'tgl_selesai' => 'date',
        'biaya_daftar' => 'decimal:2'
    ];

    public function pendaftar(): HasMany
    {
        return $this->hasMany(Pendaftar::class);
    }

    public function pendaftarDataSiswa(): HasMany
    {
        return $this->hasMany(PendaftarDataSiswa::class);
    }

    public static function getGelombangAktif($tanggal = null)
    {
        $tanggal = $tanggal ?? now()->toDateString();
        
        return self::where('tgl_mulai', '<=', $tanggal)
                   ->where('tgl_selesai', '>=', $tanggal)
                   ->first();
    }

    public static function getAllGelombang()
    {
        return self::orderBy('tgl_mulai')->get();
    }

    public function isAktif($tanggal = null)
    {
        $tanggal = $tanggal ?? now()->toDateString();
        
        return $this->tgl_mulai <= $tanggal && $this->tgl_selesai >= $tanggal;
    }
}