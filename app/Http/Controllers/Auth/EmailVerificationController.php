<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    public function notice() {
        return view('Auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/home'); // redirect setelah verifikasi
    }

    public function resend(Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'Link verifikasi baru telah dikirim!');
    }
}
