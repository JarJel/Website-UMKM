@extends('superadmin.adminSuper')

@section('title', 'Kelola BUMDES & Kategori')

@section('content')
<h2 class="page-title text-3xl font-bold mb-8 text-gray-800">Kelola BUMDES & Kategori</h2>

{{-- Tab Buttons --}}
<div class="flex border-b border-gray-200 mb-6">
    <button class="tab-button py-2 px-6 mr-2 text-gray-700 font-medium rounded-t-lg bg-white border-t border-l border-r border-gray-200 active" data-tab="bumdes-tab">
        Tambah Akun BUMDES
    </button>
    <button class="tab-button py-2 px-6 text-gray-700 font-medium rounded-t-lg bg-white border-t border-l border-r border-gray-200" data-tab="kategori-tab">
        Tambah Kategori
    </button>
</div>

<div id="tab-content">
    {{-- Tab BUMDES --}}
    <div id="bumdes-tab" class="tab-panel active bg-white p-6 rounded-b-lg shadow-lg">
        <h3 class="text-2xl font-semibold text-indigo-600 mb-4">Daftar Akun BUMDES</h3>
        <p class="text-gray-600 mb-6">Isi formulir di bawah ini untuk membuat akun pengelola BUMDES. Pastikan desa yang dipilih benar.</p>

        @if(session('success'))
    <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
        ✅ {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
        <div class="p-4 mb-4 text-red-700 bg-red-100 rounded-lg">
            ❌ {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 mb-4 text-red-700 bg-red-100 rounded-lg">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form method="POST" action="{{ route('superadmin.store-bumdes') }}" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Data Diri Pengelola --}}
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-gray-700">Data Diri Pengelola</h4>
                    <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" value="{{ old('nama_lengkap') }}" class="input w-full" required>
                    <input type="text" name="nama_pengguna" placeholder="Nama Pengguna" value="{{ old('nama_pengguna') }}" class="input w-full" required>
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="input w-full" required>
                    <input type="tel" name="nomor_telepon" placeholder="Nomor Telepon" value="{{ old('nomor_telepon') }}" class="input w-full">
                    <input type="password" name="kata_sandi" placeholder="Kata Sandi" class="input w-full" required>
                    <input type="password" name="kata_sandi_confirmation" placeholder="Konfirmasi Kata Sandi" class="input w-full" required>
                </div>

                {{-- Data BUMDES --}}
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-gray-700">Data BUMDES & Wilayah</h4>
                    <input type="text" name="nama_bumdes" placeholder="Nama BUMDES" value="{{ old('nama_bumdes') }}" class="input w-full" required>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <select id="id_provinsi" name="id_provinsi" class="select w-full" required>
                            <option value="">Pilih Provinsi</option>
                            @foreach($provinsis as $provinsi)
                                <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                            @endforeach
                        </select>
                        <select id="id_kabupaten" name="id_kabupaten" class="select w-full" disabled required>
                            <option value="">Pilih Kabupaten</option>
                        </select>
                        <select id="id_kecamatan" name="id_kecamatan" class="select w-full" disabled required>
                            <option value="">Pilih Kecamatan</option>
                        </select>
                        <select id="id_desa" name="id_desa" class="select w-full" disabled required>
                            <option value="">Pilih Desa</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="btn-primary px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700 transition">
                    Daftar BUMDES
                </button>
            </div>
        </form>
    </div>

    {{-- Tab Kategori --}}
{{-- Tab Kategori --}}
<div id="kategori-tab" class="tab-panel hidden bg-white p-6 rounded-b-lg shadow-lg">
    <h3 class="text-2xl font-semibold text-indigo-600 mb-4">Tambah Kategori</h3>
    
    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 mb-4 text-red-700 bg-red-100 rounded-lg">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Tambah Kategori --}}
    <form method="POST" action="{{ route('superadmin.kategori.store') }}" class="space-y-6" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <input type="text" name="nama_kategori" placeholder="Nama Kategori"
                value="{{ old('nama_kategori') }}" class="input w-full" required>

            {{-- Upload Icon --}}
            <div>
                <label class="block mb-2 font-medium text-gray-700">Icon Kategori</label>
                <input type="file" name="icon_kategori" accept="image/*" class="input w-full">
                <p class="text-sm text-gray-500 mt-1">Format: jpg, png, svg. Maks 2MB.</p>
            </div>
        </div>
        <div class="flex justify-end">
            <button type="submit" 
                    class="btn-primary px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700 transition">
                Tambah Kategori
            </button>
        </div>
    </form>

</div>


</div>

{{-- JS Dropdown & Tab --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Tab Switching
    const tabs = document.querySelectorAll('.tab-button');
    const panels = document.querySelectorAll('.tab-panel');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            tabs.forEach(t => t.classList.remove('active', 'border-indigo-600', 'text-indigo-600'));
            panels.forEach(p => p.classList.add('hidden'));
            tab.classList.add('active', 'border-indigo-600', 'text-indigo-600');
            document.getElementById(tab.dataset.tab).classList.remove('hidden');
        });
    });

    // Dropdowns
    const provinsiSelect = document.getElementById('id_provinsi');
    const kabupatenSelect = document.getElementById('id_kabupaten');
    const kecamatanSelect = document.getElementById('id_kecamatan');
    const desaSelect = document.getElementById('id_desa');

    function resetSelect(select, placeholder) {
        select.innerHTML = `<option value="" disabled selected>${placeholder}</option>`;
        select.disabled = true;
    }

    provinsiSelect.addEventListener('change', async function() {
        const provinsiId = this.value;
        resetSelect(kabupatenSelect, 'Memuat Kabupaten...');
        resetSelect(kecamatanSelect, 'Pilih Kecamatan');
        resetSelect(desaSelect, 'Pilih Desa');

        if (!provinsiId) return;

        const response = await fetch(`/wilayah/kabupaten/${provinsiId}`);
        const data = await response.json();
        kabupatenSelect.innerHTML = `<option value="" disabled selected>Pilih Kabupaten</option>`;
        data.forEach(item => kabupatenSelect.insertAdjacentHTML('beforeend', `<option value="${item.id}">${item.name}</option>`));
        kabupatenSelect.disabled = false;
    });

    kabupatenSelect.addEventListener('change', async function() {
        const kabupatenId = this.value;
        resetSelect(kecamatanSelect, 'Memuat Kecamatan...');
        resetSelect(desaSelect, 'Pilih Desa');

        if (!kabupatenId) return;

        const response = await fetch(`/wilayah/kecamatan/${kabupatenId}`);
        const data = await response.json();
        kecamatanSelect.innerHTML = `<option value="" disabled selected>Pilih Kecamatan</option>`;
        data.forEach(item => kecamatanSelect.insertAdjacentHTML('beforeend', `<option value="${item.id}">${item.name}</option>`));
        kecamatanSelect.disabled = false;
    });

    kecamatanSelect.addEventListener('change', async function() {
        const kecamatanId = this.value;
        resetSelect(desaSelect, 'Memuat Desa...');

        if (!kecamatanId) return;

        const response = await fetch(`/wilayah/desa/${kecamatanId}`);
        const data = await response.json();
        desaSelect.innerHTML = `<option value="" disabled selected>Pilih Desa</option>`;
        data.forEach(item => desaSelect.insertAdjacentHTML('beforeend', `<option value="${item.id}">${item.name}</option>`));
        desaSelect.disabled = false;
    });
});
</script>

<style>
.input {
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    padding: 0.5rem 0.75rem;
    transition: all 0.2s;
}
.input:focus {
    outline: none;
    border-color: #6366f1;
    box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.3);
}
.select {
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    padding: 0.5rem;
    transition: all 0.2s;
}
.select:focus {
    outline: none;
    border-color: #6366f1;
    box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.3);
}
.tab-button.active {
    background-color: #eef2ff;
    border-bottom: 2px solid #6366f1;
    color: #6366f1;
}
.tab-button:hover {
    color: #4f46e5;
}
</style>
@endsection
