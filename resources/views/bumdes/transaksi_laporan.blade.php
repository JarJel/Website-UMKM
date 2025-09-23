@extends('bumdes.layout_bumdes')

@section('title', 'Transaksi & Laporan')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Laporan Transaksi</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <h3 class="text-xl font-semibold">Total Transaksi</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">Rp 25.000.000</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <h3 class="text-xl font-semibold">Pendapatan BUMDES</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">Rp 5.000.000</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <h3 class="text-xl font-semibold">Jumlah Transaksi</h3>
            <p class="text-3xl font-bold text-purple-600 mt-2">120</p>
        </div>
    </div>

    <table class="w-full bg-white shadow rounded-lg">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2">Seller</th>
                <th class="px-4 py-2">Usaha</th>
                <th class="px-4 py-2">Jumlah</th>
                <th class="px-4 py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b">
                <td class="px-4 py-2">2025-09-10</td>
                <td class="px-4 py-2">Ani</td>
                <td class="px-4 py-2">Warung Makan</td>
                <td class="px-4 py-2">Rp 250.000</td>
                <td class="px-4 py-2 text-green-600 font-bold">Selesai</td>
            </tr>
        </tbody>
    </table>
@endsection
