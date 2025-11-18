<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wilayah extends Model
{
    protected $table = 'wilayah';
    
    protected $fillable = [
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kodepos'
    ];

    public function pendaftarDataSiswa(): HasMany
    {
        return $this->hasMany(PendaftarDataSiswa::class);
    }
}