<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm() {
        return view('login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'kata_sandi' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->email])) {
            return redirect()->intended('/homePage/home');
        } else {
            // Tambahin debug sementara
            dd('Auth gagal');
        }


        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])-> onlyInput('email');
    }
}
