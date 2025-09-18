@extends('seller.layout')

@section('title', 'Pesanan Saya')
@section('header', 'Pesanan Saya')

@section('content')
<div class="space-y-6">

    <!-- Tab Navigasi -->
    <div class="bg-white p-4 rounded-lg shadow-md overflow-x-auto">
        <div class="flex space-x-4 border-b">
            <button class="px-4 py-2 border-b-2 font-semibold text-gray-700 border-red-500">
                Semua
            </button>
            <button class="px-4 py-2 border-b-2 font-semibold text-gray-500 hover:text-red-500 hover:border-red-500 transition-colors">
                Belum Bayar
            </button>
            <button class="px-4 py-2 border-b-2 font-semibold text-gray-500 hover:text-red-500 hover:border-red-500 transition-colors">
                Perlu Dikirim
            </button>
            <button class="px-4 py-2 border-b-2 font-semibold text-gray-500 hover:text-red-500 hover:border-red-500 transition-colors">
                Dikirim
            </button>
            <button class="px-4 py-2 border-b-2 font-semibold text-gray-500 hover:text-red-500 hover:border-red-500 transition-colors">
                Selesai
            </button>
            <button class="px-4 py-2 border-b-2 font-semibold text-gray-500 hover:text-red-500 hover:border-red-500 transition-colors">
                Pembatalan
            </button>
            <button class="px-4 py-2 border-b-2 font-semibold text-gray-500 hover:text-red-500 hover:border-red-500 transition-colors">
                Pengembalian
            </button>
        </div>
    </div>

    <!-- Filter & Aksi -->
    <div class="bg-white p-6 rounded-lg shadow-md flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0 md:space-x-4">
        <div class="flex-1 w-full md:w-auto">
            <div class="relative">
                <input type="text" placeholder="Cari Pesanan" class="w-full border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
            </div>
        </div>
        <div class="flex space-x-4 items-center w-full md:w-auto">
            <input type="text" placeholder="Waktu Pesanan" class="w-full md:w-auto border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            <button class="bg-red-500 text-white px-4 py-2 rounded-lg font-bold hover:bg-red-600">Pengiriman Massal</button>
        </div>
    </div>

    <!-- Tabel Pesanan -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <h2 class="text-xl font-bold p-6 border-b">37 Pesanan</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Produk</th>
                        <th scope="col" class="px-6 py-3">Jumlah Harus Dibayar</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Jasa Kirim</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Baris Contoh Pesanan 1 -->
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <img src="https://placehold.co/50x50" alt="Produk" class="w-12 h-12 rounded-lg">
                                <div>
                                    <div class="font-semibold text-gray-800">Ecolite 600 ml</div>
                                    <p class="text-xs text-gray-500">Variasi: Green, 21x21x6 cm</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-bold text-gray-900">Rp 197.000</td>
                        <td class="px-6 py-4">
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Selesai</span>
                        </td>
                        <td class="px-6 py-4">Reguler (Cashless) J&T Express</td>
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 hover:underline">Rincian</a>
                        </td>
                    </tr>
                    <!-- Baris Contoh Pesanan 2 -->
                     <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <img src="https://placehold.co/50x50" alt="Produk" class="w-12 h-12 rounded-lg">
                                <div>
                                    <div class="font-semibold text-gray-800">Tote Bag Handmade TT062</div>
                                    <p class="text-xs text-gray-500">Variasi: Women with A I Quran</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-bold text-gray-900">Rp 77.770</td>
                        <td class="px-6 py-4">
                            <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">Dibatalkan</span>
                        </td>
                        <td class="px-6 py-4">Reguler (Cashless) J&T Express</td>
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 hover:underline">Rincian</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
