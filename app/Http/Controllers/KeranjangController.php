<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\ItemKeranjang;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function tambah(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,id_produk',
            'id_varian_produk' => 'nullable|exists:varian_produk,id_varian_produk',
            'jumlah' => 'required|integer|min:1'
        ]);

        $user = Auth::user();

        if(!$user){
            return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu!');
        }

        // 1. Ambil keranjang user atau buat baru
        $keranjang = $user->keranjang ?? Keranjang::create([
            'id_pengguna' => $user->id_pengguna
        ]);

        // 2. Cek apakah item sudah ada di keranjang
        $item = $keranjang->itemKeranjang()
            ->where('id_produk', $request->id_produk)
            ->where('id_varian_produk', $request->id_varian_produk)
            ->first();

        if($item){
            // Produk sama -> update jumlah
            $item->increment('jumlah_produk', $request->jumlah);
        } else {
            // Produk baru -> buat item baru
            $keranjang->itemKeranjang()->create([
                'id_produk' => $request->id_produk,
                'id_varian_produk' => $request->id_varian_produk,
                'jumlah_produk' => $request->jumlah
            ]);
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function index()
    {
        $user = Auth::user();

        $keranjang = $user->keranjang;

        // Ambil semua item keranjang beserta data produk
        $items = $keranjang ? $keranjang->itemKeranjang()->with('produk')->get() : collect();

        return view('keranjang.index', compact('items'));
    }
}
