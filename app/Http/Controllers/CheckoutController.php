<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\PesananPending;
use App\Models\ItemPesanan;
use App\Models\Alamat;
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

    // ambil data alamat
    $alamat = Alamat::find($request->id_alamat);

    // buat pesanan baru
    $pesanan = new Pesanan();
    $pesanan->id_pengguna         = auth()->id();
    $pesanan->id_toko             = $pesananPending->id_toko;
    $pesanan->id_alamat           = $alamat->id_alamat;
    $pesanan->total_harga_produk  = $pesananPending->total_harga_produk;
    $pesanan->biaya_pengiriman    = $pesananPending->biaya_pengiriman;
    $pesanan->metode_pembayaran   = 'transfer'; // bisa disesuaikan
    $pesanan->status_pesanan      = 'pending';
    $pesanan->tanggal_pesanan     = now();
    $pesanan->save();

    // simpan item pesanan
    foreach ($pesananPending->items as $item) {
        $pesanan->items()->create([
            'id_produk' => $item->id_produk,
            'jumlah'    => $item->jumlah,
            'harga'     => $item->harga,
        ]);
    }

    // hapus pesanan pending
    $pesananPending->delete();

    return response()->json([
        'success' => true,
        'id_pesanan' => $pesanan->id_pesanan
    ]);
}


    public function tracking($id_pesanan)
{
    $pesanan = Pesanan::with('items.produk')->findOrFail($id_pesanan);
    $alamat  = $pesanan->alamat; // relasi alamat harus ada di model Pesanan

    // contoh status timeline
    $statusList = [
        'pending' => 'Menunggu pembayaran',
        'diproses' => 'Pesanan sedang diproses',
        'dikirim' => 'Pesanan dikirim',
        'selesai' => 'Pesanan selesai'
    ];

    return view('tracking.tracking', compact('pesanan', 'alamat', 'statusList'));
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
