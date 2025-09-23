<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('loginRegist.login'); // pastikan path view sesuai
    }

    // Login
    public function login(Request $request)
    {
        // 1️⃣ Validasi input
        $request->validate([
            'email' => 'required|email',
            'kata_sandi' => 'required|min:6'
        ]);

        // 2️⃣ Cek apakah user ada
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // User tidak ditemukan
            return back()->withErrors([
                'email' => 'Email tidak ditemukan di sistem.'
            ])->withInput();
        }

        // 3️⃣ Cek password menggunakan Auth::attempt
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->kata_sandi])) {
            // Password salah
            return back()->withErrors([
                'kata_sandi' => 'Password salah, silakan coba lagi.'
            ])->withInput();
        }

        // 4️⃣ Login berhasil
        $request->session()->regenerate(); // mencegah session fixation

        return redirect()->intended('/homePage/home')->with('success', 'Login berhasil!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }
}
