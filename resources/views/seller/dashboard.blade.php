@extends('seller.layout')

@section('title', 'Dashboard')
@section('header', 'Dashboard Utama')

@section('content')
<div class="space-y-6">

    <!-- Banner -->
    <div class="bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 rounded-lg shadow-md p-6 text-white flex flex-col md:flex-row items-center justify-between">
        <div class="mb-4 md:mb-0">
            <h2 class="text-2xl font-bold">TINGKATKAN TAMPILAN TOKO ANDA</h2>
            <p class="text-sm">Tingkatkan halaman toko Anda dengan banner yang menarik.</p>
        </div>
        <button class="bg-white text-yellow-600 font-bold py-2 px-6 rounded-lg hover:bg-gray-100 transition-colors">
            BUAT BANNER SEKARANG
        </button>
    </div>

    <!-- To Do List -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Hal yang Perlu Anda Lakukan</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 gap-4 text-center">
            <!-- Card -->
            <div class="flex flex-col items-center">
                <div class="text-2xl font-bold text-gray-800">0</div>
                <p class="text-sm text-gray-600 mt-1">Belum Dibayar</p>
            </div>
            <!-- Card -->
            <div class="flex flex-col items-center">
                <div class="text-2xl font-bold text-gray-800">1</div>
                <p class="text-sm text-gray-600 mt-1">Siap Dikirim</p>
            </div>
            <!-- Card -->
            <div class="flex flex-col items-center">
                <div class="text-2xl font-bold text-gray-800">0</div>
                <p class="text-sm text-gray-600 mt-1">Sudah Dikirim</p>
            </div>
            <!-- Card -->
            <div class="flex flex-col items-center">
                <div class="text-2xl font-bold text-gray-800">15</div>
                <p class="text-sm text-gray-600 mt-1">Pengembalian Dana</p>
            </div>
            <!-- Card -->
            <div class="flex flex-col items-center">
                <div class="text-2xl font-bold text-gray-800">0</div>
                <p class="text-sm text-gray-600 mt-1">Pesanan Dibatalkan</p>
            </div>
            <!-- Card -->
            <div class="flex flex-col items-center">
                <div class="text-2xl font-bold text-blue-600">22</div>
                <p class="text-sm text-gray-600 mt-1">Produk Dilarang</p>
            </div>
            <!-- Card -->
            <div class="flex flex-col items-center">
                <div class="text-2xl font-bold text-gray-800">9</div>
                <p class="text-sm text-gray-600 mt-1">Produk Terjual Habis</p>
            </div>
            <!-- Card -->
            <div class="flex flex-col items-center">
                <div class="text-2xl font-bold text-gray-800">0</div>
                <p class="text-sm text-gray-600 mt-1">Kampanye Mendatang</p>
            </div>
        </div>
    </div>

    <!-- Business Insights -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800">Wawasan Bisnis</h2>
            <a href="#" class="text-sm text-blue-600 hover:underline">Selengkapnya ></a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Chart Placeholder -->
            <div>
                <div class="bg-gray-200 h-64 rounded-lg flex items-center justify-center">
                    <p class="text-gray-500">Placeholder Grafik Penjualan</p>
                </div>
            </div>
            <!-- Stats -->
            <div class="grid grid-cols-2 gap-4">
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-xs text-gray-500">Pengunjung <i class="fas fa-info-circle ml-1"></i></p>
                    <p class="text-2xl font-bold text-gray-800">0</p>
                    <p class="text-xs text-green-500">vs kemarin 0.00%</p>
                </div>
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-xs text-gray-500">Tampilan Halaman <i class="fas fa-info-circle ml-1"></i></p>
                    <p class="text-2xl font-bold text-gray-800">0</p>
                    <p class="text-xs text-green-500">vs kemarin 0.00%</p>
                </div>
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-xs text-gray-500">Pesanan <i class="fas fa-info-circle ml-1"></i></p>
                    <p class="text-2xl font-bold text-gray-800">0</p>
                    <p class="text-xs text-green-500">vs kemarin 0.00%</p>
                </div>
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-xs text-gray-500">Tingkat Konversi <i class="fas fa-info-circle ml-1"></i></p>
                    <p class="text-2xl font-bold text-green-600">0.00%</p>
                    <p class="text-xs text-green-500">vs kemarin 0.00%</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Marketing Center -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800">Pusat Pemasaran</h2>
            <a href="#" class="text-sm text-blue-600 hover:underline">Selengkapnya ></a>
        </div>
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded" role="alert">
            <div class="flex items-center">
                <div class="py-1"><i class="fas fa-exclamation-triangle mr-3"></i></div>
                <div>
                    <p class="font-bold">Saldo Iklan Anda sudah habis, mohon segera isi ulang.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Shopee Events (Placeholder) -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800">Acara Batara</h2>
        <div class="mt-4 text-gray-500">
            <p>Informasi acara dan promosi terbaru akan muncul di sini.</p>
        </div>
    </div>
</div>
@endsection
