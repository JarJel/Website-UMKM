<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online Kita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .container-padding { padding: 1rem; }
        @media (min-width: 768px) { .container-padding { padding: 2rem; } }
        html { scroll-behavior: smooth; }
        
        /* 1. Definisikan Animasi Fade In */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* 2. Style untuk Animasi */
        .fade-in-element {
            /* Terapkan animasi ke elemen turunan */
            animation: fadeIn 0.6s ease-out forwards;
            /* Inisialisasi opacity ke 0 sebelum diaktifkan JS */
            opacity: 0;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    @include('homePage.navbar')

    <!-- Tambahkan class 'opacity-0' secara default. Ini akan diubah oleh JS. -->
    <main id="main-content" class="container mx-auto container-padding flex-grow opacity-0 transition-opacity">

        <!-- Banner -->
        <section id="banner-section" class="relative rounded-xl overflow-hidden shadow-lg mb-8">
            <img src="https://placehold.co/1200x400/38A169/ffffff?text=Promo+Spesial" alt="Banner Promo" class="w-full h-auto object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center">
                <div class="text-white text-center">
                    <h2 class="text-3xl md:text-5xl font-extrabold mb-2 leading-tight drop-shadow-md">Diskon Spesial!</h2>
                    <p class="text-lg md:text-xl font-light mb-4 drop-shadow-sm">Belanja produk terbaik dengan harga termurah.</p>
                    <a href="#" class="inline-block bg-white text-green-600 font-semibold py-2 px-6 rounded-full shadow-lg hover:bg-gray-100 transition duration-300">Lihat Semua Promo</a>
                </div>
            </div>
        </section>

        <!-- Profil Toko -->
        <section class="p-4 mb-8 flex items-center justify-between border-b border-gray-300">
            <div class="flex items-center space-x-4">
                <img src="{{ $toko->foto_profil ? asset($toko->foto_profil) : 'https://placehold.co/100x100?text=Toko' }}" 
                     alt="{{ $toko->nama_toko }}" class="w-14 h-14 md:w-16 md:h-16 rounded-full object-cover shadow">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">{{ $toko->nama_toko }}</h3>
                    <p class="text-sm text-gray-500">{{ $toko->alamat ?? 'Alamat tidak tersedia' }}</p>
                </div>
            </div>

            <div class="flex items-center space-x-1 bg-yellow-50 px-3 py-1 rounded-full shadow-sm">
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.69-.921 1.99 0l1.24 3.82a1 
                    1 0 00.95.69h4.01a1 1 0 01.95 1.258l-3.24 
                    2.353a1 1 0 00-.36.757l1.24 3.82a1 
                    1 0 01-1.54 1.118L10 13.08l-3.24 
                    2.353a1 1 0 01-1.54-1.118l1.24-3.82a1 
                    1 0 00-.36-.757L2.85 7.685a1 1 
                    0 01.95-1.258h4.01a1 1 
                    0 00.95-.69l1.24-3.82z"/>
                </svg>
                <span class="text-sm font-medium text-gray-700">{{ $toko->rating ?? '0.0' }}</span>
            </div>
        </section>

        <!-- Produk + Dropdown -->
        <section id="product-grid" x-data="productFilter('{{ $sort }}')">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-2xl font-bold text-gray-800">Produk dari {{ $toko->nama_toko }}</h3>

                <div class="relative">
                    <button @click="open = !open" 
                            class="flex items-center gap-2 px-4 py-2 bg-white border rounded-lg shadow-sm hover:bg-gray-50 transition">
                        <span class="text-sm font-medium text-gray-700" x-text="selectedText"></span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                             stroke-width="1.5" stroke="currentColor" 
                             :class="open ? 'rotate-180 transition-transform' : 'transition-transform'"
                             class="w-4 h-4 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false" x-transition
                         class="absolute right-0 mt-2 w-44 bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden z-10">
                        <template x-for="option in options" :key="option.value">
                            <a href="#" @click.prevent="changeSort(option.value)"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                               :class="selected === option.value ? 'bg-gray-100 font-semibold' : ''"
                               x-text="option.text"></a>
                        </template>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                @forelse ($produk as $p)
                <div class="bg-white rounded-xl shadow-md overflow-hidden transform hover:scale-105 transition duration-300">
                    <a href="{{ route('produk.show', $p->id_produk) }}">
                            <img src="{{ asset('storage/' . $p->gambar_produk) }}" 
                              alt="{{ $p->nama_produk }}" 
                              class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-40" />
                        <div class="p-3">
                            <h4 class="font-semibold text-sm text-gray-800 mb-1">{{ $p->nama_produk }}</h4>
                            <p class="text-sm font-bold text-green-600 mb-1">Rp {{ number_format($p->harga_dasar,0,',','.') }}</p>
                            <p class="text-xs text-gray-500">{{ $toko->alamat ?? 'Lokasi tidak tersedia' }}</p>
                            <div class="flex items-center text-xs text-gray-500 mt-2">
                                <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.69-.921 1.99 0l1.24 3.82a1 1 0 00.95.69h4.01a1 1 0 01.95 1.258l-3.24 2.353a1 1 0 00-.36.757l1.24 3.82a1 1 0 01-1.54 1.118L10 13.08l-3.24 2.353a1 1 0 01-1.54-1.118l1.24-3.82a1 1 0 00-.36-.757L2.85 7.685a1 1 0 01.95-1.258h4.01a1 1 0 00.95-.69l1.24-3.82z"/>
                                </svg>
                                <span>{{ $p->rating ?? '0.0' }} ({{ $p->terjual ?? 0 }} terjual)</span>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <p class="col-span-full text-center text-gray-500">Belum ada produk di toko ini.</p>
                @endforelse
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white py-6 mt-8">
        <div class="container mx-auto text-center text-sm">
            &copy; 2025 Batara. Hak Cipta Dilindungi.
        </div>
    </footer>

<script src="//unpkg.com/alpinejs" defer></script>
<script>
    // Inisialisasi Alpine.js data
    function productFilter(initialSort) {
        return {
            open: false,
            selected: initialSort,
            selectedText: initialSort === 'newest' ? 'Terbaru' :
                          initialSort === 'lowest' ? 'Harga Terendah' :
                          initialSort === 'highest' ? 'Harga Tertinggi' : 'Urutkan',
            options: [
                { text: 'Terbaru', value: 'newest' },
                { text: 'Harga Terendah', value: 'lowest' },
                { text: 'Harga Tertinggi', value: 'highest' }
            ],
            changeSort(sortValue) {
                // Ganti query param sort dan scroll ke section produk
                const url = new URL(window.location.href);
                url.searchParams.set('sort', sortValue);
                window.location.href = url + '#product-grid';
            }
        }
    }

    // Skrip untuk Animasi Fade In
    document.addEventListener('DOMContentLoaded', () => {
        const mainContent = document.getElementById('main-content');
        
        // Timeout pendek untuk memastikan semua CSS dan elemen dimuat, 
        // termasuk inisialisasi Alpine.js (karena Alpine dimuat 'defer')
        setTimeout(() => {
            // 1. Hapus class opacity-0
            mainContent.classList.remove('opacity-0');
            // 2. Tambahkan class fade-in-element ke setiap elemen di dalam main,
            //    untuk animasi bertahap (staggered fade-in)
            const children = mainContent.children;

            Array.from(children).forEach((child, index) => {
                // Terapkan penundaan berdasarkan indeks agar muncul bergantian
                child.style.animationDelay = `${index * 0.1}s`;
                child.classList.add('fade-in-element');
            });

            // 3. (Opsional) Tambahkan animasi untuk footer juga
            const footer = document.querySelector('footer');
            if (footer) {
                footer.style.animationDelay = `${children.length * 0.1}s`;
                footer.classList.add('fade-in-element');
            }
        }, 100); // Penundaan 100ms
    });
</script>
</body>
</html>
