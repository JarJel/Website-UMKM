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
                        @foreach($p->items as $index => $item)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <!-- Nama Produk -->
                                <td class="px-6 py-4 flex items-center space-x-3">
                                    @if($item->produk && $item->produk->gambar_produk)
                                        <img src="{{ asset('storage/' . $item->produk->gambar_produk) }}" 
                                            alt="{{ $item->produk->nama_produk }}" 
                                            class="w-12 h-12 rounded-lg object-cover" />
                                    @else
                                        <div class="w-12 h-12 rounded-lg bg-gray-200 flex items-center justify-center text-gray-500 text-xs">
                                            No Image
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-semibold text-gray-800">
                                            {{ $item->nama_produk_snapshot ?? optional($item->produk)->nama_produk ?? 'Produk tidak tersedia' }}
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            Jumlah: {{ $item->jumlah }}
                                        </p>
                                    </div>
                                </td>

                                @if($index === 0)
                                    <!-- Nama Pembeli -->
                                    <td class="px-6 py-4 font-semibold text-gray-800" rowspan="{{ $p->items->count() }}">
                                        {{ $p->pembeli->nama_pengguna ?? 'User Tidak Ditemukan' }}
                                    </td>

                                    <!-- Total Harga -->
                                    <td class="px-6 py-4 font-bold text-gray-900" rowspan="{{ $p->items->count() }}">
                                        Rp {{ number_format($p->total_harga_produk + $p->biaya_pengiriman,0,',','.') }}
                                    </td>

                                    <!-- Status -->
                                    <td class="px-6 py-4" rowspan="{{ $p->items->count() }}">
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
                                    <td class="px-6 py-4 text-gray-700" rowspan="{{ $p->items->count() }}">
                                        {{ $p->alamat->alamat_lengkap ?? '-' }}
                                    </td>

                                    <!-- Aksi -->
                                    <td class="px-6 py-4" rowspan="{{ $p->items->count() }}">
                                        <div class="flex flex-col space-y-1">

                                            <!-- Tombol Proses -->
                                        @if($p->status_pesanan === 'pending')
                                            <form action="{{ route('seller.pesanan.updateStatus', [$p->id_pesanan]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="diproses">
                                                <button type="submit"
                                                    class="px-3 py-1 text-xs rounded bg-blue-500 text-white hover:bg-blue-600 w-full">
                                                    Proses
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Tombol Diantarkan -->
                                        @if($p->status_pesanan === 'diproses')
                                            <form action="{{ route('seller.pesanan.updateStatus', [$p->id_pesanan]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="diantarkan">
                                                <button type="submit"
                                                    class="px-3 py-1 text-xs rounded bg-purple-500 text-white hover:bg-purple-600 w-full">
                                                    Diantarkan
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Tombol Selesai -->
                                        @if($p->status_pesanan === 'diantarkan')
                                            <form action="{{ route('seller.pesanan.updateStatus', [$p->id_pesanan]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="selesai">
                                                <button type="submit"
                                                    class="px-3 py-1 text-xs rounded bg-green-500 text-white hover:bg-green-600 w-full">
                                                    Selesai
                                                </button>
                                            </form>
                                        @endif

                                        </div>
                                    </td>

                                @endif
                            </tr>
                        @endforeach
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
                                            