@extends('seller.layout')

@section('title', 'Dashboard')
@section('header', 'Dashboard Utama')

@section('content')
<div class="space-y-6">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <!-- Pesanan Belum Diproses -->
        <div class="bg-white rounded-xl shadow p-5 hover:shadow-lg transition">
            <div class="flex items-center mb-2">
                <i class="fas fa-truck text-blue-500 text-xl mr-3"></i>
                <p class="text-gray-500 text-sm">Pesanan Belum Diproses</p>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">{{ $pesananBelumDiproses ?? 0 }}</h2>
        </div>

        <!-- Produk Terjual -->
        <div class="bg-white rounded-xl shadow p-5 hover:shadow-lg transition">
            <div class="flex items-center mb-2">
                <i class="fas fa-box-open text-yellow-500 text-xl mr-3"></i>
                <p class="text-gray-500 text-sm">Produk Terjual</p>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">{{ $produkTerjual ?? 0 }}</h2>
        </div>

        <!-- Pendapatan Bulan Ini -->
        <div class="bg-white rounded-xl shadow p-5 hover:shadow-lg transition">
            <div class="flex items-center mb-2">
                <i class="fas fa-money-bill-wave text-green-500 text-xl mr-3"></i>
                <p class="text-gray-500 text-sm">Pendapatan Bulan Ini</p>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</h2>
        </div>

        <!-- Rating Toko (placeholder) -->
        <div class="bg-white rounded-xl shadow p-5 hover:shadow-lg transition">
            <div class="flex items-center mb-2">
                <i class="fas fa-star text-purple-500 text-xl mr-3"></i>
                <p class="text-gray-500 text-sm">Rating Toko</p>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">4.8</h2>
        </div>

    </div>

    <!-- Business Insights (Placeholder) -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800">Wawasan Bisnis</h2>
            <a href="#" class="text-sm text-blue-600 hover:underline">Selengkapnya ></a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <div class="bg-gray-200 h-64 rounded-lg flex items-center justify-center">
                    <p class="text-gray-500">Placeholder Grafik Penjualan</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-xs text-gray-500">Pengunjung</p>
                    <p class="text-2xl font-bold text-gray-800">0</p>
                    <p class="text-xs text-green-500">vs kemarin 0.00%</p>
                </div>
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-xs text-gray-500">Tampilan Halaman</p>
                    <p class="text-2xl font-bold text-gray-800">0</p>
                    <p class="text-xs text-green-500">vs kemarin 0.00%</p>
                </div>
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-xs text-gray-500">Pesanan</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $pesananBelumDiproses ?? 0 }}</p>
                    <p class="text-xs text-green-500">vs kemarin 0.00%</p>
                </div>
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-xs text-gray-500">Tingkat Konversi</p>
                    <p class="text-2xl font-bold text-green-600">0.00%</p>
                    <p class="text-xs text-green-500">vs kemarin 0.00%</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
