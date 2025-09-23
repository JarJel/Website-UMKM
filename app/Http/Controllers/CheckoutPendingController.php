<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\ItemKeranjang;
use App\Models\PesananPending;
use App\Models\ItemPesananPending;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Snap;
use Midtrans\Config;

class CheckoutPendingController extends Controller
{
    // proses: pindahkan item keranjang ke pesanan_pending + item_pesanan_pending
    public function process(Request $request)
{
    $user = Auth::user();
    if (!$user) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
    }

    $items = $request->items; // array dari ajax
    if (empty($items) || count($items) == 0) {
        return back()->with('error', 'Tidak ada item terpilih');
    }

    DB::beginTransaction();
    try {
        // ambil data ItemKeranjang yang dipilih + relasi produk
        $ids = array_column($items, 'id_item_keranjang');
        $cartItems = ItemKeranjang::with('produk')
            ->whereIn('id_item_keranjang', $ids)
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Item tidak ditemukan');
        }

        // asumsi semua item dari toko yg sama
        $idToko = $cartItems->first()->produk->id_toko ?? null;

        // buat pesanan_pending (header)
        $pesanan = PesananPending::create([
            'id_pengguna' => $user->id_pengguna,
            'id_toko' => $idToko,
            'total_harga_produk' => 0,
            'biaya_pengiriman' => 25000,
            'status' => 'pending',
        ]);

        $totalProduk = 0;

        // buat item_pesanan_pending (detail)
        foreach ($cartItems as $ci) {
            $qty = collect($items)->firstWhere('id_item_keranjang', $ci->id_item_keranjang)['jumlah']
                ?? $ci->jumlah_produk ?? 1;
            $price = $ci->produk->harga_dasar ?? 0;

            ItemPesananPending::create([
                'id_pending' => $pesanan->id_pending,
                'id_produk' => $ci->id_produk,
                'nama_produk_snapshot' => $ci->produk->nama_produk,
                'harga_saat_pilih' => $price,
                'jumlah' => $qty,
                'berat_per_item_kg' => $ci->produk->berat_kg ?? 0,
            ]);

            $totalProduk += $price * $qty;
        }

        // update total di header
        $pesanan->update(['total_harga_produk' => $totalProduk]);

        DB::commit();

        return response()->json([
        'message' => 'Pesanan berhasil dibuat',
        'id_pending' => $pesanan->id_pending
    ]);

        // arahkan langsung ke halaman payment
        return redirect()->route('checkout.payment', $pesanan->id_pending)
                         ->with('success', 'Pesanan berhasil dibuat, lanjutkan ke pembayaran.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}


    // tampilkan ringkasan (opsional)
    public function show($id_pending)
    {
        $pesanan = PesananPending::with('items.produk')->findOrFail($id_pending);
        $cartItems = $pesanan->items;
        $totalProduk = $pesanan->total_harga_produk ?? $cartItems->sum(fn($it) => ($it->harga_saat_pilih ?? 0) * ($it->jumlah ?? 0));
        $biayaPengiriman = $pesanan->biaya_pengiriman ?? 25000;
        $total = $totalProduk + $biayaPengiriman;

        return view('checkout.checkout', compact('pesanan','cartItems','totalProduk','biayaPengiriman','total'));
    }

    public function payment($id_pending)
    {
        $pesanan = PesananPending::with('items.produk')->findOrFail($id_pending);

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $cartItems = $pesanan->items;
        $totalProduk = $pesanan->total_harga_produk ?? $cartItems->sum(fn($it) => ($it->harga_saat_pilih ?? 0) * ($it->jumlah ?? 0));
        $biayaPengiriman = $pesanan->biaya_pengiriman ?? 25000;
        $total = $totalProduk + $biayaPengiriman;

        // --- BUAT SNAP TOKEN ---
        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $pesanan->id_pending,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->nama ?? 'User',
                'email' => auth()->user()->email ?? 'user@example.com',
            ],
        ];
        
        $orderId = 'PESANAN-' . $pesanan->id_pending . '-' . time();

        $snapToken = Snap::getSnapToken($params);

        return view('checkout.payment', compact(
            'pesanan','cartItems','totalProduk','biayaPengiriman','total','snapToken'
        ));
    }


    // confirm payment
    public function confirmPayment(Request $request, $id_pending)
    {
        $request->validate([
            'metode_pembayaran' => 'required|string'
        ]);

        $pesanan = PesananPending::findOrFail($id_pending);
        $pesanan->metode_pembayaran = $request->metode_pembayaran;
        $pesanan->status = 'paid';
        $pesanan->save();

        return redirect()->route('checkout.success', $id_pending)->with('success','Pembayaran berhasil.');
    }

    // success page
    public function success($id_pending)
    {
        $pesanan = PesananPending::with('items.produk')->findOrFail($id_pending);
        return view('checkout.success', compact('pesanan'));
    }
}
