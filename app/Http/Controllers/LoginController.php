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
            'EMAIL_USER' => 'required|email',
            'PASSWORD_USER' => 'required'
        ]);

        if (Auth::attempt(['EMAIL_USER' => $request->EMAIL_USER, 'password' => $request->PASSWORD_USER])) {
            return redirect()->intended('/homePage/home');
        } else {
            // Tambahin debug sementara
            dd('Auth gagal');
        }


        return back()->withErrors([
            'EMAIL_USER' => 'Email atau password salah',
        ])-> onlyInput('EMAIL_USER');
    }
}
