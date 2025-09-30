@extends('superadmin.dashboard')

@section('title', 'Daftar BUMDES')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar BUMDES Terdaftar</h2>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if($bumdes->isEmpty())
        <p class="text-gray-500">Belum ada BUMDES yang terdaftar.</p>
    @else
    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-gray-200">
            <thead class="bg-blue-100 text-gray-800">
                <tr>
                    <th class="px-4 py-2 border text-center">No</th>
                    <th class="px-4 py-2 border text-center">Logo</th>
                    <th class="px-4 py-2 border">Nama BUMDES</th>
                    <th class="px-4 py-2 border">Nomor Telepon</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Wilayah</th>
                    <th class="px-4 py-2 border text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bumdes as $b)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border text-center">{{ $loop->iteration }}</td>

                    <td class="px-4 py-2 border text-center">
                        <img src="{{ $b->logo ? asset('storage/' . $b->logo) : asset('storage/default.png') }}"
                             alt="{{ $b->nama_bumdes }}"
                             class="w-16 h-16 rounded-lg object-cover mx-auto">
                    </td>

                    <td class="px-4 py-2 border">{{ $b->nama_bumdes }}</td>
                    <td class="px-4 py-2 border">{{ $b->nomor_telepon ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $b->email ?? '-' }}</td>
                    <td class="px-4 py-2 border">
                        {{ $b->desa->name ?? '' }},
                        {{ $b->desa->kecamatan->name ?? '' }},
                        {{ $b->desa->kecamatan->kabupaten->name ?? '' }},
                        {{ $b->desa->kecamatan->kabupaten->provinsi->name ?? '' }}
                    </td>

                    <td class="px-4 py-2 border text-center">
                        <div class="flex justify-center gap-2">
                            <form action="{{ route('superadmin.delete-bumdes', $b->id_bumdes) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm"
                                        onclick="return confirm('Yakin ingin menghapus BUMDES ini?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
