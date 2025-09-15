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
          
          <div class="w-[175px] h-[80px]">
            <img src="../../../assets/imageInternal/logoBatara.png"
                 class="w-full h-full object-contain"
                 alt="Logo Batara">
          </div>

          <div class="flex-grow max-w-2xl">
            <input
              type="text"
              placeholder="Cari produk atau layanan..."
              class="w-full border border-gray-300 rounded-lg shadow-sm px-4 py-1 focus:outline-none focus:ring-2 focus:ring-[#42551E]"
            />
          </div>
          
          <div class="flex items-center space-x-2 text-gray-700">
            <div class="relative group">
                <button class="p-2 rounded-full hover:bg-gray-100 transition cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6 text-gray-700">
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

                <div
                    class="absolute z-50 left-1/2 -translate-x-1/2 border-2 border-black w-56 bg-white border border-gray-200 rounded-xl shadow-lg
                        opacity-0 group-hover:opacity-100 pointer-events-none group-hover:pointer-events-auto
                        transition">
                    <ul class="py-2 text-sm text-gray-700">
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 rounded-t-xl">Dashboard</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Settings</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Earnings</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 rounded-b-xl">Sign out</a></li>
                    </ul>
                </div>
            </div>

            <div class="relative group">
                <button type="button"
                        class="p-2 rounded-full hover:bg-gray-100 transition cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor"
                        class="w-6 h-6">
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

                <div
                    class="absolute z-50 left-1/2 -translate-x-1/2 
                        min-w-[18rem] bg-white border border-gray-200 rounded-xl shadow-lg
                        opacity-0 group-hover:opacity-100 pointer-events-none group-hover:pointer-events-auto
                        transition">
                    <ul class="py-2 text-sm text-gray-700 space-y-2">
                    
                    <li>
                        <div class="flex justify-between items-center px-4 py-2">
                        <div class="flex items-center space-x-2">
                            <img class="w-12 h-12 bg-gray-200 rounded-lg" src="" alt="">
                            <p class="font-medium">Nama produk</p>
                        </div>
                        <p class="text-gray-600">2 × 15.000</p>
                        </div>
                    </li>

                    <li><hr class="my-1 border-gray-200"></li>
                </div>
            </div>


              <div class="relative group">
                <button type="button" class="p-2 rounded-full hover:bg-gray-100 transition">
                     <svg xmlns="http://www.w3.org/2000/svg"
                          fill="none" viewBox="0 0 24 24"
                          stroke-width="1.5" stroke="currentColor"
                          class="w-6 h-6">
                       <path stroke-linecap="round" stroke-linejoin="round"
                             d="M21.75 6.75v10.5a2.25 2.25 
                               0 0 1-2.25 2.25h-15a2.25 
                               2.25 0 0 1-2.25-2.25V6.75m19.5 
                               0A2.25 2.25 0 0 0 19.5 
                               4.5h-15a2.25 2.25 0 0 
                               0-2.25 2.25m19.5 0v.243a2.25 
                               2.25 0 0 1-1.07 1.916l-7.5 
                               4.615a2.25 2.25 0 0 
                               1-2.36 0L3.32 8.91a2.25 
                               2.25 0 0 1-1.07-1.916V6.75" />
                     </svg>
                   </button>

                   <div
                     class="absolute z-50 left-1/2 -translate-x-1/2 border-2 border-black w-auto bg-white border border-gray-200 rounded-xl shadow-lg
                         opacity-0 group-hover:opacity-100 pointer-events-none group-hover:pointer-events-auto
                         transition">
                     <ul class="py-2 text-sm text-gray-700">
                     <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Settings</a></li>
                     <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Earnings</a></li>
                     <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 rounded-b-xl">Sign out</a></li>
                     </ul>
                 </div>
               </div>
          </div>

          <div class="hidden md:block">
            <a href="{{ url('/login') }}" class="px-4 py-2 rounded-lg bg-[#42551E] text-white hover:bg-[#5b7028] transition">
              Sign in
            </a>
          </div>
        </div>
      </div>
    </nav>

    <section class="px-8 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-16">
        <div class="relative z-10 py-4 sm:py-6 lg:py-8">
          <div class="text-center">
            <div id="default-carousel" class="relative w-full" data-carousel="slide">
                <div class="relative h-[35vh] sm:h-[40vh] md:h-[45vh] overflow-hidden rounded-lg">
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="../../../assets/bannerHome/bannerPromo.png" class="absolute h-full object cover block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="../../../assets/bannerHome/bannerPromo.png" class="absolute block h-full object cover w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="../../../assets/bannerHome/bannerPromo.png" class="absolute block w-full h-full object cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="../../../assets/bannerHome/bannerPromo.png" class="absolute h-full object cover block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="../../../assets/bannerHome/bannerPromo.png" class="absolute h-full object cover block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                </div>
                <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
                </div>
                <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>

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
          </div>
        </div>
      </div>
    </section>

    <section>

    </section>
  </body>
</html>