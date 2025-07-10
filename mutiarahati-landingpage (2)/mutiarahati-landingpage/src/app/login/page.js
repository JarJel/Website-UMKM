"use client";
import { signIn } from "next-auth/react";

export default function LoginPage() {
  return (
    <div className="min-h-screen flex items-center justify-center bg-[#333992] text-white">
      <div className="text-center space-y-6">
        <h1 className="text-3xl font-bold">Selamat Datang di Mutiara Hati</h1>
        <p className="text-white/80">Silakan login dengan akun Google terdaftar</p>
        <button
          onClick={() => signIn("google", { prompt: "select_account" })}
          className="bg-yellow-400 hover:bg-yellow-300 text-black font-semibold py-2 px-6 rounded-full transition"
        >
          Login dengan Google
        </button>
      </div>
    </div>
  );
}
