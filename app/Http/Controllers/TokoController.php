<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    public function show(Request $request, $id)
    {
        // Ambil toko yang dikunjungi
        $toko = Toko::findOrFail($id);

        // Ambil parameter sort dari query string, default 'newest'
        $sort = $request->query('sort', 'newest');

        // Query produk toko ini + relasi kategori
        $query = Product::where('id_toko', $id)->with('kategori');

        // Terapkan sort berdasarkan dropdown
        if ($sort === 'newest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'lowest') {
            $query->orderBy('harga_dasar', 'asc');
        } elseif ($sort === 'highest') {
            $query->orderBy('harga_dasar', 'desc');
        }

        // Ambil data produk (bisa ditambah pagination jika perlu)
        $produk = $query->get();

        // Ambil kategori unik dari produk toko ini
        $kategori = Kategori::whereIn('id_kategori', $produk->pluck('id_kategori')->unique())
                    ->get();

        // Kirim data ke view
        return view('HalamanToko.store', [
            'toko' => $toko,
            'produk' => $produk,
            'kategori' => $kategori,
            'sort' => $sort, // kirim sort agar Alpine.js tahu default pilihan
        ]);
    }
}
