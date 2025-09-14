<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('loginRegist.regist.registUser'); 
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_pengguna' => 'required|string|max:100',
            'email' => 'required|email|unique:pengguna,email',
            'kata_sandi' => 'required|min:6|confirmed',
            'nama_lengkap' => 'nullable|string|max:150',
            'nomor_telepon' => 'nullable|string|max:20',
        ]);

        // buat user baru
        $user = User::create([
            'nama_pengguna' => $request->nama_pengguna,
            'email'         => $request->email,
            'kata_sandi'    => Hash::make($request->kata_sandi),
            'nama_lengkap'  => $request->nama_lengkap,
            'nomor_telepon' => $request->nomor_telepon,
            'id_role'       => 3,
        ]);

        // simpan role ke pivot pengguna_role
        $user->roles()->attach($request->role);

        return redirect()->intended('/login/user')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function showRegistSellerForm() {
        return view('loginRegist.regist.registSeller');
    }

    public function registerSeller(Request $request)
    {
        // validasi input
        $request->validate([
            'nama_pengguna' => 'required|string|max:255|unique:pengguna,nama_pengguna',
            'email' => 'required|string|email|max:255|unique:pengguna,email',
            'kata_sandi' => 'required|string|min:6|confirmed',
            'nama_lengkap' => 'nullable|string|max:255',
            'nomor_telepon' => 'nullable|string|max:20',
            'sku' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'ktp' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'no_rekening' => 'required|string|max:50',
        ]);

        // buat folder otomatis jika belum ada
        if (!Storage::disk('public')->exists('dokumen/sku')) {
            Storage::disk('public')->makeDirectory('dokumen/sku');
        }
        if (!Storage::disk('public')->exists('dokumen/ktp')) {
            Storage::disk('public')->makeDirectory('dokumen/ktp');
        }

        // simpan file
        $skuPath = $request->file('sku')->store('dokumen/sku', 'public');
        $ktpPath = $request->file('ktp')->store('dokumen/ktp', 'public');

        // buat user baru
        $user = User::create([
            'nama_pengguna' => $request->nama_pengguna,
            'email'         => $request->email,
            'kata_sandi'    => Hash::make($request->kata_sandi),
            'nama_lengkap'  => $request->nama_lengkap,
            'nomor_telepon' => $request->nomor_telepon,
            'id_role'       => 2, // seller
            'sku'           => $skuPath,
            'ktp'           => $ktpPath,
            'no_rekening'   => $request->no_rekening,
        ]);

        // simpan role ke pivot (jika pakai pivot table)
        if ($request->role) {
            $user->roles()->attach($request->role);
        }

        return redirect()->route('login')
            ->with('success', 'Registrasi seller berhasil! Silakan login.');
    }
}
