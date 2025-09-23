@extends('bumdes.layout_bumdes')

@section('title', 'Arsip & Dokumen')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Arsip & Dokumen</h2>

    <table class="w-full bg-white shadow rounded-lg">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2">Nama Dokumen</th>
                <th class="px-4 py-2">Tanggal Upload</th>
                <th class="px-4 py-2">Kategori</th>
                <th class="px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b">
                <td class="px-4 py-2">Laporan BUMDES 2024</td>
                <td class="px-4 py-2">2025-01-05</td>
                <td class="px-4 py-2">Laporan Tahunan</td>
                <td class="px-4 py-2">
                    <button class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">📂 Lihat</button>
                    <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">🗑 Hapus</button>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
