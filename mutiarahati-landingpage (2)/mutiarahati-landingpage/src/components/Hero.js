"use client";
import React, { useState, useEffect } from "react";
import { Star, ChevronRight } from "lucide-react";

const carouselImages = [
  { id: 1, src: "/images/muti_1.jpg", alt: "Kelas Modern 1" },
  { id: 2, src: "/images/muti_2.jpg", alt: "Pembelajaran Digital 2" },
  { id: 3, src: "/images/muti_3.jpg", alt: "Siswa Belajar 3" },
  { id: 4, src: "/images/muti_4.jpg", alt: "Teknologi Pendidikan 4" },
  { id: 5, src: "/images/muti_5.jpg", alt: "Ruang Kelas Interaktif 5" },
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
      visible.push({ ...carouselImages[index], position: i });
    }
    return visible;
  };

  const visibleImages = getVisibleImages();

  return (
    <div className="relative w-72 h-[600px] mx-auto overflow-hidden">
      <div className="absolute inset-0 flex flex-col items-center justify-center transition-all duration-500">
        {visibleImages.map((image, idx) => {
          const zIndex = idx === 1 ? "z-30" : "z-10";
          const sizeClass =
            idx === 1
              ? "w-64 h-48 scale-100"
              : "w-56 h-40 scale-90 opacity-70";
          return (
            <div
              key={`${image.id}-${currentIndex}`}
              className={`relative rounded-xl shadow-xl overflow-hidden ${zIndex} ${sizeClass} transition-all duration-500`}
            >
              <image
                src={image.src}
                alt={image.alt}
                className="w-full h-full object-cover"
              />
              <div className="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
            </div>
          );
        })}
      </div>
    </div>
  );
};

const FadeInSection = ({ children }) => {
  const [isVisible, setIsVisible] = useState(false);
  useEffect(() => {
    const timeout = setTimeout(() => setIsVisible(true), 100);
    return () => clearTimeout(timeout);
  }, []);
  return (
    <div
      className={`transition-all duration-800 ${
        isVisible ? "opacity-100 translate-y-0" : "opacity-0 translate-y-8"
      }`}
    >
      {children}
    </div>
  );
};

export default function Hero() {
  return (
    <FadeInSection>
      <section
        className="pt-20 pb-16 px-4 sm:pt-20 lg:px-8 text-white bg-cover bg-center bg-no-repeat relative overflow-hidden"
        style={{
          backgroundImage:
            "url('https://images.unsplash.com/photo-1581090700227-1e8a774b6a5e?auto=format&fit=crop&w=1600&q=80')",
        }}
      >
        <div className="absolute top-20 left-10 w-20 h-20 bg-[#ffde59]/20 rounded-full blur-xl"></div>
        <div className="absolute bottom-20 right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
        <div className="absolute top-1/2 left-1/4 w-16 h-16 bg-[#ffde59]/30 rounded-full blur-lg"></div>

        <div className="bg-[#333992]/80 rounded-3xl p-6 sm:p-12 relative">
          <div className="max-w-7xl mx-auto">
            <div className="grid lg:grid-cols-2 gap-12 items-center">
              <div className="space-y-8">
                <h1 className="text-5xl lg:text-6xl font-black leading-tight drop-shadow-md">
                  Mutiara Hati
                  <span className="block bg-gradient-to-r from-[#ffde59] to-yellow-300 bg-clip-text text-transparent">
                    SmartSchool System
                  </span>
                </h1>
                <p className="text-lg leading-relaxed max-w-xl text-white/90">
                  Platform Pengelolaan dan Manajemen <b>Sekolah</b> dan Solusi{" "}
                  <b>digital</b> yang dirancang khusus untuk mempermudah
                  pengelolaan kegiatan sekolah. semua terintegrasi dalam satu
                  sistem yang <b>efisien dan mudah</b> digunakan.
                </p>
                <div className="flex flex-col sm:flex-row gap-4">
                  <button
                    onClick={() =>
                      window.open(
                        "https://sites.google.com/view/mutiarahati",
                        "_blank"
                      )
                    }
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
  );
}