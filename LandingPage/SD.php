<?php
$nama_sekolah = "SD Raudhatul Jannah";
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sekolah Impian - Masa Depan Cerah Dimulai Di Sini</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="icon/TK RJ.png">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Mengubah definisi primary-color agar sesuai dengan warna yang digunakan di elemen */
        .primary-color {
            background-color: #B82132; /* Diperbarui agar sesuai dengan penggunaan di elemen */
        }

        /* Mengubah definisi text-primary-color agar sesuai dengan warna yang digunakan di elemen */
        .text-primary-color {
            color: #B82132; /* Diperbarui agar sesuai dengan penggunaan di elemen */
        }

        .border-primary-color {
            border-color: #B82132; /* Diperbarui agar sesuai dengan penggunaan di elemen */
        }

        /* Warna secondary tetap sesuai dengan yang Anda berikan */
        .secondary-color {
            background-color: #F9CB43;
        }

        .text-secondary-color {
            color: #F9CB43;
        }

        .text-third-color {
            color: #222221;
        }

        .background-kelas {
            color: #b4b4b4;
        }

        .background-dashboard {
            color: #B82132;
        }

        .secondary-back-color {
            color: #F2B28C;
        }

        /* Gaya untuk navbar saat discroll */
        .scrolled {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            transition: background-color 0.3s ease;
        }

        html {
            scroll-padding-top: 100px;
        }

        .floating-element {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-15px);
            }
        }

        /* --- Animasi Hero Section --- */

        /* Animasi Fade In & Scale untuk judul utama */
        .fade-in-scale {
            opacity: 0;
            transform: scale(0.9);
            animation: fadeInScale 1s ease-out forwards;
        }

        /* Penundaan untuk setiap elemen agar muncul berurutan */
        .fade-in-scale.delay-1 {
            animation-delay: 0.5s;
        }

        .fade-in-scale.delay-2 {
            animation-delay: 1s;
        }

        @keyframes fadeInScale {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Animasi Slide In untuk sub-judul "Student" */
        .slide-in-left {
            opacity: 0;
            transform: translateX(-50px);
            animation: slideInLeft 0.8s ease-out forwards;
        }

        @keyframes slideInLeft {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Animasi untuk tombol "Mulai Sekarang" */
        .bounce-in {
            opacity: 0;
            transform: translateY(20px);
            animation: bounceIn 0.6s ease-out forwards;
            animation-delay: 1.5s; /* Mulai setelah judul muncul */
        }

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            60% {
                opacity: 1;
                transform: translateY(-5px);
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body class="bg-gray-200">
    <nav id="navbar" class="fixed top-0 w-full z-50 py-4 px-6 md:px-12 flex justify-between items-center rounded-b-xl">
        <img src="image/Raudhatul Jannah.png" alt="Logo Sekolah" class="h-11 w-auto rounded-full mr-3">
        <div class="md:hidden">
            <button id="menu-button" class="text-gray-600 hover:text-primary-color focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </nav>

    <div class="pt-[]">
        <section id="beranda" class="text-white py-20 px-6 text-center rounded-b-xl shadow-lg min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('image/back-sd1.png');">
            <div class="max-w-4xl mx-auto p-8 rounded-xl">
                <!-- Tambahkan kelas animasi di sini -->
                <p class="text-lg md:text-xl mb-2 drop-shadow-md font-bold text-black slide-in-left">Student</p>
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6 drop-shadow-md text-[#B82132] fade-in-scale delay-1">Dashboard</h1>
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6 drop-shadow-md text-[#B82132] fade-in-scale delay-2"><?php echo $nama_sekolah; ?></h1>
                <!-- Tambahkan id 'mulaiSekarangBtn' pada tombol -->
                <a href="#dashboard" id="mulaiSekarangBtn" class="inline-block bg-[#B82132] text-white font-bold py-3 px-8 rounded-full shadow-lg transition duration-300 bounce-in">Mulai Sekarang</a>
            </div>
        </section>

        <section id="dashboard" class="py-12 px-6 md:px-12 bg-[#B82132] rounded-xl shadow-lg mt-8 mx-4 md:mx-auto max-w-6xl relative">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-white mb-10 drop-shadow-lg">Selamat Datang Di <span class="text-black drop-shadow-lg">Dashboard Kelas</span></h2>
            <div class="absolute top-0 right-0 m-4 bg-white text-black px-4 py-2 rounded-full shadow-md floating-element">🎈 Selamat Belajar!</div>
            <div class="flex flex-col md:flex-row gap-4 justify-center items-center relative">

                <!-- Card 1: TK A -->
                <div class="bg-white rounded-lg shadow-md p-4 flex flex-col items-center relative">
                    <img src="image/1.png" alt="Dashboard TK A Grade" class="w-40 h-40 object-cover rounded">
                    <div class="relative mt-2">
                        <!-- Tombol ini akan membuka modal untuk TK A -->
                        <button class="bg-[#B82132] px-3 py-1 text-white rounded text-sm border border-gray-300 open-kelas-modal-btn" data-kelas="1">Pilih Kelas 1</button>
                    </div>
                </div>

                <!-- Card 2: TK B -->
                <div class="bg-white rounded-lg shadow-md p-4 flex flex-col items-center relative">
                    <img src="image/2.png" alt="Dashboard TK B Grade" class="w-40 h-40 object-cover rounded">
                    <div class="relative mt-2">
                        <!-- Tombol ini akan membuka modal untuk TK B -->
                        <button class="bg-[#B82132] px-3 py-1 text-white rounded text-sm border border-gray-300 open-kelas-modal-btn" data-kelas="2">Pilih Kelas 2</button>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-4 flex flex-col items-center relative">
                    <img src="image/3.png" alt="Dashboard TK B Grade" class="w-40 h-40 object-cover rounded">
                    <div class="relative mt-2">
                        <!-- Tombol ini akan membuka modal untuk TK B -->
                        <button class="bg-[#B82132] px-3 py-1 text-white rounded text-sm border border-gray-300 open-kelas-modal-btn" data-kelas="3">Pilih Kelas 3</button>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-4 flex flex-col items-center relative">
                    <img src="image/4.png" alt="Dashboard TK B Grade" class="w-40 h-40 object-cover rounded">
                    <div class="relative mt-2">
                        <!-- Tombol ini akan membuka modal untuk TK B -->
                        <button class="bg-[#B82132] px-3 py-1 text-white rounded text-sm border border-gray-300 open-kelas-modal-btn" data-kelas="4">Pilih Kelas 4</button>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-4 flex flex-col items-center relative">
                    <img src="image/5.png" alt="Dashboard TK B Grade" class="w-40 h-40 object-cover rounded">
                    <div class="relative mt-2">
                        <!-- Tombol ini akan membuka modal untuk TK B -->
                        <button class="bg-[#B82132] px-3 py-1 text-white rounded text-sm border border-gray-300 open-kelas-modal-btn" data-kelas="5">Pilih Kelas 5</button>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-4 flex flex-col items-center relative">
                    <img src="image/6.png" alt="Dashboard TK B Grade" class="w-40 h-40 object-cover rounded">
                    <div class="relative mt-2">
                        <!-- Tombol ini akan membuka modal untuk TK B -->
                        <button class="bg-[#B82132] px-3 py-1 text-white rounded text-sm border border-gray-300 open-kelas-modal-btn" data-kelas="6">Pilih Kelas 6</button>
                    </div>
                </div>

            </div>

        </section>

        <!-- Modal "Pilih Kelas" yang akan digunakan secara dinamis -->
        <div id="kelasModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-80">
                <h2 class="text-xl font-bold mb-4" id="modalTitle">Pilih Kelas</h2>
                <!-- Konten link kelas akan dimuat secara dinamis di sini -->
                <div id="modalLinksContainer" class="">
                    <!-- Links akan dimasukkan oleh JavaScript -->
                </div>
                <button id="closeModal" class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 w-full">Tutup</button>
            </div>
        </div>


        <section id="instagram" class="py-12 px-6 md:px-12 bg-white rounded-xl shadow-lg mt-8 mx-4 md:mx-auto max-w-6xl">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-10 drop-shadow-lg">Postingan <span class="text-[#B82132] drop-shadow-lg">Instagram</span></h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 justify-items-center">
                <img src="image/postingan.jpg" alt="Postingan Instagram" class="w-[250px] h-[250px] object-cover rounded">
                <img src="image/postingan.jpg" alt="Postingan Instagram" class="w-[250px] h-[250px] object-cover rounded">
                <img src="image/postingan.jpg" alt="Postingan Instagram" class="w-[250px] h-[250px] object-cover rounded">
            </div>
        </section>

        <!-- Bagian Ajakan Bertindak (Call to Action) / Pendaftaran -->
        <section id="pendaftaran" class="bg-[#B82132] text-white py-16 px-6 md:px-12 text-center rounded-xl shadow-lg mx-4 md:mx-auto max-w-6xl mt-8">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Ada yang ingin di tanyakan?</h2>
            <p class="text-lg md:text-xl mb-8">Konsultasikan apa yang membuat anda bingung dengan cara klik tombol di bawah.</p>
            <a href="#kontak" class="inline-block bg-gray-400 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:bg-black transition duration-500">Hubungi Kami</a>
        </section>

        <!-- Bagian Kontak -->
        <section id="kontak" class="py-16 px-6 md:px-12 bg-white rounded-xl shadow-lg mx-4 md:mx-auto max-w-6xl mt-8 mb-8">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-10">Hubungi <span class="text-[#B82132]">Kami</span></h2>
            <div class="flex flex-col md:flex-row justify-center items-start md:space-x-12">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <p class="text-gray-700 mb-4"><strong class="text-[#B82132] drop-shadow-lg">Alamat:</strong>  Balai Janggo Jl. H. Rasul No.94, Koto Baru, Kec. Payakumbuh Utara, Kota Payakumbuh, Sumatera Barat 26211</p>
                    <p class="text-gray-700 mb-4"><strong class="text-[#B82132] drop-shadow-lg">Telepon:</strong> (0752) 94663</p>
                    <div class="mt-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Jam Operasional Kantor:</h3>
                        <ul class="list-disc list-inside text-gray-700">
                            <li>Senin - Jumat: 08:00 - 16:00 WIB</li>
                            <li>Sabtu: 09:00 - 13:00 WIB</li>
                            <li>Minggu: Tutup</li>
                        </ul>
                    </div>
                </div>
                <div class="md:w-1/2 w-full">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Kirim Pesan kepada Kami:</h3>
                    <form class="space-y-4" action="submit_message.php" method="POST">
                        <div>
                            <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap:</label>
                            <input type="text" id="nama" name="nama" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent" placeholder="Nama Anda" required>
                        </div>
                        <div>
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                            <input type="email" id="email" name="email" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent" placeholder="email@contoh.com" required>
                        </div>
                        <div>
                            <label for="pesan" class="block text-gray-700 text-sm font-bold mb-2">Pesan Anda:</label>
                            <textarea id="pesan" name="pesan" rows="5" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-color focus:border-transparent" placeholder="Tulis pesan Anda di sini..." required></textarea>
                        </div>
                        <input type="hidden" name="unit_asal" value="SD">
                        <input type="hidden" name="redirect_url" value="sd.php"> <div>

                        <button type="submit" class="bg-[#27445D] text-white font-bold py-3 px-6 rounded-full shadow-lg hover:bg-orange-600 transition duration-300">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-[#B82132] text-white py-8 px-6 md:px-12 text-center rounded-t-xl mt-8">
            <p>&copy; 2025 Sekolah Impian. Hak Cipta Dilindungi Undang-Undang.</p>
            <div class="flex justify-center space-x-6 mt-4">
                <a href="#" class="hover:text-secondary-color transition duration-300">Kebijakan Privasi</a>
                <a href="#" class="hover:text-secondary-color transition duration-300">Syarat & Ketentuan</a>
            </div>
        </footer>
    </div>

    <script>
        // JavaScript untuk modal (pop-up)
        const modal = document.getElementById('kelasModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalLinksContainer = document.getElementById('modalLinksContainer');
        const openModalBtns = document.querySelectorAll('.open-kelas-modal-btn');
        const closeModalBtn = document.getElementById('closeModal');

        const kelasOptions = {
            '1': [
                { name: 'Kelas Abu Bakar Ash Shidiq (TAHFIZH)', url: '' },
                { name: 'Kelas Utsman Bin Affan', url: '' },
                { name: 'Kelas Umar Bin Khattab (FULLDAY)', url: 'kelas1-umar.html' }
            ],
            '2': [
                { name: 'Kelas Abdurrahman Bin Auf', url: '' },
                { name: 'Kelas Zubair Bin Awwam', url: '' },
                { name: 'Kelas Sa’ad Bin Abi Waqqash (TAHFIZH)', url: '' },
                { name: 'Kelas Thalhah Bin Ubaidillah (FULLDAY)', url:''}
            ],
            '3': [
                { name: 'Kelas Al-Kautase', url: '' },
                { name: 'Kelas An-Nahl', url: '' },
                { name: 'Kelas Ar-Rahman', url: '' },
                { name: 'Kelas Ali-Imran (FULLDAY)', url: '' },
                { name: 'Kelas Luqman (FULLDAY)', url: '' },
            ],
            '4': [
                { name: 'Kelas Ayyasy Bin Abi Rubai’ah (DIGITAL)', url: '' },
                { name: 'Kelas Hamzah Bin Abdul Muthalib (FULLDAY)', url: '' },
                { name: 'Kelas Ukhasyah Bin Mihsan', url: '' },
                { name: 'Kelas Salahuddin Al Ayyubi', url: '' },
                { name: 'Kelas Hudzaifah Bin Al Yaman', url: '' },
            ],
            '5': [
                { name: 'Kelas Muhammad Al-Fatih (DIGITAL)', url: '' },
                { name: 'Kelas Ibnu Sina', url: '' },
                { name: 'Kelas Jafar Bin Abu Thalib', url: '' },
                { name: 'Kelas Al Biruni', url: '' },
                { name: 'Kelas Al-Khawarizmi', url: '' },
                { name: 'Kelas Al Jazari', url: '' },
            ],
            '6': [
                { name: 'Kelas Makkah', url: '' },
                { name: 'Kelas Madinah', url: '' },
                { name: 'Kelas Jeddah', url: '' },
                { name: 'Kelas Cordoba', url: '' },
                { name: 'Kelas Istanbul', url: '' },
                { name: 'Kelas Amman', url: '' },
            ]
        };

        function populateModal(kelasType) {
            modalLinksContainer.innerHTML = '';
            const classes = kelasOptions[kelasType] || [];
            if (classes.length > 0) {
                classes.forEach(kelas => {
                    const link = document.createElement('a');
                    link.href = kelas.url;
                    link.textContent = kelas.name;
                    link.className = 'block px-4 py-2 hover:bg-gray-100';
                    modalLinksContainer.appendChild(link);
                });
            } else {
                modalLinksContainer.innerHTML = '<p class="text-center text-gray-500">Belum ada kelas tersedia.</p>';
            }
        }

        openModalBtns.forEach(button => {
            button.addEventListener('click', () => {
                const kelasType = button.dataset.kelas;
                modalTitle.textContent = `Pilih Kelas ${kelasType}`;
                populateModal(kelasType);
                modal.classList.remove('hidden');
            });
        });

        closeModalBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });


        const navbar = document.getElementById('navbar');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 10) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // JavaScript untuk smooth scroll saat tombol "Mulai Sekarang" diklik
        document.getElementById('mulaiSekarangBtn').addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah perilaku default dari link anchor

            const targetId = this.getAttribute('href'); // Mendapatkan ID target dari atribut href
            const targetElement = document.querySelector(targetId); // Mendapatkan elemen target

            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth' // Mengaktifkan efek smooth scroll
                });
            }
        });
    </script>
</body>

</html>
