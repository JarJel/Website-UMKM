<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
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
        </div>
      </div>
    </nav>

    <!-- Register Form Container -->
    <div class="flex justify-center items-center min-h-screen py-16">
      <div class="bg-[#42551E] rounded-2xl shadow-2xl p-8 max-w-md w-full">
        <h1 class="pb-6 font-bold text-gray-100 text-3xl text-center cursor-default">
          Daftar
        </h1>

        <form action="{{ route('register.post') }}" method="post" class="space-y-4">
  @csrf

  {{-- Tampilkan error validasi --}}
  @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded-lg">
      <ul class="list-disc pl-5 text-sm">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- Success message --}}
  @if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
      {{ session('success') }}
    </div>
  @endif

  {{-- Field input tetap sama --}}
  <div>
    <label for="nama_pengguna" class="block mb-1 text-gray-200">Username</label>
    <input id="nama_pengguna" name="nama_pengguna" type="text"
      class="border p-2 bg-white text-gray-900 shadow-md placeholder:text-sm
             focus:scale-105 ease-in-out duration-300 border-gray-300 rounded-lg w-full"
      placeholder="Username" value="{{ old('nama_pengguna') }}" required>
  </div>

  <div>
    <label for="email" class="block mb-1 text-gray-200">Email</label>
    <input id="email" name="email" type="email"
      class="border p-2 bg-white text-gray-900 shadow-md placeholder:text-sm
             focus:scale-105 ease-in-out duration-300 border-gray-300 rounded-lg w-full"
      placeholder="Email" value="{{ old('email') }}" required>
  </div>

  <div>
    <label for="kata_sandi" class="block mb-1 text-gray-200">Password</label>
    <input id="kata_sandi" name="kata_sandi" type="password"
      class="border p-2 bg-white text-gray-900 shadow-md placeholder:text-sm
             focus:scale-105 ease-in-out duration-300 border-gray-300 rounded-lg w-full"
      placeholder="Password" required>
  </div>

  <div>
    <label for="kata_sandi_confirmation" class="block mb-1 text-gray-200">Confirm Password</label>
    <input id="kata_sandi_confirmation" name="kata_sandi_confirmation" type="password"
      class="border p-2 bg-white text-gray-900 shadow-md placeholder:text-sm
             focus:scale-105 ease-in-out duration-300 border-gray-300 rounded-lg w-full"
      placeholder="Confirm Password" required>
  </div>

  <button type="submit"
    class="bg-white shadow-lg mt-4 p-2 text-[#42551E] rounded-lg w-full hover:scale-105 transition duration-300 ease-in-out">
    Sign Up
  </button>
</form>


        <!-- Divider -->
        <div class="flex items-center my-4">
          <div class="flex-grow border-t border-gray-300"></div>
          <span class="mx-2 text-gray-200 text-sm">or</span>
          <div class="flex-grow border-t border-gray-300"></div>
        </div>

        <!-- Login with Google -->
        <div class="flex justify-center">
          <a href="{{ url('/auth/google') }}"
            class="flex items-center justify-center gap-2 bg-white text-gray-700 font-medium shadow-md border border-gray-300 rounded-lg py-2 px-4 w-full hover:bg-gray-100 transition">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google Logo" class="w-5 h-5">
            Sign Up with Google
          </a>
        </div>

        <div class="flex flex-col mt-4 items-center justify-center text-sm">
          <h3 class="text-gray-200">
            Already have an account?
            <a href="{{ url('/login/user') }}" class="text-blue-300 hover:underline">Login</a>
          </h3>
        </div>
      </div>
    </div>
  </body>
</html>
  