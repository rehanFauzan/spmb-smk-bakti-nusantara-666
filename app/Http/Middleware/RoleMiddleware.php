<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Untuk sementara, kita skip authentication check
        // Nanti bisa ditambahkan setelah sistem auth lengkap
        
        return $next($request);
    }
}