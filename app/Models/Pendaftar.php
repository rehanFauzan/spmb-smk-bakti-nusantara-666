<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendaftar extends Model
{
    protected $table = 'pendaftar';
    
    protected $fillable = [
        'user_id',
        'tanggal_daftar',
        'no_pendaftaran',
        'gelombang_id',
        'jurusan_id',
        'status',
        'user_verifikasi_adm',
        'tgl_verifikasi_adm',
        'user_verifikasi_payment',
        'tgl_verifikasi_payment',
        'status_verifikasi',
        'catatan_verifikasi',
        'tanggal_verifikasi',
        'status_pembayaran',
        'jumlah_bayar',
        'catatan_pembayaran',
        'tanggal_bayar',
        'email',
        'hp'
    ];

    protected $casts = [
        'tanggal_daftar' => 'datetime',
        'tgl_verifikasi_adm' => 'datetime',
        'tgl_verifikasi_payment' => 'datetime'
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

    public function dataSiswa()
    {
        return $this->hasOne(PendaftarDataSiswa::class, 'user_id', 'user_id');
    }

    public function asalSekolah()
    {
        return $this->hasOneThrough(
            PendaftarAsalSekolah::class,
            PendaftarDataSiswa::class,
            'user_id', // Foreign key on pendaftar_data_siswa
            'pendaftar_id', // Foreign key on pendaftar_asal_sekolah
            'user_id', // Local key on pendaftar
            'id' // Local key on pendaftar_data_siswa
        );
    }

    public function dataOrtu()
    {
        return $this->hasOneThrough(
            PendaftarDataOrtu::class,
            PendaftarDataSiswa::class,
            'user_id',
            'pendaftar_id',
            'user_id',
            'id'
        );
    }

    public function berkas()
    {
        return $this->hasManyThrough(
            PendaftarBerkas::class,
            PendaftarDataSiswa::class,
            'user_id',
            'pendaftar_id',
            'user_id',
            'id'
        );
    }
}
