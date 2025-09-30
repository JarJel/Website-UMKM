<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batara</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.5.2/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-white">

    {{-- Navbar --}}
    @include('homePage.navbar')

    <section class="px-8 bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-16">
        <div class="relative z-10 py-4 sm:py-6 lg:py-8">
          <div class="text-center">

            <!-- Banner -->
            <div id="default-carousel" class="relative w-full" data-carousel="slide">
              <div class="relative h-[35vh] sm:h-[40vh] md:h-[45vh] overflow-hidden rounded-lg">
                <img src="{{ asset('assets/bannerHome/bannerPromo.png') }}" 
                     alt="Banner" 
                     class="h-full w-full object-cover rounded-lg">
              </div>
            </div>

            <!-- Kategori -->
            <div class="max-w-7xl mx-auto px-4 py-8">
              <h2 class="text-xl font-semibold text-center mb-6">Kategori Barang</h2>
              <div id="kategoriWrapper" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6 justify-items-center">

                <!-- Tombol Semua -->
                <button 
                  class="kategori-btn flex flex-col items-center justify-center"
                  data-id="all">
                  <div class="w-24 h-24 flex items-center justify-center text-white text-lg font-bold rounded-full bg-gray-500 shadow-md hover:scale-105 transition">
                    All
                  </div>
                  <p class="mt-2 text-sm font-medium text-gray-700">Semua</p>
                </button>

                <!-- Kategori dari DB -->
                @foreach ($categories as $category)
                  <button 
                    class="kategori-btn flex flex-col items-center justify-center"
                    data-id="{{ $category->id_kategori }}">
                    <img src="{{ asset('storage/' . $category->icon) }}" 
                      alt="{{ $category->nama_kategori }}" 
                      class="w-12 h-12 mb-2">
                    <p class="mt-2 text-sm font-medium text-gray-700">{{ $category->nama_kategori }}</p>
                  </button>
                @endforeach
              </div>
            </div>

            <!-- Produk -->
            <div class="bg-white">
              <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Trending Products</h2>

                <div id="produkWrapper" class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                  @foreach ($products as $product)
                    <div 
                      class="produk-card group relative border rounded-lg p-4 shadow hover:shadow-lg transition flex flex-col"
                      data-category="{{ $product->id_kategori }}">
                      
                      <a href="{{ route('produk.show', $product->id_produk) }}">
                          <img src="{{ asset('storage/' . $product->gambar_produk) }}" 
                              alt="{{ $product->nama_produk }}" 
                              class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-40" />

                          <div class="mt-4 text-left">
                              <h3 class="text-sm text-gray-700 font-semibold">
                                  {{ $product->nama_produk }}
                              </h3>
                              <p class="mt-2 text-base font-bold text-gray-900">
                                  Rp {{ number_format($product->harga_dasar, 0, ',', '.') }}
                              </p>
                              <div class="mt-1 flex items-center space-x-2 text-sm text-gray-500">
                                  <div class="flex items-center text-yellow-400">
                                      <i class="fas fa-star"></i>
                                      <span class="ml-1 text-gray-700">{{ $product->rating ?? '0.0' }}</span>
                                  </div>
                                  <span>| Terjual {{ $product->terjual ?? 0 }}</span>
                              </div>
                          </div>
                      </a>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

<script>
$(document).ready(function() {
    // klik kategori
    $(".kategori-btn").on("click", function() {
        let kategoriId = $(this).data("id");

        if (kategoriId === "all") {
            $(".produk-card").show();
        } else {
            $(".produk-card").hide();
            $(`.produk-card[data-category='${kategoriId}']`).show();
        }
    });
});
</script>

</body>
</html>
