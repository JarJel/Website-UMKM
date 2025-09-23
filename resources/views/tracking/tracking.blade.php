{{-- resources/views/pesanan/tracking.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking Pesanan #{{ $pesanan->id_pesanan }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

@include('homePage.navbar')

<div class="max-w-4xl mx-auto p-6 mt-4">

    {{-- Judul --}}
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Tracking Pesanan #{{ $pesanan->id_pesanan }}</h1>

    {{-- Ringkasan Pesanan --}}
    <div class="bg-white rounded-xl shadow p-6 space-y-4">
        <div class="flex justify-between">
            <span class="text-gray-600">Metode Pembayaran:</span>
            <span class="font-semibold text-gray-800">{{ ucfirst($pesanan->metode_pembayaran) }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-600">Total Harga:</span>
            <span class="font-semibold text-green-600 text-lg">
                Rp {{ number_format($pesanan->total_harga_produk + $pesanan->biaya_pengiriman,0,',','.') }}
            </span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-600">Tanggal Pesanan:</span>
            <span class="text-gray-800">{{ \Carbon\Carbon::parse($pesanan->tanggal_pesanan)->format('d M Y H:i') }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-600">Alamat Pengiriman:</span>
            <span class="text-gray-800">{{ $pesanan->alamat->alamat_lengkap ?? '-' }}</span>
        </div>
    </div>

    {{-- Status Timeline --}}
    {{-- Status Timeline --}}
<h2 class="text-2xl font-bold mt-8 mb-4 text-gray-800">Status Pengiriman</h2>
<div class="relative pl-8 space-y-8">
    @php
        $statuses = [
            'pending' => 'Pesanan dibuat',
            'diproses' => 'Sedang diproses',
            'dikirim' => 'Sedang dikirim',
            'selesai' => 'Pesanan selesai'
        ];
        $statusKeys = array_keys($statuses);
        $activeIndex = array_search($pesanan->status_pesanan, $statusKeys);
    @endphp

    @foreach($statuses as $key => $label)
        @php
            $currentIndex = $loop->index;
            $isActive = $currentIndex <= $activeIndex;
            $isCurrent = $pesanan->status_pesanan == $key;
        @endphp
        <div class="relative flex items-start">
            {{-- Lingkaran status --}}
            <span class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center font-bold 
                {{ $isActive ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-700' }}">
                {{ $loop->iteration }}
            </span>
            {{-- Garis vertikal --}}
            @if(!$loop->last)
                <span class="absolute left-5 top-10 w-0.5 h-full bg-blue-600 {{ $isActive ? '' : 'bg-gray-300' }}"></span>
            @endif
            {{-- Label status --}}
            <div class="ml-4">
                <p class="font-semibold text-lg {{ $isActive ? 'text-blue-600' : 'text-gray-700' }}">{{ $label }}</p>
                @if($isCurrent)
                    <p class="text-sm text-gray-500 mt-1">Status saat ini</p>
                @endif
            </div>
        </div>
    @endforeach
</div>

</div>

</body>
</html>
