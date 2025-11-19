<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PendaftarDataSiswa extends Model
{
    protected $table = 'pendaftar_data_siswa';
    
    protected $fillable = [
        'user_id',
        'tanggal_daftar',
        'no_pendaftaran',
        'gelombang_id',
        'jurusan_id',
        'status',
        'tgl_verifikasi_adm',
        'tgl_verifikasi_payment',
        'nik',
        'nama',
        'jk',
        'agama',
        'tmp_lahir',
        'alamat',
        'wilayah_id',
        'lat',
        'lng'
    ];

    protected $casts = [
        'tanggal_daftar' => 'datetime',
        'tgl_verifikasi_adm' => 'datetime',
        'tgl_verifikasi_payment' => 'datetime',
        'tmp_lahir' => 'date',
        'lat' => 'decimal:7',
        'lng' => 'decimal:7'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function gelombang(): BelongsTo
    {
        return $this->belongsTo(Gelombang::class);
    }

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function wilayah(): BelongsTo
    {
        return $this->belongsTo(Wilayah::class);
    }

    public function asalSekolah(): HasOne
    {
        return $this->hasOne(PendaftarAsalSekolah::class, 'pendaftar_id');
    }

    public function berkas(): HasMany
    {
        return $this->hasMany(PendaftarBerkas::class, 'pendaftar_id');
    }

    public function dataOrtu(): HasOne
    {
        return $this->hasOne(PendaftarDataOrtu::class, 'pendaftar_id');
    }
}