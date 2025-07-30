<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sekolah Impian - Masa Depan Cerah Dimulai di Sini</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../icon/iconSd2.png">
    <style>
         @font-face {
            font-family: 'Segoe-ui'; /* Ganti dengan nama font yang Anda inginkan */
            src: url('../fonts/segoeuithibd.ttf') format('ttf'), /* Ganti dengan jalur file font Anda */
                 url('../fonts/segoeuithis.ttf') format('ttf'), 
                 url('../fonts/segoeuithisi.ttf') format('ttf'), 
                 url('../fonts/segoeuithisz.ttf') format('ttf'); 
                   /* Tambahkan format lain jika tersedia */
            font-weight: 400; /* Sesuaikan dengan ketebalan font */
            font-style: normal; /* Sesuaikan dengan gaya font */
            font-display: swap; /* Opsional: Mengontrol bagaimana font dimuat dan ditampilkan */
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc; /* General background color */
            color: #334155; /* General text color */
        }
        .hero-background {
            background-image: url('../image/backgroundMksr2.png'); /* Ganti dengan jalur gambar latar belakang Anda */
            background-size: cover;
            background-position: center;
            position: relative;
            z-index: 0;
            overflow: hidden; /* Hide overflow from 3D canvas */
            /* Initial state for fade-in transition */
            opacity: 0;
            transition: opacity 1.5s ease-in-out; /* Transition duration and timing function */
        }
        .hero-background.fade-in {
            opacity: 1; /* Final state for fade-in transition */
        }
        .hero-content {
            position: relative;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            z-index: 1; /* Ensure content is above canvas */
            padding: 5rem 0; /* Add padding to match original hero section */
        }

        /* Initial state for hero text elements */
        .hero-content h1,
        .hero-content p,
        .hero-content a {
            opacity: 0;
            transform: translateY(20px); /* Start slightly below */
            transition: opacity 1s ease-out, transform 1s ease-out; /* Transition for opacity and transform */
        }

        /* Final state for hero text elements (after fade-in) */
        .hero-content.show-text h1 {
            opacity: 1;
            transform: translateY(0);
            transition-delay: 0.5s; /* Delay for h1 */
        }
        .hero-content.show-text p {
            opacity: 1;
            transform: translateY(0);
            transition-delay: 0.8s; /* Delay for p */
        }
        .hero-content.show-text a {
            opacity: 1;
            transform: translateY(0);
            transition-delay: 1.1s; /* Delay for button */
        }


        /* Custom scroll-to-top button */
        #scrollToTopBtn {
            display: none; /* Hidden by default */
            position: fixed; /* Fixed position */
            bottom: 20px; /* Place at the bottom */
            right: 20px; /* Place at the right */
            z-index: 99; /* High z-index to be on top */
            border: none; /* Remove borders */
            outline: none; /* Remove outline */
            background-color: #4f46e5; /* Background color */
            color: white; /* Text color */
            cursor: pointer; /* Add a mouse pointer on hover */
            padding: 15px; /* Some padding */
            border-radius: 50%; /* Rounded corners */
            font-size: 18px; /* Increase font size */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }
        #scrollToTopBtn:hover {
            background-color: #4338ca; /* Darker background on hover */
        }

        /* Modal styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000; /* Ensure modal is on top */
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        }
        .modal-overlay.open {
            opacity: 1;
            visibility: visible;
        }
        .modal-content {
            background-color: white;
            padding: 2rem;
            border-radius: 0.75rem; /* rounded-lg */
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
            max-width: 90%;
            width: 500px;
            position: relative;
            transform: translateY(-20px);
            opacity: 0;
            transition: transform 0.3s ease-out, opacity 0.3s ease-out;
        }
        .modal-overlay.open .modal-content {
            transform: translateY(0);
            opacity: 1;
        }
        .modal-close-button {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #6b7280; /* gray-500 */
        }
        .modal-close-button:hover {
            color: #4b5563; /* gray-700 */
        }
        /* Style for clickable list items in modals */
        .modal-content ul li a {
            color: #4f46e5; /* Indigo-600 */
            text-decoration: none;
            transition: color 0.2s ease-in-out;
            display: block; /* Make the whole li clickable */
            padding: 0.25rem 0; /* Add some padding for better click area */
        }
        .modal-content ul li a:hover {
            color: #3730a3; /* Darker indigo on hover */
            text-decoration: underline;
        }

        /* Glassmorphism style for contact form */
        .glassmorphism-form {
            background: rgba(255, 255, 255, 0.15); /* Semi-transparent white */
            backdrop-filter: blur(10px); /* Frosted glass effect */
            -webkit-backdrop-filter: blur(10px); /* For Safari */
            border: 1px solid rgba(255, 255, 255, 0.2); /* Subtle border */
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37); /* Subtle shadow */
        }
        html {
            scroll-padding-top: 100px;
        }

    </style>
