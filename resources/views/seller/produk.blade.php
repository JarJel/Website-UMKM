@extends('seller.layout')

@section('title', 'Produk Saya')
@section('header', 'Daftar Produk')

@section('content')
<div class="space-y-6" x-data="{ openDetail: false, detailProduk: {} }">
    <style>
        [x-cloak] { display: none !important; }
    </style>

    
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Total {{ $products->count() }} Produk</h2>
        <a href="{{ route('seller.products.create') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg font-bold hover:bg-red-600 transition-colors">
            <i class="fas fa-plus mr-2"></i>Tambah Produk Baru
        </a>
    </div>

    <!-- Produk List Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-200 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Nama Produk</th>
                    <th class="px-6 py-3">Harga</th>
                    <th class="px-6 py-3">Stok</th> <!-- Tambah kolom stok -->
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4 flex items-center space-x-3">
                        <img src="{{ asset('storage/' . $product->gambar_produk) }}" 
                            alt="Produk" class="w-12 h-12 rounded-lg">
                        <div>
                            <div class="font-semibold text-gray-800">{{ $product->nama_produk }}</div>
                            <div class="text-gray-500 text-sm">SKU: {{ $product->id_produk }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">Rp {{ number_format($product->harga_dasar, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">{{ $product->stok ?? 0 }}</td> <!-- Tampilkan stok -->
                    <td class="px-6 py-4">
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Aktif</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-2 justify-center">
                            <a href="{{ route('seller.products.edit', $product->id_produk) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                            <form action="{{ route('seller.products.destroy', $product->id_produk) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                            <button 
                                @click="openDetail = true; detailProduk = {
                                    nama: '{{ $product->nama_produk }}',
                                    sku: '{{ $product->id_produk }}',
                                    gambar: '{{ asset(str_replace('storage-public-', 'storage/', $product->gambar_produk)) }}',
                                    variants: [
                                        @foreach($product->varian ?? [] as $v)
                                        { 
                                            id_varian: '{{ $v->id_varian }}', 
                                            nama_varian: '{{ $v->nama_varian }}', 
                                            sku: '{{ $v->sku }}', 
                                            harga_varian: '{{ number_format($v->harga_varian,0,',','.') }}', 
                                            stok_varian: '{{ $v->stok_varian }}' 
                                        },
                                        @endforeach
                                    ]
                                }"
                                class="text-green-600 hover:text-green-800"
                            >
                                Detail
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">Belum ada produk</td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <!-- Modal Detail Produk -->
<div 
    x-show="openDetail" 
    x-cloak
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
    x-transition
>
    <div class="bg-white rounded-lg shadow-lg p-6 w-96 max-h-[80vh] overflow-y-auto relative">
        
        <img :src="detailProduk.gambar" alt="Produk" class="w-24 h-24 rounded-lg mx-auto mb-4">
        <h3 class="text-lg font-bold text-gray-800 mb-2" x-text="detailProduk.nama"></h3>
        <p class="text-gray-600 mb-4">SKU Produk: <span x-text="detailProduk.sku"></span></p>

        <!-- Table Varian -->
        <table class="w-full text-left border border-gray-200">
            <thead class="bg-gray-100 text-gray-700 text-sm">
                <tr>
                    <th class="px-3 py-2 border-b">Nama Varian</th>
                    <th class="px-3 py-2 border-b">SKU</th>
                    <th class="px-3 py-2 border-b">Harga</th>
                    <th class="px-3 py-2 border-b">Stok</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="variant in detailProduk.variants" :key="variant.id_varian">
                    <tr class="text-sm hover:bg-gray-50">
                        <td class="px-3 py-2 border-b" x-text="variant.nama_varian"></td>
                        <td class="px-3 py-2 border-b" x-text="variant.sku"></td>
                        <td class="px-3 py-2 border-b" x-text="'Rp ' + variant.harga_varian"></td>
                        <td class="px-3 py-2 border-b" x-text="variant.stok_varian"></td>
                    </tr>
                </template>
                <tr x-show="!detailProduk.variants || detailProduk.variants.length == 0">
                    <td colspan="4" class="text-center py-2 text-gray-500">Belum ada varian</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-4 flex justify-end">
            <button @click="openDetail = false" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Tutup</button>
        </div>
    </div>
</div>

<!-- Alpine.js -->
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
