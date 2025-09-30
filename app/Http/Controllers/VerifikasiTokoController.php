<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\VerifikasiToko;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifikasiTokoController extends Controller
{
    /**
     * Tampilkan semua pengajuan verifikasi toko.
     * 
     
     */

    
    public function index()
    {
        $user = Auth::user();
        $bumdes = $user->bumdes;
        $id_bumdes = $bumdes->id_bumdes ?? null;

        $pengajuan = VerifikasiToko::with('toko.user')
            ->whereHas('toko', fn($q) => $q->where('id_bumdes', $id_bumdes))
            ->orderBy('created_at', 'desc')
            ->get();

        $categories = \App\Models\Kategori::where('id_bumdes', $id_bumdes)->get();

        return view('bumdes.verifikasi_seller', compact('pengajuan', 'categories'));
    }

public function verifikasi()
{
    $user = Auth::user();
    $bumdes = $user->bumdes;

    if (!$bumdes) {
        // Jika user belum punya BUMDES, redirect atau tampilkan pesan
        return redirect()->back()->with('error', 'Anda belum terdaftar sebagai BUMDES.');
    }

    $id_bumdes = $bumdes->id_bumdes;

    // Ambil toko dengan verifikasi pending
    $businesses = Toko::where('id_bumdes', $id_bumdes)
        ->whereHas('verifikasi', fn($q) => $q->where('status_verifikasi', 'pending'))
        ->with(['user', 'kategori'])
        ->paginate(10);

    // Ambil kategori yang terkait dengan BUMDES
    $categories = \App\Models\Kategori::where('id_bumdes', $id_bumdes)->get();

    // Hitung jumlah pengajuan pending
    $totalPendingBusinesses = VerifikasiToko::whereHas('toko', fn($q) => $q->where('id_bumdes', $id_bumdes))
        ->where('status_verifikasi', 'pending')
        ->count();

    return view('bumdes.verifikasi_seller', compact(
        'businesses',
        'categories',
        'totalPendingBusinesses'
    ));
}


    /**
     * Tampilkan detail satu pengajuan verifikasi.
     */
    public function show($id)
    {
        $verifikasi = VerifikasiToko::with('toko.user')->findOrFail($id);

        return view('bumdes.verifikasi.show', compact('verifikasi'));
    }

    /**
     * Setujui pengajuan verifikasi.
     */
    public function approve(Request $request, $id)
    {
        $verifikasi = VerifikasiToko::with('toko')->findOrFail($id);

        $verifikasi->update([
            'status_verifikasi' => 'disetujui',
            'catatan_admin' => $request->catatan,
            'tanggal_verifikasi' => now(),
        ]);

        // Update status toko agar terverifikasi
        $verifikasi->toko->update(['terverifikasi' => true]);

        return redirect()->route('bumdes.verifikasi.index')
            ->with('success', 'Pengajuan berhasil disetujui.');
    }

    /**
     * Tolak pengajuan verifikasi.
     */
    public function reject(Request $request, $id)
    {
        $verifikasi = VerifikasiToko::findOrFail($id);

        $verifikasi->update([
            'status_verifikasi' => 'ditolak',
            'catatan_admin' => $request->catatan,
            'tanggal_verifikasi' => now(),
        ]);

        return redirect()->route('bumdes.verifikasi.index')
            ->with('success', 'Pengajuan berhasil ditolak.');
    }
}
