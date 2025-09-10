<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="./output.css" rel="stylesheet" />
    <title>Login</title>
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
                    <button
                    class="flex items-center justify-center space-x-2 text-white bg-[#42551E] px-4 py-2 rounded-lg hover:bg-[#5b7028] transition">
                    <span>Sign in</span>
                    </button>
                </div>
            </div>
        </div>
    </nav>


    <div class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
        <div class="max-w-screen-xl m-0 sm:m-10 bg-[#42551E] shadow sm:rounded-lg flex justify-center flex-1">
            <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
                <div class=" flex flex-col items-center">
                    <h1 class="text-2xl xl:text-3xl text-white font-extrabold">
                        Daftar Akun BUMDES
                    </h1>
                        <div class="mx-auto max-w-xs py-4">
                            <div class="mb-4 md:flex md:justify-between">
                                <div class="mb-4 md:mr-2 md:mb-0">
                                    <label class="block mb-2 text-sm font-bold text-white" for="firstName">
                                        Nama Depan
                                    </label>
                                    <input
                                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                        id="firstName"
                                        type="text"
                                        placeholder="First Name"
                                    />
                                </div>
                                <div class="md:ml-2">
                                    <label class="block mb-2 text-sm font-bold text-white" for="lastName">
                                        Nama Belakang
                                    </label>
                                    <input
                                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                        id="lastName"
                                        type="text"
                                        placeholder="Last Name"
                                    />
                                </div>
                            </div>
                            <div class="mb-4 md:flex md:justify-between">
                                <div class="mb-4 md:mr-2 md:mb-0">
                                    <label class="block mb-2 text-sm font-bold text-white" for="namaToko">
                                        Nama Toko
                                    </label>
                                    <input
                                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                        id="namaToko"
                                        type="text"
                                        placeholder="Nama Toko"
                                    />
                                </div>
                                <div class="md:ml-2">
                                    <label class="block mb-2 text-sm font-bold text-white" for="alamatToko">
                                        Alamat Toko
                                    </label>
                                    <input
                                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                        id="alamatToko"
                                        type="text"
                                        placeholder="Alamat Toko"
                                    />
                                </div>
                            </div>
                            <div class="mb-4 md:flex md:justify-between">
                                <div class="mb-4 md:mr-2 md:mb-0">
                                    <label class="block mb-2 text-sm font-bold text-white" for="desa">
                                        Desa
                                    </label>
                                    <input
                                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                        id="desa"
                                        type="text"
                                        placeholder="desa"
                                    />
                                </div>
                                <div class="md:ml-2">
                                    <label class="block mb-2 text-sm font-bold text-white" for="rekening">
                                        No Rekening
                                    </label>
                                    <input
                                    class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                    id="rekening"
                                    type="text"
                                    placeholder="Nomor Rekening"
                                    />
                                </div>
                            </div>
                            <div class="flex flex-col md:flex-row md:space-x-4">
                                <div class="flex-1 mb-4 md:mb-0">
                                    <label for="ktp" class="block mb-2 text-sm font-bold text-gray-100">Dokumen KTP</label>
                                    <input type="file" id="ktp" name="ktp" class="hidden"
                                            onchange="document.getElementById('ktp-text').innerText = this.files[0]?.name || 'No file chosen';">
                                    <label for="ktp"
                                            class="cursor-pointer inline-block px-4 py-2 rounded-full bg-white text-black font-semibold hover:bg-[#5b7028] hover:text-white">
                                        Pilih File
                                    </label>
                                    <p id="ktp-text" class="text-xs text-gray-300 mt-1">No file chosen</p>
                                </div>
                                <div class="flex-1">
                                    <label for="sku" class="block mb-2 text-sm font-bold text-gray-100">Dokumen SKU</label>
                                    <input type="file" id="sku" name="sku" class="hidden"
                                        onchange="document.getElementById('sku-text').innerText = this.files[0]?.name || 'No file chosen';">
                                    <label for="sku"
                                        class="cursor-pointer inline-block px-4 py-2 rounded-full bg-white text-black font-semibold hover:bg-[#5b7028] hover:text-white">
                                    Pilih File
                                    </label>
                                    <p id="sku-text" class="text-xs text-gray-300 mt-1">No file chosen</p>
                                </div>
                            </div>
                            <div class="flex flex-col md:flex-row md:space-x-4">
                                <div class="flex-1 mb-4 md:mb-0">
                                    <label for="ktp" class="block mb-2 text-sm font-bold text-gray-100">Dokumen KTP</label>
                                    <input type="file" id="ktp" name="ktp" class="hidden"
                                            onchange="document.getElementById('ktp-text').innerText = this.files[0]?.name || 'No file chosen';">
                                    <label for="ktp"
                                            class="cursor-pointer inline-block px-4 py-2 rounded-full bg-white text-black font-semibold hover:bg-[#5b7028] hover:text-white">
                                        Pilih File
                                    </label>
                                    <p id="ktp-text" class="text-xs text-gray-300 mt-1">No file chosen</p>
                                </div>
                            </div>
                            <input
                                class="w-full px-4 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                type="email" placeholder="Email" />
                            <input
                                class="w-full px-4 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                type="password" placeholder="Password" />

                            <div class="mt-4 text-center">
                                <div
                                    class="leading-none px-2 inline-block text-sm text-white tracking-wide font-medium transform translate-y-1/2">
                                    Or sign up with
                                </div>
                            </div>

                            <div class="w-full flex-1 mt-8">
                                <div class="flex flex-col items-center">
                                    <button
                                        class="w-full max-w-xs font-bold shadow-sm rounded-lg py-3 bg-white text-gray-800 flex items-center justify-center transition-all duration-300 ease-in-out focus:outline-none hover:shadow focus:shadow-sm focus:shadow-outline">
                                        <div class="bg-white p-2 rounded-full">
                                            <svg class="w-4" viewBox="0 0 533.5 544.3">
                                                <path
                                                    d="M533.5 278.4c0-18.5-1.5-37.1-4.7-55.3H272.1v104.8h147c-6.1 33.8-25.7 63.7-54.4 82.7v68h87.7c51.5-47.4 81.1-117.4 81.1-200.2z"
                                                    fill="#4285f4" />
                                                <path
                                                    d="M272.1 544.3c73.4 0 135.3-24.1 180.4-65.7l-87.7-68c-24.4 16.6-55.9 26-92.6 26-71 0-131.2-47.9-152.8-112.3H28.9v70.1c46.2 91.9 140.3 149.9 243.2 149.9z"
                                                    fill="#34a853" />
                                                <path
                                                    d="M119.3 324.3c-11.4-33.8-11.4-70.4 0-104.2V150H28.9c-38.6 76.9-38.6 167.5 0 244.4l90.4-70.1z"
                                                    fill="#fbbc04" />
                                                <path
                                                    d="M272.1 107.7c38.8-.6 76.3 14 104.4 40.8l77.7-77.7C405 24.6 339.7-.8 272.1 0 169.2 0 75.1 58 28.9 150l90.4 70.1c21.5-64.5 81.8-112.4 152.8-112.4z"
                                                    fill="#ea4335" />
                                            </svg>
                                        </div>
                                        <span class="ml-4">
                                            Sign Up with Google
                                        </span>
                                    </button>
                                </div>
                            <button
                                class="mt-5 tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-4 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                                <svg class="w-6 h-6 -ml-2" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                    <circle cx="8.5" cy="7" r="4" />
                                    <path d="M20 8v6M23 11h-6" />
                                </svg>
                                <span class="ml-3">
                                    Sign Up
                                </span>
                            </button>
                            <p class="mt-2 text-xs text-white text-center">
                                Already have an account?
                                <a href="#" class=" text-blue-500 border-b border-blue-500 border-dotted">
                                    Sign in
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-1 bg-white text-center hidden lg:flex">
                <div class="m-12 xl:m-16 w-full bg-contain rounded-lg bg-center bg-no-repeat"
                    style="background-image: url('../../../assets/backRegist/bannerRegistBumDes.png');">
                </div>
            </div>
        </div>
    </div>
  </body>
</html>
