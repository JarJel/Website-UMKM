<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sekolah Impian - Masa Depan Cerah Dimulai di Sini</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../icon/iconTk.png">
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <style>
        @font-face {
            font-family: 'Segoe-ui';
            src: url('../fonts/segoeuithibd.ttf') format('ttf'),
                 url('../fonts/segoeuithis.ttf') format('ttf'),
                 url('../fonts/segoeuithisi.ttf') format('ttf'),
                 url('../fonts/segoeuithisz.ttf') format('ttf');
            font-weight: 400;
            font-style: normal;
            font-display: swap;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }
        .hero-background {
            background-image: url('../image/backgroundTk.png');
            background-size: cover;
            background-position: center;
            position: relative;
            z-index: 0;
            overflow: hidden;
            }
    
        .hero-content {
            position: relative;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            z-index: 1;
            padding: 5rem 0;
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
        }
        .modal-close-button:hover {
            color: #4b5563;
        }
        /* Style for clickable list items in modals */
        .modal-content ul li a {
            color: #4f46e5;
            text-decoration: none;
            transition: color 0.2s ease-in-out;
            display: block;
            padding: 0.25rem 0;
        }
        .modal-content ul li a:hover {
            color: #3730a3;
            text-decoration: underline;
        }

        /* Glassmorphism style for contact form */
        .glassmorphism-form {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }
        html {
            scroll-padding-top: 100px;
        }


        @media (max-width: 767px) {
            .md\:flex-row {
                flex-direction: column;
                align-items: flex-start; 
            }
            .md\:space-x-8 > *:not([hidden]) ~ *:not([hidden]) {
                margin-left: 0 !important;
                margin-top: 1rem;
            }
        }
    </style>
