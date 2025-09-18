<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Registrasi Seller</title>
</head>
<body>
    <h1>Registrasi Seller</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif

    <form action="{{ route('seller.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="nama_lengkap">Nama Lengkap</label><br>
            <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}">
            @error('nama_lengkap')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="nama_pengguna">Nama Pengguna</label><br>
            <input type="text" name="nama_pengguna" id="nama_pengguna" value="{{ old('nama_pengguna') }}">
            @error('nama_pengguna')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
            @error('email')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="kata_sandi">Kata Sandi</label><br>
            <input type="password" name="kata_sandi" id="kata_sandi">
            @error('kata_sandi')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="kata_sandi_confirmation">Konfirmasi Kata Sandi</label><br>
            <input type="password" name="kata_sandi_confirmation" id="kata_sandi_confirmation">
        </div>

        <div>
            <label for="nomor_telepon">Nomor Telepon</label><br>
            <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon') }}">
            @error('nomor_telepon')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="nama_toko">Nama Toko</label><br>
            <input type="text" name="nama_toko" id="nama_toko" value="{{ old('nama_toko') }}">
            @error('nama_toko')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="nomor_rekening">Nomor Rekening</label><br>
            <input type="text" name="nomor_rekening" id="nomor_rekening" value="{{ old('nomor_rekening') }}">
            @error('nomor_rekening')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="ktp">Upload KTP</label><br>
            <input type="file" name="ktp" id="ktp">
            @error('ktp')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="sku">Upload SKU</label><br>
            <input type="file" name="sku" id="sku">
            @error('sku')
                <p style="color:red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <button type="submit">Daftar</button>
        </div>
    </form>
</body>
</html>
