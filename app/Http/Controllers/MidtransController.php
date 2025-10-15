<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function createTransaction(Request $request, $id)
    {
        try {
            $pesanan = Pesanan::findOrFail($id);

            // Konfigurasi Midtrans
            Config::$serverKey = config('services.midtrans.server_key');
            Config::$isProduction = config('services.midtrans.is_production', false);
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // Detail transaksi
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
            ];

            $snapToken = Snap::getSnapToken($params);

            // Simpan snap token ke database (opsional)
            $pesanan->update(['snap_token' => $snapToken]);

            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'id_pesanan' => $pesanan->id_pesanan
            ]);

        } catch (\Exception $e) {
            Log::error("Midtrans Error pada Pesanan ID {$id}: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Gagal membuat token pembayaran Midtrans.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
