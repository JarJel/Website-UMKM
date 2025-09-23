@extends('bumdes.layout_bumdes')

@section('title', 'Daftar Usaha')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Daftar Usaha Aktif</h2>

    <table class="w-full bg-white shadow rounded-lg">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2">Nama Usaha</th>
                <th class="px-4 py-2">Pemilik</th>
                <th class="px-4 py-2">Kategori</th>
                <th class="px-4 py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b">
                <td class="px-4 py-2">Warung Makan Sederhana</td>
                <td class="px-4 py-2">Ani</td>
                <td class="px-4 py-2">Kuliner</td>
                <td class="px-4 py-2 text-green-600 font-bold">Aktif</td>
            </tr>
        </tbody>
    </table>
@endsection
