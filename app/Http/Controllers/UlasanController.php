<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ulasan;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,id_produk',
            'rating' => 'required|integer|min:1|max:5',
            'komentar_ulasan' => 'nullable|string|max:500'
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        Ulasan::create([
            'id_produk' => $request->id_produk,
            'id_pengguna' => $user->id_pengguna,
            'rating' => $request->rating,
            'komentar_ulasan' => $request->komentar_ulasan,
            'tanggal_ulasan' => now()
        ]);

        return back()->with('success', 'Terima kasih atas ulasan Anda!');
    }
}
