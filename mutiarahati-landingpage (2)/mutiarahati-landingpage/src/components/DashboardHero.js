"use client";
import React, { useEffect, useState } from "react";
// Impor komponen Image dari next/image
import Image from "next/image";
import { BookOpen, Users, School, GraduationCap, Notebook, Globe, ClipboardCheck, CheckCircle, FileText, Phone, Mail, MapPin, Star, Award, Target, Heart, Sparkles, ChevronRight, Play, TrendingUp, BarChart3, PieChart as LucidePieChart } from "lucide-react";

import { LineChart, BarChart, Bar, PieChart as RechartsPieChart, Pie, Cell, XAxis, YAxis, CartesianGrid, Tooltip, ResponsiveContainer, Line, PieChart, Legend } from "recharts";

const features = [
  {
    icon: <ClipboardCheck className="w-8 h-8 text-primary" />,
    title: "Attendance Report",
    description: "Digunakan untuk memantau dan merekap kehadiran guru secara berkala.",
  },
  {
    icon: <CheckCircle className="w-8 h-8 text-primary" />,
    title: "Mutaba`ah",
    description: "Mendukung pelaporan aktivitas ibadah guru dalam rangka pembinaan spiritual.",
  },
  {
    icon: <FileText className="w-8 h-8 text-primary" />,
    title: "Journal Report",
    description: "Mencatat dan merangkum aktivitas kerja guru pada setiap sesi pembelajaran.",
  },
];

const achievementStats = [
  { number: "500+", label: "Siswa Aktif", icon: <Users className="w-6 h-6" /> },
  { number: "95%", label: "Kehadiran Siswa PerBulan", icon: <Users className="w-6 h-6" /> },
  { number: "50+", label: "Guru Aktif", icon: <Users className="w-6 h-6" /> },
  { number: "100%", label: "Kehadiran Guru PerBulan", icon: <Users className="w-6 h-6" /> },
];

// Data untuk charts - bisa diambil dari Google Drive
const studentProgressData = [
  { bulan: "Jan", TK: 85, SD: 88, Persiapan: 82 },
  { bulan: "Feb", TK: 87, SD: 90, Persiapan: 85 },
  { bulan: "Mar", TK: 89, SD: 92, Persiapan: 88 },
  { bulan: "Apr", TK: 91, SD: 94, Persiapan: 90 },
  { bulan: "Mei", TK: 93, SD: 96, Persiapan: 92 },
  { bulan: "Jun", TK: 95, SD: 98, Persiapan: 94 },
];

const subjectPerformanceData = [
  { subject: "Matematika", score: 92 },
  { subject: "Bahasa Indonesia", score: 88 },
  { subject: "IPA", score: 85 },
  { subject: "Bahasa Inggris", score: 90 },
  { subject: "Seni & Budaya", score: 94 },
];

const enrollmentData = [
  { name: "TK", value: 150, color: "#ffde59" },
  { name: "Unit Persiapan", value: 120, color: "#2e884a" },
  { name: "SD", value: 230, color: "#c81b18" },
];

const guruData = [
  { name: "TK", value: 10, color: "#ffde59" },
  { name: "Unit Persiapan", value: 20, color: "#2e884a" },
  { name: "SD", value: 25, color: "#c81b18" },
];

const carouselImages = [
  {
    id: 1,
    src: "/images/muti_1.jpg",
    alt: "Kelas Modern 1",
  },
  {
    id: 2,
    src: "/images/muti_2.jpg",
    alt: "Pembelajaran Digital 2",
  },
  {
    id: 3,
    src: "/images/muti_3.jpg",
    alt: "Siswa Belajar 3",
  },
  {
    id: 4,
    src: "/images/muti_4.jpg",
    alt: "Teknologi Pendidikan 4",
  },
  {
    id: 5,
    src: "/images/muti_5.jpg",
    alt: "Ruang Kelas Interaktif 5",
  },
];

