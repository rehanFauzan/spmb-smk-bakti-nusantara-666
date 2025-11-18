<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Session::has('admin_user')) {
            return redirect()->route('admin.login');
        }

        $user = Session::get('admin_user');
        
        if (!empty($roles) && !in_array($user->role, $roles)) {
            abort(403, 'Akses ditolak');
        }

        return $next($request);
    }
}
