<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="./output.css" rel="stylesheet" />
    <title>Daftar Seller</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="font-poppins bg-white min-h-screen">

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white border-b-2 border-black shadow-lg rounded-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="w-[175px] h-[100px]">
                    <img src="../../assets/imageInternal/logoBatara.png" class="w-full h-full object-contain">
                </div>
                <div class="relative inline-block group">
                    <a href="{{ url('/login/user') }}"
                    class="flex items-center justify-center space-x-2 text-white bg-[#42551E] px-4 py-2 rounded-lg hover:bg-[#5b7028] transition">
                    <span>Masuk</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>


    <div class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
        <div class="max-w-screen-xl m-0 sm:m-10 bg-[#42551E] shadow sm:rounded-lg flex justify-center flex-1">
            <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
                <div class="flex flex-col items-center">
                    <h1 class="text-2xl xl:text-3xl text-white font-extrabold">
                        Daftar Akun Seller
                    </h1>

                   <form action="{{ route('seller.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- tampilkan error -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
              @endforeach
            </ul>
        </div>
    @endif

    <input type="text" name="nama_pengguna" value="{{ old('nama_pengguna') }}" placeholder="Nama Pengguna" required>
    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="Nama Lengkap">
    <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon') }}" placeholder="Nomor Telepon">
    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>

    <input type="password" name="kata_sandi" placeholder="Password" required>
    <input type="password" name="kata_sandi_confirmation" placeholder="Konfirmasi Password" required>

    <label>Upload KTP (opsional)</label>
    <input type="file" name="ktp">

    <label>Upload SKU (opsional)</label>
    <input type="file" name="sku">

    <button type="submit">Register</button>
</form>

                </div>
            </div>

            <div class="flex-1 bg-white text-center hidden lg:flex">
                <div class="m-12 xl:m-16 w-full bg-contain rounded-lg bg-center bg-no-repeat"
                    style="background-image: url('../../../assets/backRegist/bannerRegist.png');">
                </div>
            </div>
        </div>
    </div>

  </body>
</html>
