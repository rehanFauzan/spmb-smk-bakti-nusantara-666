<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Otp extends Model
{
    protected $fillable = [
        'email',
        'otp',
        'expires_at',
        'is_used'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_used' => 'boolean'
    ];

    public static function generateOtp($email)
    {
        // Hapus OTP lama yang belum digunakan
        self::where('email', $email)->where('is_used', false)->delete();
        
        // Generate OTP 6 digit
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        return self::create([
            'email' => $email,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(5), // Berlaku 5 menit
            'is_used' => false
        ]);
    }

    public static function verifyOtp($email, $otp)
    {
        $otpRecord = self::where('email', $email)
            ->where('otp', $otp)
            ->where('is_used', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if ($otpRecord) {
            $otpRecord->update(['is_used' => true]);
            return true;
        }

        return false;
    }

    public function isExpired()
    {
        return Carbon::now()->greaterThan($this->expires_at);
    }
}