<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Product;

class KategoriController extends Controller
{
    public function show($id)
    {
        // Ambil kategori yang diklik
        $kategori = Kategori::findOrFail($id);

        // Ambil produk dengan kategori ini
        $produk = Product::where('id_kategori', $id)
                        ->with('toko') // optional kalau mau tampilkan nama toko
                        ->get();

        return view('HalamanKategori.index', [
            'kategori' => $kategori,
            'produk'   => $produk,
        ]);
    }

    
}
