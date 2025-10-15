<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Buka Toko Seller - Batara</title>
    <link rel="icon" href="{{ asset('storage/BATARA/4.png') }}" type="image/png">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        'batara-dark-blue': '#1D4567',
                        'batara-lime': '#B2D852',
                        'batara-teal': '#14B8A6',
                    },
                },
            },
        };
    </script>
</head>
<body class="font-poppins bg-gray-100 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white border-b-2 border-gray-200 shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="w-28 md:w-44 h-full flex-shrink-0">
                    <img src="{{ asset('assets/BATARA/3.png') }}" class="w-full h-full object-contain" alt="Logo Batara">
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Form -->
    <main class="flex flex-1 items-center justify-center p-4 sm:p-6 md:p-8">
        <div class="w-full max-w-4xl mx-auto bg-batara-dark-blue rounded-2xl shadow-2xl p-6 sm:p-8">

            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-white mb-3">Buka Toko Seller</h1>
                <p class="text-batara-lime text-lg font-medium">Bergabunglah dengan komunitas seller terpercaya</p>
                <div class="w-24 h-1 bg-batara-lime mx-auto mt-4 rounded-full"></div>
            </div>

            <!-- Notifikasi -->
            @if (session('success'))
                <div class="mb-6 p-4 rounded-lg bg-green-100 border border-green-300 text-green-800">
                    ✅ {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 rounded-lg bg-red-100 border border-red-300 text-red-800">
                    ❌ {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-100 border border-red-300 text-red-800">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="list-disc pl-5 mt-2 space-y-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('seller.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
              @csrf

                <!-- Grid Form -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Informasi Akun -->
                    <div class="space-y-6">
                        <h2 class="text-xl font-semibold text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-batara-lime" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Informasi Akun
                        </h2>
                        <div class="space-y-4">
                            <div>
                                <label for="nama_pengguna" class="block mb-1 text-gray-200 text-base">Username</label>
                                <input id="nama_pengguna" class="border p-2 bg-gray-100 text-gray-500 shadow-md border-gray-300 rounded-lg w-full cursor-not-allowed" 
                                       type="text" name="nama_pengguna" value="{{ $user->nama_pengguna }}" readonly disabled />
                            </div>
                            <div>
                                <label for="email" class="block mb-1 text-gray-200 text-base">Email</label>
                                <input id="email" class="border p-2 bg-gray-100 text-gray-500 shadow-md border-gray-300 rounded-lg w-full cursor-not-allowed" 
                                       type="email" name="email" value="{{ $user->email }}" readonly disabled />
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Toko & Dokumen -->
                    <div class="space-y-6">
                        <h2 class="text-xl font-semibold text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-batara-lime" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            Informasi Toko
                        </h2>
                        <div class="space-y-4">
                            <div>
                                <label for="nama_toko" class="block mb-1 text-gray-200 text-base">Nama Toko <span class="text-red-400">*</span></label>
                                <input id="nama_toko" class="border p-2 bg-white text-gray-900 shadow-md placeholder:text-sm focus:scale-105 ease-in-out duration-300 border-gray-300 rounded-lg w-full" 
                                       type="text" name="nama_toko" placeholder="Masukkan nama toko yang menarik..." required />
                                <div id="error-nama_toko" class="mt-2 text-red-400 text-sm hidden">Nama toko tidak boleh kosong.</div>
                            </div>
                            <div>
                                <label for="nomor_telepon" class="block mb-1 text-gray-200 text-base">Nomor Telepon <span class="text-red-400">*</span></label>
                                <div class="relative">
                                    <input id="nomor_telepon" class="border p-2 pl-14 bg-white text-gray-900 shadow-md placeholder:text-sm focus:scale-105 ease-in-out duration-300 border-gray-300 rounded-lg w-full" 
                                           type="tel" name="nomor_telepon" placeholder="81234567890" required />
                                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-batara-teal font-medium">+62</div>
                                </div>
                                <div id="error-nomor_telepon" class="mt-2 text-red-400 text-sm hidden">Nomor telepon tidak valid.</div>
                            </div>
                        </div>

                        <!-- Dokumen Persyaratan -->
                        <h2 class="text-xl font-semibold text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-batara-lime" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Dokumen Persyaratan
                        </h2>
                        <div class="space-y-4">
                            <div>
                                <label for="ktp" class="block mb-1 text-gray-200 text-base">Dokumen KTP <span class="text-red-400">*</span></label>
                                <input id="ktp" class="border p-2 bg-white text-gray-900 shadow-md border-gray-300 rounded-lg w-full 
                                              file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:font-semibold 
                                              file:bg-batara-lime file:text-batara-dark-blue hover:file:bg-opacity-80 file:cursor-pointer" 
                                       type="file" name="ktp" accept="image/*" required />
                                <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG (maks 2MB)</p>
                                <div id="error-ktp" class="mt-2 text-red-400 text-sm hidden">File KTP wajib diupload.</div>
                            </div>
                            <div>
                                <label for="sku" class="block mb-1 text-gray-200 text-base">Dokumen SKU <span class="text-red-400">*</span></label>
                                <input id="sku" class="border p-2 bg-white text-gray-900 shadow-md border-gray-300 rounded-lg w-full 
                                              file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-sm file:font-semibold 
                                              file:bg-batara-lime file:text-batara-dark-blue hover:file:bg-opacity-80 file:cursor-pointer" 
                                       type="file" name="sku" accept="image/*" required />
                                <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG (maks 2MB)</p>
                                <div id="error-sku" class="mt-2 text-red-400 text-sm hidden">File SKU wajib diupload.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Lokasi -->
                    <div class="space-y-6 lg:col-span-2">
                        <h2 class="text-xl font-semibold text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-batara-lime" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Informasi Lokasi
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="id_provinsi" class="block mb-1 text-gray-200 text-base">Provinsi <span class="text-red-400">*</span></label>
                                <select id="id_provinsi" name="id_provinsi" class="border p-2 bg-white text-gray-900 shadow-md focus:scale-105 ease-in-out duration-300 border-gray-300 rounded-lg w-full" required>
                                    <option value="" disabled selected>Pilih Provinsi</option>
                                    @foreach($provinsis as $provinsi)
                                        <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="id_kabupaten" class="block mb-1 text-gray-200 text-base">Kabupaten <span class="text-red-400">*</span></label>
                                <select id="id_kabupaten" name="id_kabupaten" class="border p-2 bg-white text-gray-900 shadow-md focus:scale-105 ease-in-out duration-300 border-gray-300 rounded-lg w-full" disabled required>
                                    <option value="" disabled selected>Pilih Kabupaten</option>
                                </select>
                            </div>
                            <div>
                                <label for="id_kecamatan" class="block mb-1 text-gray-200 text-base">Kecamatan <span class="text-red-400">*</span></label>
                                <select id="id_kecamatan" name="id_kecamatan" class="border p-2 bg-white text-gray-900 shadow-md focus:scale-105 ease-in-out duration-300 border-gray-300 rounded-lg w-full" disabled required>
                                    <option value="" disabled selected>Pilih Kecamatan</option>
                                </select>
                            </div>
                            <div>
                                <label for="id_desa" class="block mb-1 text-gray-200 text-base">Desa <span class="text-red-400">*</span></label>
                                <select id="id_desa" name="id_desa" class="border p-2 bg-white text-gray-900 shadow-md focus:scale-105 ease-in-out duration-300 border-gray-300 rounded-lg w-full" disabled required>
                                    <option value="" disabled selected>Pilih Desa</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label for="id_bumdes" class="block mb-1 text-gray-200 text-base">Bumdes <span class="text-gray-400">(Opsional)</span></label>
                                <select id="id_bumdes" name="id_bumdes" class="border p-2 bg-white text-gray-900 shadow-md focus:scale-105 ease-in-out duration-300 border-gray-300 rounded-lg w-full" disabled>
                                    <option value="" disabled selected>Pilih Bumdes</option>
                                </select>
                                <div id="bumdes-status" class="mt-2 text-xs text-gray-400">
                                    Pilih desa untuk melihat Bumdes yang tersedia
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-8 text-center">
                    <button class="bg-white shadow-lg p-3 text-batara-dark-blue font-semibold rounded-lg w-full max-w-md hover:scale-105 transition duration-300 ease-in-out" type="submit">
                        <span class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            Daftarkan Toko Sekarang
                        </span>
                    </button>
                    <p class="mt-4 text-sm text-gray-300">
                        Dengan mendaftar, Anda menyetujui 
                        <a href="#" class="text-batara-lime hover:underline font-medium">Syarat dan Ketentuan</a> 
                        serta 
                        <a href="#" class="text-batara-lime hover:underline font-medium">Kebijakan Privasi</a>
                        kami
                    </p>
                </div>
            </form>
        </div>
    </main>

    <!-- Script Dynamic Dropdown -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const provinsiSelect = document.getElementById('id_provinsi');
            const kabupatenSelect = document.getElementById('id_kabupaten');
            const kecamatanSelect = document.getElementById('id_kecamatan');
            const desaSelect = document.getElementById('id_desa');
            const bumdesSelect = document.getElementById('id_bumdes');
            const bumdesStatus = document.getElementById('bumdes-status');

            function resetSelect(select, placeholder) {
                select.innerHTML = `<option value="" disabled selected>${placeholder}</option>`;
                select.disabled = true;
            }

            function updateBumdesStatus(message) {
                bumdesStatus.innerHTML = message;
            }

            provinsiSelect.addEventListener('change', async function () {
                const provinsiId = this.value;
                resetSelect(kabupatenSelect, 'Memuat Kabupaten...');
                resetSelect(kecamatanSelect, 'Pilih Kecamatan');
                resetSelect(desaSelect, 'Pilih Desa');
                resetSelect(bumdesSelect, 'Pilih Bumdes');
                updateBumdesStatus('Pilih desa untuk melihat Bumdes yang tersedia');

                if (!provinsiId) return;
                try {
                    const response = await fetch(`/wilayah/kabupaten/${provinsiId}`);
                    const data = await response.json();
                    kabupatenSelect.innerHTML = `<option value="" disabled selected>Pilih Kabupaten</option>`;
                    data.forEach(item => kabupatenSelect.insertAdjacentHTML('beforeend', `<option value="${item.id}">${item.name}</option>`));
                    kabupatenSelect.disabled = false;
                } catch (err) {
                    console.error(err);
                    resetSelect(kabupatenSelect, 'Gagal memuat');
                }
            });

            kabupatenSelect.addEventListener('change', async function () {
                const kabupatenId = this.value;
                resetSelect(kecamatanSelect, 'Memuat Kecamatan...');
                resetSelect(desaSelect, 'Pilih Desa');
                resetSelect(bumdesSelect, 'Pilih Bumdes');
                updateBumdesStatus('Pilih desa untuk melihat Bumdes yang tersedia');

                if (!kabupatenId) return;
                try {
                    const response = await fetch(`/wilayah/kecamatan/${kabupatenId}`);
                    const data = await response.json();
                    kecamatanSelect.innerHTML = `<option value="" disabled selected>Pilih Kecamatan</option>`;
                    data.forEach(item => kecamatanSelect.insertAdjacentHTML('beforeend', `<option value="${item.id}">${item.name}</option>`));
                    kecamatanSelect.disabled = false;
                } catch (err) {
                    console.error(err);
                    resetSelect(kecamatanSelect, 'Gagal memuat');
                }
            });

            kecamatanSelect.addEventListener('change', async function () {
                const kecamatanId = this.value;
                resetSelect(desaSelect, 'Memuat Desa...');
                resetSelect(bumdesSelect, 'Pilih Bumdes');
                updateBumdesStatus('Pilih desa untuk melihat Bumdes yang tersedia');

                if (!kecamatanId) return;
                try {
                    const response = await fetch(`/wilayah/desa/${kecamatanId}`);
                    const data = await response.json();
                    desaSelect.innerHTML = `<option value="" disabled selected>Pilih Desa</option>`;
                    data.forEach(item => desaSelect.insertAdjacentHTML('beforeend', `<option value="${item.id}">${item.name}</option>`));
                    desaSelect.disabled = false;
                } catch (err) {
                    console.error(err);
                    resetSelect(desaSelect, 'Gagal memuat');
                }
            });

            desaSelect.addEventListener('change', async function () {
                const desaId = this.value;
                resetSelect(bumdesSelect, 'Memuat Bumdes...');
                updateBumdesStatus('Mencari Bumdes...');

                if (!desaId) return;
                try {
                    const response = await fetch(`/wilayah/bumdes/${desaId}`);
                    const data = await response.json();
                    bumdesSelect.innerHTML = `<option value="" disabled selected>Pilih Bumdes</option>`;
                    if (data.length > 0) {
                        data.forEach(item => bumdesSelect.insertAdjacentHTML('beforeend', `<option value="${item.id_bumdes}">${item.nama_bumdes}</option>`));
                        bumdesSelect.disabled = false;
                        updateBumdesStatus('<span class="text-green-600">Bumdes ditemukan!</span>');
                    } else {
                        resetSelect(bumdesSelect, 'Tidak ada Bumdes');
                        updateBumdesStatus('<span class="text-yellow-600">Tidak ada Bumdes di desa ini.</span>');
                    }
                } catch (err) {
                    console.error(err);
                    resetSelect(bumdesSelect, 'Gagal memuat');
                    updateBumdesStatus('<span class="text-red-600">Gagal memuat Bumdes.</span>');
                }
            });
        });
    </script>
</body>
</html>
