<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BumdesController extends Controller
{
    public function dashboard()
    {
        return view('bumdes.dashboard_bumdes');
    }

    public function verifikasiSeller()
    {
        return view('bumdes.verifikasi_seller');
    }

    public function daftarUsaha()
    {
        return view('bumdes.daftar_usaha');
    }

    public function manajemenSeller()
    {
        return view('bumdes.manajemen_seller');
    }

    public function transaksiLaporan()
    {
        return view('bumdes.transaksi_laporan');
    }

    public function arsipDokumen()
    {
        return view('bumdes.arsip_dokumen');
    }

    public function profil()
    {
        return view('bumdes.profil');
    }
}
