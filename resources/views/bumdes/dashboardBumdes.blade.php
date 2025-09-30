@extends('bumdes.bumdes')

@section('title', 'Dashboard BUMDES')
@section('description', 'Ringkasan data dan aktivitas utama BUMDES')

@section('content')

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="stats-card bg-white shadow rounded-lg p-6 text-center border-l-4 border-yellow-500">
            <h3 class="text-xl font-semibold text-gray-700">Usaha Menunggu Verifikasi</h3>
            <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $tokoPending }}</p>
            <div class="mt-4">
                <i class="fas fa-clock text-yellow-500 text-3xl"></i>
            </div>
        </div>
        <div class="stats-card bg-white shadow rounded-lg p-6 text-center border-l-4 border-green-500">
            <h3 class="text-xl font-semibold text-gray-700">Total Usaha Aktif</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $tokoTerverifikasi }}</p>
            <div class="mt-4">
                <i class="fas fa-check-circle text-green-500 text-3xl"></i>
            </div>
        </div>
        <div class="stats-card bg-white shadow rounded-lg p-6 text-center border-l-4 border-blue-500">
            <h3 class="text-xl font-semibold text-gray-700">Seller Terdaftar</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalToko }}</p>
            <div class="mt-4">
                <i class="fas fa-users text-blue-500 text-3xl"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <a href="{{ route('bumdes.verifikasi') }}" class="menu-card bg-white p-6 rounded-lg shadow-md border-t-4 border-accent hover:border-accent/80">
            <div class="flex items-center">
                <div class="bg-accent/20 p-3 rounded-full mr-4">
                    <i class="fas fa-clipboard-check text-accent text-xl"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-lg">Verifikasi Pengajuan Usaha</h3>
                    <p class="text-gray-600 mt-1">{{ $tokoPending }} menunggu verifikasi</p>
                </div>
            </div>
        </a>
        <a href="{{ route('bumdes.laporan') }}" class="menu-card bg-white p-6 rounded-lg shadow-md border-t-4 border-secondary hover:border-secondary/80">
            <div class="flex items-center">
                <div class="bg-secondary/20 p-3 rounded-full mr-4">
                    <i class="fas fa-chart-line text-secondary text-xl"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-lg">Lihat Laporan Transaksi</h3>
                    <p class="text-gray-600 mt-1">128 transaksi bulan ini</p>
                </div>
            </div>
        </a>
        <a href="{{ route('bumdes.seller') }}" class="menu-card bg-white p-6 rounded-lg shadow-md border-t-4 border-primary hover:border-primary/80">
            <div class="flex items-center">
                <div class="bg-primary/20 p-3 rounded-full mr-4">
                    <i class="fas fa-user-friends text-primary text-xl"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-lg">Kelola Seller</h3>
                    <p class="text-gray-600 mt-1">{{ $totalToko }} seller terdaftar</p>
                </div>
            </div>
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-primary mb-4">Aktivitas Terbaru</h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b">
                        <th class="pb-3">Seller</th>
                        <th class="pb-3">Aktivitas</th>
                        <th class="pb-3">Tanggal</th>
                        <th class="pb-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aktivitasTerbaru as $aktivitas)
                        <tr>
                            {{-- Mengakses nama pengguna melalui relasi toko dan pengguna --}}
                            <td class="py-3">{{ $aktivitas->toko->user->nama_pengguna ?? 'Nama tidak ditemukan' }}</td>
                            <td class="py-3">Status toko diubah menjadi {{ $aktivitas->status_verifikasi }}</td>
                            
                            {{-- Menambahkan pengecekan untuk memastikan tanggal tidak null sebelum diformat --}}
                            <td class="py-3">
                                @if ($aktivitas->tanggal_verifikasi)
                                    {{ $aktivitas->tanggal_verifikasi->format('d M Y') }}
                                @else
                                    <span class="text-gray-500">Tanggal tidak tersedia</span>
                                @endif
                            </td>
                            
                            <td class="py-3">
                                @if($aktivitas->status_verifikasi == 'pending')
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Menunggu</span>
                                @elseif($aktivitas->status_verifikasi == 'disetujui')
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs">Terverifikasi</span>
                                @else
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs">Ditolak</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-3 text-center text-gray-500">Belum ada aktivitas verifikasi terbaru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection