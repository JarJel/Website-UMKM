<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset', ['token' => $token, 'email' => $request->email]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $status = Password::reset(
            $request->only('email','password','password_confirmation','token'),
            function ($user, $password) {
                $user->kata_sandi = Hash::make($password); // kolom password di db kamu
                $user->save();
            }
        );

        if($status == Password::PASSWORD_RESET){
            return redirect()->route('login')->with('status', 'Password berhasil direset!');
        }

        return back()->withErrors(['email' => 'Gagal reset password.']);
    }
}
