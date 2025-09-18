@extends('seller.layout')

@section('title', 'Tambah Produk')
@section('header', 'Tambah Produk Baru')

@section('content')
<div class="space-y-6">

    <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-md">
        @csrf

        <!-- Informasi Dasar Produk -->
        <div class="mb-8">
            <h2 class="text-xl font-bold mb-4">Informasi Dasar</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block mb-2 font-semibold text-gray-700">Nama Produk <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_produk" id="nama_produk" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200">
                </div>
                <div>
                    <label for="kategori" class="block mb-2 font-semibold text-gray-700">Kategori <span class="text-red-500">*</span></label>
                    <select name="id_kategori" id="kategori" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label for="deskripsi" class="block mb-2 font-semibold text-gray-700">Deskripsi Produk <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi_produk" id="deskripsi" rows="6" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200"></textarea>
                </div>
            </div>
        </div>

        <!-- Detail Penjualan -->
        <div class="mb-8">
            <h2 class="text-xl font-bold mb-4">Detail Penjualan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="harga" class="block mb-2 font-semibold text-gray-700">Harga <span class="text-red-500">*</span></label>
                    <input type="number" name="harga_dasar" id="harga" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200" placeholder="Rp">
                </div>
                <div>
                    <label for="stok" class="block mb-2 font-semibold text-gray-700">Stok <span class="text-red-500">*</span></label>
                    <input type="number" name="stok" id="stok" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200">
                </div>
            </div>
        </div>

        <!-- Media Produk -->
        <div class="mb-8">
            <h2 class="text-xl font-bold mb-4">Media Produk</h2>
            <div>
                <label for="foto" class="block mb-2 font-semibold text-gray-700">
                    Upload Foto Produk <span class="text-red-500">*</span>
                </label>
                <input type="file" name="gambar_produk" id="foto" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200">
                <p class="text-sm text-gray-500 mt-2">Format: JPG, JPEG, PNG. Ukuran maksimal: 2MB.</p>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex justify-end space-x-4">
            <a href="{{ url('/seller/produk') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg font-bold hover:bg-gray-400 transition duration-200">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-green-700 transition duration-200">Simpan Produk</button>
        </div>
    </form>
</div>
@endsection
