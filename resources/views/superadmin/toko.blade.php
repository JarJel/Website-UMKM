@extends('superadmin.dashboard')

@section('title', 'Manajemen Toko')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Toko Terdaftar</h2>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-gray-200">
            <thead class="bg-blue-100 text-gray-800">
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Nama Toko</th>
                    <th class="px-4 py-2 border">Pemilik</th>
                    <th class="px-4 py-2 border">Alamat</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($toko as $item)
                    <tr class="hover:bg-gray-50">
                        {{-- No urut aman --}}
                        <td class="px-4 py-2 border text-center">{{ $loop->iteration }}</td>
                        
                        {{-- Nama toko --}}
                        <td class="px-4 py-2 border">{{ $item->nama_toko ?? '-' }}</td>
                        
                        {{-- Pemilik toko (gunakan optional biar aman) --}}
                        <td class="px-4 py-2 border">{{ optional($item->user)->nama_pengguna ?? '-' }}</td>  
                                              
                        {{-- Alamat --}}
                        <td class="px-4 py-2 border">{{ $item->alamat ?? '-' }}</td>
                        
                        {{-- Status --}}
                        <td class="px-4 py-2 border">
                            @if($item->status === 'aktif')
                                <span class="px-2 py-1 bg-green-200 text-green-800 rounded-lg text-sm">Aktif</span>
                            @else
                                <span class="px-2 py-1 bg-red-200 text-red-800 rounded-lg text-sm">Nonaktif</span>
                            @endif
                        </td>
                        
                        {{-- Aksi --}}
                        <td class="px-4 py-2 border text-center">
                            <div class="flex justify-center gap-2">
                                {{-- Detail --}}
                                <a href="{{ route('toko.show', $item->id_toko) }}"
                                class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                                    Detail
                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('toko.edit', $item->id_toko) }}" 
                                class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                                    Edit
                                </a>

                                {{-- Hapus --}}
                                <form action="{{ route('toko.destroy', $item->id_toko) }}" method="POST" onsubmit="return confirm('Yakin mau hapus toko ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                            Belum ada toko terdaftar
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
