<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;



class LoginController extends Controller
{
    public function showLoginForm() {
        return view('.loginRegist.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'kata_sandi' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->kata_sandi])) {
            return redirect()->intended('/homePage/home');
        } else {
            // Tambahin debug sementara
            dd('Auth gagal');
        }


        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])-> onlyInput('email');
    }

    // Redirect user ke Google login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Callback setelah login Google
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Ambil email
        $email = $googleUser->getEmail();

        // Cek apakah email sudah ada di database
        $user = User::where('email', $email)->first();

        if (!$user) {
            // Jika belum ada, daftarkan user baru
            $user = User::create([
                'nama_pengguna' => $googleUser->getName(),
                'email' => $email,
                'kata_sandi' => bcrypt(str()->random(16)), // password random
            ]);
        }

        // Login user
        Auth::login($user);

        return redirect()->intended('/homePage/home');
    }
}
