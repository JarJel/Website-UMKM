<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BATARA - E-commerce BUMDes Indonesia</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      overflow-x: hidden;
      background-color: #f7f8fa;
    }

    /* === Warna Utama === */
    :root {
      --primary: #1d4657;
    }

    /* Loading Screen */
    .loading-screen {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: white;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      z-index: 9999;
      animation: fadeOut 1s ease-out 2.5s forwards;
    }
    .loader {
      border: 5px solid #e5e7eb;
      border-top: 5px solid var(--primary);
      border-radius: 50%;
      width: 60px;
      height: 60px;
      animation: spin 1s linear infinite;
    }
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
    @keyframes fadeOut {
      to {
        opacity: 0;
        visibility: hidden;
      }
    }

    /* Page Animations */
    .fade-in {
      opacity: 0;
      animation: fadeIn 1s ease-out 3s forwards;
    }
    @keyframes fadeIn {
      to { opacity: 1; }
    }

    .slide-up {
      opacity: 0;
      transform: translateY(40px);
      animation: slideUp 1s ease-out 3.2s forwards;
    }
    @keyframes slideUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>

  <!-- Loading Screen -->
  <div class="loading-screen">
    <div class="loader"></div>
    <p class="mt-4 text-[var(--primary)] font-semibold text-lg">Memuat BATARA...</p>
  </div>

  <!-- Navbar -->
  <nav class="fixed w-full top-0 left-0 backdrop-blur-md bg-white/40 border-b border-white/20 z-50 fade-in">
    <div class="max-w-6xl mx-auto px-6 py-3 flex justify-between items-center">
      <div class="flex items-center space-x-2">
        <img src="https://upload.wikimedia.org/wikipedia/commons/7/7c/Shop.svg" alt="BATARA Logo" class="w-10 h-10">
        <h1 class="text-xl font-bold text-[var(--primary)]">BATARA</h1>
      </div>
      <div class="hidden md:flex items-center space-x-6 text-[var(--primary)] font-semibold">
        <a href="#tentang" class="hover:text-[#2f6f84] transition">Tentang</a>
        <a href="#fitur" class="hover:text-[#2f6f84] transition">Fitur</a>
        <a href="#kontak" class="hover:text-[#2f6f84] transition">Kontak</a>
        <a href="/login" class="bg-[var(--primary)] text-white px-4 py-2 rounded-lg hover:scale-105 transition">Masuk</a>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="h-screen flex flex-col justify-center items-center text-center px-6 relative fade-in"
    style="background-image: url('https://images.unsplash.com/photo-1615484477210-3a884b06c8c1?auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center;">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="relative z-10 max-w-2xl mx-auto text-white">
      <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-4 animate__animated animate__fadeInDown">
        Memberdayakan BUMDes <br> Melalui <span class="text-yellow-300">Digitalisasi</span>
      </h1>
      <p class="text-lg md:text-xl mb-6 opacity-90">
        BATARA adalah platform e-commerce yang membantu BUMDes di seluruh Indonesia memasarkan produk lokal secara online dengan mudah dan aman.
      </p>
      <a href="#tentang"
         class="bg-yellow-400 text-gray-800 font-semibold px-6 py-3 rounded-lg shadow-lg hover:scale-105 transition">
        Jelajahi Sekarang
      </a>
    </div>
  </section>

  <!-- Tentang -->
  <section id="tentang" class="py-20 bg-white slide-up">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h2 class="text-3xl font-bold text-[var(--primary)] mb-4">Tentang BATARA</h2>
      <p class="text-gray-600 max-w-2xl mx-auto">
        <strong>BATARA</strong> (Bangkitkan Desa dengan Teknologi dan Rakyat) hadir untuk mendukung perekonomian desa melalui digitalisasi. Kami menyediakan platform yang mempertemukan BUMDes dan masyarakat luas untuk menjual, membeli, dan memasarkan produk lokal unggulan secara daring.
      </p>
    </div>
  </section>

  <!-- Fitur -->
  <section id="fitur" class="py-20 bg-gray-50 slide-up">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h2 class="text-3xl font-bold text-[var(--primary)] mb-12">Fitur Unggulan</h2>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-white rounded-2xl p-6 shadow-lg hover:scale-105 transition">
          <img src="https://cdn-icons-png.flaticon.com/512/2331/2331966.png" class="w-16 mx-auto mb-4" />
          <h3 class="font-semibold text-lg text-[var(--primary)]">Pasar Digital</h3>
          <p class="text-gray-600 text-sm">Platform jual beli produk lokal unggulan dari berbagai desa di Indonesia.</p>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-lg hover:scale-105 transition">
          <img src="https://cdn-icons-png.flaticon.com/512/3771/3771518.png" class="w-16 mx-auto mb-4" />
          <h3 class="font-semibold text-lg text-[var(--primary)]">Kemudahan Transaksi</h3>
          <p class="text-gray-600 text-sm">Integrasi pembayaran yang aman, cepat, dan mendukung berbagai metode.</p>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-lg hover:scale-105 transition">
          <img src="https://cdn-icons-png.flaticon.com/512/3873/3873097.png" class="w-16 mx-auto mb-4" />
          <h3 class="font-semibold text-lg text-[var(--primary)]">Analisis Bisnis</h3>
          <p class="text-gray-600 text-sm">Pantau performa penjualan dan optimalkan strategi pemasaran produk.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Kontak -->
  <section id="kontak" class="py-20 bg-[var(--primary)] text-white text-center slide-up">
    <div class="max-w-4xl mx-auto px-6">
      <h2 class="text-3xl font-bold mb-4">Hubungi Kami</h2>
      <p class="mb-6 text-gray-100">
        Ingin tahu lebih lanjut tentang bagaimana BATARA bisa membantu BUMDes Anda?
      </p>
      <a href="mailto:info@batara.id"
         class="bg-yellow-400 text-gray-800 px-6 py-3 rounded-lg font-semibold hover:scale-105 transition">
         Kirim Email
      </a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-[#163644] text-gray-200 text-center py-4 text-sm">
    © 2025 BATARA. Semua Hak Dilindungi.
  </footer>

</body>
</html>
