<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\ItemKeranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $userId = auth()->id(); 
        $keranjang = ItemKeranjang::with('produk')
                        ->whereHas('keranjang', function($q) use ($userId) {
                            $q->where('id_pengguna', $userId);
                        })->get();

        return view('keranjang.index', compact('keranjang'));
    }

    // Dropdown keranjang untuk navbar
    public function dropdown()
    {
        $items = ItemKeranjang::whereHas('keranjang', function($q){
            $q->where('id_pengguna', Auth::id());
        })->with('produk')->get();

        $response = $items->map(function($item){
            return [
                'id' => $item->id_item_keranjang,
                'nama' => $item->produk->nama_produk ?? 'Produk tidak tersedia',
                'harga' => $item->produk->harga_dasar ?? 0,
                'image' => $item->produk->gambar_produk ? asset($item->produk->gambar_produk) : 'https://placehold.co/48x48',
                'jumlah' => $item->jumlah_produk
            ];
        });

        return response()->json(['items' => $response]);
    }

    // Tambah item ke keranjang
    public function add(Request $request, $id_produk)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1'
        ]);

        $userId = Auth::id();

        // Ambil atau buat keranjang user
        $keranjang = Keranjang::firstOrCreate(
            ['id_pengguna' => $userId]
        );

        // Cek apakah item sudah ada
        $item = ItemKeranjang::where('id_keranjang', $keranjang->id_keranjang)
                             ->where('id_produk', $id_produk)
                             ->first();

        if ($item) {
            $item->jumlah_produk += $request->jumlah; // sesuaikan kolom
            $item->save();
        } else {
            ItemKeranjang::create([
                'id_keranjang' => $keranjang->id_keranjang,
                'id_produk' => $id_produk,
                'jumlah_produk' => $request->jumlah
            ]);
        }

        return response()->json(['message' => 'Produk berhasil ditambahkan ke keranjang!']);
    }

    public function updateItem(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1'
        ]);

        $item = ItemKeranjang::findOrFail($id);
        $item->jumlah_produk = $request->jumlah;
        $item->save();

        $totalHarga = $item->produk->harga_dasar * $item->jumlah_produk;

        return response()->json(['total_harga' => $totalHarga]);
    }


    // Hapus item dari keranjang
    public function removeItem($id)
    {
        $item = ItemKeranjang::find($id);
        if($item){
            $item->delete();
        }
        return response()->json(['success' => true]);
    }
}
