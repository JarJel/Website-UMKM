<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bumdes;
use App\Models\Toko;
use App\Models\Kategori;
use App\Models\VerifikasiToko;
use App\Models\User;

class BumdesController extends Controller
{
    /**
     * Dashboard BUMDES
     */
    public function dashboard()
    {
        $user = Auth::user();

        $bumdes = Bumdes::where('id_pengguna', $user->id_pengguna)->first();
        $id_bumdes = $bumdes->id_bumdes ?? null;

        $totalToko = Toko::where('id_bumdes', $id_bumdes)->count();

        $tokoTerverifikasi = VerifikasiToko::where('status_verifikasi', 'approved')
            ->whereHas('toko', fn($q) => $q->where('id_bumdes', $id_bumdes))
            ->count();

        $tokoPending = VerifikasiToko::where('status_verifikasi', 'pending')
            ->whereHas('toko', fn($q) => $q->where('id_bumdes', $id_bumdes))
            ->count();

        $tokoDitolak = VerifikasiToko::where('status_verifikasi', 'rejected')
            ->whereHas('toko', fn($q) => $q->where('id_bumdes', $id_bumdes))
            ->count();

        $aktivitasTerbaru = VerifikasiToko::with('toko.user')
            ->whereHas('toko', fn($q) => $q->where('id_bumdes', $id_bumdes))
            ->orderBy('tanggal_verifikasi', 'desc')
            ->take(5)
            ->get();

        return view('bumdes.dashboardBumdes', compact(
            'user',
            'bumdes',
            'totalToko',
            'tokoTerverifikasi',
            'tokoPending',
            'tokoDitolak',
            'aktivitasTerbaru'
        ));
    }

    /**
     * Halaman verifikasi toko
     */
    public function verifikasi()
    {
        $user = Auth::user();
        $bumdes = Bumdes::where('id_pengguna', $user->id_pengguna)->first();
        $id_bumdes = $bumdes->id_bumdes ?? null;

        $businesses = Toko::where('id_bumdes', $id_bumdes)
            ->with(['verifikasi' => fn($q) => $q->latest('tanggal_verifikasi'), 'user', 'kategori'])
            ->paginate(10);

        return view('bumdes.verifikasi_seller', compact(
            'businesses'
        ));
    }

    /**
     * Approve verifikasi toko
     */
    public function approve($id)
{
    $verifikasi = VerifikasiToko::findOrFail($id);
    $verifikasi->status_verifikasi = 'approved';
    $verifikasi->save();

    return redirect()->route('bumdes.verifikasi')
                     ->with('success', 'Usaha berhasil disetujui.');
}

public function reject($id)
{
    $verifikasi = VerifikasiToko::findOrFail($id);
    $verifikasi->status_verifikasi = 'rejected';
    $verifikasi->save();

    return redirect()->route('bumdes.verifikasi')
                     ->with('success', 'Usaha berhasil ditolak.');
}


    /**
     * Detail verifikasi toko
     */
    public function showVerifikasi($id)
    {
        $verifikasi = VerifikasiToko::with('toko.user', 'toko.kategori')->findOrFail($id);
        return view('backend.Bumdes.verifikasi_detail', compact('verifikasi'));
    }

    /**
     * Daftar usaha
     */
    public function daftarUsaha()
    {
        $user = Auth::user();
        $bumdes = Bumdes::where('id_pengguna', $user->id_pengguna)->first();
        $id_bumdes = $bumdes->id_bumdes ?? null;

        $usaha = Toko::where('id_bumdes', $id_bumdes)
            ->with(['user', 'kategori'])
            ->get();

        return view('bumdes.daftarUsaha', compact('usaha'));
    }

    /**
     * Manajemen Seller
     */
    public function manajemenSeller()
    {
        $user = Auth::user();
        $bumdes = Bumdes::where('id_pengguna', $user->id_pengguna)->first();
        $id_bumdes = $bumdes->id_bumdes ?? null;

        $sellers = User::whereHas('toko', fn($q) => $q->where('id_bumdes', $id_bumdes))->get();

        return view('backend.Bumdes.manajemenSeller', compact('sellers'));
    }

    /**
     * Laporan & Transaksi
     */
    public function transaksiLaporan()
    {
        $user = Auth::user();
        $bumdes = Bumdes::where('id_pengguna', $user->id_pengguna)->first();
        $id_bumdes = $bumdes->id_bumdes ?? null;

        $transaksi = VerifikasiToko::whereHas('toko', fn($q) => $q->where('id_bumdes', $id_bumdes))
            ->with('toko.user')
            ->orderBy('tanggal_verifikasi', 'desc')
            ->get();

        return view('backend.Bumdes.laporan', compact('transaksi'));
    }

    /**
     * Arsip & Dokumen
     */
    public function arsipDokumen()
    {
        $user = Auth::user();
        $bumdes = Bumdes::where('id_pengguna', $user->id_pengguna)->first();

        return view('backend.Bumdes.arsip', compact('bumdes'));
    }

    /**
     * Profil BUMDES
     */
    public function profil()
    {
        $user = Auth::user();
        $bumdes = Bumdes::where('id_pengguna', $user->id_pengguna)->first();

        return view('backend.Bumdes.profil', compact('bumdes', 'user'));
    }
}
