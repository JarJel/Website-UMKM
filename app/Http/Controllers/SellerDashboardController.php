<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toko;

class SellerDashboardController extends Controller
{
    public function index()
{
    $idSeller = auth()->id();

    // Ambil toko milik seller
    $toko = Toko::where('id_pengguna', $idSeller)->first();

    if (!$toko) {
        return view('seller.dashboard', [
            'pesanan' => collect(),
            'message' => 'Anda belum memiliki toko.'
        ]);
    }

    // Ambil pesanan beserta detail dan produk
    $pesanan = $toko->pesanan()
        ->with(['detail.produk']) // eager load relasi
        ->orderBy('created_at', 'desc')
        ->get();

    return view('seller.pesanan', compact('pesanan'));
}

}
