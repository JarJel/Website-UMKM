<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard BUMDES - Verifikasi Seller</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1d4657',
                        secondary: '#11676a',
                        accent: '#b0b32a',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .sidebar {
            transition: all 0.3s ease;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 50;
                height: 100vh;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 40;
            }
            
            .overlay.active {
                display: block;
            }
        }
        
        .stats-card {
            transition: transform 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
        }
        
        .verification-item {
            transition: background-color 0.2s ease;
        }
        
        .verification-item:hover {
            background-color: #f3f4f6;
        }
    </style>
</head>

<body class="flex bg-gray-100 min-h-screen">
    <!-- Mobile menu button -->
    <div class="md:hidden fixed top-4 left-4 z-50">
        <button id="menuBtn" class="p-2 rounded-md bg-primary text-white">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Overlay for mobile -->
    <div id="overlay" class="overlay"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar w-64 bg-primary text-white min-h-screen p-5">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-bold">BUMDES</h1>
            <button id="closeMenu" class="md:hidden">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <nav class="space-y-2">
            <a href="{{ route('bumdes.dashboard') }}" class="flex items-center py-2 px-4 hover:bg-secondary rounded-md transition">
                <i class="fas fa-home mr-3"></i> Dashboard
            </a>
            <a href="{{ route('bumdes.verifikasi') }}" class="flex items-center py-2 px-4 hover:bg-secondary rounded-md transition">
                <i class="fas fa-home mr-3"></i> Verifikasi Seller
            </a>
            <a href="{{ route('bumdes.usaha') }}" class="flex items-center py-2 px-4 hover:bg-secondary rounded-md transition">
                <i class="fas fa-list mr-3"></i> Daftar Usaha
            </a>
            <a href="{{ route('bumdes.seller') }}" class="flex items-center py-2 px-4 hover:bg-secondary rounded-md transition">
                <i class="fas fa-users mr-3"></i> Manajemen Seller
            </a>
            <a href="{{ route('bumdes.laporan') }}" class="flex items-center py-2 px-4 hover:bg-secondary rounded-md transition">
                <i class="fas fa-chart-bar mr-3"></i> Transaksi & Laporan
            </a>
            <a href="{{ route('bumdes.arsip') }}" class="flex items-center py-2 px-4 hover:bg-secondary rounded-md transition">
                <i class="fas fa-archive mr-3"></i> Arsip & Dokumen
            </a>
            <a href="{{ route('bumdes.profil') }}" class="flex items-center py-2 px-4 hover:bg-secondary rounded-md transition">
                <i class="fas fa-building mr-3"></i> Profil BUMDES
            </a>
            <a href="#" class="flex items-center py-2 px-4 hover:bg-secondary rounded-md transition mt-10">
                <i class="fas fa-sign-out-alt mr-3"></i> Logout
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-4 md:p-8">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-primary">Verifikasi Seller</h2>
            <p class="text-gray-600">Verifikasi SKU yang dikirim seller sebagai syarat menjadi seller</p>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="stats-card bg-white p-4 rounded-lg shadow-md border-l-4 border-accent">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500">Menunggu Verifikasi</p>
                        <h3 class="text-2xl font-bold text-primary">24</h3>
                    </div>
                    <div class="bg-accent/20 p-3 rounded-full">
                        <i class="fas fa-clock text-accent text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="stats-card bg-white p-4 rounded-lg shadow-md border-l-4 border-green-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500">Terverifikasi</p>
                        <h3 class="text-2xl font-bold text-primary">156</h3>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-check-circle text-green-500 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="stats-card bg-white p-4 rounded-lg shadow-md border-l-4 border-red-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500">Ditolak</p>
                        <h3 class="text-2xl font-bold text-primary">12</h3>
                    </div>
                    <div class="bg-red-100 p-3 rounded-full">
                        <i class="fas fa-times-circle text-red-500 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="stats-card bg-white p-4 rounded-lg shadow-md border-l-4 border-blue-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500">Total Seller</p>
                        <h3 class="text-2xl font-bold text-primary">192</h3>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-users text-blue-500 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Verification List -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-primary">Daftar Permohonan Verifikasi</h3>
                <div class="flex space-x-2">
                    <div class="relative">
                        <input type="text" placeholder="Cari seller..." class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-accent">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <select class="border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-accent">
                        <option>Semua Status</option>
                        <option>Menunggu</option>
                        <option>Diterima</option>
                        <option>Ditolak</option>
                    </select>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left border-b">
                            <th class="pb-3">Nama Seller</th>
                            <th class="pb-3">Usaha</th>
                            <th class="pb-3">Tanggal Daftar</th>
                            <th class="pb-3">Status</th>
                            <th class="pb-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="verification-item border-b">
                            <td class="py-4">Ahmad Sutisna</td>
                            <td class="py-4">Kerajinan Bambu</td>
                            <td class="py-4">18 Sep 2025</td>
                            <td class="py-4"><span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Menunggu</span></td>
                            <td class="py-4 text-center">
                                <button class="bg-accent text-white px-3 py-1 rounded-md text-sm mr-2">Detail</button>
                                <button class="bg-primary text-white px-3 py-1 rounded-md text-sm">Proses</button>
                            </td>
                        </tr>
                        <tr class="verification-item border-b">
                            <td class="py-4">Siti Rahayu</td>
                            <td class="py-4">Makanan Tradisional</td>
                            <td class="py-4">17 Sep 2025</td>
                            <td class="py-4"><span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Menunggu</span></td>
                            <td class="py-4 text-center">
                                <button class="bg-accent text-white px-3 py-1 rounded-md text-sm mr-2">Detail</button>
                                <button class="bg-primary text-white px-3 py-1 rounded-md text-sm">Proses</button>
                            </td>
                        </tr>
                        <tr class="verification-item border-b">
                            <td class="py-4">Budi Santoso</td>
                            <td class="py-4">Konveksi Rumahan</td>
                            <td class="py-4">16 Sep 2025</td>
                            <td class="py-4"><span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Menunggu</span></td>
                            <td class="py-4 text-center">
                                <button class="bg-accent text-white px-3 py-1 rounded-md text-sm mr-2">Detail</button>
                                <button class="bg-primary text-white px-3 py-1 rounded-md text-sm">Proses</button>
                            </td>
                        </tr>
                        <tr class="verification-item border-b">
                            <td class="py-4">Dewi Anggraini</td>
                            <td class="py-4">Produk Olahan Kelapa</td>
                            <td class="py-4">15 Sep 2025</td>
                            <td class="py-4"><span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Menunggu</span></td>
                            <td class="py-4 text-center">
                                <button class="bg-accent text-white px-3 py-1 rounded-md text-sm mr-2">Detail</button>
                                <button class="bg-primary text-white px-3 py-1 rounded-md text-sm">Proses</button>
                            </td>
                        </tr>
                        <tr class="verification-item">
                            <td class="py-4">Rudi Hermawan</td>
                            <td class="py-4">Kerupuk Ikan</td>
                            <td class="py-4">14 Sep 2025</td>
                            <td class="py-4"><span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Menunggu</span></td>
                            <td class="py-4 text-center">
                                <button class="bg-accent text-white px-3 py-1 rounded-md text-sm mr-2">Detail</button>
                                <button class="bg-primary text-white px-3 py-1 rounded-md text-sm">Proses</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="flex justify-between items-center mt-6">
                <div class="text-sm text-gray-600">
                    Menampilkan 5 dari 24 permohonan
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 border rounded-md bg-gray-100">Sebelumnya</button>
                    <button class="px-3 py-1 border rounded-md bg-primary text-white">1</button>
                    <button class="px-3 py-1 border rounded-md">2</button>
                    <button class="px-3 py-1 border rounded-md">3</button>
                    <button class="px-3 py-1 border rounded-md">Selanjutnya</button>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Mobile menu toggle
        const menuBtn = document.getElementById('menuBtn');
        const closeMenu = document.getElementById('closeMenu');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        
        menuBtn.addEventListener('click', () => {
            sidebar.classList.add('active');
            overlay.classList.add('active');
        });
        
        closeMenu.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
        
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
    </script>
</body>
</html>