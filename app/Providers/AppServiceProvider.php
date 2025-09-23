<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Keranjang;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('homePage.navbar', function ($view) {
            if(auth()->check()){
                $pesanan = Pesanan::with('items', 'alamat')
                            ->where('id_pengguna', auth()->id())
                            ->latest()
                            ->first();
                $view->with('pesanan', $pesanan);
            }
        });
    }
}
