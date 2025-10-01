@extends('seller.layout')

@section('title', 'Tambah Produk')
@section('header', 'Tambah Produk')

@section('content')
<div class="bg-gray-50 p-6 rounded-lg shadow border border-gray-200">
    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded border border-red-300">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Nama Produk --}}
        <div class="mb-4">
            <label for="nama_produk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
            <input type="text" id="nama_produk" name="nama_produk"
                value="{{ old('nama_produk') }}"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 bg-white shadow-sm 
                       focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                required>
        </div>

        {{-- Deskripsi Produk --}}
        <div class="mb-4">
            <label for="deskripsi_produk" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea id="deskripsi_produk" name="deskripsi_produk" rows="4"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 bg-white shadow-sm 
                       focus:ring-2 focus:ring-blue-400 focus:border-blue-400">{{ old('deskripsi_produk') }}</textarea>
        </div>

        {{-- Harga Dasar --}}
        <div class="mb-4">
            <label for="harga_dasar" class="block text-sm font-medium text-gray-700">Harga Dasar</label>
            <input type="number" id="harga_dasar" name="harga_dasar"
                value="{{ old('harga_dasar') }}"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 bg-white shadow-sm 
                       focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                required>
        </div>

        {{-- Stok --}}
        <div class="mb-4">
            <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
            <input type="number" id="stok" name="stok"
                value="{{ old('stok') }}"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 bg-white shadow-sm 
                       focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                required>
        </div>

        {{-- Kategori --}}
        <div class="mb-4">
            <label for="id_kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
            <select name="id_kategori" id="id_kategori"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 bg-white shadow-sm 
                       focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategori as $kat)
                    <option value="{{ $kat->id_kategori }}" {{ old('id_kategori') == $kat->id_kategori ? 'selected' : '' }}>
                        {{ $kat->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Gambar --}}
        <div class="mb-4">
            <label for="gambar_produk" class="block text-sm font-medium text-gray-700">Gambar Produk</label>
            <input type="file" id="gambar_produk" name="gambar_produk"
                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 bg-white shadow-sm 
                       focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
        </div>

        {{-- Varian Produk --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Varian Produk</label>
            <div id="variants-wrapper"></div>
            <button type="button" id="add-variant" class="mt-2 px-3 py-1 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">+ Tambah Varian</button>
        </div>

        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700">Simpan</button>
    </form>
</div>

{{-- Script Varian --}}
<script>
    function tambahVarian() {
        const wrapper = document.getElementById('variants-wrapper');
        const div = document.createElement('div');
        div.classList.add('flex', 'space-x-2', 'mb-2');

        div.innerHTML = `
            <input type="text" name="varian[nama_varian][]" placeholder="Nama Varian" 
                   class="border border-gray-300 p-2 rounded-lg w-1/5 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400" required>
            <input type="text" name="varian[sku][]" placeholder="SKU" 
                   class="border border-gray-300 p-2 rounded-lg w-1/5 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
            <input type="number" name="varian[harga_varian][]" placeholder="Harga" 
                   class="border border-gray-300 p-2 rounded-lg w-1/5 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400" required>
            <input type="number" name="varian[stok_varian][]" placeholder="Stok" 
                   class="border border-gray-300 p-2 rounded-lg w-1/5 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400" required>
            <input type="number" step="0.01" name="varian[berat_varian_kg][]" placeholder="Berat (kg)" 
                   class="border border-gray-300 p-2 rounded-lg w-1/5 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400" required>
            <button type="button" onclick="this.parentElement.remove()" 
                    class="px-2 bg-red-500 text-white rounded-lg shadow hover:bg-red-600">Hapus</button>
        `;
        wrapper.appendChild(div);
    }

    document.getElementById('add-variant').addEventListener('click', tambahVarian);
</script>

{{-- Floating Chatbot --}}
<div id="chatbot-toggle" class="fixed bottom-5 right-5 w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center shadow-lg cursor-pointer hover:bg-blue-700">
    💬
</div>

<div id="chatbot-box" class="fixed bottom-20 right-5 w-80 bg-white border rounded-lg shadow-lg hidden flex-col">
    <div class="bg-blue-600 text-white p-2 rounded-t-lg flex justify-between items-center">
        <span>Chatbot AI</span>
        <button onclick="toggleChatbot()" class="text-white">✖</button>
    </div>
    <div id="chatbot-messages" class="h-64 overflow-y-auto p-2 text-sm"></div>
    <div class="flex border-t">
        <input id="chatbot-input" type="text" placeholder="Ketik pesan..." class="flex-1 p-2 text-sm focus:outline-none">
        <button id="chatbot-send" class="bg-blue-600 text-white px-3 hover:bg-blue-700">Kirim</button>
    </div>
</div>

<script>
    const toggleBtn = document.getElementById('chatbot-toggle');
    const chatBox = document.getElementById('chatbot-box');
    const msgBox = document.getElementById('chatbot-messages');
    const input = document.getElementById('chatbot-input');
    const sendBtn = document.getElementById('chatbot-send');

    toggleBtn.addEventListener('click', toggleChatbot);

    function toggleChatbot() {
        chatBox.classList.toggle('hidden');
    }

    function appendMessage(text, sender) {
        const div = document.createElement('div');
        div.className = sender === 'user' ? 'text-right mb-1' : 'text-left mb-1';
        div.innerHTML = `<span class="inline-block px-2 py-1 rounded ${sender === 'user' ? 'bg-blue-500 text-white' : 'bg-gray-200'}">${text}</span>`;
        msgBox.appendChild(div);
        msgBox.scrollTop = msgBox.scrollHeight;
    }

    function sendMessage() {
        const msg = input.value.trim();
        if (!msg) return;
        appendMessage(msg, 'user');
        input.value = '';
        const typingIndicator = document.createElement('div');
        typingIndicator.className = 'text-left mb-1';
        typingIndicator.innerHTML = `<span class="inline-block px-2 py-1 rounded bg-gray-200">⏳ Sedang mengetik...</span>`;
        msgBox.appendChild(typingIndicator);
        msgBox.scrollTop = msgBox.scrollHeight;

        fetch("{{ route('chatbot.seller.reply') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ message: msg })
        })
        .then(res => res.json())
        .then(data => {
            typingIndicator.remove();
            if (data.reply) {
                appendMessage(data.reply, 'bot');
            } else if (data.error) {
                appendMessage("⚠️ " + data.error, 'bot');
            } else {
                appendMessage("⚠️ Tidak ada balasan dari server.", 'bot');
            }
        })
        .catch(err => {
            typingIndicator.remove();
            appendMessage("⚠️ Terjadi kesalahan koneksi: " + err.message, 'bot');
        });
    }

    sendBtn.addEventListener('click', sendMessage);
    input.addEventListener('keypress', e => {
        if (e.key === 'Enter') sendMessage();
    });
</script>
@endsection
