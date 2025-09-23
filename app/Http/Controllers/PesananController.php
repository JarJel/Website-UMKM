<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;

class PesananController extends Controller
{
    public function tracking($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        return view('pesanan.tracking', compact('pesanan'));
    }
}
