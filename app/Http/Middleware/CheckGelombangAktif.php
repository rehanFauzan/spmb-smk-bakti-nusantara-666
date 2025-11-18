<?php

namespace App\Http\Middleware;

use App\Models\Gelombang;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckGelombangAktif
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $gelombangAktif = Gelombang::getGelombangAktif();
        
        if (!$gelombangAktif) {
            return redirect()->route('pendaftaran.index')
                ->with('error', 'Pendaftaran sedang tidak dibuka. Silakan coba lagi nanti.');
        }
        
        return $next($request);
    }
}
