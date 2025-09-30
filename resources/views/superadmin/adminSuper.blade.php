<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Super Admin')</title>
    <link rel="icon" href="{{ asset('storage/BATARA/4.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #1d4657;
            --secondary: #11676a;
            --accent: #b0b32a;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7f9;
        }
        /* Sidebar fixed */
        .sidebar {
            background: linear-gradient(to bottom, var(--primary), var(--secondary));
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 50;
        }
        .nav-item {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }
        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid var(--accent);
        }
        .nav-item.active {
            background-color: rgba(255, 255, 255, 0.15);
            border-left: 4px solid var(--accent);
        }
        .logout-btn {
            background-color: rgba(179, 42, 42, 0.8);
            transition: all 0.3s ease;
        }
        .logout-btn:hover {
            background-color: rgba(179, 42, 42, 1);
            transform: translateY(-2px);
        }
        .page-title {
            color: var(--primary);
            position: relative;
            padding-bottom: 15px;
        }
        .page-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 70px;
            height: 4px;
            background: var(--accent);
            border-radius: 2px;
        }
        /* Responsive sidebar */
        @media (max-width: 767px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 50;
                width: 16rem;
            }
            .sidebar.active {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body class="bg-[#f5f7f9]">
    <!-- Mobile Header -->
    <div class="md:hidden p-4 bg-white shadow-md flex justify-between items-center sticky top-0 z-40">
        <button id="sidebar-toggle-btn" class="text-xl text-[var(--primary)] focus:outline-none">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <div class="flex">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar w-64 text-white flex flex-col transition-transform duration-300 ease-in-out">
            <div class="p-6">
                <div class="flex items-center space-x-3 mb-8">
                    <div class="p-3 rounded-lg bg-white bg-opacity-10">
                        <img src="{{ asset('storage/BATARA/3.png') }}" class="w-full h-full object-contain" alt="Logo Batara">        
                    </div>
                </div>
                <nav class="space-y-2">
                    <a href="{{ url('/superadmin/dashboard') }}" class="nav-item flex items-center px-4 py-3 rounded-lg {{ Request::is('superadmin/dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home w-6 text-center mr-3"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ url('/superadmin/kelola-bumdes') }}" class="nav-item flex items-center px-4 py-3 rounded-lg {{ Request::is('superadmin/kelola-bumdes') ? 'active' : '' }}">
                        <i class="fas fa-building w-6 text-center mr-3"></i>
                        <span>Kelola BUMDES</span>
                    </a>
                    <a href="{{ url('/superadmin/daftar-bumdes') }}" class="nav-item flex items-center px-4 py-3 rounded-lg {{ Request::is('superadmin/daftar-bumdes') ? 'active' : '' }}">
                        <i class="fas fa-list w-6 text-center mr-3"></i>
                        <span>Daftar BUMDES</span>
                    <a href="{{ url('/superadmin/toko') }}" class="nav-item flex items-center px-4 py-3 rounded-lg {{ Request::is('superadmin/toko*') ? 'active' : '' }}">
                        <i class="fas fa-store w-6 text-center mr-3"></i>
                        <span>Manajemen Toko</span>
                    </a>
                    <a href="{{ url('/superadmin/transaksi') }}" class="nav-item flex items-center px-4 py-3 rounded-lg {{ Request::is('superadmin/transaksi*') ? 'active' : '' }}">
                        <i class="fas fa-exchange-alt w-6 text-center mr-3"></i>
                        <span>Manajemen Transaksi</span>
                    </a>
                    <a href="{{ url('/superadmin/user') }}" class="nav-item flex items-center px-4 py-3 rounded-lg {{ Request::is('superadmin/user*') ? 'active' : '' }}">
                        <i class="fas fa-users w-6 text-center mr-3"></i>
                        <span>Manajemen User</span>
                    </a>
                </nav>
            </div>
            <div class="mt-auto p-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn w-full flex items-center justify-center px-4 py-3 rounded-lg font-medium">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content (beri padding kiri agar tidak ketimpa sidebar fixed) -->
        <main class="flex-1 p-4 sm:p-8 ml-64">
            @yield('content')
        </main>
    </div>
    
    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggleBtn = document.getElementById('sidebar-toggle-btn');
        const mainContent = document.querySelector('main');
        
        // Sidebar toggle for mobile
        sidebarToggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        // Close sidebar on mobile when clicking outside
        mainContent.addEventListener('click', () => {
            if (sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        });
    </script>
</body>
</html>
