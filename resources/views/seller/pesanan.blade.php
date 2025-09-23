@extends('seller.layout')

@section('title', 'Pesanan Saya')
@section('header', 'Pesanan Saya')

@section('content')
<div class="space-y-6">

    <!-- Tabel Pesanan -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <h2 class="text-xl font-bold p-6 border-b">{{ $pesanan->count() }} Pesanan</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Produk</th>
                        <th scope="col" class="px-6 py-3">Pembeli</th>
                        <th scope="col" class="px-6 py-3">Jumlah Harus Dibayar</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Alamat</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesanan as $p)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <!-- Produk dalam pesanan -->
                            <td class="px-6 py-4">
                                <div class="space-y-2">
                                    @foreach($p->items as $item)
                                        <div class="flex items-center space-x-3">
                                            <img src="{{ $item->produk->gambar ?? 'https://placehold.co/50x50' }}" 
                                                 alt="Produk" class="w-12 h-12 rounded-lg">
                                            <div>
                                                <div class="font-semibold text-gray-800">
                                                    {{ $item->nama_produk_snapshot ?? $item->produk->nama_produk }}
                                                </div>
                                                <p class="text-xs text-gray-500">
                                                    Jumlah: {{ $item->jumlah }} | Harga: Rp {{ number_format($item->total_harga_produk,0,',','.') }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </td>

                            <!-- Nama Pembeli -->
                            <td class="px-6 py-4 font-semibold text-gray-800">
                                {{ $p->pembeli->nama ?? 'User Tidak Ditemukan' }}
                            </td>

                            <!-- Total Harga -->
                            <td class="px-6 py-4 font-bold text-gray-900">
                                Rp {{ number_format($p->total_harga_produk + $p->biaya_pengiriman,0,',','.') }}
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4">
                                @php
                                    $statusColor = match($p->status_pesanan) {
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'diproses' => 'bg-blue-100 text-blue-800',
                                        'dikirim' => 'bg-purple-100 text-purple-800',
                                        'selesai' => 'bg-green-100 text-green-800',
                                        'dibatalkan' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                @endphp
                                <span class="{{ $statusColor }} text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                    {{ ucfirst($p->status_pesanan) }}
                                </span>
                            </td>

                            <!-- Alamat -->
                            <td class="px-6 py-4 text-gray-700">
                                {{ $p->alamat->alamat_lengkap ?? '-' }}
                            </td>

                            <!-- Aksi -->
                            <td class="px-6 py-4">
                                <a href="{{ route('seller.pesanan.show', $p->id_pesanan) }}" 
                                   class="font-medium text-blue-600 hover:underline">Rincian</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center p-6 text-gray-500">Belum ada pesanan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
