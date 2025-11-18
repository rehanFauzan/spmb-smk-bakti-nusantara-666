<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PendaftarAsalSekolah extends Model
{
    protected $table = 'pendaftar_asal_sekolah';
    
    protected $fillable = [
        'pendaftar_id',
        'npsn',
        'nama_sekolah',
        'kabupaten',
        'nilai_rata'
    ];

    protected $casts = [
        'nilai_rata' => 'decimal:2'
    ];

    public function pendaftarDataSiswa(): BelongsTo
    {
        return $this->belongsTo(PendaftarDataSiswa::class, 'pendaftar_id');
    }
}