const AutoCarousel = () => {
  const [currentIndex, setCurrentIndex] = useState(0);

  useEffect(() => {
    const interval = setInterval(() => {
      setCurrentIndex((prevIndex) => (prevIndex + 1) % carouselImages.length);
    }, 2000);
    return () => clearInterval(interval);
  }, []);

  const getVisibleImages = () => {
    const visible = [];
    for (let i = 0; i < 3; i++) {
      const index = (currentIndex + i) % carouselImages.length;
      visible.push({
        ...carouselImages[index],
        position: i,
      });
    }
    return visible;
  };

  const visibleImages = getVisibleImages();

  return (
    <div className="relative w-72 h-[600px] mx-auto overflow-hidden">
      <div className="absolute inset-0 flex flex-col items-center justify-center transition-all duration-500">
        {visibleImages.map((image, idx) => {
          const zIndex = idx === 1 ? "z-30" : "z-10";
          const sizeClass = idx === 1 ? "w-64 h-48 scale-100" : "w-56 h-40 scale-90 opacity-70";
          return (
            <div key={`${image.id}-${currentIndex}`} className={`relative rounded-xl shadow-xl overflow-hidden ${zIndex} ${sizeClass} transition-all duration-500`}>
              {/* Mengganti <img> dengan <Image /> */}
              <Image
                src={image.src}
                alt={image.alt}
                layout="fill" // Menggunakan layout="fill" agar gambar mengisi div parent
                objectFit="cover" // Memastikan gambar tetap mencakup area tanpa terdistorsi
                className="rounded-xl" // Kelas Tailwind tetap bisa digunakan
              />
              <div className="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
            </div>
          );
        })}
      </div>
    </div>
  );
};

const StatCard = ({ stat, index }) => (
  <div className="bg-white/10 backdrop-blur-sm rounded-2xl p-6 text-center border border-white/20 hover:bg-white/20 transition-all duration-300">
    <div className="flex justify-center mb-3 text-[#ffde59]">{stat.icon}</div>
    <div className="text-3xl font-bold text-white mb-2">{stat.number}</div>
    <div className="text-white/80 text-sm">{stat.label}</div>
  </div>
);

const TestimonialCard = ({ testimonial, index }) => (
  <div className="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
    <div className="flex items-center mb-4">
      {/* Mengganti <img> dengan <Image /> */}
      <Image
        src={testimonial.image}
        alt={testimonial.name}
        width={48} // w-12 h-12 di Tailwind defaultnya 48px
        height={48} // w-12 h-12 di Tailwind defaultnya 48px
        className="rounded-full object-cover mr-4"
      />
      <div>
        <h4 className="font-bold text-[#333992]">{testimonial.name}</h4>
        <p className="text-gray-600 text-sm">{testimonial.role}</p>
      </div>
    </div>
    {/* Catatan: Jika ada masalah 'react/no-unescaped-entities' di sini,
        pastikan karakter seperti " atau ' di dalam `testimonial.content`
        di-escape dengan &quot; atau &apos; jika itu adalah string literal.
        Namun, karena `testimonial.content` adalah prop, ini seharusnya aman.
    */}
    <p className="text-gray-700 italic">{testimonial.content}</p>
    <div className="flex text-[#ffde59] mt-3">
      {[...Array(5)].map((_, i) => (
        <Star key={i} className="w-4 h-4 fill-current" />
      ))}
    </div>
  </div>
);

const FadeInSection = ({ children }) => {
  const [isVisible, setIsVisible] = useState(false);
  useEffect(() => {
    const timeout = setTimeout(() => setIsVisible(true), 100);
    return () => clearTimeout(timeout);
  }, []);
  return <div className={`transition-all duration-800 ${isVisible ? "opacity-100 translate-y-0" : "opacity-0 translate-y-8"}`}>{children}</div>;
};

