<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\kategori;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('seller.produk', compact('products'));
    }

    public function create()
    {
        $kategori = Kategori::all(); // ambil semua kategori
        return view('seller.produk_create',compact('kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk'      => 'required|string|max:255',
            'deskripsi_produk' => 'nullable|string',
            'harga_dasar'      => 'required|numeric',
            'stok'             => 'required|integer|min:0', 
            'id_kategori'      => 'required|integer',
            'gambar_produk.*'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan gambar maksimal 5
        if ($request->hasFile('gambar_produk')) {
            $file = $request->file('gambar_produk');
            $path = $file->store('produk', 'public');
            $validated['gambar_produk'] = $path;
        }

        $validated['tanggal_ditambahkan'] = now();
        $validated['id_pengguna'] = Auth::id();

        Product::create($validated);

        return redirect()->route('seller.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $kategori = Kategori::all();
        return view('seller.produk_edit', compact('product', 'kategori'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nama_produk'      => 'required|string|max:255',
            'deskripsi_produk' => 'nullable|string',
            'harga_dasar'      => 'required|numeric',
            'stok'             => 'required|integer|min:0',
            'id_kategori'      => 'nullable|integer',
            'gambar_produk'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if (empty($validated['id_kategori'])) {
            unset($validated['id_kategori']);
        }

        if ($request->hasFile('gambar_produk')) {
            // opsional: hapus file lama, jika kamu mau
            $validated['gambar_produk'] = $request->file('gambar_produk')->store('produk', 'public');
        }

        $product->update($validated);

        return redirect()->route('seller.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

}
