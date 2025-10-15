{{-- resources/views/pesanan/tracking.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-slide-in {
            animation: slideIn 0.5s ease-out forwards;
        }
        .gradient-border {
            position: relative;
            background: linear-gradient(white, white) padding-box,
                        linear-gradient(135deg, #1d4657 0%, #2f6d88 100%) border-box;
            border: 2px solid transparent;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">

@include('homePage.navbar')

<div class="max-w-6xl mx-auto p-6 mt-8 space-y-8">

    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-[#1d4657] to-[#2f6d88] bg-clip-text text-transparent mb-2">
            Tracking Pesanan
        </h1>
        <p class="text-gray-600">Pantau status pesanan Anda secara real-time</p>
    </div>

    @if($pesananList->isEmpty())
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
            <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
            </svg>
            <p class="text-gray-500 text-lg">Belum ada pesanan.</p>
        </div>
    @else
        @foreach($pesananList as $pesanan)
            @if($pesanan)
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-slide-in hover:shadow-2xl transition-shadow duration-300">
                
                {{-- Header Card --}}
                <div class="bg-gradient-to-r from-[#1d4657] to-[#2f6d88] p-6 text-white">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-2xl font-bold">Pesanan #{{ $pesanan->id_pesanan }}</h2>
                            <p class="text-[#cfe3eb] text-sm mt-1">
                                {{ $pesanan->tanggal_pesanan ? \Carbon\Carbon::parse($pesanan->tanggal_pesanan)->format('d M Y H:i') : '-' }}
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-[#cfe3eb] text-sm">Total Pembayaran</p>
                            <p class="text-2xl font-bold">
                                Rp {{ number_format(($pesanan->total_harga_produk ?? 0) + ($pesanan->biaya_pengiriman ?? 0),0,',','.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-6">

                    {{-- Daftar Produk --}}
                    <div>
                        <h3 class="font-semibold text-lg text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-[#1d4657]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Produk yang Dipesan
                        </h3>
                        <div class="space-y-3">
                            @forelse($pesanan->items as $item)
                                <div class="flex items-center space-x-4 bg-gradient-to-r from-gray-50 to-white rounded-xl p-4 border border-gray-100 hover:border-[#c9dee7] transition-colors">
                                    <div class="relative">
                                        <img src="{{ $item->produk->gambar_produk ? asset('storage/' . $item->produk->gambar_produk) : asset('images/no-image.png') }}"
                                            alt="{{ $item->produk->nama_produk ?? 'Produk tidak tersedia' }}"
                                            class="w-20 h-20 object-cover rounded-lg shadow-md">
                                        <span class="absolute -top-2 -right-2 bg-[#1d4657] text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center">
                                            {{ $item->jumlah ?? 0 }}
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-800">{{ $item->produk->nama_produk ?? 'Produk tidak tersedia' }}</p>
                                        <p class="text-sm text-gray-500">Jumlah: {{ $item->jumlah ?? 0 }} item</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center py-4">Belum ada produk.</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- Info Pembayaran & Pengiriman --}}
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="bg-gradient-to-br from-[#e8f1f4] to-[#f0f7fa] rounded-xl p-4 border border-[#c9dee7]">
                            <p class="text-sm text-gray-600 mb-1">Metode Pembayaran</p>
                            <p class="font-semibold text-gray-800 text-lg">{{ ucfirst($pesanan->metode_pembayaran ?? '-') }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-4 border border-green-100">
                            <p class="text-sm text-gray-600 mb-1">Alamat Pengiriman</p>
                            <p class="font-semibold text-gray-800">{{ $pesanan->alamat->alamat_lengkap ?? '-' }}</p>
                        </div>
                    </div>

                    {{-- Status Timeline --}}
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold mb-6 text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-[#1d4657]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Status Pengiriman
                        </h3>
                        
                        @php
                            $statuses = [
                                'pending' => ['label' => 'Pesanan dibuat', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                                'diproses' => ['label' => 'Sedang diproses', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                'diantarkan' => ['label' => 'Dalam perjalanan', 'icon' => 'M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0'],
                                'selesai' => ['label' => 'Pesanan selesai', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z']
                            ];
                            $statusKeys = array_keys($statuses);
                            $status = $pesanan->status_pesanan ?? 'pending';
                            $activeIndex = array_search($status, $statusKeys);
                            if($activeIndex === false) $activeIndex = 0;
                        @endphp

                        <div class="relative">
                            <div class="flex justify-between items-start">
                                @foreach($statuses as $key => $data)
                                    @php
                                        $currentIndex = $loop->index;
                                        $isActive = $currentIndex <= $activeIndex;
                                        $isCurrent = $status === $key;
                                    @endphp

                                    <div class="flex flex-col items-center flex-1 relative">
                                        @if(!$loop->first)
                                            <div class="absolute top-6 right-1/2 w-full h-1 -z-10 {{ $isActive ? 'bg-gradient-to-r from-[#1d4657] to-[#2f6d88]' : 'bg-gray-300' }}"></div>
                                        @endif

                                        <div class="relative z-10 mb-3">
                                            <div class="w-12 h-12 rounded-full flex items-center justify-center transition-all duration-300
                                                {{ $isActive ? 'bg-gradient-to-br from-[#1d4657] to-[#2f6d88] shadow-lg scale-110' : 'bg-gray-300' }}">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $data['icon'] }}"></path>
                                                </svg>
                                            </div>
                                            @if($isCurrent)
                                                <div class="absolute -inset-1 bg-gradient-to-r from-[#1d4657] to-[#2f6d88] rounded-full opacity-30 animate-pulse"></div>
                                            @endif
                                        </div>

                                        <p class="text-center text-sm font-medium {{ $isActive ? 'text-[#1d4657]' : 'text-gray-500' }} max-w-[100px]">
                                            {{ $data['label'] }}
                                        </p>
                                        @if($isCurrent)
                                            <span class="mt-1 px-2 py-1 bg-[#e8f1f4] text-[#1d4657] text-xs font-semibold rounded-full">
                                                Aktif
                                            </span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    @if($pesanan->status_pesanan === 'selesai')
                        <div class="mt-6 pt-6 border-t border-gray-200 space-y-4">
                            @if(!$pesanan->is_diterima)
                                <form action="{{ route('pesanan.terima', $pesanan->id_pesanan) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-semibold rounded-xl hover:from-green-700 hover:to-emerald-700 transform hover:scale-105 transition-all duration-200 shadow-lg">
                                        ✓ Terima Pesanan
                                    </button>
                                </form>
                            @else
                                <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-center">
                                    <p class="text-green-700 font-semibold flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        Pesanan sudah diterima
                                    </p>
                                </div>
                            @endif

                            {{-- Form Ulasan --}}
                            @if($pesanan->is_diterima)
                                @if(!$pesanan->ulasan)
                                    <div class="gradient-border rounded-xl p-6">
                                        <h4 class="font-semibold text-lg text-gray-800 mb-4 flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            Bagaimana pengalaman Anda?
                                        </h4>
                                        <form action="{{ route('pesanan.ulasan', $pesanan->id_pesanan) }}" method="POST" class="space-y-4">
                                            @csrf
                                            <div>
                                                <label for="rating" class="block text-gray-700 font-medium mb-2">Rating</label>
                                                <select name="rating" id="rating" class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#1d4657] focus:ring focus:ring-[#e8f1f4] transition">
                                                    <option value="5">⭐⭐⭐⭐⭐ Sangat Baik</option>
                                                    <option value="4">⭐⭐⭐⭐ Baik</option>
                                                    <option value="3">⭐⭐⭐ Cukup</option>
                                                    <option value="2">⭐⭐ Kurang</option>
                                                    <option value="1">⭐ Buruk</option>
                                                </select>
                                            </div>

                                            <div>
                                                <label for="komentar" class="block text-gray-700 font-medium mb-2">Komentar</label>
                                                <textarea name="komentar" id="komentar" rows="4" 
                                                    placeholder="Bagikan pengalaman Anda dengan produk ini..."
                                                    class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-[#1d4657] focus:ring focus:ring-[#e8f1f4] transition resize-none"></textarea>
                                            </div>

                                            <button type="submit"
                                                class="w-full px-6 py-3 bg-gradient-to-r from-[#1d4657] to-[#2f6d88] text-white font-semibold rounded-xl hover:from-[#183b4a] hover:to-[#265b70] transform hover:scale-105 transition-all duration-200 shadow-lg">
                                                📝 Kirim Ulasan
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="bg-[#e8f1f4] border border-[#c9dee7] rounded-xl p-4 text-center">
                                        <p class="text-[#1d4657] font-medium">
                                            ✅ Ulasan sudah dikirim. Terima kasih atas feedback Anda!
                                        </p>
                                    </div>
                                @endif
                            @endif
                        </div>
                    @endif

                </div>
            </div>
            @endif
        @endforeach
    @endif
</div>
</body>
</html>
