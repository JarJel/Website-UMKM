@extends('seller.layout')

@section('title', 'Profil UMKM')
@section('header', 'Profil UMKM')

@section('content')
<div class="space-y-6">

    <!-- Tab Navigasi -->
    <div class="bg-white p-4 rounded-lg shadow-md overflow-x-auto">
        <div class="flex space-x-4 border-b">
            <button class="px-4 py-2 border-b-2 font-semibold text-gray-700 border-red-500">
                Informasi Toko
            </button>
            <button class="px-4 py-2 border-b-2 font-semibold text-gray-500 hover:text-red-500 hover:border-red-500 transition-colors">
                Penilaian Toko
            </button>
        </div>
    </div>

    <!-- Informasi Toko Section -->
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-6">Informasi Dasar Toko</h2>
        
        <form action="#" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @csrf

            <!-- Form Kiri -->
            <div class="space-y-6">
                <div>
                    <label for="nama_toko" class="block mb-2 font-semibold text-gray-700">Nama Toko <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_toko" id="nama_toko" value="UMKM Desa Maju" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200">
                </div>
                <div>
                    <label for="deskripsi" class="block mb-2 font-semibold text-gray-700">Deskripsi <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200">Menjual aneka produk desa...</textarea>
                </div>
                <div>
                    <label for="alamat" class="block mb-2 font-semibold text-gray-700">Alamat <span class="text-red-500">*</span></label>
                    <input type="text" name="alamat" id="alamat" value="Jl. Desa No. 123" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200">
                </div>
                <div>
                    <label for="kontak" class="block mb-2 font-semibold text-gray-700">Nomor Kontak <span class="text-red-500">*</span></label>
                    <input type="text" name="kontak" id="kontak" value="08123456789" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200">
                </div>
                <div>
                    <label for="sku_dokumen" class="block mb-2 font-semibold text-gray-700">Upload Dokumen SKU</label>
                    <input type="file" name="sku" id="sku_dokumen" class="w-full">
                </div>
            </div>

            <!-- Form Kanan (Foto Profil & Banner) -->
            <div class="space-y-6">
                <div>
                    <label for="foto_profil" class="block mb-2 font-semibold text-gray-700">Foto Profil Toko</label>
                    <div class="mt-2 flex items-center space-x-4">
                        <img src="https://placehold.co/100x100" alt="Foto Profil" class="w-24 h-24 rounded-full border-2 border-gray-300 object-cover">
                        <input type="file" name="foto_profil" id="foto_profil">
                    </div>
                </div>
                <div>
                    <label for="banner_toko" class="block mb-2 font-semibold text-gray-700">Banner Toko</label>
                    <div class="mt-2">
                        <img src="https://placehold.co/600x200" alt="Banner Toko" class="w-full h-auto rounded-lg border-2 border-gray-300 object-cover">
                        <input type="file" name="banner_toko" id="banner_toko" class="mt-4 w-full">
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="lg:col-span-2 flex justify-end space-x-4">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-green-700 transition duration-200">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <!-- Placeholder Penilaian Toko -->
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4">Penilaian Toko</h2>
        <div class="p-4 border-l-4 border-yellow-500 bg-yellow-100 rounded-lg">
            <p class="text-yellow-700">Bagian ini akan menampilkan penilaian dan ulasan dari pembeli.</p>
        </div>
    </div>

</div>
@endsection
