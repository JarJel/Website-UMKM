<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Batara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.5.2/flowbite.min.js"></script>
  </head>
  <body class="bg-white">
    <nav class="sticky top-0 z-50 bg-white border-b shadow-xl">
      <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center h-20 justify-between space-x-4">
          
          <!-- Logo -->
          <div class="w-[175px] h-[80px]">
            <img src="../../../assets/imageInternal/logoBatara.png"
                 class="w-full h-full object-contain"
                 alt="Logo Batara">
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
            </div>

            <!-- Icon Keranjang -->
            <div class="relative group">
              <button class="p-2 rounded-full hover:bg-gray-100 transition cursor-pointer">
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
              </button>
            </div>

            <!-- Icon Toko + Tulisan -->
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
                  <li>
                    <p class="block px-4 py-2 font-semibold">
                      Mulai toko anda secara gratis
                    </p>
                  </li>
                  <li>
                    <a href="{{ route('seller.create') }}"
                      class="inline-block px-6 py-2 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 transition">
                      Daftar toko
                    </a>
                  </li>
                </ul>
              </div>

            </div>


            <!-- Dropdown Profile -->
            <div class="relative group">
              <button class="p-2 rounded-full hover:bg-gray-100 transition cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor"
                    class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9a3.75 3.75 0 1 1-7.5 
                          0 3.75 3.75 0 0 1 7.5 0ZM4.5 
                          20.25a8.25 8.25 0 1 1 15 0v.75h-15v-.75Z" />
                </svg>
              </button>

              <div
                class="absolute z-50 right-0 mt-2 w-48 bg-white border border-gray-200 rounded-xl shadow-lg
                      opacity-0 group-hover:opacity-100 pointer-events-none group-hover:pointer-events-auto transition">
                <ul class="py-2 text-sm text-gray-700">
                  <li><a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-gray-100">Profil</a></li>
                  <li>
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Keluar</button>
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

    <!-- Bagian konten -->
    <section class="px-8 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-16">
        <div class="relative z-10 py-4 sm:py-6 lg:py-8">
          <div class="text-center">
            <!-- Carousel -->
            <div id="default-carousel" class="relative w-full" data-carousel="slide">
              <div class="relative h-[35vh] sm:h-[40vh] md:h-[45vh] overflow-hidden rounded-lg">
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                  <img src="../../../assets/bannerHome/bannerPromo.png"
                       class="absolute h-full object cover block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                       alt="...">
                </div>
              </div>
            </div>

            <!-- Kategori -->
            <div class="max-w-7xl mx-auto px-4 py-8">
              <h2 class="text-xl font-semibold text-center mb-6">Kategori Barang</h2>
              <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6 justify-items-center">
                <div class="flex flex-col py-4 px-4 rounded-lg bg-[#42551E] shadow-xl items-center text-center hover:scale-105 transition">
                  <div class="w-24 h-24 overflow-hidden">
                    <img src="../../../assets/iconKategori/pertanian.png"
                         alt="Kategori 1"
                         class="w-full h-full object-cover">
                  </div>
                  <p class="mt-2 text-sm font-medium text-white">Kategori 1</p>
                </div>
              </div>
            </div>

            <div class="bg-white">
              <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Trending Products</h2>

                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                  <div class="group relative">
                    <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/product-page-01-related-product-01.jpg" alt="Front of men&#039;s Basic Tee in black." class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />
                    <div class="mt-4 flex justify-between">
                      <div>
                        <h3 class="text-sm text-gray-700">
                          <a href="#">
                            <span aria-hidden="true" class="absolute inset-0"></span>
                            Basic Tee
                          </a>
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">Black</p>
                      </div>
                      <p class="text-sm font-medium text-gray-900">$35</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
