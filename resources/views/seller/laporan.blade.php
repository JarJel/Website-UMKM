@extends('seller.layout')

@section('title', 'Laporan')
@section('header', 'Laporan Penjualan')

@section('content')
<div class="space-y-6">

    <!-- Tab Navigasi -->
    <div class="bg-white p-4 rounded-lg shadow-md overflow-x-auto">
        <div class="flex space-x-4 border-b">
            <button class="px-4 py-2 border-b-2 font-semibold text-gray-700 border-red-500">
                Wawasan Bisnis
            </button>
            <button class="px-4 py-2 border-b-2 font-semibold text-gray-500 hover:text-red-500 hover:border-red-500 transition-colors">
                Keuangan
            </button>
        </div>
    </div>

    <!-- Filter Data -->
    <div class="bg-white p-6 rounded-lg shadow-md flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0 md:space-x-4">
        <div class="flex-1 w-full md:w-auto flex items-center space-x-4">
            <span class="text-sm font-semibold text-gray-700">Periode Data:</span>
            <input type="text" placeholder="Tanggal Mulai - Tanggal Akhir" class="w-full md:w-auto border px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-600">Download Data</button>
    </div>

    <!-- Kriteria Utama -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4">Kriteria Utama</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 text-center">
            <!-- Penjualan -->
            <div class="flex flex-col items-center">
                <div class="text-2xl font-bold text-gray-800">Rp 2.131.740</div>
                <p class="text-sm text-gray-600 mt-1">Penjualan</p>
            </div>
            <!-- Pesanan -->
            <div class="flex flex-col items-center">
                <div class="text-2xl font-bold text-gray-800">18</div>
                <p class="text-sm text-gray-600 mt-1">Pesanan</p>
            </div>
            <!-- Pesanan Dibatalkan -->
            <div class="flex flex-col items-center">
                <div class="text-2xl font-bold text-gray-800">0</div>
                <p class="text-sm text-gray-600 mt-1">Pesanan Dibatalkan</p>
            </div>
            <!-- Tingkat Konversi -->
            <div class="flex flex-col items-center">
                <div class="text-2xl font-bold text-gray-800">0.59%</div>
                <p class="text-sm text-gray-600 mt-1">Tingkat Konversi</p>
            </div>
            <!-- Total Pengunjung -->
            <div class="flex flex-col items-center">
                <div class="text-2xl font-bold text-gray-800">2.692</div>
                <p class="text-sm text-gray-600 mt-1">Total Pengunjung</p>
            </div>
            <!-- Produk Dilihat -->
            <div class="flex flex-col items-center">
                <div class="text-2xl font-bold text-gray-800">5.051</div>
                <p class="text-sm text-gray-600 mt-1">Produk Dilihat</p>
            </div>
        </div>
    </div>

    <!-- Grafik Penjualan -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4">Grafik Penjualan</h2>
        <p class="mb-4 text-gray-600">Grafik setiap kriteria</p>
        <div class="w-full h-64 bg-gray-100 flex items-center justify-center rounded-lg">
            <span class="text-gray-500">Placeholder Grafik Penjualan</span>
        </div>
    </div>

    <!-- Informasi Keuangan Placeholder -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4">Informasi Keuangan</h2>
        <div class="flex flex-wrap -mx-2">
            <!-- Placeholder for a Finance Info Card -->
            <div class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4">
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-500">Akan Dilepaskan</p>
                    <div class="text-2xl font-bold text-gray-800">Rp 0</div>
                </div>
            </div>
            <!-- Placeholder for a Finance Info Card -->
            <div class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4">
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-500">Sudah Dilepas</p>
                    <div class="text-2xl font-bold text-gray-800">Rp 1.895.899</div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <p class="text-sm text-gray-500">Rincian pelepasan dana akan muncul di sini.</p>
        </div>
    </div>

</div>
@endsection