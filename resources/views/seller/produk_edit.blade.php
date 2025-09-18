@extends('seller.layout')

@section('title', 'Edit Produk')
@section('header', 'Edit Produk')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    @if ($errors->any())
        <div class="mb-4 bg-red-200 text-red-800 p-3 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('seller.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium">Nama Produk</label>
            <input 
                type="text" 
                name="nama_produk" 
                value="{{ old('nama_produk', $product->nama_produk) }}"
                class="w-full border rounded-lg p-2"
            >
        </div>

        <div class="mb-4">
            <label class="block font-medium">Deskripsi</label>
            <textarea 
                name="deskripsi_produk" 
                class="w-full border rounded-lg p-2"
            >{{ old('deskripsi_produk', $product->deskripsi_produk) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Harga Dasar</label>
            <input 
                type="number" 
                name="harga_dasar" 
                value="{{ old('harga_dasar', $product->harga_dasar) }}"
                class="w-full border rounded-lg p-2"
            >
        </div>

        <div class="mb-4">
            <label class="block font-medium">Stok</label>
            <input 
                type="number" 
                name="stok" 
                value="{{ old('stok', $product->stok) }}"
                class="w-full border rounded-lg p-2"
            >
        </div>

        <div class="mb-4">
            <label class="block font-medium">Kategori</label>
            <select name="id_kategori" class="w-full border rounded-lg p-2">
                @foreach($kategori as $k)
                  <option 
                    value="{{ $k->id }}" 
                    {{ $k->id == $product->id_kategori ? 'selected' : '' }}
                  >
                    {{ $k->nama_kategori }}
                  </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Gambar Produk</label>
            <input type="file" name="gambar_produk" class="w-full">
            @if($product->gambar_produk)
              <img src="{{ asset('storage/'.$product->gambar_produk) }}" class="mt-2 w-40">
            @endif
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
