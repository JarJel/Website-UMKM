@extends('bumdes.layout_bumdes')

@section('title', 'Verifikasi Usaha Seller')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Daftar Usaha Menunggu Verifikasi</h2>

    <table class="w-full bg-white shadow rounded-lg">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2">Nama Usaha</th>
                <th class="px-4 py-2">Pemilik</th>
                <th class="px-4 py-2">Kategori</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b">
                <td class="px-4 py-2">Toko Sembako Jaya</td>
                <td class="px-4 py-2">Budi</td>
                <td class="px-4 py-2">Sembako</td>
                <td class="px-4 py-2">
                    <button class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">✔ Terima</button>
                    <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">✖ Tolak</button>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
