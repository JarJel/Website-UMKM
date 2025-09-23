@include('homePage.navbar')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Keranjang Belanja</h1>

    @if($cart && $cart->items->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">Gambar</th>
                        <th class="px-4 py-2 border">Nama Produk</th>
                        <th class="px-4 py-2 border">Deskripsi</th>
                        <th class="px-4 py-2 border">Harga Dasar</th>
                        <th class="px-4 py-2 border">Stok</th>
                        <th class="px-4 py-2 border">Rating</th>
                        <th class="px-4 py-2 border">Jumlah Rating</th>
                        <th class="px-4 py-2 border">Kategori</th>
                        <th class="px-4 py-2 border">Tanggal Ditambahkan</th>
                        <th class="px-4 py-2 border">Jumlah</th>
                        <th class="px-4 py-2 border">Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart->items as $index => $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border text-center">
                                <img src="{{ asset($item->produk->image) }}" alt="{{ $item->produk->nama_produk }}" class="w-16 h-16 object-cover rounded">
                            </td>
                            <td class="px-4 py-2 border">{{ $item->produk->nama_produk }}</td>
                            <td class="px-4 py-2 border">{{ $item->produk->deskripsi_produk }}</td>
                            <td class="px-4 py-2 border">Rp {{ number_format($item->produk->harga_dasar, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 border text-center">{{ $item->produk->stok }}</td>
                            <td class="px-4 py-2 border text-center">{{ $item->produk->rating_produk }}</td>
                            <td class="px-4 py-2 border text-center">{{ $item->produk->jumlah_rating_produk }}</td>
                            <td class="px-4 py-2 border text-center">{{ $item->produk->id_kategori }}</td>
                            <td class="px-4 py-2 border text-center">{{ $item->produk->tanggal_ditambahkan->format('d-m-Y') }}</td>
                            <td class="px-4 py-2 border text-center">{{ $item->jumlah_produk }}</td>
                            <td class="px-4 py-2 border text-center">
                                Rp {{ number_format($item->jumlah_produk * $item->produk->harga_dasar, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total -->
        <div class="mt-6 flex justify-end space-x-4">
            <span class="font-bold text-lg">Total Belanja:</span>
            <span class="font-bold text-lg text-green-600">
                Rp {{ number_format($cart->items->sum(function($item){ return $item->jumlah_produk * $item->produk->harga_dasar; }), 0, ',', '.') }}
            </span>
        </div>

    @else
        <p class="text-center text-gray-500">Keranjang Anda masih kosong.</p>
    @endif
</div>
@endsection