const MutiaraHatiLanding = () => {
  return (
    <div className="min-h-screen bg-[#333992] text-white">
      <FadeInSection>
        <section
          className="pt-20 pb-16 px-4 sm:pt-20 lg:px-8 text-white bg-cover bg-center bg-no-repeat relative overflow-hidden"
          style={{
            backgroundImage: "url('https://images.unsplash.com/photo-1581090700227-1e8a774b6a5e?auto=format&fit=crop&w=1600&q=80')",
          }}
        >
          {/* Decorative Elements */}
          <div className="absolute top-20 left-10 w-20 h-20 bg-[#ffde59]/20 rounded-full blur-xl"></div>
          <div className="absolute bottom-20 right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
          <div className="absolute top-1/2 left-1/4 w-16 h-16 bg-[#ffde59]/30 rounded-full blur-lg"></div>

          <div className="bg-[#333992]/80 rounded-3xl p-6 sm:p-12 relative">
            <div className="max-w-7xl mx-auto">
              <div className="grid lg:grid-cols-2 gap-12 items-center">
                <div className="space-y-8">
                  <h1 className="text-5xl lg:text-6xl font-black leading-tight drop-shadow-md">
                    Mutiara Hati
                    <span className="block bg-gradient-to-r from-[#ffde59] to-yellow-300 bg-clip-text text-transparent">SmartSchool System</span>
                  </h1>
                  <p className="text-lg leading-relaxed max-w-xl text-white/90">
                    Platform Pengelolaan dan Manajemen <b>Sekolah</b> dan Solusi <b>digital</b> yang dirancang khusus untuk mempermudah pengelolaan kegiatan sekolah. semua terintegrasi dalam satu sistem yang <b>efisien dan mudah</b> digunakan.
                    {/* Catatan: Jika ada error 'react/no-unescaped-entities' di baris ini (seperti yang dilaporkan pada baris 149 di DashboardHero.js),
                        pastikan tidak ada karakter tanda kutip ganda (") atau tanda kutip tunggal (') yang tidak di-escape
                        di dalam teks ini. Contoh perbaikan:
                        Ganti " dengan &quot; atau &#34;
                        Ganti ' dengan &apos; atau &#39;
                        Namun, pada kode yang disediakan, tidak ada unescaped quotes di baris ini.
                    */}
                  </p>
                  <div className="flex flex-col sm:flex-row gap-4">
                    <button
                      onClick={() => window.open("https://sites.google.com/view/mutiarahati", "_blank")}
                      className="bg-white text-[#333992] px-8 py-4 rounded-full text-lg font-medium shadow-inner hover:shadow-xl transition-all duration-300 hover:scale-105 flex items-center justify-center group"
                    >
                      Get Started Now
                      <ChevronRight className="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" />
                    </button>
                    <div className="inline-flex items-center bg-[#ffde59] text-[#333992] px-4 py-2 rounded-full text-sm font-medium shadow-sm">
                      <Star className="w-4 h-4 mr-2" />
                      Platform Pembelajaran Terdepan
                    </div>
                  </div>
                </div>
                <div className="flex justify-center">
                  <AutoCarousel />
                </div>
              </div>
            </div>
          </div>
        </section>
      </FadeInSection>

      {/* Stats Section */}
      <section className="py-16 bg-[#333992] relative">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-2 md:grid-cols-4 gap-6">
            {achievementStats.map((stat, index) => (
              <StatCard key={index} stat={stat} index={index} />
            ))}
          </div>
        </div>
      </section>

      <section className="py-20 bg-white text-[#333992] relative overflow-hidden">
        {/* Background Decoration */}
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
            <h2 className="text-4xl font-bold mb-4">Teknologi Manajemen Sekolah</h2>
            <p className="text-xl text-gray-600">Merancang sistem pendidikan untuk masa depan yang lebih cerah</p>
          </div>
          <div className="grid md:grid-cols-3 gap-8">
            {features.map((feature, index) => (
              <div key={index} className="group bg-white border-2 border-[#333992]/10 p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-105 hover:border-[#333992]/30 relative overflow-hidden">
                <div className="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-[#ffde59]/20 to-transparent rounded-full -mr-10 -mt-10"></div>
                <div className="mb-6 p-3 bg-[#333992]/10 rounded-xl inline-block group-hover:bg-[#333992] group-hover:text-white transition-colors duration-300">{feature.icon}</div>
                <h3 className="text-xl font-bold mb-3">{feature.title}</h3>
                <p className="text-gray-600 leading-relaxed">{feature.description}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Charts & Analytics Section */}
      <section className="py-20 bg-gray-50">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-16">
            <div className="inline-flex items-center bg-[#333992]/10 text-[#333992] px-4 py-2 rounded-full text-sm font-medium mb-4">
              <TrendingUp className="w-4 h-4 mr-2" />
              Data & Analytics
            </div>
            <h2 className="text-4xl font-bold text-[#333992] mb-4">Progres Guru dan Siswa</h2>
            <p className="text-xl text-gray-600">Data terkini untuk monitoring kemajuan guru dan siswa</p>
          </div>

          {/* Pembungkus Visualisasi data*/}
          <div className="grid lg:grid-cols-2 gap-8 mb-12">
            {/* Pie Chart - Student Enrollment */}
            <div className="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
              <div className="flex items-center justify-between mb-6">
                <div>
                  <h3 className="text-xl font-bold text-[#333992] mb-2">Distribusi Siswa</h3>
                  <p className="text-gray-600 text-sm">Jumlah siswa aktif per jenjang pendidikan</p>
                </div>
                <div className="p-3 bg-[#333992]/10 rounded-xl">
                  <LucidePieChart className="w-6 h-6 text-[#333992]" /> {/* Menggunakan LucidePieChart */}
                </div>
              </div>
              <ResponsiveContainer width="100%" height={300}>
                <RechartsPieChart>
                  <Pie data={enrollmentData} cx="50%" cy="50%" outerRadius={100} fill="#8884d8" dataKey="value" label={({ name, value }) => `${name}: ${value}`}>
                    {enrollmentData.map((entry, index) => (
                      <Cell key={`cell-${index}`} fill={entry.color} />
                    ))}
                  </Pie>
                  <Tooltip
                    contentStyle={{
                      backgroundColor: "#333992",
                      border: "none",
                      borderRadius: "12px",
                      color: "white",
                    }}
                  />
                </RechartsPieChart>
              </ResponsiveContainer>
              <div className="grid grid-cols-3 gap-4 mt-4">
                {enrollmentData.map((item, index) => (
                  <div key={index} className="text-center p-3 bg-gray-50 rounded-xl">
                    <div className="text-2xl font-bold" style={{ color: item.color }}>
                      {item.value}
                    </div>
                    <div className="text-sm text-gray-600">{item.name}</div>
                  </div>
                ))}
              </div>
            </div>


            {/* Pie Chart - Teacher Enrollment */}
            <div className="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
              <div className="flex items-center justify-between mb-6">
                <div>
                  <h3 className="text-xl font-bold text-[#333992] mb-2">Distribusi Guru</h3>
                  <p className="text-gray-600 text-sm">Jumlah Guru aktif per jenjang pendidikan</p>
                </div>
                <div className="p-3 bg-[#333992]/10 rounded-xl">
                  <LucidePieChart className="w-6 h-6 text-[#333992]" /> {/* Menggunakan LucidePieChart */}
                </div>
              </div>
              <ResponsiveContainer width="100%" height={300}>
                <RechartsPieChart>
                  <Pie data={guruData} cx="50%" cy="50%" outerRadius={100} fill="#8884d8" dataKey="value" label={({ name, value }) => `${name}: ${value}`}>
                    {guruData.map((entry, index) => (
                      <Cell key={`cell-${index}`} fill={entry.color} />
                    ))}
                  </Pie>
                  <Tooltip
                    contentStyle={{
                      backgroundColor: "#333992",
                      border: "none",
                      borderRadius: "12px",
                      color: "white",
                    }}
                  />
                </RechartsPieChart>
              </ResponsiveContainer>
              <div className="grid grid-cols-3 gap-4 mt-4">
                {guruData.map((item, index) => (
                  <div key={index} className="text-center p-3 bg-gray-50 rounded-xl">
                    <div className="text-2xl font-bold" style={{ color: item.color }}>
                      {item.value}
                    </div>
                    <div className="text-sm text-gray-600">{item.name}</div>
                  </div>
                ))}
              </div>
            </div>
          </div>

          <div className="grid lg:grid-cols-2 gap-8 mb-12">
            {/* Line Chart - Progress over time #Attendence Report*/}
            <div className="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
              <div className="flex items-center justify-between mb-6">
                <div>
                  <h3 className="text-xl font-bold text-[#333992] mb-2">Rata-rata Attendence - Guru</h3>
                  <p className="text-gray-600 text-sm">Attendence Report (1 tahun)</p>
                </div>
                <div className="p-3 bg-[#333992]/10 rounded-xl">
                  <BarChart3 className="w-6 h-6 text-[#333992]" />
                </div>
              </div>
              <ResponsiveContainer width="100%" height={300}>
                <LineChart data={studentProgressData}>
                  <CartesianGrid strokeDasharray="3 3" stroke="#f0f0f0" />
                  <XAxis dataKey="bulan" stroke="#666" />
                  <YAxis stroke="#666" />
                  <Tooltip
                    contentStyle={{
                      backgroundColor: "#333992",
                      border: "none",
                      borderRadius: "12px",
                      color: "white",
                    }}
                  />
                  <Line type="monotone" dataKey="TK" stroke="#ffde59" strokeWidth={3} dot={{ fill: "#ffde59", strokeWidth: 2, r: 5 }} />
                  <Line type="monotone" dataKey="SD" stroke="#c81b18" strokeWidth={3} dot={{ fill: "#c81b18", strokeWidth: 2, r: 5 }} />
                  <Line type="monotone" dataKey="Persiapan" stroke="#2e884a" strokeWidth={3} dot={{ fill: "#2e884a", strokeWidth: 2, r: 5 }} />
                </LineChart>
              </ResponsiveContainer>
              <div className="flex justify-center space-x-6 mt-4">
                <div className="flex items-center">
                  <div className="w-3 h-3 bg-[#ffde59] rounded-full mr-2"></div>
                  <span className="text-sm text-gray-600">TK</span>
                </div>
                <div className="flex items-center">
                  <div className="w-3 h-3 bg-[#c81b18] rounded-full mr-2"></div>
                  <span className="text-sm text-gray-600">SD</span>
                </div>
                <div className="flex items-center">
                  <div className="w-3 h-3 bg-[#2e884a] rounded-full mr-2"></div>
                  <span className="text-sm text-gray-600">Unit Persiapan</span>
                </div>
              </div>
            </div>
            {/* Line Chart - Progress over time #Mutaba'ah*/}
            <div className="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
              <div className="flex items-center justify-between mb-6">
                <div>
                  <h3 className="text-xl font-bold text-[#333992] mb-2">Rata-rata Mutaba ah - Guru</h3>
                  {/* Catatan: Jika ada error 'react/no-unescaped-entities' di baris ini (seperti yang dilaporkan pada baris 402/403 di DashboardHero.js),
                      pastikan tidak ada karakter tanda kutip ganda (") atau tanda kutip tunggal (') yang tidak di-escape
                      di dalam teks ini. Contoh perbaikan:
                      Ganti " dengan &quot; atau &#34;
                      Ganti ' dengan &apos; atau &#39;
                      Namun, pada kode yang disediakan, tidak ada unescaped quotes di baris ini.
                  */}
                  <p className="text-gray-600 text-sm">Mutaba&apos;ah (1 tahun)</p> {/* Perbaikan di sini: ' menjadi &apos; */}
                </div>
                <div className="p-3 bg-[#333992]/10 rounded-xl">
                  <BarChart3 className="w-6 h-6 text-[#333992]" />
                </div>
              </div>
              <ResponsiveContainer width="100%" height={300}>
                <LineChart data={studentProgressData}>
                  <CartesianGrid strokeDasharray="3 3" stroke="#f0f0f0" />
                  <XAxis dataKey="bulan" stroke="#666" />
                  <YAxis stroke="#666" />
                  <Tooltip
                    contentStyle={{
                      backgroundColor: "#333992",
                      border: "none",
                      borderRadius: "12px",
                      color: "white",
                    }}
                  />
                  <Line type="monotone" dataKey="TK" stroke="#ffde59" strokeWidth={3} dot={{ fill: "#ffde59", strokeWidth: 2, r: 5 }} />
                  <Line type="monotone" dataKey="SD" stroke="#c81b18" strokeWidth={3} dot={{ fill: "#c81b18", strokeWidth: 2, r: 5 }} />
                  <Line type="monotone" dataKey="Persiapan" stroke="#2e884a" strokeWidth={3} dot={{ fill: "#2e884a", strokeWidth: 2, r: 5 }} />
                </LineChart>
              </ResponsiveContainer>
              <div className="flex justify-center space-x-6 mt-4">
                <div className="flex items-center">
                  <div className="w-3 h-3 bg-[#ffde59] rounded-full mr-2"></div>
                  <span className="text-sm text-gray-600">TK</span>
                </div>
                <div className="flex items-center">
                  <div className="w-3 h-3 bg-[#c81b18] rounded-full mr-2"></div>
                  <span className="text-sm text-gray-600">SD</span>
                </div>
                <div className="flex items-center">
                  <div className="w-3 h-3 bg-[#2e884a] rounded-full mr-2"></div>
                  <span className="text-sm text-gray-600">Unit Persiapan</span>
                </div>
              </div>
            </div>
          </div>

          {/* Bar Chart - Subject Performance #Journal Report*/}
          <div className="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
            <div className="flex items-center justify-between mb-6">
              <div>
                <h3 className="text-xl font-bold text-[#333992] mb-2">Rata-Rata Jurnal Report Guru</h3>
                <p className="text-gray-600 text-sm">Jurnal Report Guru (1 tahun)</p>
              </div>
              <div className="p-3 bg-[#333992]/10 rounded-xl">
                <BarChart3 className="w-6 h-6 text-[#333992]" />
              </div>
            </div>
            <ResponsiveContainer width="100%" height={350}>
              <BarChart data={subjectPerformanceData} margin={{ top: 20, right: 30, left: 20, bottom: 5 }}>
                <CartesianGrid strokeDasharray="3 3" stroke="#f0f0f0" />
                <XAxis dataKey="subject" stroke="#666" />
                <YAxis stroke="#666" />
                <Tooltip
                  contentStyle={{
                    backgroundColor: "#333992",
                    border: "none",
                    borderRadius: "12px",
                    color: "white",
                  }}
                />
                <Bar dataKey="score" fill="#333992" radius={[8, 8, 0, 0]}>
                  {subjectPerformanceData.map((entry, index) => (
                    <Cell key={`cell-${index}`} fill={`hsl(${220 + index * 30}, 70%, 50%)`} />
                  ))}
                </Bar>
              </BarChart>
            </ResponsiveContainer>
          </div>

          {/* Data Source Info */}
          <div className="mt-8 text-center">
            <div className="inline-flex items-center bg-white px-6 py-3 rounded-full shadow-md">
              <Globe className="w-5 h-5 text-[#333992] mr-2" />
              <span className="text-sm text-gray-600">Data diambil secara real time</span>
            </div>
          </div>
        </div>
      </section>

      {/* Portal Masuk */}
      <section className="py-20 bg-[#333992] text-white relative overflow-hidden">
        {/* Background Accent */}
        <div className="absolute top-0 left-0 w-72 h-72 bg-yellow-400 opacity-20 rounded-full blur-3xl -z-10"></div>

        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="text-center mb-12">
            <h2 className="text-4xl font-bold mb-4">Platform Portal Sistem</h2>
            <p className="text-xl text-yellow-100">Pilih jenjang pendidikan untuk mengelola sistem di Mutiara Hati</p>
          </div>

          <div className="grid md:grid-cols-3 gap-8">
            {/* TK */}
            <div className="group bg-white rounded-2xl shadow-lg overflow-hidden transition-all hover:scale-105 duration-300 relative">
              <div className="flex items-center justify-center px-6 pt-6">
                <div className="w-24 h-24 bg-[#ffde59]/20 rounded-full flex items-center justify-center">
                  <School className="w-12 h-12 text-[#ffde59]" />
                </div>
              </div>
              <div className="p-6">
                <h3 className="text-2xl font-bold text-[#ffde59] mb-2">TK - Mutiara Hati</h3>
                <p className="text-gray-600 mb-4">Manajemen pembelajaran anak usia dini, absensi, laporan perkembangan, dan komunikasi orang tua.</p>
                <button
                  onClick={() => window.open("https://sites.google.com/view/mutiarahati-tk", "_blank")}
                  className="w-full bg-[#ffde59] text-[#333992] px-6 py-3 rounded-full hover:bg-[#facc15] transition font-medium flex items-center justify-center group"
                >
                  Masuk ke Platform TK
                  <Play className="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" />
                </button>
              </div>
            </div>

            {/* Unit Persiapan */}
            <div className="group bg-white rounded-2xl shadow-lg overflow-hidden transition-all hover:scale-105 duration-300">
              <div className="flex items-center justify-center px-6 pt-6">
                <div className="w-24 h-24 bg-[#2e884a]/20 rounded-full flex items-center justify-center">
                  <School className="w-12 h-12 text-[#2e884a]" />
                </div>
              </div>
              <div className="p-6">
                <h3 className="text-2xl font-bold text-[#2e884a] mb-2">Unit Persiapan - Mutiara Hati</h3>
                <p className="text-gray-600 mb-4">Manajemen pembelajaran Unit Persiapan, absensi, laporan perkembangan, dan komunikasi orang tua.</p>
                <button
                  onClick={() => window.open("https://sites.google.com/view/mutiarahati-sd", "_blank")}
                  className="w-full bg-[#2e884a] text-white px-6 py-3 rounded-full hover:bg-green-700 transition font-medium flex items-center justify-center group"
                >
                  Masuk ke Platform Persiapan
                  <Play className="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" />
                </button>
              </div>
            </div>

            {/* SD */}
            <div className="group bg-white rounded-2xl shadow-lg overflow-hidden transition-all hover:scale-105 duration-300">
              <div className="flex items-center justify-center px-6 pt-6">
                <div className="w-24 h-24 bg-[#c81b18]/20 rounded-full flex items-center justify-center">
                  <School className="w-12 h-12 text-[#c81b18]" />
                </div>
              </div>
              <div className="p-6">
                <h3 className="text-2xl font-bold text-[#c81b18] mb-2">SD Mutiara Hati</h3>
                <p className="text-gray-600 mb-4">Manajemen pembelajaran anak sekolah dasar, absensi, laporan perkembangan, dan komunikasi orang tua.</p>
                <button
                  onClick={() => window.open("https://sites.google.com/view/mutiarahati-sd", "_blank")}
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
    </div>
  );
};

export default MutiaraHatiLanding;
