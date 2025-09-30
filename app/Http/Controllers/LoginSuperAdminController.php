<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginSuperAdminController extends Controller
{
    public function showLoginForm()
    {
        return view('loginRegist.loginSuperAdmin'); // bikin view khusus untuk superadmin
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'kata_sandi' => 'required|min:6'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->kata_sandi])) {
            $request->session()->regenerate();

            if (Auth::user()->id_role == 4) {
                return redirect()->intended('/superadmin/dashboard')
                                 ->with('success', 'Login berhasil sebagai Super Admin!');
            }

            Auth::logout();
            return back()->withErrors(['akses' => 'Hanya superadmin yang boleh login di sini.']);
        }

        return back()->withErrors(['login' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('superadmin.login')->with('success', 'Anda berhasil logout.');
    }
}
