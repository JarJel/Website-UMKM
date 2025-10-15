<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\PesananPending;
use App\Models\ItemPesanan;
use App\Models\Alamat;
use App\Models\Product;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        $pesananPending = PesananPending::with('items')->findOrFail($id_pending);
        $alamat = Alamat::find($request->id_alamat);
        $metode_pembayaran = $request->input('metode');

        // 1. Simpan pesanan ke database permanen (tabel 'pesanan')
        try {
            $pesanan = DB::transaction(function() use ($pesananPending, $alamat, $metode_pembayaran) {
                $pesanan = new Pesanan();
                $pesanan->id_pengguna         = auth()->id();
                $pesanan->id_toko             = $pesananPending->id_toko;
                $pesanan->id_alamat           = $alamat->id_alamat;
                $pesanan->total_harga_produk  = $pesananPending->total_harga_produk;
                $pesanan->biaya_pengiriman    = $pesananPending->biaya_pengiriman;
                $pesanan->metode_pembayaran   = $metode_pembayaran; // Gunakan metode dari request
                $pesanan->status_pesanan      = 'pending';
                $pesanan->tanggal_pesanan     = now();
                $pesanan->save();

                foreach ($pesananPending->items as $item) {
                    $produk = Product::find($item->id_produk);

                    $pesanan->items()->create([
                        'id_produk' => $item->id_produk,
                        'id_varian' => $item->id_varian ?? null,
                        'jumlah'    => $item->jumlah,
                        'harga_saat_pesan' => $item->harga,
                        'nama_produk_snapshot' => $produk->nama_produk ?? null,
                        'berat_per_item_kg' => $item->berat_per_item_kg ?? 0,
                    ]);

                    if($produk){
                        $produk->stok = max(0, $produk->stok - $item->jumlah);
                        $produk->terjual = ($produk->terjual ?? 0) + $item->jumlah;
                        $produk->save();
                    }
                }

                // Hapus PesananPending setelah berhasil disimpan
                $pesananPending->delete();
                
                return $pesanan;
            });
        } catch (\Exception $e) {
            Log::error("DB Transaction Failed: " . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Gagal menyimpan pesanan.', 'message' => $e->getMessage()], 500);
        }

        // Jika metode CASH, langsung kembalikan sukses
        if ($metode_pembayaran === 'cash') {
            return response()->json([
                'success' => true,
                'id_pesanan' => $pesanan->id_pesanan
            ]);
        }

        // 2. Jika metode MIDTRANS, Generate Snap Token
        try { 
            $order_id = 'ORDER-' . $pesanan->id_pesanan . '-' . time();
            $gross_amount = $pesanan->total_harga_produk + $pesanan->biaya_pengiriman;
            
            $params = [
                'transaction_details' => [
                    'order_id' => $order_id,
                    'gross_amount' => $gross_amount,
                ],
                'customer_details' => [
                    'first_name' => auth()->user()->nama_pengguna ?? 'Pengguna',
                    'email' => auth()->user()->email ?? 'email@dummy.com',
                ],
                // Anda juga bisa menambahkan 'item_details' di sini
            ];

            // Konfigurasi Midtrans
            Config::$serverKey = config('services.midtrans.server_key');
            Config::$isProduction = config('services.midtrans.is_production', false);
            Config::$isSanitized = true;
            Config::$is3ds = true;


            $snapToken = Snap::getSnapToken($params);

            // Simpan Order ID dan Snap Token jika diperlukan untuk callback atau status
            // Jika Anda memiliki tabel Transaksi, simpan di sana.
            // Jika tidak, Anda dapat menyimpannya di kolom Pesanan.
            // $pesanan->update(['snap_token' => $snapToken, 'midtrans_order_id' => $order_id]);
            
            return response()->json([
                'success' => true,
                'snap_token' => $snapToken, // Ubah key menjadi snap_token agar konsisten
                'id_pesanan' => $pesanan->id_pesanan
            ]);

        } catch (\Exception $e) {
            // Tulis error ke log
            Log::error("Midtrans Snap Error pada Pesanan ID {$pesanan->id_pesanan}: " . $e->getMessage());
            
            // Kembalikan respons 500 yang informatif ke frontend
            return response()->json([
                'success' => false,
                'error' => 'Gagal membuat token pembayaran Midtrans.',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    // =======================
    // CALLBACK MIDTRANS (Tidak Berubah)
    // =======================
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', 
            $request->order_id . 
            $request->status_code . 
            $request->gross_amount . 
            $serverKey
        );

        if ($hashed == $request->signature_key) {
            // ORDER-123-timestamp -> Ambil ID pesanan 123
            $id_pesanan = explode('-', $request->order_id)[1]; 
            $pesanan = Pesanan::find($id_pesanan);

            if ($pesanan) {
                if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                    $pesanan->status_pesanan = 'dibayar';
                } elseif ($request->transaction_status == 'pending') {
                    // Biarkan status tetap 'pending'
                    // $pesanan->status_pesanan = 'pending'; 
                } elseif ($request->transaction_status == 'cancel' || $request->transaction_status == 'expire') {
                    $pesanan->status_pesanan = 'batal';
                }
                $pesanan->save();
            }
        }

        return response()->json(['success' => true]);
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
