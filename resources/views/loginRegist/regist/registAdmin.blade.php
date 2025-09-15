<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="./output.css" rel="stylesheet" />
  <title>Registrasi BUMDes</title>
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
          <button
            class="flex items-center justify-center space-x-2 text-white bg-[#42551E] px-4 py-2 rounded-lg hover:bg-[#5b7028] transition">
            <span>Sign in</span>
          </button>
        </div>
      </div>
    </div>
  </nav>

  <!-- Container -->
  <div class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
    <div class="max-w-screen-xl m-0 sm:m-10 bg-[#42551E] shadow sm:rounded-lg flex justify-center flex-1">
      <div class="lg:w-1/2 xl:w-7/12 p-6 sm:p-12">
        <div class="flex flex-col items-center">
          <h1 class="text-2xl xl:text-3xl text-white font-extrabold mb-6">
            Daftar Akun BUMDes
          </h1>

          <form action="{{ route('registBumdes') }}" class="mx-auto w-full grid grid-cols-1 md:grid-cols-2 gap-6" method="POST" enctype="multipart/form-data">
            <!-- Kolom 1 -->
             @csrf
            <div>
              <label class="block mb-2 text-sm font-bold text-white">Nama BUMDes</label>
              <input name="nama_bumdes" type="text" placeholder="Nama BUMDes"
                class="w-full px-3 py-2 border rounded shadow focus:outline-none" required />
            </div>

            <div>
              <label class="block mb-2 text-sm font-bold text-white">Kata Sandi</label>
              <input name="kata_sandi" type="password" placeholder="Password"
                class="w-full px-3 py-2 border rounded shadow focus:outline-none" required />
            </div>

            <div>
              <label class="block mb-2 text-sm font-bold text-white">Deskripsi</label>
              <textarea name="deskripsi" placeholder="Deskripsi singkat BUMDes"
                class="w-full px-3 py-2 border rounded shadow focus:outline-none"></textarea>
            </div>

            <div>
              <label class="block mb-2 text-sm font-bold text-white">Alamat BUMDes</label>
              <input name="alamat_bumdes" type="text" placeholder="Alamat lengkap"
                class="w-full px-3 py-2 border rounded shadow focus:outline-none" />
            </div>

            <div>
              <label class="block mb-2 text-sm font-bold text-white">Nomor Telepon</label>
              <input name="nomor_telepon" type="text" placeholder="08xxxx"
                class="w-full px-3 py-2 border rounded shadow focus:outline-none" />
            </div>

            <div>
              <label class="block mb-2 text-sm font-bold text-white">Email</label>
              <input name="email" type="email" placeholder="Email"
                class="w-full px-3 py-2 border rounded shadow focus:outline-none" required />
            </div>

            <div>
              <label class="block mb-2 text-sm font-bold text-white">Nomor Rekening</label>
              <input name="nomor_rekening" type="text" placeholder="Rekening"
                class="w-full px-3 py-2 border rounded shadow focus:outline-none" />
            </div>

            <div>
              <label class="block mb-2 text-sm font-bold text-white">Logo BUMDes</label>
              <input name="logo" type="file"
                class="w-full px-3 py-2 border rounded shadow focus:outline-none" />
            </div>

            <div>
              <label class="block mb-2 text-sm font-bold text-white">Dokumen KTP</label>
              <input name="ktp" type="file"
                class="w-full px-3 py-2 border rounded shadow focus:outline-none" />
            </div>

            <div>
              <label class="block mb-2 text-sm font-bold text-white">Dokumen SKU</label>
              <input name="sku" type="file"
                class="w-full px-3 py-2 border rounded shadow focus:outline-none" />
            </div>

            <!-- Tombol Daftar -->
            <div class="md:col-span-2">
              <button type="submit"
                class="mt-5 tracking-wide font-semibold bg-indigo-500 text-white w-full py-3 rounded-lg hover:bg-indigo-700 transition-all">
                Daftar BUMDes
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Gambar samping -->
      <div class="flex-1 bg-white text-center hidden lg:flex">
        <div class="m-12 xl:m-16 w-full bg-contain rounded-lg bg-center bg-no-repeat"
          style="background-image: url('../../../assets/backRegist/bannerRegistBumDes.png');">
        </div>
      </div>
    </div>
  </div>
</body>
</html>
