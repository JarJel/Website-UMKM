<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batara</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.5.2/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }

        .fade-target {
            opacity: 0;
        }

        body {
            visibility: hidden;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .gradient-border {
            position: relative;
            background: linear-gradient(white, white) padding-box,
                        linear-gradient(135deg, #667eea 0%, #764ba2 100%) border-box;
            border: 3px solid transparent;
        }

        .shimmer {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            background-size: 1000px 100%;
            animation: shimmer 2s infinite;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-gray-100">

    {{-- Navbar --}}
    <div id="navbar-wrapper" class="fade-target"> 
        @include('homePage.navbar')
    </div>

    <section class="px-4 sm:px-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-16">
        <div class="relative z-10 py-4 sm:py-6 lg:py-8">
        <div class="text-center">

            <!-- Banner CAROUSEL dengan Overlay Modern -->
            <div id="default-carousel" class="relative w-full fade-target mb-12" data-carousel="slide">
              
              <div class="relative h-[40vh] sm:h-[50vh] md:h-[60vh] overflow-hidden rounded-3xl shadow-2xl">
                  
                  <!-- Item 1: Banner Promo -->
                  <div class="duration-700 ease-in-out" data-carousel-item>
                      <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-purple-600/20 z-10"></div>
                      <img src="{{ asset('assets/bannerHome/bannerPromo.png') }}" 
                          alt="Banner Promo" 
                          class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                  </div>
                  
                  <!-- Item 2: Placeholder 1 -->
                  <div class="duration-700 ease-in-out" data-carousel-item>
                      <div class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-cyan-600/20 z-10"></div>
                      <img src="https://placehold.co/1600x800/3b82f6/ffffff?text=🎉+Diskon+Hingga+50%25+%0A+Produk+Pilihan" 
                          alt="Banner Diskon Terbatas" 
                          class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                  </div>
                  
                  <!-- Item 3: Placeholder 2 -->
                  <div class="duration-700 ease-in-out" data-carousel-item>
                      <div class="absolute inset-0 bg-gradient-to-r from-green-600/20 to-emerald-600/20 z-10"></div>
                      <img src="https://placehold.co/1600x800/10b981/ffffff?text=✨+Koleksi+Terbaru+%0A+Sudah+Tersedia" 
                          alt="Banner Barang Baru" 
                          class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                  </div>
                  
              </div>
              
              <!-- Tombol Indikator Modern -->
              <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                  <button type="button" class="w-12 h-1.5 rounded-full bg-white/50 hover:bg-white transition-all" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                  <button type="button" class="w-12 h-1.5 rounded-full bg-white/50 hover:bg-white transition-all" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                  <button type="button" class="w-12 h-1.5 rounded-full bg-white/50 hover:bg-white transition-all" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
              </div>

              <!-- Tombol Prev/Next Modern -->
              <button type="button" class="absolute top-1/2 start-4 z-30 -translate-y-1/2 flex items-center justify-center w-12 h-12 rounded-full bg-white/90 shadow-lg hover:bg-white hover:scale-110 transition-all group focus:outline-none" data-carousel-prev>
                  <svg class="w-5 h-5 text-gray-800 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 6 10">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                  </svg>
              </button>
              <button type="button" class="absolute top-1/2 end-4 z-30 -translate-y-1/2 flex items-center justify-center w-12 h-12 rounded-full bg-white/90 shadow-lg hover:bg-white hover:scale-110 transition-all group focus:outline-none" data-carousel-next>
                  <svg class="w-5 h-5 text-gray-800 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 6 10">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                  </svg>
              </button>
            </div>

            <!-- Kategori Modern dengan Glass Effect -->
            <div class="max-w-7xl mx-auto px-4 py-4 fade-target" id="kategori-section">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold bg-[#1d4657] from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">
                        Kategori Barang
                    </h2>
                    <p class="text-gray-600">Temukan produk sesuai kebutuhan Anda</p>
                </div>

                <div id="kategoriWrapper" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6 justify-items-center">

                    <!-- Tombol Semua -->
                    <button class="kategori-btn group flex flex-col items-center justify-center w-full" data-id="all">
                        <div class="relative w-24 h-24 flex items-center justify-center rounded-2xl bg-gradient-to-br from-gray-400 to-gray-600 shadow-lg hover:shadow-2xl transform hover:scale-110 transition-all duration-300">
                            <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-white/20 to-transparent"></div>
                            <svg class="w-10 h-10 text-white z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                        </div>
                        <p class="mt-3 text-sm font-semibold text-gray-700 group-hover:text-blue-600 transition">Semua</p>
                    </button>

                    <!-- Kategori dari DB -->
                    @foreach ($categories as $category)
                    <button class="kategori-btn group flex flex-col items-center justify-center w-full" data-id="{{ $category->id_kategori }}">
                        <div class="relative w-24 h-24 flex items-center justify-center rounded-2xl bg-gradient-to-br from-blue-50 to-purple-50 border-2 border-blue-100 shadow-lg hover:shadow-2xl transform hover:scale-110 hover:rotate-3 transition-all duration-300">
                            <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-white/50 to-transparent"></div>
                            <img src="{{ asset('storage/' . $category->icon) }}" 
                                alt="{{ $category->nama_kategori }}" 
                                class="w-14 h-14 object-contain z-10">
                        </div>
                        <p class="mt-3 text-sm font-semibold text-gray-700 group-hover:text-blue-600 transition text-center px-2">
                            {{ $category->nama_kategori }}
                        </p>
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- Produk Section Modern -->
            <div class="bg-transparent fade-target" id="produk-section">
                <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                    
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="text-3xl font-bold bg-[#1d4657] from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                Trending Products
                            </h2>
                            <p class="text-gray-600 mt-1">Produk paling diminati minggu ini</p>
                        </div>
                        <div class="hidden md:flex items-center space-x-2">
                            <span class="text-sm text-gray-500">🔥</span>
                            <span class="text-sm font-medium text-gray-700">Popular</span>
                        </div>
                    </div>

                    {{-- Wrapper Produk --}}
                    <div 
                        id="produkWrapper" 
                        class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4"
                        data-next-page="{{ $products->nextPageUrl() ?? 'false' }}"
                        data-last-page="{{ $products->lastPage() }}">

                        @foreach ($products as $product)
                        <div class="produk-card group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 bg-white"
                            data-category="{{ $product->id_kategori }}">
                            
                            <a href="{{ route('produk.show', $product->id_produk) }}" class="block">
                                {{-- Image Container dengan Overlay --}}
                                <div class="relative overflow-hidden aspect-square">
                                    <img src="{{ asset('storage/' . $product->gambar_produk) }}" 
                                        alt="{{ $product->nama_produk }}" 
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                                    
                                    {{-- Gradient Overlay --}}
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    
                                    {{-- Badge Trending --}}
                                    @if($product->terjual > 50)
                                    <div class="absolute top-3 left-3 px-3 py-1 bg-gradient-to-r from-orange-500 to-red-500 text-white text-xs font-bold rounded-full shadow-lg flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        Hot
                                    </div>
                                    @endif
                                    
                                    {{-- Quick View Button --}}
                                    <div class="absolute bottom-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <button class="p-2 bg-white rounded-full shadow-lg hover:bg-blue-600 hover:text-white transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                {{-- Product Info --}}
                                <div class="p-5">
                                    <h3 class="text-sm font-semibold text-gray-800 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                        {{ $product->nama_produk }}
                                    </h3>
                                    
                                    {{-- Price --}}
                                    <div class="flex items-baseline space-x-2 mb-3">
                                        <p class="text-xl font-bold bg-[#1d4657] from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                            Rp {{ number_format($product->harga_dasar, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    
                                    {{-- Rating & Sales --}}
                                    <div class="flex items-center justify-between text-sm">
                                        <div class="flex items-center space-x-1">
                                            <div class="flex items-center text-yellow-400">
                                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <span class="ml-1 font-semibold text-gray-700">{{ $product->rating ?? '5.0' }}</span>
                                            </div>
                                        </div>
                                        <div class="flex items-center text-gray-500">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                                            </svg>
                                            <span class="font-medium">{{ $product->terjual ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    
                    {{-- Loading Indicator Modern --}}
                    <div id="loading-indicator" class="text-center py-12" style="display: none;">
                        <div class="inline-flex items-center justify-center space-x-2">
                            <div class="w-3 h-3 bg-blue-600 rounded-full animate-bounce" style="animation-delay: 0s"></div>
                            <div class="w-3 h-3 bg-purple-600 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                            <div class="w-3 h-3 bg-blue-600 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                        </div>
                        <p class="mt-4 text-gray-600 font-medium">Memuat produk lainnya...</p>
                    </div>

                    {{-- End Message --}}
                    <div id="end-message" class="text-center py-12" style="display: none;">
                        <div class="inline-block p-4 bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl border-2 border-blue-100">
                            <svg class="w-12 h-12 text-blue-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-gray-700 font-semibold">Semua produk telah ditampilkan</p>
                            <p class="text-sm text-gray-500 mt-1">Terima kasih telah menjelajahi katalog kami</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        </div>
    </div>
    </section>

<script>
// Flowbite Carousel Auto-Sliding
document.addEventListener('DOMContentLoaded', () => {
    if (window.Flowbite) {
        const carouselElement = document.getElementById('default-carousel');
        const items = [
            { position: 0, el: document.querySelector('[data-carousel-slide-to="0"]') },
            { position: 1, el: document.querySelector('[data-carousel-slide-to="1"]') },
            { position: 2, el: document.querySelector('[data-carousel-slide-to="2"]') }
        ];

        const options = {
            defaultPosition: 0,
            interval: 5000,
            indicators: {
                activeClasses: 'bg-white',
                inactiveClasses: 'bg-white/50 hover:bg-white/80',
                items: items
            }
        };

        new window.Flowbite.Carousel(carouselElement, options);
    }
});

$(document).ready(function() {
    
    // Tampilkan body dan fade-in animations
    $('body').css('visibility', 'visible');
    $('#navbar-wrapper').animate({ opacity: 1 }, 400);
    $('#default-carousel').delay(100).animate({ opacity: 1 }, 500);
    $('#kategori-section').delay(300).animate({ opacity: 1 }, 500);
    $('#produk-section').delay(500).animate({ opacity: 1 }, 600);

    // Kategori Filter dengan animasi
    $(".kategori-btn").on("click", function() {
        let kategoriId = $(this).data("id");

        // Highlight kategori aktif
        $(".kategori-btn").removeClass("ring-4 ring-blue-300");
        $(this).addClass("ring-4 ring-blue-300");

        $("#produkWrapper").fadeOut(250, function() {
            $('#loading-indicator').show();
        });

        setTimeout(function() {
            $('#loading-indicator').hide();

            if (kategoriId === "all") {
                $(".produk-card").fadeIn(300);
            } else {
                $(".produk-card").hide();
                $(`.produk-card[data-category='${kategoriId}']`).fadeIn(300);
            }

            $("#produkWrapper").fadeIn(350);
        }, 600);
    });

    // Infinite Scroll
    let isLoading = false;
    let nextPageUrl = $('#produkWrapper').data('next-page');
    let currentPage = {{ $products->currentPage() }};

    function loadMoreProducts() {
        if (isLoading || nextPageUrl === 'false' || !nextPageUrl) {
            return;
        }

        isLoading = true;
        $('#loading-indicator').show();

        $.ajax({
            url: nextPageUrl,
            method: 'GET',
            data: { 
                page: currentPage + 1,
            },
            success: function(response) {
                if (response.html.trim() === '') {
                    nextPageUrl = false;
                    $('#end-message').fadeIn(400);
                } else {
                    $(response.html).hide().appendTo('#produkWrapper').fadeIn(600);
                    nextPageUrl = response.nextPageUrl;
                    currentPage++;
                }

                $('#loading-indicator').fadeOut(300);
                isLoading = false;
            },
            error: function(xhr) {
                console.error("Gagal memuat produk:", xhr);
                $('#loading-indicator').fadeOut(300);
                isLoading = false;
            }
        });
    }

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 200) {
            loadMoreProducts();
        }
    });

});
</script>

</body>
</html>