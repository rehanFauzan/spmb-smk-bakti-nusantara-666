<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengguna extends Model
{
    protected $table = 'pengguna';
    
    protected $fillable = [
        'nama',
        'email',
        'hp',
        'password_hash',
        'role',
        'aktif'
    ];

    protected $hidden = [
        'password_hash'
    ];

    protected $casts = [
        'aktif' => 'boolean'
    ];

    public function logAktivitas(): HasMany
    {
        return $this->hasMany(LogAktivitas::class, 'user_id');
    }
}