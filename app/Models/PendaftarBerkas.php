<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PendaftarBerkas extends Model
{
    protected $table = 'pendaftar_berkas';
    
    protected $fillable = [
        'pendaftar_id',
        'jenis',
        'tipe_ijazah',
        'nama_file',
        'ukuran_kb',
        'valid',
        'catatan'
    ];

    protected $casts = [
        'valid' => 'boolean'
    ];

    public function pendaftarDataSiswa(): BelongsTo
    {
        return $this->belongsTo(PendaftarDataSiswa::class, 'pendaftar_id');
    }
}