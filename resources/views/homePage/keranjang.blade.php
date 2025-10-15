<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tambahkan Font Awesome untuk ikon keranjang dan tombol aksi -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMDJ87N8I2Qj9x64U6KqF5y3q2zXJ8l9z64U6KqF5y3q2zXJ8l9z65uU9D8fS03S0p5l6a/9+6xP6j8z+g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        .fade-in-element {
            animation: fadeIn 0.6s ease-out forwards;
            opacity: 0;
        }
        
        .qty-btn {
            @apply w-8 h-8 flex items-center justify-center border border-gray-300 text-gray-700 hover:bg-gray-100 transition duration-150;
        }

        /* Style untuk Modal */
        .modal-overlay {
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* 2. Definisi Animasi Spinner Kustom */
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .spinner {
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top-color: #fff; /* Warna putih untuk spinner */
            border-radius: 50%;
            width: 1.25rem;
            height: 1.25rem;
            animation: spin 0.8s linear infinite;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    @include('homePage.navbar')

    <!-- MODAL NOTIFIKASI KUSTOM (Awal) -->
    <div id="custom-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 modal-overlay">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm transform transition-all scale-95 opacity-0 duration-300" id="modal-content">
            <div class="p-6">
                <div class="flex items-center justify-center mb-4">
                    <div class="bg-red-100 p-3 rounded-full">
                        <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 text-center mb-2" id="modal-title">Keranjang Kosong!</h3>
                <p class="text-gray-600 text-sm text-center" id="modal-body">
                    Anda belum memilih item apa pun untuk di-checkout. Mohon pilih minimal satu produk.
                </p>
            </div>
            <div class="bg-gray-50 px-6 py-4 flex justify-center border-t rounded-b-xl">
                <button onclick="closeModal()" class="w-full bg-green-600 text-white font-semibold py-2 rounded-lg hover:bg-green-700 transition duration-200">
                    Oke, Saya Mengerti
                </button>
            </div>
        </div>
    </div>
    <!-- MODAL NOTIFIKASI KUSTOM (Akhir) -->


    <!-- Tambahkan class 'opacity-0' secara default. Ini akan diubah oleh JS. -->
    <main id="main-content" class="container mx-auto container-padding flex-grow opacity-0 transition-opacity">

        <!-- CONTENT: KERANJANG BELANJA -->
        <div class="max-w-6xl mx-auto space-y-8">
            <h1 class="text-3xl font-bold text-gray-800 border-b pb-4 fade-in-element" style="animation-delay: 0s;">
                <i class="fas fa-shopping-cart text-green-500 mr-2"></i> Keranjang Belanja Anda
            </h1>

            @php
                // Hitung total item yang sebenarnya (server-side)
                $totalItems = isset($cart) ? $cart->items->count() : 0;
            @endphp

            @if($totalItems > 0)
                <div class="lg:flex lg:space-x-8">
                    
                    <!-- Kiri: Daftar Item Keranjang -->
                    <div class="lg:w-3/4 space-y-4">
                        @foreach($cart->items as $index => $item)
                        <!-- Card Item Keranjang dengan Staggered Fade-In -->
                        <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-200 fade-in-element" style="animation-delay: {{ ($index * 0.1) + 0.1 }}s;">
                            
                            <!-- Header Toko/Penjual (Asumsi $item->produk->toko tersedia) -->
                            <div class="flex items-center space-x-2 text-sm text-gray-600 mb-3 pb-3 border-b border-gray-100">
                                <i class="fas fa-store"></i>
                                <span class="font-semibold">{{ $item->produk->toko->nama_toko ?? 'Toko Tidak Dikenal' }}</span>
                            </div>

                            <div class="flex flex-col md:flex-row md:items-center space-y-4 md:space-y-0 md:space-x-6">
                                
                                <!-- Gambar Produk -->
                                <div class="flex-shrink-0">
                                    <img src="{{ asset($item->produk->image) }}" 
                                         alt="{{ $item->produk->nama_produk }}" 
                                         class="w-24 h-24 object-cover rounded-lg shadow-md">
                                </div>
                                
                                <!-- Detail Produk (Nama & Deskripsi) -->
                                <div class="flex-grow">
                                    <h3 class="text-lg font-bold text-gray-900">{{ $item->produk->nama_produk }}</h3>
                                    <p class="text-sm text-gray-500 line-clamp-2 mt-1">{{ $item->produk->deskripsi_produk }}</p>
                                    
                                    <!-- Detail tambahan (opsional) -->
                                    <div class="text-xs text-gray-400 mt-2 space-x-3 hidden sm:block">
                                        <span>Kategori: {{ $item->produk->id_kategori ?? '-' }}</span>
                                    </div>
                                </div>

                                <!-- Kuantitas & Harga -->
                                <div class="flex-shrink-0 w-full md:w-auto md:text-right space-y-2">
                                    <div class="text-sm font-medium text-gray-500">
                                        Harga Satuan: 
                                        <span class="font-semibold text-gray-800">
                                            Rp {{ number_format($item->produk->harga_dasar, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    
                                    <!-- Kontrol Kuantitas -->
                                    <div class="flex items-center justify-start md:justify-end space-x-3">
                                        <label for="qty-{{ $item->produk->id_produk }}" class="text-sm text-gray-500">Jumlah:</label>
                                        <div class="flex rounded-lg overflow-hidden border border-gray-300">
                                            <!-- Tombol Pengurangan -->
                                            <button type="button" class="qty-btn rounded-l-lg" onclick="updateQuantity('{{ $item->produk->id_produk }}', -1)">
                                                <i class="fas fa-minus text-xs"></i>
                                            </button>
                                            
                                            <!-- Input Jumlah -->
                                            <input type="number" id="qty-{{ $item->produk->id_produk }}" 
                                                value="{{ $item->jumlah_produk }}" 
                                                min="1" max="{{ $item->produk->stok }}"
                                                class="w-12 text-center text-sm font-semibold border-x-0 border-gray-300 focus:ring-0 focus:border-gray-300"
                                                readonly>
                                            
                                            <!-- Tombol Penambahan -->
                                            <button type="button" class="qty-btn rounded-r-lg" onclick="updateQuantity('{{ $item->produk->id_produk }}', 1)">
                                                <i class="fas fa-plus text-xs"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Subtotal -->
                                    <div class="text-lg font-bold text-green-600 pt-1">
                                        Subtotal: Rp {{ number_format($item->jumlah_produk * $item->produk->harga_dasar, 0, ',', '.') }}
                                    </div>
                                    
                                    <!-- Aksi Hapus -->
                                    <form action="#" method="POST" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-500 hover:text-red-700 text-sm font-medium transition duration-150">
                                            <i class="fas fa-trash-alt mr-1"></i> Hapus Item
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <!-- Kanan: Ringkasan Belanja (Checkout Summary) -->
                    <div class="lg:w-1/4 mt-8 lg:mt-0 sticky top-4 fade-in-element" style="animation-delay: {{ ($totalItems * 0.1) + 0.2 }}s;">
                        <div class="bg-white p-6 rounded-xl shadow-lg border-2 border-green-300/50">
                            <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-3">Ringkasan Belanja</h2>
                            
                            <!-- Subtotal Item -->
                            <div class="flex justify-between text-sm text-gray-600 mb-2">
                                <span>Total Harga Produk ({{ $totalItems }} item):</span>
                                <span class="font-semibold">
                                    Rp {{ number_format($cart->items->sum(function($item){ return $item->jumlah_produk * $item->produk->harga_dasar; }), 0, ',', '.') }}
                                </span>
                            </div>
                            
                            <!-- Biaya Pengiriman (Placeholder) -->
                            <div class="flex justify-between text-sm text-gray-600 mb-4">
                                <span>Biaya Pengiriman:</span>
                                <span class="font-semibold text-gray-400">TBD</span>
                            </div>

                            <!-- Total Akhir -->
                            <div class="flex justify-between text-lg font-bold text-gray-900 border-t pt-3 mt-3">
                                <span>Total Belanja:</span>
                                <span class="text-green-600" id="total-amount">
                                    Rp {{ number_format($cart->items->sum(function($item){ return $item->jumlah_produk * $item->produk->harga_dasar; }), 0, ',', '.') }}
                                </span>
                            </div>
                            
                            <!-- Tombol Checkout (Diubah menjadi <button> dengan ID) -->
                            <button id="checkoutButton" 
                                onclick="handleCheckout(event, {{ $totalItems }})"
                                class="mt-6 block w-full text-center bg-green-600 text-white font-bold py-3 rounded-xl shadow-lg hover:bg-green-700 transition duration-300 transform hover:scale-[1.01] disabled:opacity-75 disabled:cursor-not-allowed">
                                
                                <!-- Konten Normal -->
                                <span id="checkoutText">
                                    <i class="fas fa-money-check-alt mr-2"></i> Lanjutkan ke Checkout
                                </span>
                                
                                <!-- Konten Loading (Awalnya Tersembunyi) -->
                                <span id="checkoutLoading" class="hidden flex items-center justify-center">
                                    <div class="spinner mr-2"></div>
                                    Memproses...
                                </span>
                            </button>
                        </div>
                    </div>
                </div>

            @else
                <div class="bg-white p-12 rounded-xl shadow-lg border-2 border-dashed border-gray-300 text-center fade-in-element" style="animation-delay: 0.1s;">
                    <i class="fas fa-box-open text-6xl text-gray-400 mb-4"></i>
                    <p class="text-xl font-semibold text-gray-700">Keranjang Anda masih kosong.</p>
                    <p class="text-gray-500 mt-2">Yuk, temukan produk menarik dan mulai belanja sekarang!</p>
                    <a href="/" class="mt-4 inline-block bg-green-500 text-white font-medium py-2 px-6 rounded-full hover:bg-green-600 transition duration-300">
                        Mulai Belanja
                    </a>
                </div>
            @endif
        </div>
        <!-- END OF CONTENT -->

    </main>

    <footer class="bg-gray-800 text-white py-6 mt-8">
        <div class="container mx-auto text-center text-sm">
            &copy; 2025 Batara. Hak Cipta Dilindungi.
        </div>
    </footer>

<script src="//unpkg.com/alpinejs" defer></script>
<script>
    // Fungsi baru untuk mengelola status loading pada tombol checkout
    function setCheckoutLoading(isLoading) {
        const button = document.getElementById('checkoutButton');
        const text = document.getElementById('checkoutText');
        const loading = document.getElementById('checkoutLoading');

        if (!button || !text || !loading) return; 

        button.disabled = isLoading;
        if (isLoading) {
            text.classList.add('hidden');
            loading.classList.remove('hidden');
        } else {
            text.classList.remove('hidden');
            loading.classList.add('hidden');
        }
    }

    // --- FUNGSI MODAL KUSTOM ---
    function openModal() {
        const modal = document.getElementById('custom-modal');
        const content = document.getElementById('modal-content');
        modal.classList.remove('hidden');
        
        // Animasi pop-up
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeModal() {
        const modal = document.getElementById('custom-modal');
        const content = document.getElementById('modal-content');
        
        // Animasi fade-out
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300); // Sesuai durasi transisi CSS
    }
    
    // --- FUNGSI CHECKOUT DENGAN LOADING INDICATOR ---
    async function handleCheckout(event, itemCount) {
        event.preventDefault(); // Mencegah navigasi default

        // 1. Periksa Keranjang
        if (itemCount <= 0) {
            openModal();
            return;
        }

        try {
            // 2. Tampilkan status memuat
            setCheckoutLoading(true);

            // 3. Simulasi proses validasi/transaksi server (1.5 detik)
            await new Promise(resolve => setTimeout(resolve, 1500)); 

            // 4. Lanjutkan ke proses checkout
            window.location.href = '/checkout'; 
            console.log('Lanjut ke halaman Checkout...');

        } catch (error) {
            console.error('Proses checkout gagal:', error);
            // Di sini Anda bisa menambahkan modal lain untuk error checkout nyata
            
        } finally {
            // Catatan: Karena kita akan redirect, setCheckoutLoading(false) tidak akan terlihat, 
            // tetapi jika Anda mengubahnya menjadi AJAX, baris ini penting.
            setCheckoutLoading(false);
        }
    }


    // --- FUNGSI PLACEHOLDER UNTUK MENGATUR JUMLAH (Dipertahankan dari sebelumnya) ---
    function updateQuantity(productId, change) {
        const input = document.getElementById(`qty-${productId}`);
        let currentQty = parseInt(input.value);
        let newQty = currentQty + change;
        const maxQty = parseInt(input.max);

        if (newQty >= 1 && newQty <= maxQty) {
            input.value = newQty;
            console.log(`Produk ID ${productId} diubah menjadi jumlah: ${newQty}. Harap implementasikan AJAX update.`);
        } else if (newQty < 1) {
            console.warn(`Item ${productId} akan dihapus. Gunakan modal kustom untuk konfirmasi penghapusan.`);
        }
    }


    // --- Skrip untuk Animasi Fade In (dipertahankan) ---
    document.addEventListener('DOMContentLoaded', () => {
        const mainContent = document.getElementById('main-content');
        
        setTimeout(() => {
            // 1. Hapus class opacity-0
            mainContent.classList.remove('opacity-0');
            // 2. Tambahkan class fade-in-element ke container utama
            mainContent.classList.add('fade-in-element'); 
            mainContent.style.animationDelay = '0s'; // Mulai tanpa delay
            
            // 3. Tambahkan animasi untuk footer
            const footer = document.querySelector('footer');
            if (footer) {
                footer.style.animationDelay = `0.2s`; 
                footer.classList.add('fade-in-element');
            }
        }, 100); 
    });
</script>
</body>
</html>