</head>
<body class="antialiased">

    <button id="scrollToTopBtn" title="Kembali ke Atas">↑</button>

    <header class="bg-white shadow-md py-4 px-6 md:px-12 sticky top-0 z-50 rounded-b-lg">
        <nav class="container mx-auto flex justify-between items-center">
            <a href="#" class="flex items-center space-x-2">
                <img src="../image/logoTk1.png" alt="Logo Sekolah" class="h-20 w-30">
            </a>

            <div class="hidden md:flex md:flex-row md:space-x-8 items-center">
                <a href="#beranda" class="text-gray-700 hover:text-indigo-600 font-medium transition duration-300">Beranda</a>
                <a href="#kelas" class="text-gray-700 hover:text-indigo-600 font-medium transition duration-300">Kelas Kami</a>
                <a href="#program" class="text-gray-700 hover:text-indigo-600 font-medium transition duration-300">Program</a>
                <a href="#galeri-video" class="text-gray-700 hover:text-indigo-600 font-medium transition duration-300">Galeri</a>
            </div>

            <button id="mobile-menu-button" class="md:hidden text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </nav>

        <div id="mobile-menu" class="hidden md:hidden mt-4 flex flex-col space-y-2 px-4 pb-4 bg-white rounded-lg shadow-lg">
            <a href="#beranda" class="block text-gray-700 hover:text-indigo-600 font-medium py-2 transition duration-300">Beranda</a>
            <a href="#kelas" class="block text-gray-700 hover:text-indigo-600 font-medium py-2 transition duration-300">Kelas Kami</a>
            <a href="#program" class="block text-gray-700 hover:text-indigo-600 font-medium py-2 transition duration-300">Program</a>
            <a href="#galeri-video" class="block text-gray-700 hover:text-indigo-600 font-medium py-2 transition duration-300">Galeri</a>
        </div>
    </header>

    <section id="beranda" class="hero-background py-20 md:py-32 text-center mb-12 h-[500px] md:h-[630px] flex flex-col justify-center">
        <div class="hero-content text-white text-left max-w-4xl px-6">
            <h1 class="text-lg md:text-4xl font-extrabold leading-tight mb-6 drop-shadow-lg">
                Dashboard
            </h1>
            <p class="text-3xl md:text-6xl font-extrabold text-[#f26b35] mb-10 max-w-2xl drop-shadow-md">
                TK ISLAM CENDEKIA MUDA BANDUNG
            </p>
            <a href="#kelas" class="bg-white hover:bg-[#f06a35] text-[#f06a35] hover:text-white font-bold py-3 px-8 rounded-full text-lg transition duration-900 transform hover:scale-105 shadow-lg">
                Mulai Sekarang
            </a>
        </div>
    </section>

    <section id="kelas" class="container mx-auto px-6 md:px-12 py-16 mb-12 bg-[#f06a35] rounded-lg shadow-xl text-center">
        <h2 class="text-3xl md:text-4xl font-bold drop-shadow-lg text-white mb-10">Pilihan <span class="text-[#313556] drop-shadow-lg">Kelas Kami</span> </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="class-card bg-indigo-50 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center">
                <img src="../imageTK/1.png" onerror="this.onerror=null;this.src='https://placehold.co/150x150/a78bfa/ffffff?text=Kelas+1';" alt="Icon Kelas 1" class="w-36 h-36 rounded-full mb-6 object-cover border-4 border-indigo-300">
                <h3 class="text-2xl font-semibold text-indigo-700 mb-3">WATERMELLON CLASS</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Memperkenalkan dasar-dasar membaca, menulis, dan berhitung dengan metode yang menyenangkan dan interaktif.
                </p>
                <a href="https://sites.google.com/u/0/d/1otgGJ09KXBuWdpwkDT5wTeU2l3m4TOhc/preview" target="_blank" class="class-link inline-block bg-[#313556] text-white font-semibold py-2 px-6 rounded-md transition duration-300 hover:bg-[#1e253e] text-center" data-class-url="https://sites.google.com/u/0/d/1otgGJ09KXBuWdpwkDT5wTeU2l3m4TOhc/preview">
                    Lihat Detail Kelas
                </a>
            </div>

            <div class="class-card bg-indigo-50 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center">
                <img src="../imageTK/2.png" onerror="this.onerror=null;this.src='https://placehold.co/150x150/a78bfa/ffffff?text=Kelas+2';" alt="Icon Kelas 2" class="w-36 h-36 rounded-full mb-6 object-cover border-4 border-indigo-300">
                <h3 class="text-2xl font-semibold text-indigo-700 mb-3">PUMPKIN CLASS</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Memperkenalkan dasar-dasar membaca, menulis, dan berhitung dengan metode yang menyenangkan dan interaktif.
                </p>
                <a href="https://sites.google.com/u/0/d/1VClgf98aOhJTcJVuhyr8TQBxsWdR275Y/preview" target="_blank" class="class-link inline-block bg-[#313556] text-white font-semibold py-2 px-6 rounded-md transition duration-300 hover:bg-[#1e253e] text-center" data-class-url="https://sites.google.com/u/0/d/1VClgf98aOhJTcJVuhyr8TQBxsWdR275Y/preview">
                    Lihat Detail Kelas
                </a>
            </div>

            <div class="class-card bg-indigo-50 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center">
                <img src="../imageTK/3.png" onerror="this.onerror=null;this.src='https://placehold.co/150x150/a78bfa/ffffff?text=Kelas+2';" alt="Icon Kelas 2" class="w-36 h-36 rounded-full mb-6 object-cover border-4 border-indigo-300">
                <h3 class="text-2xl font-semibold text-indigo-700 mb-3">POMELO CLASS</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Memperkenalkan dasar-dasar membaca, menulis, dan berhitung dengan metode yang menyenangkan dan interaktif.
                </p>
                <a href="https://sites.google.com/u/0/d/1cIAq4_dpaysDFf0RHfPHCXu-9OuFlHzv/preview" target="_blank" class="class-link inline-block bg-[#313556] text-white font-semibold py-2 px-6 rounded-md transition duration-300 hover:bg-[#1e253e] text-center" data-class-url="https://sites.google.com/u/0/d/1cIAq4_dpaysDFf0RHfPHCXu-9OuFlHzv/preview">
                    Lihat Detail Kelas
                </a>
            </div>

            <div class="class-card bg-indigo-50 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center">
                <img src="../imageTK/4.png" onerror="this.onerror=null;this.src='https://placehold.co/150x150/a78bfa/ffffff?text=Kelas+2';" alt="Icon Kelas 2" class="w-36 h-36 rounded-full mb-6 object-cover border-4 border-indigo-300">
                <h3 class="text-2xl font-semibold text-indigo-700 mb-3">PINEAPPLE CLASS</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Memperkenalkan dasar-dasar membaca, menulis, dan berhitung dengan metode yang menyenangkan dan interaktif.
                </p>
                <a href="https://sites.google.com/u/0/d/1k7bBFPVzJnp0m-EPkEkSD6zLOa-jCeV1/preview" target="_blank" class="class-link inline-block bg-[#313556] text-white font-semibold py-2 px-6 rounded-md transition duration-300 hover:bg-[#1e253e] text-center" data-class-url="https://sites.google.com/u/0/d/1k7bBFPVzJnp0m-EPkEkSD6zLOa-jCeV1/preview">
                    Lihat Detail Kelas
                </a>
            </div>

            <div class="class-card bg-indigo-50 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center">
                <img src="../imageTK/5.png" onerror="this.onerror=null;this.src='https://placehold.co/150x150/a78bfa/ffffff?text=Kelas+2';" alt="Icon Kelas 2" class="w-36 h-36 rounded-full mb-6 object-cover border-4 border-indigo-300">
                <h3 class="text-2xl font-semibold text-indigo-700 mb-3">ORANGE CLASS</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Memperkenalkan dasar-dasar membaca, menulis, dan berhitung dengan metode yang menyenangkan dan interaktif.
                </p>
                <a href="https://sites.google.com/u/0/d/1ZijJjRG9a4jEMjwO0V0XDqW8KqrhTVpJ/preview" target="_blank" class="class-link inline-block bg-[#313556] text-white font-semibold py-2 px-6 rounded-md transition duration-300 hover:bg-[#1e253e] text-center" data-class-url="https://sites.google.com/u/0/d/1ZijJjRG9a4jEMjwO0V0XDqW8KqrhTVpJ/preview">
                    Lihat Detail Kelas
                </a>
            </div>

            <div class="class-card bg-indigo-50 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center">
                <img src="../imageTK/6.png" onerror="this.onerror=null;this.src='https://placehold.co/150x150/a78bfa/ffffff?text=Kelas+2';" alt="Icon Kelas 2" class="w-36 h-36 rounded-full mb-6 object-cover border-4 border-indigo-300">
                <h3 class="text-2xl font-semibold text-indigo-700 mb-3">KIWI CLASS</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Memperkenalkan dasar-dasar membaca, menulis, dan berhitung dengan metode yang menyenangkan dan interaktif.
                </p>
                <a href="https://sites.google.com/u/0/d/17-hVM8N7D95SxCv9myaFrRQNz9HdqRYn/preview" target="_blank" class="class-link inline-block bg-[#313556] text-white font-semibold py-2 px-6 rounded-md transition duration-300 hover:bg-[#1e253e] text-center" data-class-url="https://sites.google.com/u/0/d/17-hVM8N7D95SxCv9myaFrRQNz9HdqRYn/preview">
                    Lihat Detail Kelas
                </a>
            </div>

            <div class="class-card bg-indigo-50 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center">
                <img src="../imageTK/7.png" onerror="this.onerror=null;this.src='https://placehold.co/150x150/a78bfa/ffffff?text=Kelas+2';" alt="Icon Kelas 2" class="w-36 h-36 rounded-full mb-6 object-cover border-4 border-indigo-300">
                <h3 class="text-2xl font-semibold text-indigo-700 mb-3">HONEYDEW CLASS</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Memperkenalkan dasar-dasar membaca, menulis, dan berhitung dengan metode yang menyenangkan dan interaktif.
                </p>
                <a href="https://sites.google.com/u/0/d/1210n0nu1Bh9d9ZA5RIYLpZZ5a4-967jR/preview" target="_blank" class="class-link inline-block bg-[#313556] text-white font-semibold py-2 px-6 rounded-md transition duration-300 hover:bg-[#1e253e] text-center" data-class-url="https://sites.google.com/u/0/d/1210n0nu1Bh9d9ZA5RIYLpZZ5a4-967jR/preview">
                    Lihat Detail Kelas
                </a>
            </div>

            <div class="class-card bg-indigo-50 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center">
                <img src="../imageTK/8.png" onerror="this.onerror=null;this.src='https://placehold.co/150x150/a78bfa/ffffff?text=Kelas+2';" alt="Icon Kelas 2" class="w-36 h-36 rounded-full mb-6 object-cover border-4 border-indigo-300">
                <h3 class="text-2xl font-semibold text-indigo-700 mb-3">COCONUT CLASS</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Memperkenalkan dasar-dasar membaca, menulis, dan berhitung dengan metode yang menyenangkan dan interaktif.
                </p>
                <a href="https://sites.google.com/u/0/d/1HYGGnekQJ5UiJZBpZsjrelFkUqBqRsQt/preview" target="_blank" class="class-link inline-block bg-[#313556] text-white font-semibold py-2 px-6 rounded-md transition duration-300 hover:bg-[#1e253e] text-center" data-class-url="https://sites.google.com/u/0/d/1HYGGnekQJ5UiJZBpZsjrelFkUqBqRsQt/preview">
                    Lihat Detail Kelas
                </a>
            </div>

            <div class="class-card bg-indigo-50 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center">
                <img src="../imageTK/9.png" onerror="this.onerror=null;this.src='https://placehold.co/150x150/a78bfa/ffffff?text=Kelas+2';" alt="Icon Kelas 2" class="w-36 h-36 rounded-full mb-6 object-cover border-4 border-indigo-300">
                <h3 class="text-2xl font-semibold text-indigo-700 mb-3">CHERRY CLASS</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Memperkenalkan dasar-dasar membaca, menulis, dan berhitung dengan metode yang menyenangkan dan interaktif.
                </p>
                <a href="https://sites.google.com/u/0/d/1VrKxcKJihq6OplbkSKVRjVrT4rw5zUxS/preview" target="_blank" class="class-link inline-block bg-[#313556] text-white font-semibold py-2 px-6 rounded-md transition duration-300 hover:bg-[#1e253e] text-center" data-class-url="https://sites.google.com/u/0/d/1VrKxcKJihq6OplbkSKVRjVrT4rw5zUxS/preview">
                    Lihat Detail Kelas
                </a>
            </div>

            <div class="class-card bg-indigo-50 p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col items-center">
                <img src="../imageTK/10.png" onerror="this.onerror=null;this.src='https://placehold.co/150x150/a78bfa/ffffff?text=Kelas+2';" alt="Icon Kelas 2" class="w-36 h-36 rounded-full mb-6 object-cover border-4 border-indigo-300">
                <h3 class="text-2xl font-semibold text-indigo-700 mb-3">APPLE CLASS</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Memperkenalkan dasar-dasar membaca, menulis, dan berhitung dengan metode yang menyenangkan dan interaktif.
                </p>
                <a href="https://sites.google.com/u/0/d/1AspQJAr9uobJEAt6bkpz37bTE9OM9Rso/preview" target="_blank" class="class-link inline-block bg-[#313556] text-white font-semibold py-2 px-6 rounded-md transition duration-300 hover:bg-[#1e253e] text-center" data-class-url="https://sites.google.com/u/0/d/1AspQJAr9uobJEAt6bkpz37bTE9OM9Rso/preview">
                    Lihat Detail Kelas
                </a>
            </div>
        </div>
    </section>

    <section id="program" class="bg-white py-16 mb-12 rounded-lg shadow-xl">
        <div class="container mx-auto px-6 md:px-12 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-[#313556] mb-10">Program Unggulan Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-500 text-5xl mb-4">📚</div> <h3 class="text-xl font-semibold text-[#313556] mb-3">Kurikulum Inovatif</h3>
                    <p class="text-gray-600">
                        Menggabungkan teori dan praktik dengan pendekatan berbasis proyek untuk pembelajaran yang mendalam.
                    </p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-500 text-5xl mb-4">🔬</div> <h3 class="text-xl font-semibold text-[#313556] mb-3">Fasilitas Modern</h3>
                    <p class="text-gray-600">
                        Laboratorium canggih, perpustakaan digital, dan ruang kelas interaktif mendukung proses belajar.
                    </p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-500 text-5xl mb-4">🎨</div> <h3 class="text-xl font-semibold text-[#313556] mb-3">Ekstrakurikuler Beragam</h3>
                    <p class="text-gray-600">
                        Mengembangkan bakat dan minat siswa melalui berbagai klub dan kegiatan.
                    </p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-500 text-5xl mb-4">🤝</div> <h3 class="text-xl font-semibold text-[#313556] mb-3">Bimbingan Karir</h3>
                    <p class="text-gray-600">
                        Membantu siswa merencanakan masa depan mereka dengan bimbingan karir personal.
                    </p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="text-indigo-500 text-5xl mb-4">🌍</div> <h3 class="text-xl font-semibold text-[#313556] mb-3">Program Internasional</h3>
                    <p class="text-gray-600">
                        Kesempatan pertukaran pelajar dan kolaborasi global untuk pengalaman yang lebih luas.
                    </p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
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
                Galeri <span class="text-[#f06a35]">Video Kegiatan TK</span>
            </h2>
            <p class="text-gray-600 mb-8">
                Beberapa dokumentasi kegiatan terbaru kami
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-8">
                <div class="relative w-full h-64 rounded-lg overflow-hidden shadow-md">
                    <iframe class="w-full h-full"
                        src="https://www.youtube.com/embed/bY47q5UKKng?si=AN0oFB6sJ5uYT5Nb"
                        title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>
                </div>
                <div class="relative w-full h-64 rounded-lg overflow-hidden shadow-md">
                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/IaKmz4MzvI8"
                        title="Fashion Show - MINGGON SUNDA TK ISLAM CENDEKIA MUDA 2023"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>
                </div>
                <div class="relative w-full h-64 rounded-lg overflow-hidden shadow-md">
                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/7rJE2xfgo6c"
                        title="🟠 [LIVE] ASSEMBLY ORANGE CLASS - ALLAH SEES AND PROTECTS"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-[#f06a35] text-white py-8 mt-12 rounded-t-lg">
        <div class="container mx-auto px-6 md:px-12 text-center">
            <p>© 2025 TK ISLAM CENDEKIA MUDA. Hak Cipta Dilindungi.</p>
            <div class="flex justify-center space-x-6 mt-4">
                <a href="#" class="text-white hover:text-white transition duration-300">Facebook</a>
                <a href="#" class="text-white hover:text-white transition duration-300">Instagram</a>
                <a href="#" class="text-white hover:text-white transition duration-300">Twitter</a>
            </div>
        </div>
    </footer>


    <script>
        // Panggil updateLoginStateUI saat DOM selesai dimuat
        window.addEventListener('DOMContentLoaded', () => {
            updateLoginStateUI(); // Panggil saat halaman pertama kali dimuat
        });


        // Tambahkan kode ini untuk menampilkan teks hero
    document.addEventListener('DOMContentLoaded', function() {
        const heroContent = document.querySelector('.hero-content');
        if (heroContent) {
            // Menambahkan kelas `show-text` setelah jeda singkat
            // agar transisi terlihat lebih halus
            setTimeout(() => {
                heroContent.classList.add('show-text');
            }, 100);
        }
    });

        // Tambahkan event listener untuk mencegah navigasi jika link kelas tidak aktif
        document.addEventListener('click', function(event) {
            const target = event.target;
            // Periksa jika yang diklik adalah link kelas yang dinonaktifkan
            if (target.matches('.class-link[data-disabled="true"]')) {
                event.preventDefault(); // Mencegah navigasi
                alert('Silakan login terlebih dahulu untuk mengakses kelas ini.');
            }
        }); 
    </script>
</body>
</html>