</head>
<body class="antialiased">

    <!-- Scroll to Top Button -->
    <button id="scrollToTopBtn" title="Kembali ke Atas">↑</button>

    <!-- Header Section -->
    <header class="bg-white shadow-md py-4 px-6 md:px-12 sticky top-0 z-50 rounded-b-lg">
        <nav class="container mx-auto flex justify-between items-center">
            <!-- Logo Sekolah -->
            <a href="#" class="flex items-center space-x-2">
                <img src="../image/logoMksr1.png" alt="Logo Sekolah" class="h-20 w-30">
            </a>

            <!-- Navigasi (Hamburger Menu for Mobile) -->
            <div class="hidden md:flex space-x-8">
                <a href="#beranda" class="text-gray-700 hover:text-indigo-600 font-medium transition duration-300">Beranda</a>
                <a href="#kelas" class="text-gray-700 hover:text-indigo-600 font-medium transition duration-300">Kelas Kami</a>
                <a href="#program" class="text-gray-700 hover:text-indigo-600 font-medium transition duration-300">Program</a>
                <a href="#galeri-video" class="text-gray-700 hover:text-indigo-600 font-medium transition duration-300">Galeri</a>            
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="md:hidden text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </nav>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden mt-4 space-y-2 px-4 pb-4 bg-white rounded-lg shadow-lg">
            <a href="#beranda" class="block text-gray-700 hover:text-indigo-600 font-medium py-2 transition duration-300">Beranda</a>
            <a href="#kelas" class="block text-gray-700 hover:text-indigo-600 font-medium py-2 transition duration-300">Kelas Kami</a>
            <a href="#program" class="block text-gray-700 hover:text-indigo-600 font-medium py-2 transition duration-300">Program</a>
            <a href="#galeri-video" class="text-gray-700 hover:text-indigo-600 font-medium py-2 transition duration-300">Galeri</a>
        </div>
    </header>

    <!-- Hero Section with Background Image -->
    <section id="beranda" class="hero-background py-20 md:py-32 text-center mb-12 h-[500px] md:h-[630px] flex flex-col justify-center">
        <div class="hero-content text-white text-left max-w-4xl px-6">
            <h1 class="text-lg md:text-4xl font-extrabold leading-tight mb-6 drop-shadow-lg">
                Dashboard
            </h1>
            <p class="text-3xl md:text-6xl font-extrabold text-[#0987c6] mb-10 max-w-2xl drop-shadow-md">
                SD ISLAM CENDEKIA MUDA MAKASAR
            </p>
            <a href="#kelas" class="bg-white hover:bg-[#6bdd38] text-[#0987c6] hover:text-white font-bold py-3 px-8 rounded-full text-lg transition duration-900 transform hover:scale-105 shadow-lg">
                Mulai Sekarang
            </a>
        </div>
    </section>

    <!-- Kelas Section (Previously About Section) -->
    <section id="kelas" class="container mx-auto px-6 md:px-12 py-16 mb-12 bg-[#0987c6] rounded-lg shadow-xl text-center">
        <h2 class="text-3xl md:text-4xl font-bold drop-shadow-lg text-white mb-10">Pilihan <span class="text-[#313556] drop-shadow-lg">Kelas Kami</span> </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card Kelas 1 -->
            <div class="bg-indigo-50 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center">
                <img src="../image/kelas1.png" onerror="this.onerror=null;this.src='https://placehold.co/150x150/a78bfa/ffffff?text=Kelas+1';" alt="Icon Kelas 1" class="w-36 h-36 rounded-full mb-6 object-cover border-4 border-indigo-300">
                <h3 class="text-2xl font-semibold text-indigo-700 mb-3">Kelas 1</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Memperkenalkan dasar-dasar membaca, menulis, dan berhitung dengan metode yang menyenangkan dan interaktif.
                </p>
                <a href="https://level1sd.cendekiamuda.sch.id/home" class="inline-block bg-[#313556] drop-shadow-lg text-white font-semibold py-2 px-6 rounded-md transition duration-300">
                    Dashboard Level 1
                </a>
            </div>

            <!-- Card Kelas 2 -->
            <div class="bg-indigo-50 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center">
                <img src="../image/kelas2.png" onerror="this.onerror=null;this.src='https://placehold.co/150x150/a78bfa/ffffff?text=Kelas+2';" alt="Icon Kelas 2" class="w-36 h-36 rounded-full mb-6 object-cover border-4 border-indigo-300">
                <h3 class="text-2xl font-semibold text-indigo-700 mb-3">Kelas 2</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Pengembangan kemampuan dasar dengan fokus pada pemecahan masalah dan kreativitas dalam setiap pelajaran.
                </p>
                <a href="https://level1sd.cendekiamuda.sch.id/home" class="inline-block bg-[#313556] drop-shadow-lg text-white font-semibold py-2 px-6 rounded-md transition duration-300">
                    Dashboard Level 2
                </a>
            </div>

            <!-- Card Kelas 3 -->
            <div class="bg-indigo-50 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center">
                <img src="../image/kelas3.png" onerror="this.onerror=null;this.src='https://placehold.co/150x150/a78bfa/ffffff?text=Kelas+3';" alt="Icon Kelas 3" class="w-36 h-36 rounded-full mb-6 object-cover border-4 border-indigo-300">
                <h3 class="text-2xl font-semibold text-indigo-700 mb-3">Kelas 3</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Meningkatkan pemahaman konsep yang lebih kompleks dan pengenalan mata pelajaran baru.
                </p>
                <a href="https://level1sd.cendekiamuda.sch.id/home" class="inline-block bg-[#313556] drop-shadow-lg text-white font-semibold py-2 px-6 rounded-md transition duration-300">
                    Dashboard Level 3
                </a>
            </div>
            <!-- Card Kelas 4 -->
            <div class="bg-indigo-50 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center">
                <img src="../image/kelas3.png" onerror="this.onerror=null;this.src='https://placehold.co/150x150/a78bfa/ffffff?text=Kelas+3';" alt="Icon Kelas 3" class="w-36 h-36 rounded-full mb-6 object-cover border-4 border-indigo-300">
                <h3 class="text-2xl font-semibold text-indigo-700 mb-3">Kelas 4</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Meningkatkan pemahaman konsep yang lebih kompleks dan pengenalan mata pelajaran baru.
                </p>
                <a href="https://level1sd.cendekiamuda.sch.id/home" class="inline-block bg-[#313556] drop-shadow-lg text-white font-semibold py-2 px-6 rounded-md transition duration-300">
                    Dashboard Level 4
                </a>
            </div>
            <!-- Card kelas 5 -->
            <div class="bg-indigo-50 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center">
                <img src="../image/kelas3.png" onerror="this.onerror=null;this.src='https://placehold.co/150x150/a78bfa/ffffff?text=Kelas+3';" alt="Icon Kelas 3" class="w-36 h-36 rounded-full mb-6 object-cover border-4 border-indigo-300">
                <h3 class="text-2xl font-semibold text-indigo-700 mb-3">Kelas 5</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Meningkatkan pemahaman konsep yang lebih kompleks dan pengenalan mata pelajaran baru.
                </p>
                <a href="https://level1sd.cendekiamuda.sch.id/home" class="inline-block bg-[#313556] drop-shadow-lg text-white font-semibold py-2 px-6 rounded-md transition duration-300">
                    Dashboard Level 5
                </a>
            </div>
            <!-- Card kelas 6 -->
            <div class="bg-indigo-50 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center">
                <img src="../image/kelas3.png" onerror="this.onerror=null;this.src='https://placehold.co/150x150/a78bfa/ffffff?text=Kelas+3';" alt="Icon Kelas 3" class="w-36 h-36 rounded-full mb-6 object-cover border-4 border-indigo-300">
                <h3 class="text-2xl font-semibold text-indigo-700 mb-3">Kelas 6</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Meningkatkan pemahaman konsep yang lebih kompleks dan pengenalan mata pelajaran baru.
                </p>
                <a href="https://level1sd.cendekiamuda.sch.id/home" class="inline-block bg-[#313556] drop-shadow-lg text-white font-semibold py-2 px-6 rounded-md transition duration-300">
                    Dashboard Level 6
                </a>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section id="program" class="bg-white py-16 mb-12 rounded-lg shadow-xl">
        <div class="container mx-auto px-6 md:px-12 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-[#313556] mb-10">Program Unggulan Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Program 1 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-500 text-5xl mb-4">📚</div> <!-- Icon -->
                    <h3 class="text-xl font-semibold text-[#313556] mb-3">Kurikulum Inovatif</h3>
                    <p class="text-gray-600">
                        Menggabungkan teori dan praktik dengan pendekatan berbasis proyek untuk pembelajaran yang mendalam.
                    </p>
                </div>
                <!-- Program 2 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-500 text-5xl mb-4">🔬</div> <!-- Icon -->
                    <h3 class="text-xl font-semibold text-[#313556] mb-3">Fasilitas Modern</h3>
                    <p class="text-gray-600">
                        Laboratorium canggih, perpustakaan digital, dan ruang kelas interaktif mendukung proses belajar.
                    </p>
                </div>
                <!-- Program 3 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-500 text-5xl mb-4">🎨</div> <!-- Icon -->
                    <h3 class="text-xl font-semibold text-[#313556] mb-3">Ekstrakurikuler Beragam</h3>
                    <p class="text-gray-600">
                        Mengembangkan bakat dan minat siswa melalui berbagai klub dan kegiatan.
                    </p>
                </div>
                <!-- Program 4 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-500 text-5xl mb-4">🤝</div> <!-- Icon -->
                    <h3 class="text-xl font-semibold text-[#313556] mb-3">Bimbingan Karir</h3>
                    <p class="text-gray-600">
                        Membantu siswa merencanakan masa depan mereka dengan bimbingan karir personal.
                    </p>
                </div>
                <!-- Program 5 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-500 text-5xl mb-4">🌍</div> <!-- Icon -->
                    <h3 class="text-xl font-semibold text-[#313556] mb-3">Program Internasional</h3>
                    <p class="text-gray-600">
                        Kesempatan pertukaran pelajar dan kolaborasi global untuk pengalaman yang lebih luas.
                    </p>
                </div>
                <!-- Program 6 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-500 text-5xl mb-4">🏆</div> <!-- Icon -->
                    <h3 class="text-xl font-semibold text-[#313556] mb-3">Pendidikan Holistik</h3>
                    <p class="text-gray-600">
                        Fokus pada pengembangan akademik, emosional, sosial, dan spiritual siswa.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="galeri-video" class="bg-gray-50 py-16 mb-12 rounded-lg shadow-xl">
        <div class="container mx-auto px-6 md:px-12 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-[#313556] mb-10">
                Galeri <span class="text-[#0987c6]">Video Kegiatan SD</span>
            </h2>
            <p class="text-gray-600 mb-8">
                Beberapa dokumentasi kegiatan terbaru kami
            </p>
            
            <!-- Grid Video -->
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-8">
                
                <!-- Video 1 -->
                <div class="relative w-full h-full rounded-lg overflow-hidden shadow-md">
                    <blockquote class="instagram-media" 
                    data-instgrm-permalink="https://www.instagram.com/reel/DEj3vzxvOjc/?utm_source=ig_embed&amp;utm_campaign=loading" 
                    data-instgrm-version="14" 
                    style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="https://www.instagram.com/reel/DEj3vzxvOjc/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/reel/DEj3vzxvOjc/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by SD Islam Cendekia Muda Makassar (@cendekiamudamakassar)</a></p></div></blockquote>
                    <script async src="//www.instagram.com/embed.js"></script>
                </div>

                
                <!-- Video 2 -->
                <div class="relative w-full h-full rounded-lg overflow-hidden shadow-md">
                    <blockquote class="instagram-media" 
                    data-instgrm-permalink="https://www.instagram.com/reel/DDJv9KOxIc5/?utm_source=ig_embed&amp;utm_campaign=loading" 
                    data-instgrm-version="14" 
                    style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="https://www.instagram.com/reel/DDJv9KOxIc5/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/reel/DDJv9KOxIc5/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by SD Islam Cendekia Muda Makassar (@cendekiamudamakassar)</a></p></div></blockquote>
                    <script async src="//www.instagram.com/embed.js"></script>
                </div>
                
                <!-- Video 3 -->
                <div class="relative w-full h-full rounded-lg overflow-hidden shadow-md">
                    <blockquote class="instagram-media" 
                    data-instgrm-permalink="https://www.instagram.com/reel/DGNZWtgzx8Z/?utm_source=ig_embed&amp;utm_campaign=loading" 
                    data-instgrm-version="14" 
                    style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="https://www.instagram.com/reel/DGNZWtgzx8Z/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/reel/DGNZWtgzx8Z/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by SD Islam Cendekia Muda Makassar (@cendekiamudamakassar)</a></p></div></blockquote>
                    <script async src="//www.instagram.com/embed.js"></script>
                </div>
                
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-[#313556] text-white py-8 mt-12 rounded-t-lg">
        <div class="container mx-auto px-6 md:px-12 text-center">
            <p>&copy; 2025 SD ISLAM CENDEKIA MUDA. Hak Cipta Dilindungi.</p>
            <div class="flex justify-center space-x-6 mt-4">
                <a href="#" class="text-gray-400 hover:text-white transition duration-300">Facebook</a>
                <a href="#" class="text-gray-400 hover:text-white transition duration-300">Instagram</a>
                <a href="#" class="text-gray-400 hover:text-white transition duration-300">Twitter</a>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });

                // Close mobile menu if open
                const mobileMenu = document.getElementById('mobile-menu');
                if (!mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            });
        });

        // Toggle mobile menu
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Scroll to top button functionality
        const scrollToTopBtn = document.getElementById("scrollToTopBtn");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                scrollToTopBtn.style.display = "block";
            } else {
                scrollToTopBtn.style.display = "none";
            }
        };

        // When the user clicks on the button, scroll to the top of the document
        scrollToTopBtn.addEventListener("click", function() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        });

        // Add fade-in effect to hero section on page load
        window.addEventListener('load', () => {
            const heroSection = document.getElementById('beranda');
            const heroContent = heroSection.querySelector('.hero-content');

            if (heroSection) {
                heroSection.classList.add('fade-in');
            }
            // Add a slight delay for the text to appear after the background fades in
            setTimeout(() => {
                if (heroContent) {
                    heroContent.classList.add('show-text');
                }
            }, 500); // Adjust delay as needed (e.g., 500ms after background starts fading)
        });
    </script>
</body>
</html>
