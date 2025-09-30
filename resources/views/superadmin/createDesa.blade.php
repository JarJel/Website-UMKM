@extends('superadmin.adminSuper')

@section('title', 'Tambah Desa')

@section('content')
<h2 class="page-title text-2xl sm:text-3xl font-bold mb-6">Tambah Desa</h2>

{{-- Notifikasi --}}
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

<form method="POST" action="{{ route('superadmin.desa.store') }}" class="space-y-6">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-4">
            <h4 class="text-lg font-semibold text-gray-700">Pilih Wilayah & Nama Desa</h4>

            <select id="id_provinsi" name="provinsi_id" class="select w-full" required>
                <option value="" disabled selected>Pilih Provinsi</option>
                @foreach($provinsi as $prov)
                    <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                @endforeach
            </select>

            <select id="id_kabupaten" name="kabupaten_id" class="select w-full" disabled required>
                <option value="" disabled selected>Pilih Kabupaten</option>
            </select>

            <select id="id_kecamatan" name="kecamatan_id" class="select w-full" disabled required>
                <option value="" disabled selected>Pilih Kecamatan</option>
            </select>

            <input type="text" name="nama_desa" placeholder="Nama Desa" value="{{ old('nama_desa') }}" class="input w-full" required>
        </div>
    </div>

    <div class="flex justify-end mt-6">
        <button type="submit" class="btn-primary px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700 transition">
            Tambah Desa
        </button>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const provinsiSelect = document.getElementById('id_provinsi');
    const kabupatenSelect = document.getElementById('id_kabupaten');
    const kecamatanSelect = document.getElementById('id_kecamatan');

    function resetSelect(select, placeholder) {
        select.innerHTML = `<option value="" disabled selected>${placeholder}</option>`;
        select.disabled = true;
    }

    provinsiSelect.addEventListener('change', async function() {
        const provinsiId = this.value;
        resetSelect(kabupatenSelect, 'Memuat Kabupaten...');
        resetSelect(kecamatanSelect, 'Pilih Kecamatan');

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

        if (!kabupatenId) return;

        const response = await fetch(`/wilayah/kecamatan/${kabupatenId}`);
        const data = await response.json();
        kecamatanSelect.innerHTML = `<option value="" disabled selected>Pilih Kecamatan</option>`;
        data.forEach(item => kecamatanSelect.insertAdjacentHTML('beforeend', `<option value="${item.id}">${item.name}</option>`));
        kecamatanSelect.disabled = false;
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
</style>
@endsection
