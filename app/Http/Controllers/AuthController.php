<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
}
