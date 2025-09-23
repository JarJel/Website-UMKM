@extends('seller.layout')

@section('title', 'Tambah Produk')
@section('header', 'Tambah Produk')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Nama Produk --}}
        <div class="mb-4">
            <label for="nama_produk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
            <input type="text" id="nama_produk" name="nama_produk" value="{{ old('nama_produk') }}" class="mt-1 block w-full border rounded p-2" required>
        </div>

        {{-- Deskripsi Produk --}}
        <div class="mb-4">
            <label for="deskripsi_produk" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea id="deskripsi_produk" name="deskripsi_produk" rows="4" class="mt-1 block w-full border rounded p-2">{{ old('deskripsi_produk') }}</textarea>
        </div>

        {{-- Harga Dasar --}}
        <div class="mb-4">
            <label for="harga_dasar" class="block text-sm font-medium text-gray-700">Harga Dasar</label>
            <input type="number" id="harga_dasar" name="harga_dasar" value="{{ old('harga_dasar') }}" class="mt-1 block w-full border rounded p-2" required>
        </div>

        {{-- Stok --}}
        <div class="mb-4">
            <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
            <input type="number" id="stok" name="stok" value="{{ old('stok') }}" class="mt-1 block w-full border rounded p-2" required>
        </div>

        {{-- Kategori --}}
        <div class="mb-4">
            <label for="id_kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
            <select name="id_kategori" id="id_kategori" class="mt-1 block w-full border rounded p-2">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategori as $kat)
                    <option value="{{ $kat->id_kategori }}" {{ old('id_kategori') == $kat->id_kategori ? 'selected' : '' }}>
                        {{ $kat->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Gambar --}}
        <div class="mb-4">
            <label for="gambar_produk" class="block text-sm font-medium text-gray-700">Gambar Produk</label>
            <input type="file" id="gambar_produk" name="gambar_produk" class="mt-1 block w-full border rounded p-2">
        </div>

        {{-- Varian Produk --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Varian Produk</label>
            <div id="variants-wrapper"></div>
            <button type="button" id="add-variant" class="mt-2 px-3 py-1 bg-blue-600 text-white rounded">+ Tambah Varian</button>
        </div>

        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
    </form>
</div>

{{-- Inline Script --}}
<script>
    function tambahVarian() {
        const wrapper = document.getElementById('variants-wrapper');
        const div = document.createElement('div');
        div.classList.add('flex', 'space-x-2', 'mb-2');

        div.innerHTML = `
            <input type="text" name="varian[nama_varian][]" placeholder="Nama Varian" class="border p-2 rounded w-1/5" required>
            <input type="text" name="varian[sku][]" placeholder="SKU" class="border p-2 rounded w-1/5">
            <input type="number" name="varian[harga_varian][]" placeholder="Harga" class="border p-2 rounded w-1/5" required>
            <input type="number" name="varian[stok_varian][]" placeholder="Stok" class="border p-2 rounded w-1/5" required>
            <input type="number" step="0.01" name="varian[berat_varian_kg][]" placeholder="Berat (kg)" class="border p-2 rounded w-1/5" required>
            <button type="button" onclick="this.parentElement.remove()" class="px-2 bg-red-500 text-white rounded">Hapus</button>
        `;
        wrapper.appendChild(div);
    }

    document.getElementById('add-variant').addEventListener('click', tambahVarian);
</script>
@endsection
