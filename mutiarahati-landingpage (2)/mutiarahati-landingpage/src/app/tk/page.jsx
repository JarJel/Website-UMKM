// app/tk/page.jsx
"use client";

import { useSession, signIn, signOut } from "next-auth/react";
import MutiaraHatiLanding from "../page.js";

export default function TKPage() {
  const { data: session, status } = useSession();

  if (status === "loading") return <div className="text-center mt-10">Loading...</div>;

  if (!session) {
    return (
      <div className="min-h-screen flex items-center justify-center bg-[#333992] text-white">
        <div className="text-center space-y-6">
          <h1 className="text-3xl font-bold">Selamat Datang di Mutiara Hati</h1>
          <p className="text-white/80">Silakan login dengan akun Google terdaftar</p>
          <button onClick={() => signIn("google", { prompt: "select_account" })} className="bg-yellow-400 hover:bg-yellow-300 text-black font-semibold py-2 px-6 rounded-full transition">
            Login dengan Google
          </button>
        </div>
      </div>
    );
  }

  return (
    <div>
      <nav className="flex justify-between items-center p-4 bg-white shadow-md">
        <span className="font-bold text-[#333992]">Mutiara Hati</span>
        <button onClick={() => signOut()} className="bg-red-500 hover:bg-red-400 text-white font-medium py-1 px-4 rounded">
          Logout
        </button>
      </nav>

      {/* Landing Page atau konten utama */}
      <MutiaraHatiLanding user={session.user} />
    </div>
  );
}
