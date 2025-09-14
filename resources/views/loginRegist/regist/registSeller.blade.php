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

                    <form action="{{ route('registerSeller') }}" method="POST" enctype="multipart/form-data" class="mx-auto max-w-xs py-4 w-full">
                        @csrf

                        <div class="mb-4 md:flex md:justify-between">
                            <div class="mb-4 md:mr-2 md:mb-0">
                                <label class="block mb-2 text-sm font-bold text-white">Nama Pengguna</label>
                                <input name="nama_pengguna" type="text" placeholder="Username"
                                    class="w-full px-3 py-2 text-sm border rounded shadow appearance-none focus:outline-none focus:shadow-outline" required />
                            </div>
                            <div class="md:ml-2">
                                <label class="block mb-2 text-sm font-bold text-white">Nama Lengkap</label>
                                <input name="nama_lengkap" type="text" placeholder="Nama Lengkap"
                                    class="w-full px-3 py-2 text-sm border rounded shadow appearance-none focus:outline-none focus:shadow-outline" />
                            </div>
                        </div>

                        <div class="mb-4 md:flex md:justify-between">
                            <div class="mb-4 md:mr-2 md:mb-0">
                                <label class="block mb-2 text-sm font-bold text-white">Nomor Telepon</label>
                                <input name="nomor_telepon" type="text" placeholder="Nomor Telepon"
                                    class="w-full px-3 py-2 text-sm border rounded shadow appearance-none focus:outline-none focus:shadow-outline" />
                            </div>
                            <div class="md:ml-2">
                                <label class="block mb-2 text-sm font-bold text-white">No Rekening</label>
                                <input name="no_rekening" type="text" placeholder="Nomor Rekening"
                                    class="w-full px-3 py-2 text-sm border rounded shadow appearance-none focus:outline-none focus:shadow-outline" required />
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-white">Email</label>
                            <input name="email" type="email" placeholder="Email"
                                class="w-full px-3 py-2 text-sm border rounded shadow appearance-none focus:outline-none focus:shadow-outline" required />
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-white">Password</label>
                            <input name="kata_sandi" type="password" placeholder="Password"
                                class="w-full px-3 py-2 text-sm border rounded shadow appearance-none focus:outline-none focus:shadow-outline" required />
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-white">Konfirmasi Password</label>
                            <input name="kata_sandi_confirmation" type="password" placeholder="Konfirmasi Password"
                                class="w-full px-3 py-2 text-sm border rounded shadow appearance-none focus:outline-none focus:shadow-outline" required />
                        </div>

                        <div class="flex flex-col md:flex-row md:space-x-4">
                            <div class="flex-1 mb-4 md:mb-0">
                                <label for="ktp" class="block mb-2 text-sm font-bold text-gray-100">Dokumen KTP</label>
                                <input type="file" id="ktp" name="ktp" class="w-full text-sm text-gray-300" required>
                            </div>
                            <div class="flex-1">
                                <label for="sku" class="block mb-2 text-sm font-bold text-gray-100">Dokumen SKU</label>
                                <input type="file" id="sku" name="sku" class="w-full text-sm text-gray-300" required>
                            </div>
                        </div>

                        <button type="submit"
                            class="mt-6 tracking-wide font-semibold bg-indigo-500 text-white w-full py-3 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center">
                            <svg class="w-6 h-6 -ml-2" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                <circle cx="8.5" cy="7" r="4" />
                                <path d="M20 8v6M23 11h-6" />
                            </svg>
                            <span class="ml-3">Sign Up</span>
                        </button>

                        <p class="mt-2 text-xs text-white text-center">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-blue-500 border-b border-blue-500 border-dotted">
                                Sign in
                            </a>
                        </p>
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
