<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Alias middleware rute.
     */
    protected $routeMiddleware = [
        // ... middleware lain ...
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    ];
}