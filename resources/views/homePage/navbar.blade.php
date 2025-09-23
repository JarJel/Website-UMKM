<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <nav class="sticky top-0 z-50 bg-white border-b shadow-xl">
      <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center h-[60px] justify-between">
          
          <div class="w-[175px] h-[80px]">
            <a href="{{ route('home') }}"> <!-- Ganti 'home' dengan nama route homePage Anda -->
                <img src="{{ asset('assets/imageInternal/logoBatara.png') }}"
                    class="w-full h-full object-contain"
                    alt="Logo Batara">
            </a>
        </div>

          <!-- Search bar -->
          <div class="flex-grow max-w-2xl">
            <input
              type="text"
              placeholder="Cari produk atau layanan..."
              class="w-full border border-gray-300 rounded-lg shadow-sm px-4 py-1 focus:outline-none focus:ring-2 focus:ring-[#42551E]"
            />
          </div>
          
          <!-- Bagian kanan navbar -->
          <div class="flex items-center space-x-4 text-gray-700">
            
            {{-- ✅ Jika user sudah login --}}
          @auth

            <!-- Wrapper untuk kedua icon -->
            <div class="flex items-center">
                <!-- Icon Notifikasi -->
                 <!-- Icon Notifikasi -->
<div class="relative group">
    <button class="p-2 rounded-full hover:bg-gray-100 transition cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-6 h-6 text-gray-700">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M14.857 17.082a23.848 23.848 0 0 0 
                    5.454-1.31A8.967 8.967 0 0 1 
                    18 9.75V9A6 6 0 0 0 
                    6 9v.75a8.967 8.967 0 0 1-2.312 
                    6.022c1.733.64 3.56 1.085 
                    5.455 1.31m5.714 0a24.255 
                    24.255 0 0 1-5.714 0m5.714 
                    0a3 3 0 1 1-5.714 0" />
        </svg>
    </button>

    <!-- Dropdown -->
    <div class="absolute top-full left-1/2 w-80 bg-white rounded-xl shadow-lg z-50 
                opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto
                -translate-x-1/2 transition-all duration-200">
        <div class="p-4 border-b font-semibold text-gray-800">Update Pengiriman</div>
        <ul class="p-4 space-y-4">
            @php
                $statuses = [
                    'pending' => 'Pesanan dibuat',
                    'diproses' => 'Sedang diproses',
                    'dikirim' => 'Sedang dikirim',
                    'selesai' => 'Pesanan selesai'
                ];
                $statusKeys = array_keys($statuses);
                $activeIndex = array_search($pesanan->status_pesanan, $statusKeys);
            @endphp

            @foreach($statuses as $key => $label)
                @php
                    $currentIndex = $loop->index;
                    $isActive = $currentIndex <= $activeIndex;
                @endphp
                <li class="flex items-center space-x-3">
                    <span class="w-6 h-6 rounded-full flex items-center justify-center font-bold
                        {{ $isActive ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-700' }}">
                        {{ $loop->iteration }}
                    </span>
                    <div class="flex flex-col">
                        <span class="font-semibold text-sm {{ $isActive ? 'text-blue-600' : 'text-gray-700' }}">
                            {{ $label }}
                        </span>
                        @if($isActive && $pesanan->status_pesanan == $key)
                            <span class="text-xs text-gray-400">Status saat ini</span>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="p-2 text-center border-t">
            <a href="{{ route('checkout.tracking', $pesanan->id_pesanan) }}" 
               class="text-blue-600 text-sm hover:underline">
               Lihat semua detail
            </a>
        </div>
    </div>
</div>


                <!-- Icon Keranjang -->
                <div class="relative group">
                    <a href="{{ route('keranjang.index') }}" class="p-2 rounded-full hover:bg-gray-100 transition cursor-pointer flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 1
                                    0-7.5 0v4.5m11.356-1.993
                                    1.263 12c.07.665-.45 1.243-1.119 
                                    1.243H4.25a1.125 1.125
                                    0 0 1-1.12-1.243l1.264-12A1.125 
                                    1.125 0 0 1 5.513 
                                    7.5h12.974c.576 0 1.059.435
                                    1.119 1.007ZM8.625 10.5a.375.375 
                                    0 1 1-.75 0 .375.375 0 
                                    0 1 .75 0Zm7.5 0a.375.375 
                                    0 1 1-.75 0 .375.375 0 
                                    0 1 .75 0Z" />
                        </svg>
                    </a>

                    <!-- Dropdown -->
                    <div class="absolute z-50 top-10 left-1/2 -translate-x-1/2 w-80 bg-white border border-gray-200 rounded-xl shadow-lg
                                opacity-0 group-hover:opacity-100 pointer-events-none group-hover:pointer-events-auto transition">
                        <ul id="cart-dropdown" class="py-2 text-sm text-gray-700 space-y-2">
                            <!-- Konten akan di-render oleh JS -->
                            <li class="px-4 py-2 text-gray-500 text-center">Memuat keranjang...</li>
                        </ul>
                    </div>
                </div>
            </div>


            <!-- Icon Toko + Tulisan -->
            <div class="relative group flex items-center">
              <button type="button" class="p-2 rounded-full hover:bg-gray-100 transition cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                        d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 
                          .75.75V21m-4.5 0H2.36m11.14 0H18m0 
                          0h3.64m-1.39 0V9.349M3.75 21V9.349m0 
                          0a3.001 3.001 0 0 0 3.75-.615A2.993 
                          2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 
                          2.25-1.016a2.993 2.993 0 0 0 2.25 
                          1.016c.896 0 1.7-.393 2.25-1.015a3.001 
                          3.001 0 0 0 3.75.614m-16.5 0a3.004 
                          3.004 0 0 1-.621-4.72l1.189-1.19A1.5 
                          1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 
                          1.06.44l1.19 1.189a3 3 0 0 1-.621 
                          4.72M6.75 18h3.75a.75.75 0 0 0 
                          .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 
                          0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                </svg>
              </button>
              <p class="ml-1 text-gray-800 font-medium">Toko</p>

              <!-- Dropdown -->
              <div
                class="absolute z-50 left-1/2 -translate-x-1/2 min-w-[18rem] bg-white border border-gray-200 rounded-xl shadow-lg
                      opacity-0 group-hover:opacity-100 pointer-events-none group-hover:pointer-events-auto transition top-10">
                <ul class="py-2 text-sm text-gray-700 space-y-2 text-center">
                  @if(Auth::user()->roles()->where('id_role', 2)->exists())
                    <!-- Jika sudah seller -->
                    <li>
                      <a href="{{ route('seller.dashboard') }}"
                        class="inline-block px-6 py-2 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 transition">
                        Dashboard Toko
                      </a>
                    </li>
                  @else
                    <!-- Jika belum seller -->
                    <li>
                      <p class="block px-4 py-2 font-semibold">
                        Mulai toko anda secara gratis
                      </p>
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


            <div class="relative group">
                <button class="p-2 rounded-full hover:bg-gray-100 transition cursor-pointer flex items-center space-x-2">
                    <!-- Icon Person -->
                    <i class="fas fa-user text-gray-800"></i>
                    <!-- Optional: nama pengguna di samping ikon -->
                    <span class="sr-only">{{ Auth::user()->nama_pengguna }}</span>
                </button>

                <!-- Dropdown -->
                <div
                    class="absolute z-50 right-0 w-48 bg-white border border-gray-200 rounded-xl shadow-lg
                        opacity-0 group-hover:opacity-100 pointer-events-none group-hover:pointer-events-auto transition">

                    <!-- Header Halo User -->
                    <div class="px-4 py-3 border-b text-center">
                        <span class="font-semibold text-gray-800">Halo,</span>
                        <div class="text-sm text-gray-600">{{ Auth::user()->nama_pengguna }}</div>
                    </div>

                    <ul class="py-2 text-sm text-gray-700 text-center">
                        <li>
                            <a href="{{ route('profile.index') }}" 
                            class="block px-4 py-2 hover:bg-gray-100">
                                <i class="fas fa-user text-gray-600 mr-2"></i>
                                Profil
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="w-full px-4 py-2 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt text-gray-600 mr-2"></i>
                                    Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

          @endauth


            {{-- ✅ Jika user belum login --}}
            @guest
              <div class="hidden md:block">
                <a href="{{ url('login') }}"
                   class="px-4 py-2 rounded-lg bg-[#42551E] text-white hover:bg-[#5b7028] transition">
                  Masuk
                </a>
              </div>
              <div class="hidden md:block">
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
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
const csrfToken = '{{ csrf_token() }}';

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
    $('#cart-count').text(total);
}

function loadCartDropdown() {
    $.get("{{ route('keranjang.dropdown') }}", function(response){
        updateCartDropdown(response);
    });
}

$(document).ready(function(){
    loadCartDropdown();
    window.loadCartDropdown = loadCartDropdown; // buat global supaya bisa dipanggil dari halaman lain
});
</script>
</html>