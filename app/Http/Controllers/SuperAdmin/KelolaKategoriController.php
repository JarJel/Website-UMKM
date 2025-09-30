<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KelolaKategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('backend.superadmin.kelola-kategori', compact('kategori'));
    }

    public function storeKategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'slug_kategori' => Str::slug($request->nama_kategori),
        ]);

        return back()->with('success', 'Kategori baru berhasil ditambahkan!');
    }
}
