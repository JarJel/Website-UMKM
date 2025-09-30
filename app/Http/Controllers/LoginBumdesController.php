<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginBumdesController extends Controller
{
    // Menampilkan form login BUMDES
    public function showLoginForm()
    {
        return view('loginRegist.loginBumdes'); // sesuaikan dengan path view
    }

    // Login BUMDES
    public function login(Request $request)
    {
        // 1️⃣ Validasi input
        $request->validate([
            'email' => 'required|email',
            'kata_sandi' => 'required|min:6'
        ]);

        // 2️⃣ Cari user berdasarkan email
        $user = User::where('email', $request->email)
                    ->where('id_role', 3) // pastikan hanya BUMDES
                    ->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan untuk akun BUMDES.'
            ])->withInput();
        }

        // 3️⃣ Cek password
        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->kata_sandi
        ])) {
            return back()->withErrors([
                'kata_sandi' => 'Password salah, silakan coba lagi.'
            ])->withInput();
        }

        // 4️⃣ Login berhasil, regenerate session
        $request->session()->regenerate();

        return redirect()->intended('/bumdes/dashboard')
                         ->with('success', 'Login berhasil sebagai BUMDES!');
    }

    // Logout BUMDES
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('bumdes.login')
                         ->with('success', 'Anda berhasil logout.');
    }
}
