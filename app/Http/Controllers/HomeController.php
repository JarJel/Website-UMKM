<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Kategori;   // <-- jangan lupa import
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboardToko()
    {
        $user = Auth::user();

        // Cek role seller
        if ($user->roles()->where('id_role', 2)->exists()) {
            return redirect()->route('seller.dashboard');
        }

        abort(403, 'Anda tidak memiliki akses ke dashboard toko.');
    }

    public function index()
    {
        // ambil kategori
        $categories = Kategori::all();

        // ambil produk terbaru
        $products = Product::latest()->take(8)->get();

        // kirim ke view
        return view('homePage.homePage', compact('products', 'categories'));
    }
}
