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
        @font-face {
            font-family: 'Segoe-ui';
            /* Ganti dengan nama font yang Anda inginkan */
            src: url('../fonts/segoeuithibd.ttf') format('ttf'),
                /* Ganti dengan jalur file font Anda */
                url('../fonts/segoeuithis.ttf') format('ttf'),
                url('../fonts/segoeuithisi.ttf') format('ttf'),
                url('../fonts/segoeuithisz.ttf') format('ttf');
            /* Tambahkan format lain jika tersedia */
            font-weight: 400;
            /* Sesuaikan dengan ketebalan font */
            font-style: normal;
            /* Sesuaikan dengan gaya font */
            font-display: swap;
            /* Opsional: Mengontrol bagaimana font dimuat dan ditampilkan */
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            /* General background color */
            color: #334155;
            /* General text color */
        }

        .hero-background {
            background-image: url('../image/try4.png');
            /* Ganti dengan jalur gambar latar belakang Anda */
            background-size: cover;
            background-position: center;
            position: relative;
            z-index: 0;
            overflow: hidden;
            /* Hide overflow from 3D canvas */
            /* Initial state for fade-in transition */
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
            /* Transition duration and timing function */
        }

        .hero-background.fade-in {
            opacity: 1;
            /* Final state for fade-in transition */
        }

        .hero-content {
            position: relative;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            z-index: 1;
            /* Ensure content is above canvas */
            padding: 5rem 0;
            /* Add padding to match original hero section */
        }

        /* Initial state for hero text elements */
        .hero-content h1,
        .hero-content p,
        .hero-content a {
            opacity: 0;
            transform: translateY(20px);
            /* Start slightly below */
            transition: opacity 1s ease-out, transform 1s ease-out;
            /* Transition for opacity and transform */
        }

        /* Final state for hero text elements (after fade-in) */
        .hero-content.show-text h1 {
            opacity: 1;
            transform: translateY(0);
            transition-delay: 0.5s;
            /* Delay for h1 */
        }

        .hero-content.show-text p {
            opacity: 1;
            transform: translateY(0);
            transition-delay: 0.8s;
            /* Delay for p */
        }

        .hero-content.show-text a {
            opacity: 1;
            transform: translateY(0);
            transition-delay: 1.1s;
            /* Delay for button */
        }


        /* Custom scroll-to-top button */
        #scrollToTopBtn {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Fixed position */
            bottom: 20px;
            /* Place at the bottom */
            right: 20px;
            /* Place at the right */
            z-index: 99;
            /* High z-index to be on top */
            border: none;
            /* Remove borders */
            outline: none;
            /* Remove outline */
            background-color: #4f46e5;
            /* Background color */
            color: white;
            /* Text color */
            cursor: pointer;
            /* Add a mouse pointer on hover */
            padding: 15px;
            /* Some padding */
            border-radius: 50%;
            /* Rounded corners */
            font-size: 18px;
            /* Increase font size */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        #scrollToTopBtn:hover {
            background-color: #4338ca;
            /* Darker background on hover */
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
            z-index: 1000;
            /* Ensure modal is on top */
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
            border-radius: 0.75rem;
            /* rounded-lg */
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
            color: #6b7280;
            /* gray-500 */
        }

        .modal-close-button:hover {
            color: #4b5563;
            /* gray-700 */
        }

        /* Style for clickable list items in modals */
        .modal-content ul li a {
            color: #4f46e5;
            /* Indigo-600 */
            text-decoration: none;
            transition: color 0.2s ease-in-out;
            display: block;
            /* Make the whole li clickable */
            padding: 0.25rem 0;
            /* Add some padding for better click area */
        }

        .modal-content ul li a:hover {
            color: #3730a3;
            /* Darker indigo on hover */
            text-decoration: underline;
        }

        /* Glassmorphism style for contact form */
        .glassmorphism-form {
            background: rgba(255, 255, 255, 0.15);
            /* Semi-transparent white */
            backdrop-filter: blur(10px);
            /* Frosted glass effect */
            -webkit-backdrop-filter: blur(10px);
            /* For Safari */
            border: 1px solid rgba(255, 255, 255, 0.2);
            /* Subtle border */
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            /* Subtle shadow */
        }

        html {
            scroll-padding-top: 100px;
        }

        /* Tambahan CSS untuk menyembunyikan/menampilkan Google button */
        .g_id_signin.hidden {
            display: none !important;
        }
        button#logout-button.hidden,
        button#logout-button-mobile.hidden {
            display: none !important;
        }
    </style>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>

