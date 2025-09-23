@extends('bumdes.layout_bumdes')

@section('title', 'Profil BUMDES')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Profil BUMDES</h2>

    <div class="bg-white shadow rounded-lg p-6 max-w-2xl">
        <p><strong>Nama BUMDES:</strong> BUMDES Makmur Sejahtera</p>
        <p><strong>Alamat:</strong> Jl. Desa Raya No. 10, Kecamatan Sukamaju</p>
        <p><strong>Email:</strong> bumdes@mail.com</p>
        <p><strong>Telepon:</strong> 0812-3456-7890</p>
        <p><strong>Deskripsi:</strong> BUMDES yang berfokus pada pemberdayaan usaha mikro desa untuk meningkatkan ekonomi masyarakat.</p>

        <button class="mt-4 bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">✏️ Edit Profil</button>
    </div>
@endsection
