@extends('bumdes.bumdes')

@section('title', 'Verifikasi Usaha Seller')
@section('page_title', 'Daftar Usaha Menunggu Verifikasi')
@section('page_description', 'Verifikasi usaha seller yang mendaftar di platform BUMDES')

@section('content')
<div class="space-y-6">

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <h2 class="text-xl font-bold p-6 border-b">{{ $businesses->total() }} Usaha Menunggu Verifikasi</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-3">Nama Toko</th>
                        <th class="px-6 py-3">Pemilik</th>
                        <th class="px-6 py-3">Tanggal Daftar</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($businesses as $business)
                        @php
                            $verifikasi = $business->verifikasi?->first();
                            $statusColor = match($verifikasi?->status_verifikasi) {
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'approved' => 'bg-green-100 text-green-800',
                                'rejected' => 'bg-red-100 text-red-800',
                                default => 'bg-gray-100 text-gray-800',
                            };
                        @endphp
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-semibold text-gray-800">{{ $business->nama_toko }}</td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ $business->user->name ?? $business->pemilik }}
                                <br>
                                <span class="text-xs text-gray-500">{{ $business->user->email ?? $business->email }}</span>
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ \Carbon\Carbon::parse($business->tanggal_daftar)->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="{{ $statusColor }} text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                    {{ ucfirst($verifikasi->status_verifikasi ?? 'Belum Diverifikasi') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($verifikasi)
                                    <div class="flex flex-col space-y-1">
                                        {{-- Tombol Approve --}}
                                        @if($verifikasi->status_verifikasi === 'pending')
                                            <form action="{{ route('bumdes.verifikasi.approve', $verifikasi->id_verifikasi_toko) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-3 py-1 w-full text-xs rounded bg-green-500 text-white hover:bg-green-600">
                                                    ✔ Setujui
                                                </button>
                                            </form>

                                            <form action="{{ route('bumdes.verifikasi.reject', $verifikasi->id_verifikasi_toko) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-3 py-1 w-full text-xs rounded bg-red-500 text-white hover:bg-red-600">
                                                    ✖ Tolak
                                                </button>
                                            </form>
                                        @endif

                                        {{-- Tombol Lihat --}}
                                        <a href="{{ route('bumdes.verifikasi.show', $verifikasi->id_verifikasi_toko) }}"
                                           class="px-3 py-1 w-full text-xs rounded bg-blue-500 text-white hover:bg-blue-600 text-center">
                                           👁 Lihat
                                        </a>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center p-6 text-gray-500">Belum ada pengajuan verifikasi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="flex justify-between items-center mt-6">
        <div class="text-sm text-gray-600">
            Menampilkan {{ $businesses->firstItem() }} hingga {{ $businesses->lastItem() }} dari {{ $businesses->total() }} usaha
        </div>
        <div class="flex space-x-2">
            {{ $businesses->links() }}
        </div>
    </div>
</div>
@endsection
