"use client";

import Navbar from "@/components/Navbar";
import Hero from "@/components/Hero";
import Features from "@/components/Features";
import DataAnalytics from "@/components/DataAnalytics";
import Portal from "@/components/Portal";
import Footer from "@/components/Footer";
import { Users } from "lucide-react";

const achievementStats = [
  { number: "500+", label: "Siswa Aktif", icon: <Users className="w-6 h-6" /> },
  { number: "95%", label: "Kehadiran Siswa PerBulan", icon: <Users className="w-6 h-6" /> },
  { number: "50+", label: "Guru Aktif", icon: <Users className="w-6 h-6" /> },
  { number: "100%", label: "Kehadiran Guru PerBulan", icon: <Users className="w-6 h-6" /> },
];

const StatCard = ({ stat }) => (
  <div className="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
    <div className="flex justify-center mb-3 text-[#ffde59]">{stat.icon}</div>
    <div className="text-3xl font-bold text-white mb-2">{stat.number}</div>
    <div className="text-white/80 text-sm">{stat.label}</div>
  </div>
);

export default function MutiaraHatiLanding() {
  return (
    <div className="min-h-screen bg-[#333992] text-white">
      <Navbar />
      <main>
        <Hero />
        <section className="py-16 bg-[#333992]">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div className="grid grid-cols-2 md:grid-cols-4 gap-6">
              {achievementStats.map((stat, index) => (
                <StatCard key={index} stat={stat} />
              ))}
            </div>
          </div>
        </section>
        <Features />
        <DataAnalytics />
        <Portal />
      </main>
      <Footer />
    </div>
  );
}
