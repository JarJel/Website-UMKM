<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Seller Dashboard - BATARA')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" 
               class="w-64 bg-[#67828e] text-white shadow-lg flex flex-col justify-between fixed inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-50">
            <div class="p-6">
                <!-- Logo -->
                <div class="mb-8 flex justify-center">
                    <a href="{{ url('/seller/dashboard') }}">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo BATARA" class="w-32">
                    </a>
                </div>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ url('/seller/dashboard') }}" 
                           class="flex items-center px-4 py-3 rounded-lg transition 
                           {{ Request::is('seller/dashboard') ? 'bg-green-200 text-green-800 font-bold' : 'hover:bg-[#4e6b75]' }}">
                            <i class="fas fa-home w-5 h-5 mr-3"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/seller/produk') }}" 
                           class="flex items-center px-4 py-3 rounded-lg transition 
                           {{ Request::is('seller/produk*') ? 'bg-green-200 text-green-800 font-bold' : 'hover:bg-[#4e6b75]' }}">
                            <i class="fas fa-box w-5 h-5 mr-3"></i> Produk
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/seller/pesanan') }}" 
                           class="flex items-center px-4 py-3 rounded-lg transition 
                           {{ Request::is('seller/pesanan*') ? 'bg-green-200 text-green-800 font-bold' : 'hover:bg-[#4e6b75]' }}">
                            <i class="fas fa-shopping-cart w-5 h-5 mr-3"></i> Pesanan
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/seller/laporan') }}" 
                           class="flex items-center px-4 py-3 rounded-lg transition 
                           {{ Request::is('seller/laporan*') ? 'bg-green-200 text-green-800 font-bold' : 'hover:bg-[#4e6b75]' }}">
                            <i class="fas fa-chart-line w-5 h-5 mr-3"></i> Laporan
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/seller/profil') }}" 
                           class="flex items-center px-4 py-3 rounded-lg transition 
                           {{ Request::is('seller/profil*') ? 'bg-green-200 text-green-800 font-bold' : 'hover:bg-[#4e6b75]' }}">
                            <i class="fas fa-store w-5 h-5 mr-3"></i> Profil Toko
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/seller/bantuan') }}" 
                           class="flex items-center px-4 py-3 rounded-lg transition 
                           {{ Request::is('seller/bantuan*') ? 'bg-green-200 text-green-800 font-bold' : 'hover:bg-[#4e6b75]' }}">
                            <i class="fas fa-question-circle w-5 h-5 mr-3"></i> Bantuan
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Logout -->
            <div class="p-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 md:ml-64">
            <!-- Header -->
            <header class="bg-white shadow p-4 md:p-6 flex justify-between items-center sticky top-0 z-40">
                <div class="flex items-center space-x-3">
                    <!-- Mobile toggle -->
                    <button onclick="document.getElementById('sidebar').classList.toggle('-translate-x-full')" 
                            class="md:hidden p-2 rounded-lg bg-gray-100 hover:bg-gray-200">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="text-xl md:text-2xl font-bold text-gray-800">@yield('header', 'Dashboard')</h1>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="text-gray-600 hidden sm:inline">Halo, {{ Auth::user()->name ?? 'Seller' }}</span>
                    <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-200">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Seller' }}&background=22c55e&color=fff&bold=true" 
                             alt="Avatar" class="w-full h-full object-cover">
                    </div>
                </div>
            </header>

            <!-- Cards -->
            <main class="p-4 md:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow p-5 hover:shadow-lg transition">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-truck text-blue-500 text-xl mr-3"></i>
                            <p class="text-gray-500 text-sm">Pesanan Belum Diproses</p>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">12</h2>
                    </div>
                    <div class="bg-white rounded-xl shadow p-5 hover:shadow-lg transition">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-box-open text-yellow-500 text-xl mr-3"></i>
                            <p class="text-gray-500 text-sm">Produk Terjual</p>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">540</h2>
                    </div>
                    <div class="bg-white rounded-xl shadow p-5 hover:shadow-lg transition">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-money-bill-wave text-green-500 text-xl mr-3"></i>
                            <p class="text-gray-500 text-sm">Pendapatan Bulan Ini</p>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Rp 5,4 Juta</h2>
                    </div>
                    <div class="bg-white rounded-xl shadow p-5 hover:shadow-lg transition">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-star text-purple-500 text-xl mr-3"></i>
                            <p class="text-gray-500 text-sm">Rating Toko</p>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">4.8</h2>
                    </div>
                </div>

                <!-- Dynamic Content -->
                <div>
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

</body>
</html>
