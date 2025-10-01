<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Toko;
use App\Models\Pesanan;

class SellerDashboardController extends Controller
{
    public function index()
    {
        $idSeller = auth()->id();

        // Ambil toko milik seller, sekaligus eager load produk dan pesanan beserta items-nya
        $toko = Toko::with(['produk', 'pesanan.items'])->where('id_pengguna', $idSeller)->first();

        if (!$toko) {
            // Jika belum ada toko
            return view('seller.dashboard', [
                'message' => 'Anda belum memiliki toko.',
                'pesananBelumDiproses' => 0,
                'produkTerjual' => 0,
                'totalPendapatan' => 0,
                'toko' => null
            ]);
        }

        // Hitung produk terjual (jumlah semua item)
        $produkTerjual = $toko->pesanan->sum(function($pesanan) {
            return $pesanan->items->sum('jumlah');
        });

        // Hitung jumlah pesanan belum diproses
        $pesananBelumDiproses = $toko->pesanan->where('status_pesanan', 'pending')->count();

        // Total pendapatan
        $totalPendapatan = $toko->pesanan()->sum(\DB::raw('total_harga_produk + biaya_pengiriman'));

        return view('seller.dashboard', compact(
            'toko', 'produkTerjual', 'pesananBelumDiproses', 'totalPendapatan'
        ));
    }

    public function pesanan()
    {
        $idSeller = auth()->id();
        $toko = Toko::where('id_pengguna', $idSeller)->first();

        if (!$toko) {
            return view('seller.pesanan', [
                'pesanan' => collect(),
                'message' => 'Anda belum memiliki toko.'
            ]);
        }

        $pesanan = $toko->pesanan()
            ->with(['items.produk', 'alamat', 'pembeli'])
            ->orderBy('tanggal_pesanan', 'desc')
            ->get();

        return view('seller.pesanan', compact('pesanan'));
    }

    public function selesaiPesanan($id)
    {
        $pesanan = \App\Models\Pesanan::findOrFail($id);

        // seller hanya bisa menyelesaikan jika buyer sudah menerima
        if ($pesanan->status_seller !== 'diterima') {
            return back()->with('error', 'Pesanan belum diterima oleh buyer.');
        }

        $pesanan->status_seller = 'selesai';   // status di seller
        $pesanan->status_pesanan = 'selesai';  // update status buyer juga
        $pesanan->save();

        return back()->with('success', 'Pesanan berhasil diselesaikan.');
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status_pesanan = $request->status; // ✅ pakai field sesuai DB
        $pesanan->save();

        return redirect()->route('seller.pesanan')->with('success', 'Status pesanan berhasil diperbarui!');
    }


    public function profil()
    {
        $toko = Toko::where('id_pengguna', Auth::id())->first();
        return view('seller.profil', compact('toko'));
    }

    public function updateProfil(Request $request)
    {
        $toko = Toko::where('id_pengguna', Auth::id())->first();

        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:20',
            'foto_profil' => 'nullable|image|max:2048',
            'banner_toko' => 'nullable|image|max:4096',
        ]);

        $toko->nama_toko = $request->nama_toko;
        $toko->deskripsi = $request->deskripsi;
        $toko->alamat = $request->alamat;
        $toko->kontak = $request->kontak;

        if ($request->hasFile('foto_profil')) {
            $toko->foto_profil = $request->file('foto_profil')->store('public/toko');
        }

        if ($request->hasFile('banner_toko')) {
            $toko->banner = $request->file('banner_toko')->store('public/toko');
        }

        $toko->save();

        return redirect()->back()->with('success', 'Profil toko berhasil diperbarui.');
    }

    public function show($id)
    {
        $pesanan = \App\Models\Pesanan::with(['items.produk', 'alamat', 'toko', 'pembeli'])
            ->findOrFail($id);

        return view('seller.pesanan_show', compact('pesanan'));
    }
}
