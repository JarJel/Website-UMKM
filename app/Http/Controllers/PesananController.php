<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Ulasan;
use Carbon\Carbon;


class PesananController extends Controller
{
    public function terima($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // hanya user yang memiliki pesanan bisa menandai diterima
        if ($pesanan->id_pengguna !== auth()->id()) {
            abort(403);
        }

        $pesanan->status_pesanan = 'selesai';
        $pesanan->is_diterima = true; // tambahkan ini
        $pesanan->save();

        return redirect()->back()->with('success', 'Pesanan berhasil diterima.');
    }

public function ulasan(Request $request, $id)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'komentar' => 'required|string|max:500'
    ]);

    $pesanan = \App\Models\Pesanan::with('items')->findOrFail($id);
    $user = auth()->user();

    // Ambil produk pertama dari pesanan (kalau hanya 1 produk)
    $produkId = $pesanan->items->first()->id_produk ?? null;

    if (!$produkId) {
        return back()->with('error', 'Tidak dapat menemukan produk untuk ulasan.');
    }

    // Cegah user mengirim ulang ulasan
    $sudahAda = \App\Models\Ulasan::where('id_produk', $produkId)
        ->where('id_pengguna', $user->id_pengguna)
        ->exists();

    if ($sudahAda) {
        return back()->with('error', 'Anda sudah memberikan ulasan untuk produk ini.');
    }

    // Simpan ulasan baru
    \App\Models\Ulasan::create([
        'id_produk' => $produkId,
        'id_pengguna' => $user->id_pengguna,
        'rating' => $request->rating,
        'komentar_ulasan' => $request->komentar,
        'tanggal_ulasan' => now(),
    ]);

    return redirect()->route('pesanan.tracking')->with('success', 'Ulasan berhasil dikirim!');
}



    public function tracking()
    {
        $user = auth()->user();

        $pesananList = \App\Models\Pesanan::with(['items.produk', 'alamat', 'ulasan'])
            ->where('id_pengguna', $user->id_pengguna)
            ->get();

        return view('pesanan.tracking', compact('pesananList'));
    }


}
