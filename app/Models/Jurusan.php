<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jurusan extends Model
{
    protected $table = 'jurusan';
    
    protected $fillable = [
        'kode',
        'kode_jurusan',
        'nama_jurusan',
        'kuota'
    ];

    public function pendaftar(): HasMany
    {
        return $this->hasMany(Pendaftar::class);
    }

    public function pendaftarDataSiswa(): HasMany
    {
        return $this->hasMany(PendaftarDataSiswa::class);
    }
}
