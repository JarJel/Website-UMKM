<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sekolah Impian - Masa Depan Cerah Dimulai di Sini</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../icon/iconSd.png">
    <style>
        /* Gaya CSS Anda yang sudah ada */
        /* ... */

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
            font-size: 18px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        #scrollToTopBtn:hover {
            background-color: #4338ca;
        }

        html {
            scroll-padding-top: 100px;
        }

        .card-bg {
        /* Mengatur posisi relatif agar pseudo-element bisa diposisikan di dalamnya */
        position: relative;
        overflow: hidden; /* Penting untuk menjaga pseudo-element di dalam batas */
        z-index: 1; /* Memberi konten z-index lebih tinggi dari pseudo-element */
        height: auto;
    }

    .card-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        /* Gambar latar belakang diletakkan di pseudo-element */
        background-image: url('../cardBackground/bgCard1.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        opacity: 0.4;
        z-index: -1;
    }

        .g_id_signin.hidden {
            display: none !important;
        }

        button#logout-button.hidden,
        button#logout-button-mobile.hidden {
            display: none !important;
        }

        /* Responsive Iframe */
        .video-wrapper {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            border-radius: 0.5rem; /* rounded-lg */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* shadow-md */
        }

        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>

<body class="antialiased">

    <button id="scrollToTopBtn" title="Kembali ke Atas">↑</button>

    <header class="bg-white shadow-md py-4 px-6 md:px-12 sticky top-0 z-50 rounded-b-lg">
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

        <div id="mobile-menu" class="hidden md:hidden mt-4 space-y-2 px-4 pb-4 bg-white rounded-lg shadow-lg">
            <a href="#beranda"
                class="block text-gray-700 hover:text-indigo-600 font-medium py-2 transition duration-300">Beranda</a>
            <a href="#kelas"
                class="block text-gray-700 hover:text-indigo-600 font-medium py-2 transition duration-300">Dashboard</a>
            <a href="#program"
                class="block text-gray-700 hover:text-indigo-600 font-medium py-2 transition duration-300">Program</a>
            <a href="#galeri-video"
                class="text-gray-700 hover:text-indigo-600 font-medium py-2 transition duration-300">Galeri</a>
        </div>
    </header>

    <section id="beranda"
        class="hero-background py-20 md:py-32 text-center mb-12 min-h-[500px] md:min-h-[630px] flex flex-col justify-center">
        <div class="hero-content text-white text-left px-6">
            <h1 class="text-xl md:text-4xl font-extrabold leading-tight sm:mb-3 drop-shadow-lg">
                Dashboard
            </h1>
            <p class="text-3xl md:text-6xl font-extrabold text-[#d62037] sm:mb-3  max-w-xs sm:max-w-sm md:max-w-2xl break-words drop-shadow-md leading-snug">
                SD ISLAM CENDEKIA MUDA
            </p>
            <a href="#kelas"
                class="inline-block bg-white hover:bg-[#d62037] text-[#d62037] hover:text-white font-bold 
                py-2 px-5 text-base rounded-full 
                sm:py-3 sm:px-8 sm:text-lg 
                transition duration-900 transform hover:scale-105 shadow-lg">
                Mulai Sekarang
            </a>

        </div>
    </section>

    <section id="kelas"
        class="container mx-auto px-6 md:px-12 py-16 mb-12 bg-[#d62037] rounded-lg shadow-xl text-center">
        <h2 class="text-3xl md:text-4xl font-bold drop-shadow-lg text-white mb-10">Akses <span
                class="text-[#313556] drop-shadow-lg">Dashboard</span> </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div
                class="bg-white/90 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center p-6 sm:p-8">
                <div class="card-bg w-full rounded-lg flex-grow p-4 sm:p-6 mb-6 flex flex-col items-center justify-center text-center">
                    <h2 class="text-xl font-bold text-[#d62037] mb-1">DASHBOARD</h2>
                    <h3 class="text-base sm:text-xl font-semibold text-[#313556] mb-2">SD ISLAM CENDEKIA MUDA BANDUNG
                    </h3>
                    <p class="text-black-700 text-sm leading-relaxed mb-4">
                        Memperkenalkan dasar-dasar membaca, menulis, dan berhitung dengan metode yang menyenangkan dan
                        interaktif.
                    </p>
                </div>
                <a href="SD-Bandung.php"
                    class="dashboard-link inline-block bg-[#313556] text-white font-semibold py-2 px-6 rounded-md transition duration-300 w-full md:w-auto text-sm md:text-base">
                    SD Islam Cendekia Muda Bandung
                </a>
            </div>

            <div
                class="bg-white/90 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center p-6 sm:p-8">
                <div class="card-bg w-full rounded-lg flex-grow p-4 sm:p-6 mb-6 flex flex-col items-center justify-center text-center">
                    <h2 class="text-xl font-bold text-[#d62037] mb-1">DASHBOARD</h2>
                    <h3 class="text-base sm:text-xl font-semibold text-[#313556] mb-2">SD ISLAM CENDEKIA MUDA MAKASAR
                    </h3>
                    <p class="text-black-700 text-sm leading-relaxed mb-4">
                        Pengembangan kemampuan dasar dengan fokus pada pemecahan masalah dan kreativitas dalam setiap
                        pelajaran.
                    </p>
                </div>
                <a href="SD-Makasar.php"
                    class="dashboard-link inline-block bg-[#313556] text-white font-semibold py-2 px-6 rounded-md transition duration-300 w-full md:w-auto text-sm md:text-base">
                    SD Islam Cendekia Muda Makasar
                </a>
            </div>

            <div
                class="bg-white/90 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center p-6 sm:p-8">
                <div class="card-bg w-full rounded-lg flex-grow p-4 sm:p-6 mb-6 flex flex-col items-center justify-center text-center">
                    <h2 class="text-xl font-bold text-[#d62037] mb-1">DASHBOARD</h2>
                    <h3 class="text-base sm:text-xl font-semibold text-[#313556] mb-2">SD ISLAM CENDEKIA MUDA Program Bilingual
                    </h3>
                    <p class="text-black-700 text-sm leading-relaxed mb-4">
                        Membekali siswa dengan kemampuan berbahasa yang baik dalam dua bahasa, serta memperluas wawasan
                        mereka tentang budaya yang terkait dengan bahasa tersebut.
                    </p>
                </div>
                <a href="SD-Billingual"
                    class="dashboard-link target="_blank" inline-block bg-[#313556] text-white font-semibold py-2 px-6 rounded-md transition duration-300 w-full md:w-auto text-sm md:text-base">
                    SD Islam Cendekia Muda Program Bilingual
                </a>
            </div>

        </div>
    </section>

    <section id="program" class="bg-white py-16 mb-12 rounded-lg shadow-xl">
        <div class="container mx-auto px-6 md:px-12 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-[#313556] mb-10">Program Unggulan Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
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
                    <div class="text-indigo-500 text-5xl mb-4">🎨</div>
                    <h3 class="text-xl font-semibold text-[#313556] mb-3">Ekstrakurikuler Beragam</h3>
                    <p class="text-gray-600">
                        Mengembangkan bakat dan minat siswa melalui berbagai klub dan kegiatan.
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
            <h2 class="text-3xl md:text-4xl font-bold text-[#313556] mb-10">
                Galeri <span class="text-[#d62037]">Video Kegiatan SD</span>
            </h2>
            <p class="text-gray-600 mb-8">
                Beberapa dokumentasi kegiatan terbaru kami
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="video-wrapper">
                    <iframe src="https://www.youtube.com/embed/6rMofSvFhh0?si=sHEbjK9QvEI4gBSP" title="Video Kegiatan 1" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="video-wrapper">
                    <iframe src="https://www.youtube.com/embed/X9d1ZUDxYd8?si=_-ZWRnHB63ESlzE8" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>
                </div>
                <div class="video-wrapper">
                    <iframe src="https://www.youtube.com/embed/wY-RySfOnBM"
                        title="Plants And Animals Creation - Field Trip Level 3" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>
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
        window.onscroll = function () {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                scrollToTopBtn.style.display = "block";
            } else {
                scrollToTopBtn.style.display = "none";
            }
        };

        // When the user clicks on the button, scroll to the top of the document
        scrollToTopBtn.addEventListener("click", function () {
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