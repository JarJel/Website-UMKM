<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;

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

}
