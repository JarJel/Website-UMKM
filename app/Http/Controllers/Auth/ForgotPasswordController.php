<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    
    public function showLinkRequestForm()
{
    return view('Auth.passwords.email'); // path ke form lupa password
}

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak terdaftar.']);
        }

        // Generate token reset password
        $token = Password::getRepository()->create($user);

        // Build link reset
        $url = url(route('password.reset', ['token' => $token, 'email' => $user->email], false));

        // Kirim email
        Mail::to($user->email)->send(new ResetPasswordMail($url));

        return back()->with('status', 'Email reset password terkirim!');
    }
}
