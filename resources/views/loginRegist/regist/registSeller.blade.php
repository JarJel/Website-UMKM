<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Form Registrasi Seller</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

  <div class="w-full max-w-2xl bg-white shadow-xl rounded-lg p-8">
    <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Registrasi Seller</h1>

    @if(session('success'))
      <p class="mb-4 text-green-600 text-center">{{ session('success') }}</p>
    @endif

    @if(session('error'))
      <p class="mb-4 text-red-600 text-center">{{ session('error') }}</p>
    @endif

    <form action="{{ route('seller.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
      @csrf

      <!-- Nama Lengkap -->
      <div>
        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}"
               class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        @error('nama_lengkap')
          <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label for="nama_pengguna" class="block text-sm font-medium text-gray-700">Nama Pengguna</label>
        <input type="text" name="nama_pengguna" id="nama_pengguna" value="{{ old('nama_pengguna') }}"
               class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        @error('nama_pengguna')
          <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
      </div>

      <!-- Nomor Telepon -->
      <div>
        <label for="nomor_telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
        <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon') }}"
               class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        @error('nomor_telepon')
          <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
      </div>

      <!-- Nama Toko -->
      <div>
        <label for="nama_toko" class="block text-sm font-medium text-gray-700">Nama Toko</label>
        <input type="text" name="nama_toko" id="nama_toko" value="{{ old('nama_toko') }}"
               class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        @error('nama_toko')
          <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
      </div>

      <!-- Nomor Rekening -->
      <div>
        <label for="nomor_rekening" class="block text-sm font-medium text-gray-700">Nomor Rekening</label>
        <input type="text" name="nomor_rekening" id="nomor_rekening" value="{{ old('nomor_rekening') }}"
               class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        @error('nomor_rekening')
          <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
      </div>

      <!-- Kata Sandi -->
      <div>
        <label for="kata_sandi" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
        <input type="password" name="kata_sandi" id="kata_sandi"
               class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        @error('kata_sandi')
          <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
      </div>

      <!-- Konfirmasi Kata Sandi -->
      <div>
        <label for="kata_sandi_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
        <input type="password" name="kata_sandi_confirmation" id="kata_sandi_confirmation"
               class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
      </div>

      <!-- Upload KTP -->
      <div>
        <label for="ktp" class="block text-sm font-medium text-gray-700">Upload KTP</label>
        <input type="file" name="ktp" id="ktp"
               class="mt-1 w-full px-3 py-2 border rounded-lg bg-white focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        @error('ktp')
          <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
      </div>

      <!-- Upload SKU -->
      <div>
        <label for="sku" class="block text-sm font-medium text-gray-700">Upload SKU</label>
        <input type="file" name="sku" id="sku"
               class="mt-1 w-full px-3 py-2 border rounded-lg bg-white focus:ring-2 focus:ring-indigo-500 focus:outline-none">
        @error('sku')
          <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
      </div>

      <!-- Tombol -->
      <div class="pt-4">
        <button type="submit"
                class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg shadow-md hover:bg-indigo-700 transition">
          Daftar
        </button>
      </div>
    </form>
  </div>

</body>
</html>
