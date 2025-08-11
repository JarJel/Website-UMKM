<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sekolah Impian - Masa Depan Cerah Dimulai di Sini</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../icon/iconSd.png">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../icon/iconSd.png">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }

        .hero-background {
            background-image: url('../image/try4.png');
            background-size: cover;
            background-position: center;
            position: relative;
            z-index: 0;
            overflow: hidden;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
        }

        .hero-background.fade-in {
            opacity: 1;
        }

        .hero-content {
            position: relative;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            z-index: 1;
            padding: 5rem 0;
        }

        .hero-content h1,
        .hero-content p,
        .hero-content a {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 1s ease-out, transform 1s ease-out;
        }

        .hero-content.show-text h1 {
            opacity: 1;
            transform: translateY(0);
            transition-delay: 0.5s;
        }

        .hero-content.show-text p {
            opacity: 1;
            transform: translateY(0);
            transition-delay: 0.8s;
        }

        .hero-content.show-text a {
            opacity: 1;
            transform: translateY(0);
            transition-delay: 1.1s;
        }

        #scrollToTopBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 99;
            border: none;
            outline: none;
            background-color: #4f46e5;
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        #scrollToTopBtn:hover {
            background-color: #4338ca;
        }

        html {
            scroll-padding-top: 100px;
        }

        .card-bg1 {
            position: relative;
            overflow: hidden;
            z-index: 1;
            height: 300px;
        }

        .card-bg1::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('../cardBackground/bgCard1.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.7;
            z-index: -1;
        }

        .card-bg2 {
            position: relative;
            overflow: hidden;
            z-index: 1;
            height: 300px;
        }

        .card-bg2::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('../cardBackground/bgCard2.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.7;
            z-index: -1;
        }

        .card-bg3 {
            position: relative;
            overflow: hidden;
            z-index: 1;
            height: 300px;
        }

        .card-bg3::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('../image/sdAren.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.7;
            z-index: -1;
        }

        .g_id_signin.hidden {
            display: none !important;
        }

        button#logout-button.hidden,
        button#logout-button-mobile.hidden {
            display: none !important;
        }

        .video-wrapper {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        /* Dropdown CSS - Pastikan ini sudah benar */
        /* Dropdown CSS */
        .dropdown-menu {
            display: none;
            position: absolute;
            left: 0;
            top: 100%;
            width: 100%;
            background-color: white;
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 50;
            padding: 0.5rem 0;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-menu a {
            display: block;
            padding: 0.5rem 1rem;
            color: #4b5563;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .dropdown-menu a:hover {
            background-color: #f3f4f6;
            color: #d62037;
        }

        /* Mobile Popup CSS - Pastikan ini sudah benar */
        .popup-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 100;
        }

        .popup-container.show {
            display: flex;
        }

        .popup-content {
            background-color: #ffffff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 400px;
            position: relative;
        }

        .popup-close {
            position: absolute;
            top: 12px;
            right: 12px;
            cursor: pointer;
            font-size: 24px;
            color: #64748b;
            line-height: 1;
        }
    </style>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>

<body class="antialiased">

    <button id="scrollToTopBtn" title="Kembali ke Atas">↑</button>

    <header class="bg-white shadow-md px-6 md:px-12 sticky top-0 z-50">
        <nav class="container mx-auto flex justify-between items-center">
            <a href="#" class="flex items-center space-x-2">
                <img src="../image/logoSd1.png" alt="Logo Sekolah" class="h-20 w-auto">
            </a>

            <div class="hidden md:flex space-x-8">
                <a href="#beranda"
                    class="text-gray-700 hover:text-indigo-600 font-medium transition duration-300">Beranda</a>
                <a href="#kelas"
                    class="text-gray-700 hover:text-indigo-600 font-medium transition duration-300">Dashboard</a>
                <a href="#program"
                    class="text-gray-700 hover:text-indigo-600 font-medium transition duration-300">Program</a>
                <a href="#galeri-video"
                    class="text-gray-700 hover:text-indigo-600 font-medium transition duration-300">Galeri</a>
            </div>

            <button id="mobile-menu-button" class="md:hidden text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </nav>

        <div id="mobile-menu" class="absolute top-full left-0 right-0 hidden md:hidden space-y-2 px-4 pb-4 bg-white rounded-bl-lg rounded-br-lg shadow-lg z-40">
            <a href="#beranda"
                class="block text-gray-700 hover:text-indigo-600 font-medium py-2 transition duration-300">Beranda</a>
            <a href="#kelas"
                class="block text-gray-700 hover:text-indigo-600 font-medium py-2 transition duration-300">Dashboard</a>
            <a href="#program"
                class="block text-gray-700 hover:text-indigo-600 font-medium py-2 transition duration-300">Program</a>
            <a href="#galeri-video"
                class="block text-gray-700 hover:text-indigo-600 font-medium py-2 transition duration-300">Galeri</a>
        </div>
    </header>

    <section id="beranda"
        class="hero-background py-20 md:py-32 text-center mb-12 min-h-[500px] md:min-h-[630px] flex flex-col justify-center">
        <div class="container ml-auto px-6">
            <div class="hero-content text-white text-left">
                <h1 class="text-xl md:text-4xl font-extrabold leading-tight sm:mb-3 drop-shadow-lg">
                    SELAMAT DATANG DI
                </h1>
                <p
                    class="text-3xl md:text-6xl font-extrabold text-[#d62037] sm:mb-3 max-w-xs sm:max-w-sm md:max-w-2xl break-words drop-shadow-md leading-snug">
                    PORTAL DASHBOARD CENDEKIA MUDA UNIT SD
                </p>
                <a href="#kelas"
                    class="inline-block bg-white hover:bg-[#d62037] text-[#d62037] hover:text-white font-bold
                py-2 px-5 text-base rounded-full
                sm:py-3 sm:px-8 sm:text-lg
                transition duration-900 transform hover:scale-105 shadow-lg">
                    Mulai Sekarang
                </a>
            </div>
        </div>
    </section>

    <section id="kelas"
        class="container mx-auto px-6 md:px-12 py-16 mb-12 bg-[#d62037] rounded-lg shadow-xl text-center">
        <h2 class="text-3xl md:text-4xl font-bold drop-shadow-lg text-white mb-10">Akses <span
                class="text-white drop-shadow-lg">Dashboard</span> </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div
                class="bg-white/90 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center p-6 sm:p-8">
                <div
                    class="card-bg1 w-full rounded-lg flex-grow p-4 sm:p-6 mb-6 flex flex-col items-center justify-end text-center">
                    <h3 class="text-base sm:text-xs px-4 py-4 text-white uppercase font-bold mb-2 bg-gray-800 bg-opacity-70 rounded-md">
                        Informasi kegiatan, kumpulan materi dan rekaman hybrid learning di setiap kelas unit SD Islam Cendekia Muda
                    </h3>
                </div>
                <div class="relative w-full">
                    <button onclick="toggleAction(this, 'SD Islam Cendekia Muda Bandung')"
                        class="bg-[#313556] text-white font-semibold py-2 px-6 rounded-md w-full md:w-auto text-sm md:text-base hover:bg-[#1f2937] transition">
                        Dashboard SD Islam Cendekia Muda Bandung ▼
                    </button>
                    <div class="dropdown-menu hidden absolute left-0 mt-2 w-full bg-white rounded-md shadow-lg z-50 text-left">
                        <a href="https://sites.google.com/cendekiamuda.sch.id/2526sitelevel1/"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#d62037] rounded-lg transition duration-300 ease-in-out">Level
                            1</a>
                        <a href="https://sites.google.com/cendekiamuda.sch.id/2526sitelevel2/"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#d62037] rounded-lg transition duration-300 ease-in-out">Level
                            2</a>
                        <a href="https://sites.google.com/cendekiamuda.sch.id/2526sitelevel3/"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#d62037] rounded-lg transition duration-300 ease-in-out">Level
                            3</a>
                        <a href="https://sites.google.com/cendekiamuda.sch.id/2526-site-level-4/"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#d62037] rounded-lg transition duration-300 ease-in-out">Level
                            4</a>
                        <a href="https://sites.google.com/cendekiamuda.sch.id/2526-site-level-5/"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#d62037] rounded-lg transition duration-300 ease-in-out">Level
                            5</a>
                        <a href="https://sites.google.com/cendekiamuda.sch.id/2526sitelevel6/"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#d62037] rounded-lg transition duration-300 ease-in-out">Level
                            6</a>
                    </div>
                </div>
            </div>

            <div
                class="bg-white/90 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center p-6 sm:p-8">
                <div
                    class="card-bg2 w-full rounded-lg flex-grow p-4 sm:p-6 mb-6 flex flex-col items-center justify-end text-center">
                    <h3 class="text-base sm:text-xs uppercase px-4 py-4 text-white font-bold mb-2 bg-gray-800 bg-opacity-70 rounded-md">
                        Informasi kegiatan, kumpulan materi dan rekaman hybrid learning di setiap kelas unit SD Islam Cendekia Muda Makassar
                    </h3>
                </div>
                <div class="relative w-full">
                    <button onclick="toggleAction(this, 'SD Islam Cendekia Muda Makassar')"
                        class="bg-[#313556] text-white font-semibold py-2 px-6 rounded-md w-full md:w-auto text-sm md:text-base hover:bg-[#1f2937] transition">
                        Dashboard SD Islam Cendekia Muda Makassar ▼
                    </button>
                    <div class="dropdown-menu hidden absolute left-0 mt-2 w-full bg-white rounded-md shadow-lg z-50 text-left">
                        <a href="https://sites.google.com/cendekiamuda.sch.id/2425-site-level-1-makassar/"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#d62037] rounded-lg transition duration-300 ease-in-out">Level
                            1</a>
                        <a href="https://sites.google.com/cendekiamuda.sch.id/2425sitelevel2makassar/"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#d62037] rounded-lg transition duration-300 ease-in-out">Level
                            2</a>
                        <a href="https://sites.google.com/cendekiamuda.sch.id/2425-site-level-3/"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#d62037] rounded-lg transition duration-300 ease-in-out">Level
                            3</a>
                    </div>
                </div>
            </div>

            <div
                class="bg-white/90 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center p-6 sm:p-8">
                <div
                    class="card-bg3 w-full rounded-lg flex-grow p-4 sm:p-6 mb-6 flex flex-col items-center justify-end text-center">
                    <h3 class="text-base sm:text-xs uppercase px-4 py-4 text-white font-bold mb-2 bg-gray-800 bg-opacity-70 rounded-md">
                        Informasi kegiatan, kumpulan materi dan rekaman hybrid learning di setiap kelas unit SD Islam Cendekia Muda Program Bilingual
                    </h3>
                </div>
                <div class="relative w-full">
                    <button onclick="toggleAction(this, 'SD Islam Cendekia Muda Bilingual')"
                        class="bg-[#313556] text-white font-semibold py-2 px-6 rounded-md w-full md:w-auto text-sm md:text-base hover:bg-[#1f2937] transition">
                        Dashboard SD Islam Cendekia Muda Bilingual ▼
                    </button>
                    <div class="dropdown-menu hidden absolute left-0 mt-2 w-full bg-white rounded-md shadow-lg z-50 text-left">
                        <a href="https://sites.google.com/cendekiamuda.sch.id/2425-site-level-1/"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#d62037] rounded-lg transition duration-300 ease-in-out">Level
                            1</a>
                        <a href="https://sites.google.com/cendekiamuda.sch.id/2425-site-level-2/"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-[#d62037] rounded-lg transition duration-300 ease-in-out">Level
                            2</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="mobile-popup" class="popup-container">
        <div class="popup-content">
            <span id="popup-close-button" class="popup-close">×</span>
            <h2 id="popup-title" class="text-xl font-bold mb-4 text-center text-[#313556]"></h2>
            <div id="popup-links" class="space-y-2">
            </div>
        </div>
    </div>

    <section id="program" class="bg-white py-16 mb-12 rounded-lg shadow-xl">
        <div class="container mx-auto px-6 md:px-12 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-[#313556] mb-10">Program Unggulan Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div
                    class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-500 text-5xl mb-4">🎨</div>
                    <h3 class="text-xl font-semibold text-[#313556] mb-3">Ekstrakurikuler Beragam</h3>
                    <p class="text-gray-600 mb-4">
                        Mengembangkan bakat dan minat siswa melalui berbagai klub dan kegiatan.
                    </p>
                    <a href="https://sites.google.com/cendekiamuda.sch.id/2526siteekskul/" class="px-2 py-2 bg-[#313556] text-white rounded-lg hover:bg-[#1f2937] transition">Dashboard Ekstakurikuler</a>
                </div>
                <div
                    class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-500 text-5xl mb-4">📚</div>
                    <h3 class="text-xl font-semibold text-[#313556] mb-3">Kurikulum Inovatif</h3>
                    <p class="text-gray-600">
                        Menggabungkan teori dan praktik dengan pendekatan berbasis proyek untuk pembelajaran yang
                        mendalam.
                    </p>
                </div>
                <div
                    class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-500 text-5xl mb-4">🔬</div>
                    <h3 class="text-xl font-semibold text-[#313556] mb-3">Fasilitas Modern</h3>
                    <p class="text-gray-600">
                        Laboratorium canggih, perpustakaan digital, dan ruang kelas interaktif mendukung proses belajar.
                    </p>
                </div>
                <div
                    class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-500 text-5xl mb-4">🤝</div>
                    <h3 class="text-xl font-semibold text-[#313556] mb-3">Bimbingan Karir</h3>
                    <p class="text-gray-600">
                        Membantu siswa merencanakan masa depan mereka dengan bimbingan karir personal.
                    </p>
                </div>
                <div
                    class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-500 text-5xl mb-4">🌍</div>
                    <h3 class="text-xl font-semibold text-[#313556] mb-3">Program Internasional</h3>
                    <p class="text-gray-600">
                        Kesempatan pertukaran pelajar dan kolaborasi global untuk pengalaman yang lebih luas.
                    </p>
                </div>
                <div
                    class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-500 text-5xl mb-4">🏆</div>
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
            <h2 class="text-3xl md:text-4xl font-bold text-[#313556] mb-4">
                Galeri <span class="text-[#d62037]">Video Kegiatan SD</span>
            </h2>
            <p class="text-gray-600 mb-4">
                Beberapa dokumentasi kegiatan terbaru kami
            </p>
            <p class="text-[#d62037] md:text-2xl mb-4 mt-4">
                Bandung
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="video-wrapper">
                    <iframe src="https://www.youtube.com/embed/6rMofSvFhh0?si=sHEbjK9QvEI4gBSP"
                        title="Video Kegiatan 1" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="video-wrapper">
                    <iframe src="https://www.youtube.com/embed/X9d1ZUDxYd8?si=_-ZWRnHB63ESlzE8"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>
                </div>
                <div class="video-wrapper">
                    <iframe src="https://www.youtube.com/embed/wY-RySfOnBM" title="Plants And Animals Creation - Field Trip Level 3"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>
                </div>
            </div>

            <p class="text-[#d62037] md:text-2xl mb-4 mt-4">
                Makassar
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="relative w-full h-full rounded-lg overflow-hidden shadow-md">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/w69AZbBbCV8?si=FQBrd-XVtp61kb_L"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>


                <div class="relative w-full h-full rounded-lg overflow-hidden shadow-md">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/WpcbvNTX-A0?si=Vej4Q9YsGoiQFemp"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>

                <div class="relative w-full h-full rounded-lg overflow-hidden shadow-md">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/zQZXJj2FWyk?si=ivVK6tUhRdlH1LEy"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>


    <footer class="bg-[#313556] text-white py-8 mt-12 rounded-t-lg">
        <div class="container mx-auto px-6 md:px-12 text-center">
            <p>© 2025 SD ISLAM CENDEKIA MUDA. Hak Cipta Dilindungi.</p>
            <div class="flex justify-center space-x-6 mt-4">
                <a href="#" class="text-gray-400 hover:text-white transition duration-300">Facebook</a>
                <a href="#" class="text-gray-400 hover:text-white transition duration-300">Instagram</a>
                <a href="#" class="text-gray-400 hover:text-white transition duration-300">Twitter</a>
            </div>
        </div>
    </footer>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });

                const mobileMenu = document.getElementById('mobile-menu');
                if (!mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            });
        });

        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        const scrollToTopBtn = document.getElementById("scrollToTopBtn");
        window.onscroll = function () {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                scrollToTopBtn.style.display = "block";
            } else {
                scrollToTopBtn.style.display = "none";
            }
        };
        scrollToTopBtn.addEventListener("click", function () {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        });

        window.addEventListener('load', () => {
            const heroSection = document.getElementById('beranda');
            const heroContent = heroSection.querySelector('.hero-content');
            if (heroSection) {
                heroSection.classList.add('fade-in');
            }
            setTimeout(() => {
                if (heroContent) {
                    heroContent.classList.add('show-text');
                }
            }, 500);
        });

        function closeAllDropdowns() {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        }

        // Fungsi untuk membuka pop-up mobile
        function openPopup(title, links) {
            const popupContainer = document.getElementById('mobile-popup');
            const popupTitle = document.getElementById('popup-title');
            const popupLinks = document.getElementById('popup-links');

            popupTitle.textContent = title;
            popupLinks.innerHTML = '';
            links.forEach(link => {
                const newLink = document.createElement('a');
                newLink.href = link.href;
                newLink.textContent = link.textContent;
                newLink.className = 'block w-full text-center px-4 py-2 text-gray-700 hover:bg-gray-200 hover:text-[#d62037] rounded-md';
                popupLinks.appendChild(newLink);
            });
            popupContainer.classList.add('show');
        }

        // Fungsi utama untuk menangani klik tombol
        function toggleAction(button, title) {
            const isMobile = window.innerWidth <= 768;
            const dropdownMenu = button.nextElementSibling;
            
            if (isMobile) {
                // Mobile: Tampilkan pop-up
                const links = Array.from(dropdownMenu.querySelectorAll('a')).map(a => ({
                    href: a.href,
                    textContent: a.textContent
                }));
                openPopup(title, links);
            } else {
                // Desktop: Toggle dropdown
                const isVisible = dropdownMenu.classList.contains('show');
                closeAllDropdowns();
                if (!isVisible) {
                    dropdownMenu.classList.add('show');
                }
            }
        }

        // Event listener untuk tombol close pop-up
        document.getElementById('popup-close-button').addEventListener('click', () => {
            document.getElementById('mobile-popup').classList.remove('show');
        });

        // Tutup dropdown desktop saat klik di luar
        document.addEventListener('click', function(e) {
            const dropdownButtons = document.querySelectorAll('.relative button');
            const dropdownMenus = document.querySelectorAll('.dropdown-menu');
            
            // Periksa apakah yang diklik adalah salah satu tombol dropdown atau menu dropdown
            let isClickInsideDropdown = false;
            dropdownButtons.forEach(button => {
                if (button.contains(e.target)) {
                    isClickInsideDropdown = true;
                }
            });
            dropdownMenus.forEach(menu => {
                if (menu.contains(e.target)) {
                    isClickInsideDropdown = true;
                }
            });

            // Jika bukan, maka tutup semua dropdown
            if (!isClickInsideDropdown) {
                closeAllDropdowns();
            }
        });

        // Tutup pop-up mobile saat klik di area overlay
        document.getElementById('mobile-popup').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('show');
            }
        });

        // Tutup dropdown saat window di-resize ke mobile
        window.addEventListener('resize', function() {
            if (window.innerWidth <= 768) {
                closeAllDropdowns();
            }
        });

    // ICON    
    feather.replace();
    </script>
</body>

</html>