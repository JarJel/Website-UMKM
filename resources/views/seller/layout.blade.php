<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Seller Dashboard - BATARA')</title>
    <!-- Tailwind Configuration for Custom Colors -->
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // Primary color based on user request: #2f7c65ff
                        'primary-dark': '#2a6870ff',
                        // Slightly darker for hover states
                        'primary-hover': '#1e5a49', 
                        // Accent color for active/buttons (maintained a contrasting bright green)
                        'accent': '#3ec26fff', 
                    }
                }
            }
        }
    </script>
    <link rel="icon" href="{{ asset('assets/BATARA/1.png') }}" 
            type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" 
               class="w-64 bg-primary-dark text-white shadow-lg flex flex-col justify-between fixed inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-50">
            <div class="p-6">
                <!-- Logo -->
                <div class="mb-8 flex justify-center">
                    <a href="{{ url('/seller/dashboard') }}">
                      <img src="{{ asset('assets/BATARA/3.png') }}" class="w-full h-full object-contain" alt="Logo Batara">
                    </a>
                </div>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ url('/seller/dashboard') }}" 
                           class="flex items-center px-4 py-3 rounded-lg transition 
                           {{ Request::is('seller/dashboard') ? 'bg-accent/20 text-accent font-bold' : 'hover:bg-primary-hover' }}">
                            <i class="fas fa-home w-5 h-5 mr-3"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/seller/produk') }}" 
                           class="flex items-center px-4 py-3 rounded-lg transition 
                           {{ Request::is('seller/produk*') ? 'bg-accent/20 text-accent font-bold' : 'hover:bg-primary-hover' }}">
                            <i class="fas fa-box w-5 h-5 mr-3"></i> Produk
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/seller/pesanan') }}" 
                           class="flex items-center px-4 py-3 rounded-lg transition 
                           {{ Request::is('seller/pesanan*') ? 'bg-accent/20 text-accent font-bold' : 'hover:bg-primary-hover' }}">
                            <i class="fas fa-shopping-cart w-5 h-5 mr-3"></i> Pesanan
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/seller/laporan') }}" 
                           class="flex items-center px-4 py-3 rounded-lg transition 
                           {{ Request::is('seller/laporan*') ? 'bg-accent/20 text-accent font-bold' : 'hover:bg-primary-hover' }}">
                            <i class="fas fa-chart-line w-5 h-5 mr-3"></i> Laporan
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/seller/profil') }}" 
                           class="flex items-center px-4 py-3 rounded-lg transition 
                           {{ Request::is('seller/profil*') ? 'bg-accent/20 text-accent font-bold' : 'hover:bg-primary-hover' }}">
                            <i class="fas fa-store w-5 h-5 mr-3"></i> Profil Toko
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/seller/gemini') }}" 
                           class="flex items-center px-4 py-3 rounded-lg transition 
                           {{ Request::is('seller/gemini*') ? 'bg-accent/20 text-accent font-bold' : 'hover:bg-primary-hover' }}">
                            <i class="fas fa-robot w-5 h-5 mr-3"></i> Gemini AI
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/seller/bantuan') }}" 
                           class="flex items-center px-4 py-3 rounded-lg transition 
                           {{ Request::is('seller/bantuan*') ? 'bg-accent/20 text-accent font-bold' : 'hover:bg-primary-hover' }}">
                            <i class="fas fa-question-circle w-5 h-5 mr-3"></i> Bantuan
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Logout -->
            <div class="p-6">
                <a href="{{ url('/homePage/home') }}"
                class="w-full inline-block bg-accent text-primary-dark px-4 py-2 rounded-lg hover:bg-accent/90 transition text-center font-semibold">
                    <i class="fas fa-home mr-2"></i> Beranda
                </a>
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
                    <span class="text-gray-600 hidden sm:inline">
                        Halo, {{ Auth::user()->nama_pengguna ?? 'Seller' }}
                    </span>
                    <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-200">
                        <!-- Update avatar background color -->
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->nama_pengguna ?? 'Seller' }}&background=2a705b&color=fff&bold=true" 
                            alt="Avatar" class="w-full h-full object-cover">
                    </div>
                </div>
            </header>


            <!-- Cards -->
            <main class="p-4 md:p-8">
                <!-- Dynamic Content -->
                <div>
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @yield('scripts')
</body>
</html>
