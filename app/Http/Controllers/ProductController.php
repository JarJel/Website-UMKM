<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\kategori;
use App\Models\VarianProduk;
use App\Models\Toko;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil id_toko user login
        $idToko = $user->toko->id_toko ?? null;

        // Hanya ambil produk milik toko user
        $products = Product::where('id_toko', $idToko)->get();   
        return view('seller.produk', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('homePage.detailProduk', compact('product'));
    }

    public function create()
    {
        $kategori = Kategori::all(); // ambil semua kategori
        return view('seller.produk_create',compact('kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'nullable|string',
            'harga_dasar' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'gambar_produk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'varian.nama_varian.*' => 'nullable|string|max:255',
            'varian.sku.*' => 'nullable|string|max:100',
            'varian.harga_varian.*' => 'nullable|numeric|min:0',
            'varian.stok_varian.*' => 'nullable|integer|min:0',
            'varian.berat_varian_kg.*' => 'nullable|numeric|min:0',
        ]);

        $user = Auth::user();
        $toko = Toko::where('id_pengguna', $user->id_pengguna)->first();

        if (!$toko) {
            return back()->withErrors('Anda belum memiliki toko, silakan buat toko terlebih dahulu.');
        }

        // Upload gambar
        $gambarPath = null;
        if ($request->hasFile('gambar_produk')) {
            $gambarPath = $request->file('gambar_produk')->store('produk', 'public');
        }

        // Simpan produk
        $product = Product::create([
            'nama_produk' => $validated['nama_produk'],
            'deskripsi_produk' => $validated['deskripsi_produk'] ?? null,
            'harga_dasar' => $validated['harga_dasar'],
            'stok' => $validated['stok'],
            'id_kategori' => $validated['id_kategori'],
            'gambar_produk' => $gambarPath,
            'id_toko' => $toko->id_toko,
            'tanggal_ditambahkan' => now(),
        ]);

        // Simpan varian
        if ($request->has('varian') && isset($request->varian['nama_varian'])) {
            foreach ($request->varian['nama_varian'] as $i => $nama) {
                if ($nama) {
                    VarianProduk::create([
                        'id_produk' => $product->id_produk,
                        'nama_varian' => $nama,
                        'sku' => $request->varian['sku'][$i] ?? null,
                        'harga_varian' => $request->varian['harga_varian'][$i] ?? 0,
                        'stok_varian' => $request->varian['stok_varian'][$i] ?? 0,
                        'berat_varian_kg' => $request->varian['berat_varian_kg'][$i] ?? 0,
                    ]);
                }
            }
        }

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

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // hapus file gambar kalau ada
        if ($product->gambar_produk && Storage::disk('public')->exists($product->gambar_produk)) {
            Storage::disk('public')->delete($product->gambar_produk);
        }

        // hapus data produk
        $product->delete();

        return redirect()->route('seller.products.index')
                         ->with('success', 'Produk berhasil dihapus.');
    }

}
