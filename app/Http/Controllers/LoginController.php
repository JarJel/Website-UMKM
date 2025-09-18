<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('loginRegist.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'kata_sandi' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->kata_sandi])) {
            $request->session()->regenerate(); // penting untuk keamanan session fixation

            $user = Auth::user();

            // Redirect berdasarkan role
            if ($user->id_role === 2) {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->id_role === 3) {
                return redirect()->route('seller.dashboard');
            } else {
                return redirect()->intended('/homePage/home');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // invalidate session biar benar-benar keluar
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda berhasil logout.');
    }

}
