"use client";
import { useEffect } from "react";
import { signOut } from "next-auth/react";

export default function LogoutPage() {
  useEffect(() => {
    signOut({ callbackUrl: "/login" }); // setelah logout, kembali ke /login
  }, []);

  return <p className="text-center mt-20 text-white">Melakukan logout...</p>;
}
