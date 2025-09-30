<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class AdminTransaksi extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::all();

        return view('backend.superadmin.AdminTransaksi', compact('transaksi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'jumlah'    => 'required|numeric',
            'status'    => 'required|in:pending,selesai',
        ]);

        Transaksi::create($request->all());

        return redirect()->back()->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->back()->with('success', 'Transaksi berhasil dihapus.');
    }
}
