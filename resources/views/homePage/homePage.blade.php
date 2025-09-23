<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Batara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.5.2/flowbite.min.js"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- AJAX Keranjang Global -->
    <script src="{{ asset('js/cart.js') }}"></script>
  </head>
  <body class="bg-white">

    @include('homePage.navbar')

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
                  @foreach ($products as $product)
                    <div class="group relative border rounded-lg p-4 shadow hover:shadow-lg transition flex flex-col">
                      <a href="{{ route('produk.show', $product->id_produk) }}">
                          <!-- Gambar -->
                          <img src="{{ asset($product->gambar_produk) }}" 
                              alt="{{ $product->nama_produk }}" 
                              class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-40" />

                          <!-- Nama + kategori -->
                          <div class="mt-4 text-left">
                              <h3 class="text-sm text-gray-700 font-semibold">
                                  {{ $product->nama_produk }}
                              </h3>

                              <!-- Harga -->
                              <p class="mt-2 text-base font-bold text-gray-900">
                                  Rp {{ number_format($product->harga_dasar, 0, ',', '.') }}
                              </p>

                              <!-- Rating + Terjual -->
                              <div class="mt-1 flex items-center space-x-2 text-sm text-gray-500">
                                  <!-- Rating bintang -->
                                  <div class="flex items-center text-yellow-400">
                                      <i class="fas fa-star"></i>
                                      <span class="ml-1 text-gray-700">{{ $product->rating ?? '0.0' }}</span>
                                  </div>
                                  <!-- Jumlah terjual -->
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
  </body>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    // Render dropdown
    function renderDropdown(items) {
        let html = '';
        if (items && items.length > 0) {
            items.forEach(item => {
                html += `
                <li class="flex items-center justify-between px-4 py-2 hover:bg-gray-100 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <img src="${item.image}" alt="${item.nama}" class="w-12 h-12 object-cover rounded">
                        <div class="flex flex-col text-left">
                            <span class="font-semibold text-gray-800 text-sm">${item.nama}</span>
                            <span class="text-gray-500 text-xs">Rp ${item.harga.toLocaleString('id-ID')}</span>
                        </div>
                        <span class="ml-2 text-gray-600 text-xs font-semibold">${item.jumlah}x</span>
                    </div>
                </li>`;
            });
        } else {
            html = '<li class="px-4 py-2 text-gray-500 text-center">Belum ada produk</li>';
        }
        $('#cart-dropdown').html(html);
    }

    // Load dropdown dari server
    function loadCartDropdown() {
        $.ajax({
            url: '/keranjang/dropdown',
            method: 'GET',
            cache: false,
            success: function(response) {
                renderDropdown(response.items);
            },
            error: function() {
                renderDropdown([]);
            }
        });
    }

    loadCartDropdown();

    // Tambah ke keranjang
    $(document).on('click', '.add-to-cart', function() {
        const productId = $(this).data('id');
        const quantity = $(this).data('quantity') || 1;
        const $button = $(this);
        $button.prop('disabled', true).text('Menambahkan...');

        $.ajax({
            url: '/keranjang/tambah/' + productId,
            method: 'POST',
            data: {_token: csrfToken, quantity: quantity},
            success: function() {
                loadCartDropdown();
            },
            complete: function() {
                $button.prop('disabled', false).html('<i class="fas fa-shopping-cart mr-2"></i> Tambah ke Keranjang');
            }
        });
    });
});

</script>

</html>
