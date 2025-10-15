<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Kategori;
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

    /**
     * Tampilkan 20 produk pertama dan data kategori untuk halaman awal.
     */
    public function index()
    {
        // Ambil kategori
        $categories = Kategori::all();

        // Ambil 20 produk terbaru pertama menggunakan pagination
        // Pagination sangat penting untuk infinite scroll
        $products = Product::latest()->paginate(20);

        // Kirim ke view
        return view('homePage.homePage', compact('products', 'categories'));
    }

    /**
     * Tangani permintaan AJAX untuk memuat lebih banyak produk saat scroll.
     */
    public function loadMore(Request $request)
    {
        // Tentukan jumlah produk per halaman (harus konsisten dengan index)
        $perPage = 20;

        // Ambil produk dari halaman berikutnya (sesuai request 'page')
        $products = Product::latest()->paginate($perPage);
        
        // Cek jika ini adalah permintaan AJAX
        if ($request->ajax()) {
            $html = '';
            
            // Render setiap produk menggunakan partial view
            foreach ($products as $product) {
                // Pastikan nama view ini sesuai dengan file partial yang Anda buat
                $html .= view('homePage._product_card', compact('product'))->render();
            }

            // Kembalikan respons JSON yang berisi HTML dan URL halaman berikutnya
            return response()->json([
                'html' => $html,
                // Jika tidak ada next page, kembalikan 'false'
                'nextPageUrl' => $products->nextPageUrl() ? $products->nextPageUrl() : false, 
            ]);
        }
        
        // Jika bukan permintaan AJAX, redirect ke halaman utama
        return redirect()->route('home');
    }
}
