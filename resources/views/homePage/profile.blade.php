<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f3f4f6; }
        .profile-header { background-color: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .profile-avatar { position: relative; cursor: pointer; }
        .profile-avatar img { border-radius: 9999px; border: 3px solid #6366F1; }
        .profile-avatar .camera-icon { 
            position: absolute; bottom: 0; right: 0; 
            background: #6366F1; color: #fff; 
            border-radius: 9999px; padding: 0.4rem; 
            transition: all 0.2s;
        }
        .profile-avatar:hover .camera-icon { transform: scale(1.1); }
        .tab-active { border-bottom: 3px solid #6366F1; font-weight: 600; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
@include('homePage.navbar')

<!-- Header Profil -->
<header class="profile-header p-6 flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6">
    <div class="profile-avatar">
        <img src="{{ Auth::user()->photo ?? 'https://placehold.co/120x120/E5E7EB/A0AEC0?text=Foto' }}" alt="Foto Profil" class="w-28 h-28 object-cover shadow-md">
        <div class="camera-icon">
            <i class="fas fa-camera"></i>
        </div>
    </div>
    <div>
        <h1 class="text-2xl font-bold text-gray-800">{{ Auth::user()->nama_pengguna ?? 'Nama Pengguna' }}</h1>
        <p class="text-gray-500">{{ Auth::user()->email ?? 'user@example.com' }}</p>
    </div>
</header>

<!-- Tabs Profil -->
<div class="mt-6 px-6 md:px-12">
    <div class="flex space-x-6 border-b border-gray-200">
        <button class="py-3 text-gray-600 hover:text-indigo-600 tab-active" data-tab="transaksi">
            <i class="fas fa-receipt mr-2"></i> Daftar Transaksi
        </button>
        <button class="py-3 text-gray-600 hover:text-indigo-600" data-tab="alamat">
            <i class="fas fa-map-marker-alt mr-2"></i> Daftar Alamat
        </button>
        <button class="py-3 text-gray-600 hover:text-indigo-600" data-tab="menu">
            <i class="fas fa-th-large mr-2"></i> Menu Profil
        </button>
    </div>

    <!-- Tab Contents -->
    <div id="tab-contents" class="mt-4">
        <!-- Daftar Transaksi -->
        <div id="transaksi" class="tab-content">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-white shadow-md p-4 rounded-lg hover:shadow-lg transition">
                    <p class="text-gray-700 font-semibold">Transaksi #001</p>
                    <p class="text-gray-400 text-sm">Tanggal: 20 Sep 2025</p>
                    <p class="text-gray-400 text-sm">Status: Selesai</p>
                </div>
                <div class="bg-white shadow-md p-4 rounded-lg hover:shadow-lg transition">
                    <p class="text-gray-700 font-semibold">Transaksi #002</p>
                    <p class="text-gray-400 text-sm">Tanggal: 18 Sep 2025</p>
                    <p class="text-gray-400 text-sm">Status: Diproses</p>
                </div>
            </div>
        </div>

        <!-- Daftar Alamat -->
        <div id="alamat" class="tab-content hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-white shadow-md p-4 rounded-lg hover:shadow-lg transition">
                    <p class="text-gray-700 font-semibold">Alamat Rumah</p>
                    <p class="text-gray-400 text-sm">Jl. Merpati No.12, Jakarta</p>
                </div>
                <div class="bg-white shadow-md p-4 rounded-lg hover:shadow-lg transition">
                    <p class="text-gray-700 font-semibold">Alamat Kantor</p>
                    <p class="text-gray-400 text-sm">Jl. Sudirman No.45, Jakarta</p>
                </div>
            </div>
        </div>

        <!-- Menu Profil -->
        <div id="menu" class="tab-content">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <a href="#" class="bg-white shadow-md p-4 flex items-center space-x-4 hover:shadow-lg transition rounded-lg">
                    <i class="fas fa-box text-indigo-600 text-2xl"></i>
                    <div>
                        <p class="text-gray-700 font-semibold">Pesanan Saya</p>
                        <p class="text-gray-400 text-sm">Lihat riwayat pesanan</p>
                    </div>
                </a>
                <a href="#" class="bg-white shadow-md p-4 flex items-center space-x-4 hover:shadow-lg transition rounded-lg">
                    <i class="fas fa-wallet text-indigo-600 text-2xl"></i>
                    <div>
                        <p class="text-gray-700 font-semibold">Dompet</p>
                        <p class="text-gray-400 text-sm">Cek saldo & top up</p>
                    </div>
                </a>
                <a href="#" class="bg-white shadow-md p-4 flex items-center space-x-4 hover:shadow-lg transition rounded-lg">
                    <i class="fas fa-user-cog text-indigo-600 text-2xl"></i>
                    <div>
                        <p class="text-gray-700 font-semibold">Pengaturan</p>
                        <p class="text-gray-400 text-sm">Atur profil & akun</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    const tabs = document.querySelectorAll('[data-tab]');
    const contents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('tab-active'));
            tab.classList.add('tab-active');

            contents.forEach(c => c.classList.add('hidden'));
            document.getElementById(tab.dataset.tab).classList.remove('hidden');
        });
    });
</script>
</body>
</html>
