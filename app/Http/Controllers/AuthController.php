<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // 1️⃣ Form registrasi
    public function showRegisterForm() {
        return view('loginRegist.regist.registUser');
    }

    // 2️⃣ Proses register → kirim OTP
    public function register(Request $request) {
        $request->validate([
            'nama_pengguna' => 'required|string|max:100',
            'email' => 'required|email|unique:pengguna,email',
            'kata_sandi' => 'required|min:6|confirmed',
        ]);

        $code = mt_rand(100000, 999999); // generate 6 digit OTP

        $user = User::create([
            'nama_pengguna' => $request->nama_pengguna,
            'email' => $request->email,
            'kata_sandi' => Hash::make($request->kata_sandi),
            'id_role' => 1,
            'verification_code' => $code,
        ]);

        // Kirim email OTP
        $url = route('verify.code.form', ['email' => $user->email]);
        Mail::send('Auth.emails.otp-email', ['code'=>$code,'nama'=>$user->nama_pengguna], function($message) use ($user){
            $message->to($user->email);
            $message->subject('Kode Verifikasi Email');
        });

        return redirect()->route('verify.code.form', ['email'=>$user->email])
            ->with('success','Kode verifikasi telah dikirim ke email Anda.');
    }

    // 3️⃣ Form input kode OTP
    public function showVerifyCodeForm(Request $request) {
        $email = $request->query('email');
        return view('loginRegist.regist.verifyCode', compact('email'));
    }

    // 4️⃣ Proses verifikasi kode
    public function verifyCode(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:6'
        ]);

        $user = User::where('email', $request->email)
                    ->where('verification_code', $request->code)
                    ->first();

        if(!$user){
            return back()->withErrors(['code'=>'Kode verifikasi salah']);
        }

        // tandai email verified, hapus kode, login otomatis
        $user->email_verified_at = now();
        $user->verification_code = null;
        $user->save();

        Auth::login($user);

        return redirect()->route('home')->with('success','Registrasi berhasil! Selamat datang 👋');
    }
}
