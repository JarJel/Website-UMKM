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

        // Ambil data bumdes sesuai user login
        $bumdes = Bumdes::where('id_pengguna', $user->id_pengguna)->first();
        $id_bumdes = $bumdes->id_bumdes ?? null;

        // Statistik
        $totalToko = Toko::where('id_bumdes', $id_bumdes)->count();

        $tokoTerverifikasi = VerifikasiToko::where('status_verifikasi', 'disetujui')
            ->whereHas('toko', fn($q) => $q->where('id_bumdes', $id_bumdes))
            ->count();

        $tokoPending = VerifikasiToko::where('status_verifikasi', 'pending')
            ->whereHas('toko', fn($q) => $q->where('id_bumdes', $id_bumdes))
            ->count();

        $tokoDitolak = VerifikasiToko::where('status_verifikasi', 'ditolak')
            ->whereHas('toko', fn($q) => $q->where('id_bumdes', $id_bumdes))
            ->count();

        // 5 Aktivitas verifikasi terbaru
        $aktivitasTerbaru = VerifikasiToko::with('toko.user') // ganti 'pengguna' jadi 'user'
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
            ->whereHas('verifikasi', fn($q) => $q->where('status_verifikasi', 'pending'))
            ->with(['user', 'kategori']) // ganti 'pengguna' jadi 'user'
            ->paginate(10);

        $totalPendingBusinesses = $businesses->total();
        $categories = Kategori::where('id_bumdes', $id_bumdes)->get();

        return view('backend.Bumdes.verifikasi', compact(
            'businesses',
            'totalPendingBusinesses',
            'categories'
        ));
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
            ->with(['user', 'kategori']) // ganti 'pengguna' jadi 'user'
            ->get();

        return view('backend.Bumdes.daftarUsaha', compact('usaha'));
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
            ->with('toko.user') // ganti 'pengguna' jadi 'user'
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
