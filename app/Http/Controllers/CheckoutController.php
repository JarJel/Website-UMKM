<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\PesananPending;
use App\Models\ItemPesanan;
use App\Models\Alamat;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // Menampilkan halaman pembayaran
    public function payment($idPending)
    {
        $pesanan = Pesanan::where('id_pesanan', $idPending)->first();
        $cartItems = $pesanan ? $pesanan->items : [];
        $alamat = Alamat::where('id_pengguna', auth()->id())
                         ->where('is_default', 1)
                         ->first();

        return view('checkout.payment', compact('pesanan', 'cartItems', 'alamat'));
    }

    // Submit bayar via AJAX
    public function payNow(Request $request, $id_pending)
    {
        $request->validate([
            'id_alamat' => 'required|exists:alamat,id_alamat',
        ]);

        $pesananPending = PesananPending::findOrFail($id_pending);

        $alamat = Alamat::find($request->id_alamat);

        DB::transaction(function() use ($pesananPending, $alamat) {
            // buat pesanan baru
            $pesanan = new Pesanan();
            $pesanan->id_pengguna         = auth()->id();
            $pesanan->id_toko             = $pesananPending->id_toko;
            $pesanan->id_alamat           = $alamat->id_alamat;
            $pesanan->total_harga_produk  = $pesananPending->total_harga_produk;
            $pesanan->biaya_pengiriman    = $pesananPending->biaya_pengiriman;
            $pesanan->metode_pembayaran   = 'transfer';
            $pesanan->status_pesanan      = 'pending';
            $pesanan->tanggal_pesanan     = now();
            $pesanan->save();

            // simpan item pesanan & kurangi stok
            foreach ($pesananPending->items as $item) {
                $pesanan->items()->create([
                    'id_produk' => $item->id_produk,
                    'id_varian' => $item->id_varian ?? null,
                    'jumlah'    => $item->jumlah,
                    'harga_saat_pesan' => $item->harga,
                    'nama_produk_snapshot' => $produk->nama_produk ?? null,
                    'berat_per_item_kg' => $item->berat_per_item_kg ?? 0,
                ]);

                $produk = Product::find($item->id_produk);
                if($produk){
                    $produk->stok = max(0, $produk->stok - $item->jumlah);

                    // update jumlah terjual
                    $produk->terjual = ($produk->terjual ?? 0) + $item->jumlah;

                    $produk->save();
                }
            }

            // hapus pesanan pending
            $pesananPending->delete();
        });

        return response()->json([
            'success' => true,
            'id_pesanan' => $pesanan->id_pesanan ?? null
        ]);
    }


    public function tracking($id_pesanan)
    {
        // Ambil semua pesanan user saat ini
        $pesananList = Pesanan::with('items.produk', 'alamat')
                        ->where('id_pengguna', auth()->id())
                        ->orderBy('tanggal_pesanan', 'desc')
                        ->get();

        // Ambil pesanan spesifik jika id_pesanan diberikan, tapi aman kalau null
        $pesanan = Pesanan::with('items.produk', 'alamat')
                    ->where('id_pengguna', auth()->id())
                    ->where('id_pesanan', $id_pesanan)
                    ->first();

        // Ambil alamat default dari pesanan (jika ada)
        $alamat = $pesanan ? $pesanan->alamat : null;

        // Status timeline
        $statusList = [
            'pending' => 'Menunggu pembayaran',
            'diproses' => 'Pesanan sedang diproses',
            'diantarkan' => 'Pesanan sedan dalam perjalanan',
            'selesai' => 'Pesanan selesai'
        ];

        return view('tracking.tracking', compact('pesanan', 'alamat', 'statusList', 'pesananList'));
    }



    // Load semua alamat user
    public function alamatList()
    {
        $alamat = Alamat::where('id_pengguna', auth()->id())->get();
        return response()->json(['alamat'=>$alamat]);
    }

    // Pilih alamat default
    public function pilihAlamat($idAlamat)
    {
        Alamat::where('id_pengguna', auth()->id())->update(['is_default'=>0]);
        $alamat = Alamat::where('id_alamat', $idAlamat)->first();
        if($alamat){
            $alamat->update(['is_default'=>1]);
            return response()->json(['success'=>true]);
        }
        return response()->json(['success'=>false]);
    }
}
