"use client";
import React from "react";

export default function Footer() {
  return (
    <footer className="bg-gray-900 text-white py-12">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid md:grid-cols-4 gap-8">
          <div>
            <div className="flex items-center space-x-3 mb-4">
              <div className="w-40 h-10 bg-gradient-to-br from-#ffffff-600 to-#ffffff-600 rounded-full flex items-center justify-center">
                <image src="/images/logo.png" alt="Mutiara Hati Logo" />
              </div>
            </div>
            <p className="text-gray-400">
              Platform pembelajaran digital terdepan untuk generasi masa
              depan.
            </p>
          </div>

          <div>
            <h4 className="text-lg font-semibold mb-4">Platform</h4>
            <ul className="space-y-2 text-gray-400">
              <li>
                <a href="#" className="hover:text-white transition-colors">
                  Dashboard
                </a>
              </li>
              <li>
                <a href="#" className="hover:text-white transition-colors">
                  Kelas Online
                </a>
              </li>
              <li>
                <a href="#" className="hover:text-white transition-colors">
                  Tugas & Quiz
                </a>
              </li>
              <li>
                <a href="#" className="hover:text-white transition-colors">
                  Laporan
                </a>
              </li>
            </ul>
          </div>

          <div>
            <h4 className="text-lg font-semibold mb-4">Dukungan</h4>
            <ul className="space-y-2 text-gray-400">
              <li>
                <a href="#" className="hover:text-white transition-colors">
                  Bantuan
                </a>
              </li>
              <li>
                <a href="#" className="hover:text-white transition-colors">
                  Tutorial
                </a>
              </li>
              <li>
                <a href="#" className="hover:text-white transition-colors">
                  FAQ
                </a>
              </li>
              <li>
                <a href="#" className="hover:text-white transition-colors">
                  Kontak
                </a>
              </li>
            </ul>
          </div>

          <div>
            <h4 className="text-lg font-semibold mb-4">Koneksi</h4>
            <ul className="space-y-2 text-gray-400">
              <li>
                <button
                  onClick={() => window.open("#", "_blank")}
                  className="hover:text-white transition-colors"
                >
                  Portal Sekolah
                </button>
              </li>
              <li>
                <button
                  onClick={() => window.open("#", "_blank")}
                  className="hover:text-white transition-colors"
                >
                  Google Drive
                </button>
              </li>
              <li>
                <a href="#" className="hover:text-white transition-colors">
                  Google Classroom
                </a>
              </li>
              <li>
                <a href="#" className="hover:text-white transition-colors">
                  Workspace
                </a>
              </li>
            </ul>
          </div>
        </div>

        <div className="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
          <p>&copy; 2025 PT.Kibar SmartSchool System.</p>
        </div>
      </div>
    </footer>
  );
}