@extends('layouts.bumdes')

@section('title', 'Verifikasi Usaha Seller - BUMDES')
@section('page_title', 'Daftar Usaha Menunggu Verifikasi')
@section('page_description', 'Verifikasi usaha seller yang mendaftar di platform BUMDES')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex flex-col md:flex-row md:items-center gap-4 w-full md:w-auto">
                <div class="relative w-full md:w-64">
                    <input type="text" placeholder="Cari toko atau pemilik..." class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-accent w-full">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
                <select class="border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-accent w-full md:w-auto">
                    <option>Semua Kategori</option>
                    {{-- Loop data kategori dari database --}}
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="text-sm text-gray-600 flex-shrink-0">
                {{-- Menampilkan jumlah data yang menunggu verifikasi --}}
                <span class="font-semibold">{{ $totalPendingBusinesses }}</span> usaha menunggu verifikasi
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Toko</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemilik</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($businesses as $business)
                    <tr class="verification-item">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center">
                                    <i class="fas fa-store text-gray-600"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $business->nama_toko }}</div>
                                    <div class="text-sm text-gray-500">ID: {{ $business->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $business->pemilik }}</div>
                            <div class="text-sm text-gray-500">{{ $business->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">{{ $business->kategori }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($business->tanggal_daftar)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <button class="bg-green-600 text-white px-3 py-1 rounded-md hover:bg-green-700">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button class="bg-accent text-white px-3 py-1 rounded-md hover:bg-accent/90">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="flex justify-between items-center mt-6">
        <div class="text-sm text-gray-600">
            {{-- Menampilkan 4 dari 12 usaha --}}
            Menampilkan {{ $businesses->firstItem() }} hingga {{ $businesses->lastItem() }} dari {{ $businesses->total() }} usaha
        </div>
        <div class="flex space-x-2">
            {{-- Tombol navigasi pagination --}}
            {{ $businesses->links() }}
        </div>
    </div>
@endsection