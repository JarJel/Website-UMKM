<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar</title>
  <link rel="icon" href="{{ asset('assets/BATARA/1.png') }}" 
            type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-white overflow-x-hidden">
  <nav class="sticky top-0 z-50 bg-white border-b shadow-xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center h-[60px] justify-between">

        <!-- Logo -->
        <div class="w-[175px] h-[80px] flex-shrink-0">
          <a href="{{ route('home') }}">
            <img src="{{ asset('assets/BATARA/3.png') }}"
                 class="w-full h-full object-contain"
                 alt="Logo Batara">
          </a>
        </div>

        <!-- Search bar -->
        <div class="flex-grow max-w-2xl">
          <input
            type="text"
            placeholder="Cari produk atau layanan..."
            class="w-full border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#42551E]"
          />
        </div>

        <!-- Bagian kanan navbar -->
        <div class="flex items-center space-x-4 text-gray-700 pr-4">
          @auth
          <!-- Wrapper untuk icon notifikasi, keranjang, toko, user -->
          <div class="flex items-center space-x-4">
            <!-- Notifikasi -->
            <div class="relative group">
              <button class="p-2 rounded-full hover:bg-gray-100 transition cursor-pointer">
                <i class="fas fa-bell text-gray-700"></i>
              </button>
              <!-- Dropdown Notifikasi -->
              <!-- Dropdown Notifikasi -->
<div class="absolute top-full right-0 w-[24rem] bg-white rounded-xl shadow-lg z-50 
            opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto
            transition-all duration-200">
  <div class="p-4 border-b font-semibold text-gray-800">Update Pengiriman</div>

  @php
    $pesanan = \App\Models\Pesanan::where('id_pengguna', auth()->id() ?? 0)->latest()->first();
  @endphp

  @if($pesanan)
    @php
      $statuses = [
          'pending' => ['label' => 'Pesanan dibuat', 'icon' => 'fas fa-clock'],
          'diproses' => ['label' => 'Sedang diproses', 'icon' => 'fas fa-cogs'],
          'diantarkan' => ['label' => 'Sedang diantarkan', 'icon' => 'fas fa-truck'],
          'selesai' => ['label' => 'Pesanan selesai', 'icon' => 'fas fa-check']
      ];

      $statusKeys = array_keys($statuses);
      $activeIndex = array_search($pesanan->status_pesanan, $statusKeys);
    @endphp

    <ul class="flex justify-between p-4">
      @foreach($statuses as $key => $status)
        @php
          $isActive = $loop->index <= $activeIndex;
        @endphp
        <li class="flex flex-col items-center">
          <span class="w-10 h-10 rounded-full flex items-center justify-center text-white
                       {{ $isActive ? 'bg-blue-600' : 'bg-gray-300' }}">
            <i class="{{ $status['icon'] }}"></i>
          </span>
          <span class="mt-2 text-xs font-semibold text-center {{ $isActive ? 'text-blue-600' : 'text-gray-700' }}">
            {{ $status['label'] }}
          </span>
          @if($isActive && $pesanan->status_pesanan == $key)
            <span class="text-[10px] text-gray-400 mt-1">Status saat ini</span>
          @endif
        </li>
      @endforeach
    </ul>

    <div class="p-2 text-center border-t">
      <a href="{{ route('checkout.tracking', $pesanan->id_pesanan) }}" 
         class="text-blue-600 text-sm hover:underline">
        Lihat semua detail
      </a>
    </div>
  @else
    <p class="p-4 text-gray-500 text-center">Belum ada pesanan</p>
  @endif
