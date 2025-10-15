<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar</title>
  <!-- Load Tailwind CSS CDN for styling -->
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Menggunakan font Inter */
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
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
            <!-- Tombol Notifikasi -->
            <button id="notifButton" class="relative p-2 rounded-full hover:bg-gray-100 transition cursor-pointer">
              <i class="fas fa-bell text-gray-700 text-lg"></i>
              <!-- Badge jumlah notifikasi -->
              <span class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-red-500 text-white text-[10px] font-bold flex items-center justify-center rounded-full">1</span>
            </button>

            <!-- Dropdown Notifikasi -->
            <div
              class="absolute top-[110%] right-0 w-[22rem] bg-white rounded-2xl shadow-2xl z-50 opacity-0 scale-95
                    group-hover:opacity-100 group-hover:scale-100 group-hover:pointer-events-auto pointer-events-none
                    transform transition-all duration-300 origin-top-right border border-gray-100 overflow-hidden">

              <!-- Header -->
              <div class="bg-gradient-to-r from-[#1d4657] to-[#2f6d88] text-white px-5 py-3 flex items-center justify-between">
                <span class="font-semibold text-sm tracking-wide">🔔 Notifikasi</span>
                <a href="{{ route('checkout.tracking', $pesanan->id_pesanan ?? 0) }}" 
                  class="text-xs text-white/80 hover:text-white transition">Lihat Semua</a>
              </div>

              <!-- Isi Notifikasi -->
              <div class="max-h-80 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-transparent">
                @php
                  $pesanan = \App\Models\Pesanan::where('id_pengguna', auth()->id() ?? 0)->latest()->take(3)->get();
                @endphp

                @if($pesanan->isNotEmpty())
                  @foreach($pesanan as $p)
                    @php
                      $statusColors = [
                        'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-300',
                        'diproses' => 'bg-blue-100 text-blue-700 border-blue-300',
                        'diantarkan' => 'bg-indigo-100 text-indigo-700 border-indigo-300',
                        'selesai' => 'bg-green-100 text-green-700 border-green-300'
                      ];
                      $statusIcons = [
                        'pending' => 'fas fa-clock',
                        'diproses' => 'fas fa-cogs',
                        'diantarkan' => 'fas fa-truck',
                        'selesai' => 'fas fa-check-circle'
                      ];
                    @endphp

                    <div class="flex items-start space-x-3 px-5 py-4 border-b hover:bg-gray-50 transition">
                      <!-- Icon -->
                      <div class="w-10 h-10 rounded-full flex items-center justify-center border {{ $statusColors[$p->status_pesanan] ?? 'bg-gray-100 text-gray-700 border-gray-200' }}">
                        <i class="{{ $statusIcons[$p->status_pesanan] ?? 'fas fa-info' }}"></i>
                      </div>
                      <!-- Info -->
                      <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-800">
                          Pesanan #{{ $p->id_pesanan }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                          Status: <span class="font-medium capitalize">{{ $p->status_pesanan }}</span>
                        </p>
                        <p class="text-[11px] text-gray-400 mt-0.5">
                          {{ \Carbon\Carbon::parse($p->created_at)->diffForHumans() }}
                        </p>
                      </div>
                      <!-- Aksi -->
                      <a href="{{ route('checkout.tracking', $p->id_pesanan) }}" 
                        class="text-[#1d4657] text-xs font-semibold hover:underline mt-1">
                        Detail
                      </a>
                    </div>
                  @endforeach
                @else
                  <div class="p-6 text-center text-gray-500 text-sm">
                    Tidak ada notifikasi baru
                  </div>
                @endif
              </div>

              <!-- Footer -->
              <div class="bg-gray-50 px-5 py-3 text-center text-xs text-gray-500">
                Hanya menampilkan 3 notifikasi terakhir
              </div>
            </div>
          </div>


                      <!-- 🛒 Keranjang Modern -->
          <div class="relative group">
            <!-- Tombol Keranjang -->
            <button id="cartButton" class="relative p-2 rounded-full hover:bg-gray-100 transition cursor-pointer">
              <i class="fas fa-shopping-cart text-gray-700 text-lg"></i>
              <span id="cartCount" class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-[#1d4657] text-white text-[10px] font-bold flex items-center justify-center rounded-full">0</span>
            </button>

            <!-- Dropdown Keranjang -->
            <div
              class="absolute top-[110%] right-0 w-[22rem] bg-white rounded-2xl shadow-2xl z-50 opacity-0 scale-95
                    group-hover:opacity-100 group-hover:scale-100 group-hover:pointer-events-auto pointer-events-none
                    transform transition-all duration-300 origin-top-right border border-gray-100 overflow-hidden">

              <!-- Header -->
              <div class="bg-gradient-to-r from-[#1d4657] to-[#2f6d88] text-white px-5 py-3 flex items-center justify-between">
                <span class="font-semibold text-sm tracking-wide">🛍️ Keranjang Belanja</span>
                <a href="{{ route('keranjang.index') }}" class="text-xs text-white/80 hover:text-white transition">Lihat Semua</a>
              </div>

              <!-- Isi Keranjang -->
              <div id="cart-dropdown" class="max-h-80 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-transparent divide-y divide-gray-100">
                <div class="p-6 text-center text-gray-500 text-sm">
                  Memuat keranjang...
                </div>
              </div>

              <!-- Footer -->
              <div id="cart-footer" class="bg-gray-50 px-5 py-3 hidden">
                <div class="flex items-center justify-between mb-3">
                  <span class="text-sm font-semibold text-gray-700">Total:</span>
                  <span id="cart-total" class="text-[#1d4657] font-bold text-base">Rp0</span>
                </div>
                <a href="{{ route('keranjang.index') }}"
                  class="w-full block text-center py-2.5 bg-gradient-to-r from-[#1d4657] to-[#2f6d88] text-white font-semibold text-sm rounded-lg shadow-md hover:scale-[1.02] transform transition">
                  Lanjut ke Checkout
                </a>
              </div>
            </div>
          </div>


            <!-- TOKO (Dashboard Dropdown yang diperbarui) -->
            <div class="relative group flex items-center">
              <button type="button" class="p-2 rounded-full hover:bg-gray-100 transition cursor-pointer">
                <i class="fas fa-store text-[#1d4657]"></i>
              </button>
              <p class="ml-1 text-gray-800 font-medium hidden md:block">Toko</p>
              
              <div class="absolute z-50 right-0 w-80 bg-white border border-gray-200 rounded-xl shadow-2xl overflow-hidden
                         opacity-0 group-hover:opacity-100 pointer-events-none group-hover:pointer-events-auto transition top-10 transform scale-95 group-hover:scale-100 duration-200 origin-top-right">
                
                @php
                  // Cek apakah user adalah seller (asumsi role id 2)
                  $isSeller = Auth::user()->roles()->where('id_role',2)->exists();
                  
                  // Inisialisasi variabel untuk menghindari error jika toko tidak ditemukan
                  $shopName = 'Nama Toko Default'; 
                  $newOrders = 0;
                  $productCount = 0;
                  $monthlyRevenue = '0';
                  $totalPendapatan = 0; // Inisialisasi variabel $totalPendapatan

                  if ($isSeller) {
                    // MENGAMBIL DATA NAMA TOKO SECARA DINAMIS
                    $toko = \App\Models\Toko::where('id_pengguna', Auth::id())->first();
                    
                    if ($toko) {
                      $shopName = $toko->nama_toko;

                      // --- LOGIKA DIPERBARUI: MENGHITUNG TOTAL PRODUK DARI MODEL Product ---
                      // Model produk diasumsikan \App\Models\Product dan memiliki id_toko
                      $productCount = \App\Models\Product::where('id_toko', $toko->id_toko)->count();

                      // --- LOGIKA PENDAPATAN BULAN INI (DIPERBARUI DENGAN FORMAT Kueri DB) ---
                      // DI SINI ADALAH TEMPAT UNTUK Kueri DB Anda untuk mendapatkan total pendapatan bulanan
                      // Menggunakan kueri agregasi dari pengguna dan menambahkan filter bulan/tahun.
                      $currentMonth = date('m');
                      $currentYear = date('Y');

                      $totalPendapatan = $toko->pesanan()
                                               ->whereMonth('created_at', $currentMonth)
                                               ->whereYear('created_at', $currentYear)
                                               ->where('status_pesanan', 'selesai') // Pastikan hanya pesanan yang selesai
                                               ->sum(\DB::raw('total_harga_produk + biaya_pengiriman'));

                      // Format pendapatan menggunakan logika yang diminta: Rp X.XXX.XXX
                      $monthlyRevenue = 'Rp ' . number_format($totalPendapatan ?? 0, 0, ',', '.');


                      // TODO: Ganti dengan data statistik nyata
                      $newOrders = 4; // Mock Data
                    } else {
                      // Jika user punya role seller tapi data toko tidak ada, tampilkan CTA
                      $isSeller = false;
                    }
                  }
                @endphp

                @if($isSeller)
                  <!-- Tampilan Dashboard Toko -->
                  <div class="p-4 bg-[#f8fcf4] border-b border-[#42551E]/10">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500 font-medium">Dashboard Toko Anda</p>
                            <!-- NAMA TOKO DINAMIS ($shopName berisi $toko->nama_toko) -->
                            <p class="text-lg font-bold text-[#1d4657] truncate">{{ $shopName }}</p>
                        </div>
                        <a href="{{ route('seller.dashboard') }}" 
                           class="text-xs font-semibold text-blue-600 hover:text-blue-700 transition flex items-center ml-2">
                           <i class="fas fa-chart-line mr-1 text-sm"></i>
                           Lihat Penuh
                        </a>
                    </div>
                  </div>

                  <ul class="p-3 text-sm text-gray-700 space-y-1">
                    <!-- Stat 1: Pesanan Baru -->
                    <li class="hover:bg-gray-50 rounded-lg transition p-2 cursor-pointer flex items-center justify-between">
                      <div class="flex items-center space-x-3">
                        <span class="text-blue-500 w-6 text-center"><i class="fas fa-box-open"></i></span>
                        <span class="font-medium">Pesanan Baru</span>
                      </div>
                      <span class="text-blue-600 font-bold">{{ $newOrders }}</span>
                    </li>

                    <!-- Stat 2: Jumlah Produk -->
                    <li class="hover:bg-gray-50 rounded-lg transition p-2 cursor-pointer flex items-center justify-between">
                      <div class="flex items-center space-x-3">
                        <span class="text-yellow-500 w-6 text-center"><i class="fas fa-tags"></i></span>
                        <span class="font-medium">Total Produk</span>
                      </div>
                      <span class="text-gray-800 font-semibold">{{ $productCount }}</span>
                    </li>
                    
                    <!-- Stat 3: Pendapatan Bulan Ini -->
                    <li class="hover:bg-gray-50 rounded-lg transition p-2 cursor-pointer flex items-center justify-between">
                      <div class="flex items-center space-x-3">
                        <span class="text-green-600 w-6 text-center"><i class="fas fa-money-bill-wave"></i></span>
                        <span class="font-medium">Pendapatan (Bln Ini)</span>
                      </div>
                      <span class="text-green-600 font-bold">{{ $monthlyRevenue }}</span>
                    </li>
                  </ul>
                  
                  <div class="p-3 border-t">
                      <a href="{{ route('seller.dashboard') }}" 
                         class="w-full block text-center py-2 bg-[#1d4657] text-white font-semibold text-sm rounded-lg shadow-md hover:bg-[#5b7028] transition">
                        Kelola Toko Sekarang
                      </a>
                  </div>

                @else
                  <!-- Tampilan Pendaftaran Toko (CTA) -->
                  <div class="p-5 text-center">
                    <i class="fas fa-store text-5xl text-[#1d4657] mb-3"></i>
                    <p class="text-xl font-bold text-gray-800 mb-2">Jual di Batara!</p>
                    <p class="text-sm text-gray-500 mb-4">Mulai bisnis Anda dengan modal nol dan jangkau jutaan pelanggan.</p>
                    
                    <a href="{{ route('seller.create') }}"
                       class="inline-block w-full px-6 py-3 bg-[#1d4657] text-white font-bold rounded-xl shadow-lg hover:bg-blue-700 transition transform hover:scale-[1.01]">
                      Daftar Toko Gratis <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                  </div>

                @endif
              </div>
            </div>


            <!-- 🌟 User Dropdown Modern -->
            <div class="relative group">
              <button class="flex items-center space-x-2 p-2 rounded-full hover:bg-gray-100 transition cursor-pointer">
                <img src="{{ Auth::user()->foto_profil ? asset('storage/' . Auth::user()->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->nama_pengguna) . '&background=1d4657&color=fff' }}"
                    class="w-8 h-8 rounded-full border border-gray-300 object-cover"
                    alt="User Avatar">
                <i class="fas fa-chevron-down text-gray-600 text-xs hidden sm:block"></i>
              </button>

              <!-- Dropdown -->
              <div class="absolute z-50 right-0 mt-2 w-56 bg-white rounded-2xl shadow-2xl border border-gray-100 transform opacity-0 scale-95 
                          group-hover:opacity-100 group-hover:scale-100 group-hover:pointer-events-auto pointer-events-none 
                          transition-all duration-200 origin-top-right">

                <!-- Header Profil -->
                <div class="bg-gradient-to-r from-[#1d4657] to-[#2f6d88] px-5 py-4 text-white rounded-t-2xl flex items-center space-x-3">
                  <img src="{{ Auth::user()->foto_profil ? asset('storage/' . Auth::user()->foto_profil) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->nama_pengguna) . '&background=ffffff&color=1d4657' }}"
                      class="w-10 h-10 rounded-full border-2 border-white object-cover">
                  <div>
                    <p class="font-semibold text-sm">{{ Auth::user()->nama_pengguna }}</p>
                    <p class="text-xs text-white/80">{{ Auth::user()->email }}</p>
                  </div>
                </div>

                <!-- Menu -->
                <ul class="py-2 text-sm text-gray-700">
                  <li>
                    <a href="{{ route('profile.index') }}"
                      class="flex items-center px-5 py-2 hover:bg-gray-50 transition rounded-lg">
                      <i class="fas fa-user text-[#1d4657] w-5 mr-3"></i> Profil Saya
                    </a>
                  </li>

                  <li>
                    <a href="{{ route('keranjang.index') }}"
                      class="flex items-center px-5 py-2 hover:bg-gray-50 transition rounded-lg">
                      <i class="fas fa-shopping-bag text-[#1d4657] w-5 mr-3"></i> Pesanan Saya
                    </a>
                  </li>

                  <li>
                    <a href="{{ route('seller.dashboard') }}"
                      class="flex items-center px-5 py-2 hover:bg-gray-50 transition rounded-lg">
                      <i class="fas fa-store text-[#1d4657] w-5 mr-3"></i> Dashboard Toko
                    </a>
                  </li>

                  <li class="border-t mt-2">
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button type="submit"
                              class="flex items-center w-full px-5 py-2 text-red-600 hover:bg-red-50 transition rounded-lg">
                        <i class="fas fa-sign-out-alt w-5 mr-3"></i> Keluar
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

    $(document).ready(function () {
      $.ajax({
        url: '/keranjang/data',
        type: 'GET',
        success: function (data) {
          updateCartDropdown(data);
        },
        error: function () {
          console.error('Gagal memuat data keranjang.');
        }
      });
    });


    function loadCartDropdown() {
      // NOTE: Ganti URL ini dengan URL API yang sebenarnya untuk keranjang
      $.get("{{ route('keranjang.dropdown') }}", function(response){
        updateCartDropdown(response);
      }).fail(function() {
         // Mock data jika API gagal, untuk demo tampilan
         const mockData = {
           items: [
             { nama: 'Beras Organik', harga: 50000, jumlah: 1, image: 'https://placehold.co/100x100/42551E/ffffff?text=P1' },
             { nama: 'Sayur Bayam', harga: 5000, jumlah: 3, image: 'https://placehold.co/100x100/008000/ffffff?text=P2' }
           ]
         };
         updateCartDropdown(mockData);
      });
    }

    $(document).ready(function(){
      loadCartDropdown();
      window.loadCartDropdown = loadCartDropdown;
    });
  </script>
</body>
</html>