<body class="antialiased">

    <button id="scrollToTopBtn" title="Kembali ke Atas">↑</button>

    <header class="bg-white shadow-md py-4 px-6 md:px-12 sticky top-0 z-50 rounded-b-lg">
        <nav class="container mx-auto flex justify-between items-center">
            <a href="#" class="flex items-center space-x-2">
                <img src="../image/logoSd1.png" alt="Logo Sekolah" class="h-20 w-30">
            </a>

            <div class="hidden md:flex space-x-8">
                <a href="#beranda"
                    class="text-gray-700 hover:text-indigo-600 font-medium transition duration-300">Beranda</a>
                <a href="#kelas" class="text-gray-700 hover:text-indigo-600 font-medium transition duration-300">Kelas
                    Kami</a>
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
                class="block text-gray-700 hover:text-indigo-600 font-medium py-2 transition duration-300">Kelas
                Kami</a>
            <a href="#program"
                class="block text-gray-700 hover:text-indigo-600 font-medium py-2 transition duration-300">Program</a>
            <a href="#galeri-video"
                class="text-gray-700 hover:text-indigo-600 font-medium py-2 transition duration-300">Galeri</a>
        </div>
    </header>

    <section id="beranda"
        class="hero-background py-20 md:py-32 text-center mb-12 h-[500px] md:h-[630px] flex flex-col justify-center">
        <div class="hero-content text-white text-left max-w-4xl px-6">
            <h1 class="text-lg md:text-4xl font-extrabold leading-tight mb-6 drop-shadow-lg">
                Dashboard
            </h1>
            <p class="text-3xl md:text-6xl font-extrabold text-[#d62037] mb-10 max-w-2xl drop-shadow-md">
                SD ISLAM CENDEKIA MUDA BANDUNG
            </p>
            <a href="#kelas"
                class="bg-white hover:bg-[#d62037] text-[#d62037] hover:text-white font-bold py-3 px-8 rounded-full text-lg transition duration-900 transform hover:scale-105 shadow-lg">
                Mulai Sekarang
            </a>
        </div>
    </section>

    <section id="kelas"
        class="container mx-auto px-6 md:px-12 py-16 mb-12 bg-[#d62037] rounded-lg shadow-xl text-center">
        <h2 class="text-3xl md:text-4xl font-bold drop-shadow-lg text-white mb-10">Pilihan <span
                class="text-[#313556] drop-shadow-lg">Kelas Kami</span> </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div
                class="bg-indigo-50 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center">
                <img src="../image/kelas1.png"
                    onerror="this.onerror=null;this.src='https://placehold.co/150x150/a78bfa/ffffff?text=Kelas+1';"
                    alt="Icon Kelas 1" class="w-36 h-36 rounded-full mb-6 object-cover border-4 border-indigo-300">
                <h3 class="text-2xl font-semibold text-indigo-700 mb-3">Level 1</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Memperkenalkan dasar-dasar membaca, menulis, dan berhitung dengan metode yang menyenangkan dan
                    interaktif.
                </p>
                <a href="https://sites.google.com/cendekiamuda.sch.id/2425sitelevel1/home"
                    class="dashboard-link inline-block bg-[#313556] text-white font-semibold py-2 px-6 rounded-md transition duration-300"
                    data-dashboard-url="https://sites.google.com/cendekiamuda.sch.id/2425sitelevel1/home">
                    Dashboard Level 1
                </a>
            </div>

            <div
                class="bg-indigo-50 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center">
                <img src="../image/kelas2.png"
                    onerror="this.onerror=null;this.src='https://placehold.co/150x150/a78bfa/ffffff?text=Kelas+2';"
                    alt="Icon Kelas 2" class="w-36 h-36 rounded-full mb-6 object-cover border-4 border-indigo-300">
                <h3 class="text-2xl font-semibold text-indigo-700 mb-3">Level 2</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Pengembangan kemampuan dasar dengan fokus pada pemecahan masalah dan kreativitas dalam setiap
                    pelajaran.
                </p>
                 <a href="https://sites.google.com/cendekiamuda.sch.id/2425sitelevel2/home"
                    class="dashboard-link inline-block bg-[#313556] text-white font-semibold py-2 px-6 rounded-md transition duration-300"
                    data-dashboard-url="https://sites.google.com/cendekiamuda.sch.id/2425sitelevel2/home">
                    Dashboard Level 2
                </a>
            </div>

            <div
                class="bg-indigo-50 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center">
                <img src="../image/kelas3.png"
                    onerror="this.onerror=null;this.src='https://placehold.co/150x150/a78bfa/ffffff?text=Kelas+3';"
                    alt="Icon Kelas 3" class="w-36 h-36 rounded-full mb-6 object-cover border-4 border-indigo-300">
                <h3 class="text-2xl font-semibold text-indigo-700 mb-3">Level 3</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Meningkatkan pemahaman konsep yang lebih kompleks dan pengenalan mata pelajaran baru.
                </p>
                 <a href="https://sites.google.com/cendekiamuda.sch.id/2425sitelevel3/home"
                    class="dashboard-link inline-block bg-[#313556] text-white font-semibold py-2 px-6 rounded-md transition duration-300"
                    data-dashboard-url="https://sites.google.com/cendekiamuda.sch.id/2425sitelevel3/home">
                    Dashboard Level 3
                </a>
            </div>
            <div
                class="bg-indigo-50 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center">
                <img src="../image/kelas3.png"
                    onerror="this.onerror=null;this.src='https://placehold.co/150x150/a78bfa/ffffff?text=Kelas+3';"
                    alt="Icon Kelas 3" class="w-36 h-36 rounded-full mb-6 object-cover border-4 border-indigo-300">
                <h3 class="text-2xl font-semibold text-indigo-700 mb-3">Level 4</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Meningkatkan pemahaman konsep yang lebih kompleks dan pengenalan mata pelajaran baru.
                </p>
                 <a href="https://sites.google.com/cendekiamuda.sch.id/2425sitelevel4/home"
                    class="dashboard-link inline-block bg-[#313556] text-white font-semibold py-2 px-6 rounded-md transition duration-300"
                    data-dashboard-url="https://sites.google.com/cendekiamuda.sch.id/2425sitelevel4/home">
                    Dashboard Level 4
                </a>
            </div>
            <div
                class="bg-indigo-50 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center">
                <img src="../image/kelas3.png"
                    onerror="this.onerror=null;this.src='https://placehold.co/150x150/a78bfa/ffffff?text=Kelas+3';"
                    alt="Icon Kelas 3" class="w-36 h-36 rounded-full mb-6 object-cover border-4 border-indigo-300">
                <h3 class="text-2xl font-semibold text-indigo-700 mb-3">Level 5</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Meningkatkan pemahaman konsep yang lebih kompleks dan pengenalan mata pelajaran baru.
                </p>
                 <a href="https://sites.google.com/cendekiamuda.sch.id/2425-site-level-5/home"
                    class="dashboard-link inline-block bg-[#313556] text-white font-semibold py-2 px-6 rounded-md transition duration-300"
                    data-dashboard-url="https://sites.google.com/cendekiamuda.sch.id/2425-site-level-5/home">
                    Dashboard Level 5
                </a>
            </div>
            <div
                class="bg-indigo-50 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center">
                <img src="../image/kelas3.png"
                    onerror="this.onerror=null;this.src='https://placehold.co/150x150/a78bfa/ffffff?text=Kelas+3';"
                    alt="Icon Kelas 3" class="w-36 h-36 rounded-full mb-6 object-cover border-4 border-indigo-300">
                <h3 class="text-2xl font-semibold text-indigo-700 mb-3">Level 6</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Meningkatkan pemahaman konsep yang lebih kompleks dan pengenalan mata pelajaran baru.
                </p>
                 <a href="https://sites.google.com/cendekiamuda.sch.id/2526sitelevel6/home-20252026"
                    class="dashboard-link inline-block bg-[#313556] text-white font-semibold py-2 px-6 rounded-md transition duration-300"
                    data-dashboard-url="https://sites.google.com/cendekiamuda.sch.id/2526sitelevel6/home-20252026">
                    Dashboard Level 6
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
                    <div class="text-indigo-500 text-5xl mb-4">📚</div> <h3 class="text-xl font-semibold text-[#313556] mb-3">Kurikulum Inovatif</h3>
                    <p class="text-gray-600">
                        Menggabungkan teori dan praktik dengan pendekatan berbasis proyek untuk pembelajaran yang
                        mendalam.
                    </p>
                </div>
                <div
                    class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-500 text-5xl mb-4">🔬</div> <h3 class="text-xl font-semibold text-[#313556] mb-3">Fasilitas Modern</h3>
                    <p class="text-gray-600">
                        Laboratorium canggih, perpustakaan digital, dan ruang kelas interaktif mendukung proses belajar.
                    </p>
                </div>
                <div
                    class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-500 text-5xl mb-4">🎨</div> <h3 class="text-xl font-semibold text-[#313556] mb-3">Ekstrakurikuler Beragam</h3>
                    <p class="text-gray-600">
                        Mengembangkan bakat dan minat siswa melalui berbagai klub dan kegiatan.
                    </p>
                </div>
                <div
                    class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-500 text-5xl mb-4">🤝</div> <h3 class="text-xl font-semibold text-[#313556] mb-3">Bimbingan Karir</h3>
                    <p class="text-gray-600">
                        Membantu siswa merencanakan masa depan mereka dengan bimbingan karir personal.
                    </p>
                </div>
                <div
                    class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-500 text-5xl mb-4">🌍</div> <h3 class="text-xl font-semibold text-[#313556] mb-3">Program Internasional</h3>
                    <p class="text-gray-600">
                        Kesempatan pertukaran pelajar dan kolaborasi global untuk pengalaman yang lebih luas.
                    </p>
                </div>
                <div
                    class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-500 text-5xl mb-4">🏆</div> <h3 class="text-xl font-semibold text-[#313556] mb-3">Pendidikan Holistik</h3>
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

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-8">

                <div class="relative w-full h-64 rounded-lg overflow-hidden shadow-md">
                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/6rMofSvFhh0?si=sHEbjK9QvEI4gBSP"
                        title="Video Kegiatan 1" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen>
                    </iframe>
                </div>


                <div class="relative w-full h-64 rounded-lg overflow-hidden shadow-md">
                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/X9d1ZUDxYd8?si=_-ZWRnHB63ESlzE8"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>
                </div>

                <div class="relative w-full h-64 rounded-lg overflow-hidden shadow-md">
                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/wY-RySfOnBM"
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