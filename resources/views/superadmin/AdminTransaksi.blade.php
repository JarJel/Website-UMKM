@extends('superadmin.adminSuper')

@section('title', 'Manajemen Transaksi')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Transaksi</h2>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form tambah transaksi --}}
    <form action="{{ route('admin.transaksi.store') }}" method="POST" class="mb-6">
        @csrf
        <div class="grid grid-cols-3 gap-4">
            <input type="text" name="nama" placeholder="Nama Transaksi" class="border p-2 rounded" required>
            <input type="number" name="jumlah" placeholder="Jumlah" class="border p-2 rounded" required>
            <select name="status" class="border p-2 rounded" required>
                <option value="pending">Pending</option>
                <option value="selesai">Selesai</option>
            </select>
        </div>
        <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">Tambah</button>
    </form>

    {{-- Tabel transaksi --}}
    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-gray-200">
            <thead class="bg-blue-100 text-gray-800">
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Jumlah</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksi as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border text-center">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border">{{ $item->nama }}</td>
                        <td class="px-4 py-2 border">{{ $item->jumlah }}</td>
                        <td class="px-4 py-2 border">
                            @if($item->status === 'selesai')
                                <span class="px-2 py-1 bg-green-200 text-green-800 rounded text-sm">Selesai</span>
                            @else
                                <span class="px-2 py-1 bg-yellow-200 text-yellow-800 rounded text-sm">Pending</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border text-center">
                            <form action="{{ route('admin.transaksi.destroy', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin mau hapus?')" class="px-3 py-1 bg-red-500 text-white rounded">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 py-4">Belum ada transaksi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
