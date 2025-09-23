<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Produk - {{ $product->nama_produk }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">
@include('homePage.navbar')

<div class="max-w-6xl mx-auto px-4 py-8">
  <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
    
    <!-- Kolom Kiri: Foto Produk -->
    <div>
      <img src="{{ asset($product->gambar_produk) }}" 
           alt="{{ $product->nama_produk }}" 
           class="w-full rounded-lg shadow-md">
    </div>

    <!-- Kolom Tengah: Detail Produk -->
    <div class="flex flex-col justify-center">
      <h1 class="text-3xl font-bold text-gray-800">{{ $product->nama_produk }}</h1>
      <p class="text-indigo-600 text-2xl font-semibold mt-2">
        Rp <span id="price">{{ number_format($product->harga_dasar, 0, ',', '.') }}</span>
      </p>

      <!-- Stok -->
      <p class="mt-2 text-gray-600">
        <i class="fas fa-box-open mr-2 text-indigo-500"></i> 
        Stok tersedia: <span id="stock" class="font-semibold">{{ $product->stok }}</span>
      </p>

      {{-- Varian Produk --}}
     @if($product->variants && $product->variants->count() > 0)
        <div class="mt-6">
          <h2 class="text-gray-700 font-semibold mb-2">Pilih Varian:</h2>
          <div class="flex flex-wrap gap-3">
            @foreach($product->variants as $variant)
              <button 
                class="variant-btn px-5 py-2 rounded-full border border-gray-300 bg-white text-gray-700 font-medium shadow-sm hover:bg-indigo-600 hover:text-white transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1"
                data-id="{{ $variant->id_varian }}"
                data-price="{{ $variant->harga_varian }}" 
                data-stock="{{ $variant->stok_varian }}">
                {{ $variant->nama_varian }}
              </button>
            @endforeach
          </div>
        </div>
      @endif



      {{-- Profil Toko --}}
      @if($product->toko)
        <div class="mt-8 p-4 border rounded-lg flex items-center justify-between bg-white shadow-sm">
          <div class="flex items-center space-x-4">
            <img src="{{ $product->toko->foto_profile ? asset($product->toko->foto_profile) : 'https://placehold.co/60x60' }}" 
                alt="Foto Toko" 
                class="w-14 h-14 rounded-full object-cover">
            <div>
              <h3 class="text-lg font-semibold text-gray-800">{{ $product->toko->nama_toko }}</h3>
              <p class="text-sm text-gray-500">Penjual terpercaya</p>
            </div>
          </div>
          <a href="{{ route('toko.show', $product->toko->id_toko) }}" 
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            Kunjungi
          </a>
        </div>
      @endif

      <!-- Deskripsi -->
      <div class="mt-6">
        <h2 class="text-gray-700 font-semibold mb-2">Deskripsi Produk:</h2>
        <p class="text-gray-600 leading-relaxed">{{ $product->deskripsi_produk }}</p>
      </div>
    </div>

    <!-- Kolom Kanan: Tombol Aksi -->
    <div class="flex flex-col space-y-4 self-start sticky top-24 self-start">
      <!-- Jumlah Produk -->
      <div>
        <h2 class="text-gray-700 font-semibold mb-2">Jumlah:</h2>
        <div class="flex items-center space-x-3">
          <button type="button" id="decrease" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">-</button>
          <input type="number" id="quantity" value="1" min="1" class="w-16 text-center border rounded-lg py-2">
          <button type="button" id="increase" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">+</button>
        </div>
        <span id="totalPrice" class="mt-2 block text-lg font-bold text-green-600">
          Rp {{ number_format($product->harga_dasar, 0, ',', '.') }}
        </span>
      </div>

      <!-- Tombol -->
      <button 
          id="addToCart"
          class="w-full bg-indigo-600 text-white py-3 rounded-lg shadow-md hover:bg-indigo-700 transition flex items-center justify-center"
          data-id="{{ $product->id_produk }}"
      >
          <i class="fas fa-shopping-cart mr-2"></i> Tambah ke Keranjang
      </button>

      <button class="w-full bg-green-600 text-white py-3 rounded-lg shadow-md hover:bg-green-700 transition flex items-center justify-center">
          <i class="fas fa-bolt mr-2"></i> Beli Sekarang
      </button>
    </div>
  </div>

  <!-- Bagian Ulasan -->
  <div class="mt-10 p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Ulasan Pelanggan</h2>

    @if($product->ulasan && $product->ulasan->count() > 0)
      <div class="space-y-6">
        @foreach($product->ulasan as $ulasan)
          <div class="border-b pb-4">
            <div class="flex items-center space-x-3">
              <div class="w-10 h-10 rounded-full bg-indigo-500 text-white flex items-center justify-center font-bold">
                {{ strtoupper(substr($ulasan->user->nama_pengguna, 0, 1)) }}
              </div>
              <div>
                <p class="font-semibold text-gray-800">{{ $ulasan->user->nama_pengguna }}</p>
                <p class="text-sm text-gray-500">{{ $ulasan->created_at->format('d M Y') }}</p>
              </div>
            </div>
            <div class="mt-2 flex items-center">
              @for($i = 1; $i <= 5; $i++)
                <i class="fas fa-star {{ $i <= $ulasan->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
              @endfor
            </div>
            <p class="mt-2 text-gray-700">{{ $ulasan->komentar }}</p>
          </div>
        @endforeach
      </div>
    @else
      <p class="text-gray-500">Belum ada ulasan untuk produk ini.</p>
    @endif
  </div>
</div>

</body>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".variant-btn");
    const priceElement = document.getElementById("price");
    const stockElement = document.getElementById("stock");
    let currentPrice = {{ $product->harga_dasar }}; // default harga dasar

    buttons.forEach(btn => {
        btn.addEventListener("click", function () {
            // Reset semua button
            buttons.forEach(b => {
                b.classList.remove("bg-indigo-600", "text-white");
                b.classList.add("bg-white", "text-gray-800");
            });

            // Tambahkan status aktif ke button yang dipilih
            this.classList.remove("bg-white", "text-gray-800");
            this.classList.add("bg-indigo-600", "text-white");

            // Update harga & stok sesuai varian
            currentPrice = parseInt(this.dataset.price); // simpan harga varian aktif
            const stock = this.dataset.stock;

            priceElement.textContent = new Intl.NumberFormat('id-ID').format(currentPrice);
            if (stockElement) stockElement.textContent = stock;

            // Update total sesuai harga varian & qty
            updateTotal();

            // Simpan varian terpilih
            document.getElementById("addToCart").setAttribute("data-variant", this.dataset.id);
        });
    });

    // Pilih default varian pertama jika ada
    if (buttons.length > 0) {
        buttons[0].click();
    }

    // Hitung ulang total harga
    function updateTotal() {
        const quantity = parseInt(document.getElementById("quantity").value) || 1;
        const total = currentPrice * quantity;
        document.getElementById("totalPrice").textContent = 
            "Rp " + total.toLocaleString("id-ID");
    }

    // Tambah / kurang qty
    document.getElementById("increase").addEventListener("click", function () {
        let qty = parseInt(document.getElementById("quantity").value) || 1;
        qty++;
        document.getElementById("quantity").value = qty;
        updateTotal();
    });

    document.getElementById("decrease").addEventListener("click", function () {
        let qty = parseInt(document.getElementById("quantity").value) || 1;
        if (qty > 1) qty--;
        document.getElementById("quantity").value = qty;
        updateTotal();
    });

    document.getElementById("quantity").addEventListener("input", function () {
        let qty = parseInt(this.value) || 1;
        if (qty < 1) qty = 1;
        this.value = qty;
        updateTotal();
    });

    // Tambah ke keranjang
    document.getElementById("addToCart").addEventListener("click", function () {
        const productId = this.dataset.id;
        const variantId = this.dataset.variant || null;
        const quantity = parseInt(document.getElementById("quantity").value) || 1;

        $.ajax({
            url: `/keranjang/add/${productId}`,
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                jumlah: quantity,
                varian: variantId
            },
            success: function (res) {
                alert(res.message);
                updateTotal();
            },
            error: function (err) {
                console.log(err.responseJSON);
                alert("Gagal menambahkan ke keranjang.");
            }
        });
    });
});
</script>


</html>
