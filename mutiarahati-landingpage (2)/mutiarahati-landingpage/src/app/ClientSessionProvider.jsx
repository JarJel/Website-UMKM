// app/ClientSessionProvider.jsx
"use client"; // PENTING: Tandai ini sebagai client component

import { SessionProvider } from "next-auth/react";

export default function ClientSessionProvider({ children }) {
  return <SessionProvider>{children}</SessionProvider>;
}