<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Tangani permintaan masuk.
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();

                // Pengalihan berdasarkan id_role
                if ($user->id_role === 3) { // Admin
                    return redirect()->route('admin.dashboard');
                } elseif ($user->id_role === 2) { // Penjual
                    return redirect()->route('seller.dashboard');
                } else { // Pengguna biasa
                    return redirect()->route('home.page'); // Pastikan nama rute ini benar
                }
            }
        }

        return $next($request);
    }
}