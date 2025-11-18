<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PendaftarDataOrtu extends Model
{
    protected $table = 'pendaftar_data_ortu';
    
    protected $fillable = [
        'pendaftar_id',
        'nama_ayah',
        'pekerjaan_ayah',
        'no_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'no_ibu',
        'nama_wali',
        'pekerjaan_wali',
        'no_wali'
    ];

    public function pendaftarDataSiswa(): BelongsTo
    {
        return $this->belongsTo(PendaftarDataSiswa::class, 'pendaftar_id');
    }
}