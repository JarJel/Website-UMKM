"use client";
import React from "react";
import { BookOpen, Clock, Calendar } from "lucide-react";

export default function Navbar() {
  return (
    <div className="bg-[#ffde59] backdrop-blur-md fixed w-full top-0 z-50 border-b border-blue-100">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex justify-between items-center h-16">
          <div className="flex items-center space-x-3">
            <div className="w-40 h-10 ml-13 bg-gradient-to-br from-#ffffff-600 to-#ffffff-600 rounded-full flex items-center justify-center">
              <image src="/images/logo.png" alt="Mutiara Hati Logo" />
            </div>
          </div>
            <button
              onClick={() => signOut({ callbackUrl: "/login" })}
              className="bg-yellow-400 text-black px-4 py-1 rounded"
            >
              Logout
            </button>
        </div>
      </div>
    </div>
  );
}