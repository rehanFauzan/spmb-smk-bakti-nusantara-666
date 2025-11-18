<?php

namespace App\Helpers;

use App\Models\LogAktivitas;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class LogHelper
{
    public static function log($aksi, $objek, $objekData = null, ?Request $request = null)
    {
        $user = Session::get('admin_user');
        
        if (!$user) {
            return;
        }
        
        if (!$request) {
            $request = request();
        }
        
        LogAktivitas::create([
            'user_id' => $user->id,
            'aksi' => $aksi,
            'objek' => $objek,
            'objek_data' => $objekData ?: [],
            'waktu' => now(),
            'ip' => $request->ip()
        ]);
    }
}