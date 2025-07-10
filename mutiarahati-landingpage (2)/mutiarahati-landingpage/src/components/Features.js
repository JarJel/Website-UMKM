"use client";
import React from "react";
import {
  ClipboardCheck,
  CheckCircle,
  FileText,
  Sparkles,
} from "lucide-react";

const features = [
  {
    icon: <ClipboardCheck className="w-8 h-8 text-primary" />,
    title: "Attendance Report",
    description:
      "Digunakan untuk memantau dan merekap kehadiran guru secara berkala.",
  },
  {
    icon: <CheckCircle className="w-8 h-8 text-primary" />,
    title: "Mutaba`ah",
    description:
      "Mendukung pelaporan aktivitas ibadah guru dalam rangka pembinaan spiritual.",
  },
  {
    icon: <FileText className="w-8 h-8 text-primary" />,
    title: "Journal Report",
    description:
      "Mencatat dan merangkum aktivitas kerja guru pada setiap sesi pembelajaran.",
  },
];

export default function Features() {
  return (
    <section className="py-20 bg-white text-[#333992] relative overflow-hidden">
      <div className="absolute top-0 left-0 w-full h-full">
        <div className="absolute top-20 right-10 w-64 h-64 bg-[#333992]/5 rounded-full blur-3xl"></div>
        <div className="absolute bottom-20 left-10 w-48 h-48 bg-[#ffde59]/20 rounded-full blur-2xl"></div>
      </div>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div className="text-center mb-16">
          <div className="inline-flex items-center bg-[#333992]/10 text-[#333992] px-4 py-2 rounded-full text-sm font-medium mb-4">
            <Sparkles className="w-4 h-4 mr-2" />
            Fitur Unggulan Kami
          </div>
          <h2 className="text-4xl font-bold mb-4">
            Teknologi Manajemen Sekolah
          </h2>
          <p className="text-xl text-gray-600">
            Merancang sistem pendidikan untuk masa depan yang lebih cerah
          </p>
        </div>
        <div className="grid md:grid-cols-3 gap-8">
          {features.map((feature, index) => (
            <div
              key={index}
              className="group bg-white border-2 border-[#333992]/10 p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105 hover:border-[#333992]/30 relative overflow-hidden"
            >
              <div className="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-[#ffde59]/20 to-transparent rounded-full -mr-10 -mt-10"></div>
              <div className="mb-6 p-3 bg-[#333992]/10 rounded-xl inline-block group-hover:bg-[#333992] group-hover:text-white transition-colors duration-300">
                {feature.icon}
              </div>
              <h3 className="text-xl font-bold mb-3">{feature.title}</h3>
              <p className="text-gray-600 leading-relaxed">
                {feature.description}
              </p>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}