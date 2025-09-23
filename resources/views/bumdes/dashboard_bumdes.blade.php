<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard BUMDES</title>
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
                width: 70%;
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
            
            .mobile-header {
                display: flex;
            }
        }
        
        .stats-card {
            transition: transform 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
        }
        
        .menu-card {
            transition: all 0.3s ease;
        }
        
        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        /* Header khusus untuk mobile - disembunyikan di desktop */
        .mobile-header {
            display: none;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background-color: #1d4657;
            color: white;
            position: sticky;
            top: 0;
            z-index: 30;
        }
    </style>
</head>

<body class="flex bg-gray-100 min-h-screen">
    <!-- Header untuk mobile - hanya muncul di mobile -->
    <div class="mobile-header">
        <h1 class="text-xl font-bold">BUMDES</h1>
        <button id="menuBtn" class="p-2 rounded-md bg-accent text-white">
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
            <a href="{{ route('bumdes.dashboard') }}" class="flex items-center py-2 px-4 bg-secondary rounded-md transition">
                <i class="fas fa-home mr-3"></i> Dashboard
            </a>
            <a href="{{ route('bumdes.verifikasi') }}" class="flex items-center py-2 px-4 hover:bg-secondary rounded-md transition">
                <i class="fas fa-check-circle mr-3"></i> Verifikasi Seller
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
        <h2 class="text-3xl font-bold text-primary mb-6">Dashboard BUMDES</h2>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="stats-card bg-white shadow rounded-lg p-6 text-center border-l-4 border-yellow-500">
                <h3 class="text-xl font-semibold text-gray-700">Usaha Menunggu Verifikasi</h3>
                <p class="text-3xl font-bold text-yellow-600 mt-2">5</p>
                <div class="mt-4">
                    <i class="fas fa-clock text-yellow-500 text-3xl"></i>
                </div>
            </div>
            <div class="stats-card bg-white shadow rounded-lg p-6 text-center border-l-4 border-green-500">
                <h3 class="text-xl font-semibold text-gray-700">Total Usaha Aktif</h3>
                <p class="text-3xl font-bold text-green-600 mt-2">18</p>
                <div class="mt-4">
                    <i class="fas fa-check-circle text-green-500 text-3xl"></i>
                </div>
            </div>
            <div class="stats-card bg-white shadow rounded-lg p-6 text-center border-l-4 border-blue-500">
                <h3 class="text-xl font-semibold text-gray-700">Seller Terdaftar</h3>
                <p class="text-3xl font-bold text-blue-600 mt-2">25</p>
                <div class="mt-4">
                    <i class="fas fa-users text-blue-500 text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Menu Cepat -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <a href="{{ url('/bumdes/verifikasi') }}" class="menu-card bg-white p-6 rounded-lg shadow-md border-t-4 border-accent hover:border-accent/80">
                <div class="flex items-center">
                    <div class="bg-accent/20 p-3 rounded-full mr-4">
                        <i class="fas fa-clipboard-check text-accent text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg">Verifikasi Pengajuan Usaha</h3>
                        <p class="text-gray-600 mt-1">5 menunggu verifikasi</p>
                    </div>
                </div>
            </a>
            <a href="{{ url('/bumdes/transaksi') }}" class="menu-card bg-white p-6 rounded-lg shadow-md border-t-4 border-secondary hover:border-secondary/80">
                <div class="flex items-center">
                    <div class="bg-secondary/20 p-3 rounded-full mr-4">
                        <i class="fas fa-chart-line text-secondary text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg">Lihat Laporan Transaksi</h3>
                        <p class="text-gray-600 mt-1">128 transaksi bulan ini</p>
                    </div>
                </div>
            </a>
            <a href="{{ url('/bumdes/seller') }}" class="menu-card bg-white p-6 rounded-lg shadow-md border-t-4 border-primary hover:border-primary/80">
                <div class="flex items-center">
                    <div class="bg-primary/20 p-3 rounded-full mr-4">
                        <i class="fas fa-user-friends text-primary text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg">Kelola Seller</h3>
                        <p class="text-gray-600 mt-1">25 seller terdaftar</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-primary mb-4">Aktivitas Terbaru</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left border-b">
                            <th class="pb-3">Seller</th>
                            <th class="pb-3">Aktivitas</th>
                            <th class="pb-3">Tanggal</th>
                            <th class="pb-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="py-3">Budi Santoso</td>
                            <td class="py-3">Mendaftarkan usaha "Kerajinan Bambu"</td>
                            <td class="py-3">18 Sep 2025</td>
                            <td class="py-3"><span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Menunggu</span></td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3">Siti Rahayu</td>
                            <td class="py-3">Mengupload dokumen SKU</td>
                            <td class="py-3">17 Sep 2025</td>
                            <td class="py-3"><span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs">Terverifikasi</span></td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3">Ahmad Sutisna</td>
                            <td class="py-3">Melakukan pembaruan data usaha</td>
                            <td class="py-3">16 Sep 2025</td>
                            <td class="py-3"><span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Diperbarui</span></td>
                        </tr>
                        <tr>
                            <td class="py-3">Dewi Anggraini</td>
                            <td class="py-3">Menambahkan produk baru</td>
                            <td class="py-3">15 Sep 2025</td>
                            <td class="py-3"><span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs">Aktif</span></td>
                        </tr>
                    </tbody>
                </table>
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