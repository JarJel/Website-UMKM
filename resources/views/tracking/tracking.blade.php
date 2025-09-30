{{-- resources/views/pesanan/tracking.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

@include('homePage.navbar')

<div class="max-w-5xl mx-auto p-6 mt-4 space-y-6">

    <h1 class="text-3xl font-bold mb-6 text-gray-800">Tracking Pesanan</h1>

    @if($pesananList->isEmpty())
        <p class="text-center text-gray-500">Belum ada pesanan.</p>
    @else
        {{-- Loop setiap pesanan --}}
        @foreach($pesananList as $pesanan)
            @if($pesanan)
            <div class="bg-white rounded-xl shadow p-6 space-y-4">

                
                {{-- Ringkasan Pesanan --}}
                <div class="space-y-2">
                    <h2 class="font-semibold text-xl text-gray-800">Pesanan #{{ $pesanan->id_pesanan }}</h2>
                    {{-- Daftar Produk dalam Pesanan --}}
                    <ul class="p-0 space-y-4">
                        @forelse($pesanan->items as $item)
                            <li class="flex items-center space-x-4 bg-gray-50 rounded-lg p-2">
                                {{-- Gambar produk --}}
                                <img src="{{ $item->produk->gambar_produk ? asset('storage/' . $item->produk->gambar_produk) : asset('images/no-image.png') }}"
                                    alt="{{ $item->produk->nama_produk ?? 'Produk tidak tersedia' }}"
                                    class="w-16 h-16 object-cover rounded-lg">

                                {{-- Nama dan jumlah --}}
                                <div class="flex-1 flex justify-between items-center">
                                    <span class="font-medium text-gray-800">{{ $item->produk->nama_produk ?? 'Produk tidak tersedia' }}</span>
                                    <span class="font-semibold text-gray-700">x{{ $item->jumlah ?? 0 }}</span>
                                </div>
                            </li>
                        @empty
                            <li class="text-gray-500">Belum ada produk.</li>
                        @endforelse
                    </ul>
                    <div class="flex justify-between text-gray-600">
                        <span>Metode Pembayaran:</span>
                        <span class="font-semibold text-gray-800">{{ ucfirst($pesanan->metode_pembayaran ?? '-') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Total Harga:</span>
                        <span class="font-semibold text-green-600">
                            Rp {{ number_format(($pesanan->total_harga_produk ?? 0) + ($pesanan->biaya_pengiriman ?? 0),0,',','.') }}
                        </span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Tanggal Pesanan:</span>
                        <span class="text-gray-800">
                            {{ $pesanan->tanggal_pesanan ? \Carbon\Carbon::parse($pesanan->tanggal_pesanan)->format('d M Y H:i') : '-' }}
                        </span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Alamat Pengiriman:</span>
                        <span class="text-gray-800">{{ $pesanan->alamat->alamat_lengkap ?? '-' }}</span>
                    </div>
                </div>

                {{-- Status Timeline Horizontal --}}
                <h3 class="text-lg font-semibold mt-4 mb-2 text-gray-800">Status Pengiriman</h3>
                @php
                    $statuses = [
                        'pending' => 'Pesanan dibuat',
                        'diproses' => 'Sedang diproses',
                        'diantarkan' => 'Pesanan sedang dalam perjalanan',
                        'selesai' => 'Pesanan selesai'
                    ];
                    $statusKeys = array_keys($statuses);
                    $status = $pesanan->status_pesanan ?? 'pending';
                    $activeIndex = array_search($status, $statusKeys);
                    if($activeIndex === false) $activeIndex = 0;
                @endphp

                <div class="flex items-center space-x-8 overflow-x-auto pb-4">
                    @foreach($statuses as $key => $label)
                        @php
                            $currentIndex = $loop->index;
                            $isActive = $currentIndex <= $activeIndex;
                            $isCurrent = $status === $key;
                        @endphp

                        <div class="flex flex-col items-center relative min-w-[120px]">
                            {{-- Lingkaran --}}
                            <span class="w-10 h-10 rounded-full flex items-center justify-center font-bold
                                {{ $isActive ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-700' }}">
                                {{ $loop->iteration }}
                            </span>

                            {{-- Garis horizontal --}}
                            @if(!$loop->last)
                                <div class="absolute top-5 left-10 w-full h-1 {{ $isActive ? 'bg-blue-600' : 'bg-gray-300' }}" style="z-index:-1"></div>
                            @endif

                            {{-- Label --}}
                            <p class="mt-2 text-center text-sm {{ $isActive ? 'text-blue-600' : 'text-gray-700' }}">{{ $label }}</p>
                            @if($isCurrent)
                                <p class="text-xs text-gray-500">Status saat ini</p>
                            @endif
                        </div>
                    @endforeach
                </div>

                {{-- Tombol Terima dan Form Ulasan --}}
                @if($pesanan->status_pesanan === 'selesai')
                    <div class="mt-4 border-t pt-4 space-y-4">
                        {{-- Tombol Terima --}}
                        @if(!$pesanan->is_diterima)
                            <form action="{{ route('pesanan.terima', $pesanan->id_pesanan) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                    Terima Pesanan
                                </button>
                            </form>
                        @else
                            <p class="text-green-600 font-semibold">Pesanan sudah diterima</p>
                        @endif

                        {{-- Form Ulasan --}}
                        @if($pesanan->is_diterima)
                            @if(!$pesanan->ulasan)
                                <form action="{{ route('pesanan.ulasan', $pesanan->id_pesanan) }}" method="POST" class="space-y-2">
                                    @csrf
                                    <label for="rating" class="block text-gray-700 font-medium">Beri Rating</label>
                                    <select name="rating" id="rating" class="border rounded px-3 py-2 w-full">
                                        <option value="5">5 - Sangat Baik</option>
                                        <option value="4">4 - Baik</option>
                                        <option value="3">3 - Cukup</option>
                                        <option value="2">2 - Kurang</option>
                                        <option value="1">1 - Buruk</option>
                                    </select>

                                    <label for="komentar" class="block text-gray-700 font-medium">Komentar</label>
                                    <textarea name="komentar" id="komentar" rows="3" class="border rounded px-3 py-2 w-full"></textarea>

                                    <button type="submit"
                                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                        Kirim Ulasan
                                    </button>
                                </form>
                            @else
                                <p class="text-gray-600 font-medium">Ulasan sudah dikirim. Terima kasih!</p>
                            @endif
                        @endif
                    </div>
                @endif

            </div>
            @endif
        @endforeach
    @endif

</div>
</body>
</html>
