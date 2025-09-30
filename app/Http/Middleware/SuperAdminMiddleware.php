<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // cek login
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Silakan login dulu');
        }

        // cek role superadmin (id_role = 4)
        if (Auth::user()->id_role !== 4) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
