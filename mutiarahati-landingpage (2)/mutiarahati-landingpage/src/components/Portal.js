"use client";
import React from "react";
import { School, Play } from "lucide-react";

export default function Portal() {
  return (
    <section className="py-20 bg-[#333992] text-white relative overflow-hidden">
      <div className="absolute top-0 left-0 w-72 h-72 bg-yellow-400 opacity-20 rounded-full blur-3xl -z-10"></div>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-12">
          <h2 className="text-4xl font-bold mb-4">Platform Portal Sistem</h2>
          <p className="text-xl text-yellow-100">
            Pilih jenjang pendidikan untuk mengelola sistem di Mutiara Hati
          </p>
        </div>

        <div className="grid md:grid-cols-3 gap-8">
          <div className="group bg-white rounded-2xl shadow-lg overflow-hidden transition-all hover:scale-105 duration-300 relative">
            <div className="flex items-center justify-center px-6 pt-6">
              <div className="w-24 h-24 bg-[#ffde59]/20 rounded-full flex items-center justify-center">
                <School className="w-12 h-12 text-[#ffde59]" />
              </div>
            </div>
            <div className="p-6">
              <h3 className="text-2xl font-bold text-[#ffde59] mb-2">
                TK - Mutiara Hati
              </h3>
              <p className="text-gray-600 mb-4">
                Manajemen pembelajaran anak usia dini, absensi, laporan
                perkembangan, dan komunikasi orang tua.
              </p>
              <button
                onClick={() =>
                  window.open(
                    "https://sites.google.com/view/mutiarahati-tk",
                    "_blank"
                  )
                }
                className="w-full bg-[#ffde59] text-[#333992] px-6 py-3 rounded-full hover:bg-[#facc15] transition font-medium flex items-center justify-center group"
              >
                Masuk ke Platform TK
                <Play className="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" />
              </button>
            </div>
          </div>
          <div className="group bg-white rounded-2xl shadow-lg overflow-hidden transition-all hover:scale-105 duration-300">
            <div className="flex items-center justify-center px-6 pt-6">
              <div className="w-24 h-24 bg-[#2e884a]/20 rounded-full flex items-center justify-center">
                <School className="w-12 h-12 text-[#2e884a]" />
              </div>
            </div>
            <div className="p-6">
              <h3 className="text-2xl font-bold text-[#2e884a] mb-2">
                Unit Persiapan - Mutiara Hati
              </h3>
              <p className="text-gray-600 mb-4">
                Manajemen pembelajaran Unit Persiapan, absensi, laporan
                perkembangan, dan komunikasi orang tua.
              </p>
              <button
                onClick={() =>
                  window.open(
                    "https://sites.google.com/view/mutiarahati-sd",
                    "_blank"
                  )
                }
                className="w-full bg-[#2e884a] text-white px-6 py-3 rounded-full hover:bg-green-700 transition font-medium flex items-center justify-center group"
              >
                Masuk ke Platform Persiapan
                <Play className="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" />
              </button>
            </div>
          </div>
          <div className="group bg-white rounded-2xl shadow-lg overflow-hidden transition-all hover:scale-105 duration-300">
            <div className="flex items-center justify-center px-6 pt-6">
              <div className="w-24 h-24 bg-[#c81b18]/20 rounded-full flex items-center justify-center">
                <School className="w-12 h-12 text-[#c81b18]" />
              </div>
            </div>
            <div className="p-6">
              <h3 className="text-2xl font-bold text-[#c81b18] mb-2">
                SD Mutiara Hati
              </h3>
              <p className="text-gray-600 mb-4">
                Manajemen pembelajaran anak sekolah dasar, absensi, laporan
                perkembangan, dan komunikasi orang tua.
              </p>
              <button
                onClick={() =>
                  window.open(
                    "https://sites.google.com/view/mutiarahati-sd",
                    "_blank"
                  )
                }
                className="w-full bg-[#c81b18] text-white px-6 py-3 rounded-full hover:bg-red-700 transition font-medium flex items-center justify-center group"
              >
                Masuk ke Platform SD
                <Play className="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" />
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}