</div>

            </div>

            <!-- Keranjang -->
            <div class="relative group">
              <a href="{{ route('keranjang.index') }}" class="p-2 rounded-full hover:bg-gray-100 transition cursor-pointer flex items-center justify-center">
                <i class="fas fa-shopping-cart"></i>
              </a>
              <div class="absolute z-50 top-10 right-0 w-80 bg-white border border-gray-200 rounded-xl shadow-lg
                          opacity-0 group-hover:opacity-100 pointer-events-none group-hover:pointer-events-auto transition">
                <ul id="cart-dropdown" class="py-2 text-sm text-gray-700 space-y-2">
                  <li class="px-4 py-2 text-gray-500 text-center">Memuat keranjang...</li>
                </ul>
              </div>
            </div>

            <!-- Toko -->
            <div class="relative group flex items-center">
              <button type="button" class="p-2 rounded-full hover:bg-gray-100 transition cursor-pointer">
                <i class="fas fa-store text-gray-800"></i>
              </button>
              <p class="ml-1 text-gray-800 font-medium">Toko</p>
              <div class="absolute z-50 right-0 min-w-[18rem] bg-white border border-gray-200 rounded-xl shadow-lg
                    opacity-0 group-hover:opacity-100 pointer-events-none group-hover:pointer-events-auto transition top-10">
                <ul class="py-2 text-sm text-gray-700 space-y-2 text-center">
                  @if(Auth::user()->roles()->where('id_role',2)->exists())
                    <li>
                      <a href="{{ route('seller.dashboard') }}"
                         class="inline-block px-6 py-2 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 transition">
                        Dashboard Toko
                      </a>
                    </li>
                  @else
                    <li>
                      <p class="block px-4 py-2 font-semibold">Mulai toko anda secara gratis</p>
                    </li>
                    <li>
                      <a href="{{ route('seller.create') }}"
                         class="inline-block px-6 py-2 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 transition">
                        Daftar Toko
                      </a>
                    </li>
                  @endif
                </ul>
              </div>
            </div>

            <!-- User -->
            <div class="relative group">
              <button class="p-2 rounded-full hover:bg-gray-100 transition cursor-pointer flex items-center space-x-2">
                <i class="fas fa-user text-gray-800"></i>
                <span class="sr-only">{{ Auth::user()->nama_pengguna }}</span>
              </button>
              <div class="absolute z-50 right-0 w-48 bg-white border border-gray-200 rounded-xl shadow-lg
                          opacity-0 group-hover:opacity-100 pointer-events-none group-hover:pointer-events-auto transition">
                <div class="px-4 py-3 border-b text-center">
                  <span class="font-semibold text-gray-800">Halo,</span>
                  <div class="text-sm text-gray-600">{{ Auth::user()->nama_pengguna }}</div>
                </div>
                <ul class="py-2 text-sm text-gray-700 text-center">
                  <li>
                    <a href="{{ route('profile.index') }}" class="block px-4 py-2 hover:bg-gray-100">
                      <i class="fas fa-user text-gray-600 mr-2"></i>Profil
                    </a>
                  </li>
                  <li>
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button type="submit" class="w-full px-4 py-2 hover:bg-gray-100">
                        <i class="fas fa-sign-out-alt text-gray-600 mr-2"></i>Keluar
                      </button>
                    </form>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          @endauth

          @guest
            <div class="hidden md:flex space-x-2">
              <a href="{{ url('login') }}"
                 class="px-4 py-2 rounded-lg bg-[#42551E] text-white hover:bg-[#5b7028] transition">
                Masuk
              </a>
              <a href="{{ route('register') }}"
                 class="px-4 py-2 rounded-lg bg-[#42551E] text-white hover:bg-[#5b7028] transition">
                Daftar
              </a>
            </div>
          @endguest

        </div>
      </div>
    </div>
  </nav>

  <script>
    function updateCartDropdown(data) {
      let html = '';
      let total = 0;
      if(data.items.length > 0){
        data.items.forEach(item => {
          total += item.jumlah;
          html += `
            <li class="flex items-center justify-between px-4 py-2 hover:bg-gray-100 rounded-lg">
              <div class="flex items-center space-x-3">
                <img src="${item.image}" class="w-12 h-12 object-cover rounded">
                <div class="flex flex-col text-left">
                  <span class="font-semibold text-gray-800 text-sm">${item.nama}</span>
                  <span class="text-gray-500 text-xs">Rp ${item.harga.toLocaleString('id-ID')}</span>
                </div>
              </div>
              <span class="text-gray-600 font-semibold">${item.jumlah}x</span>
            </li>`;
        });
      } else {
        html = '<li class="px-4 py-2 text-gray-500 text-center">Belum ada produk</li>';
      }
      $('#cart-dropdown').html(html);
    }

    function loadCartDropdown() {
      $.get("{{ route('keranjang.dropdown') }}", function(response){
        updateCartDropdown(response);
      });
    }

    $(document).ready(function(){
      loadCartDropdown();
      window.loadCartDropdown = loadCartDropdown;
    });
  </script>
</body>
</html>
