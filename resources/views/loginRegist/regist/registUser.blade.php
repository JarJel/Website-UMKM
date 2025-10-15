<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    <style>
      body {
        overflow: hidden;
        height: 100vh;
        font-family: 'Poppins', sans-serif;
        background-image: url('../../assets/BATARA/back-desa.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
      }

      nav {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        backdrop-filter: blur(10px);
        background-color: rgba(255, 255, 255, 0.2);
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        z-index: 50;
      }

      .loading-screen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 20px;
        z-index: 9999;
        animation: fadeOut 0.5s ease-out 1.8s forwards;
      }

      .loader {
        width: 50px;
        height: 50px;
        border: 4px solid #e5e7eb;
        border-top: 4px solid #1d4657;
        border-radius: 50%;
        animation: spin 1s linear infinite;
      }

      .loading-text {
        color: #1d4657;
        font-weight: 600;
        font-size: 16px;
      }

      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }

      @keyframes fadeOut {
        to { opacity: 0; visibility: hidden; }
      }

      .fade-in {
        animation: fadeIn 0.6s ease-out 2s both;
      }

      .slide-up {
        animation: slideUp 0.6s ease-out 2.2s both;
      }

      @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
      }

      @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
      }

      /* Responsive grid for username & email */
      .grid-2col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
      }

      @media (max-width: 640px) {
        .grid-2col {
          grid-template-columns: 1fr;
        }
      }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>

    <!-- Loading Screen -->
    <div class="loading-screen">
      <div class="loader"></div>
      <div class="loading-text">Loading...</div>
    </div>

    <!-- Navbar Transparan -->
    <nav class="fade-in">
      <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
          <div class="w-[155px] h-[80px]">
            <img src="{{ asset('assets/BATARA/3.png') }}" class="w-full h-full object-contain">
          </div>
        </div>
      </div>
    </nav>

    <!-- Register Form -->
    <div class="flex justify-center items-center mt-8" style="height: 100vh;">
      <div class="bg-[#1d4657]/90 rounded-2xl shadow-2xl p-6 max-w-sm w-full mx-4 slide-up">
        <h1 class="pb-4 font-bold text-gray-100 text-2xl text-center cursor-default">
          Daftar
        </h1>

        <!-- Error & Success Messages -->
        @if ($errors->any())
          <div class="mb-3 p-2.5 rounded-lg bg-red-100 text-red-700 text-sm">
              <ul class="list-disc pl-5">
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif

        @if (session('success'))
          <div class="mb-3 p-2.5 rounded-lg bg-green-100 text-green-700 text-sm">
              {{ session('success') }}
          </div>
        @endif

        <!-- Register Form -->
        <form action="{{ route('register.post') }}" method="post" class="space-y-3">
          @csrf

          <!-- Username & Email Horizontal -->
          <div class="grid-2col">
            <div>
              <label for="nama_pengguna" class="block mb-1 text-gray-200 text-sm">Username</label>
              <input id="nama_pengguna" name="nama_pengguna" type="text"
                class="border p-2 bg-white text-gray-900 shadow-md placeholder:text-sm
                       focus:scale-105 ease-in-out duration-300 border-gray-300 rounded-lg w-full"
                placeholder="Username" value="{{ old('nama_pengguna') }}" required>
            </div>

            <div>
              <label for="email" class="block mb-1 text-gray-200 text-sm">Email</label>
              <input id="email" name="email" type="email"
                class="border p-2 bg-white text-gray-900 shadow-md placeholder:text-sm
                       focus:scale-105 ease-in-out duration-300 border-gray-300 rounded-lg w-full"
                placeholder="Email" value="{{ old('email') }}" required>
            </div>
          </div>

          <!-- Password -->
          <div>
            <label for="kata_sandi" class="block mb-1 text-gray-200 text-sm">Kata sandi</label>
            <input id="kata_sandi" name="kata_sandi" type="password"
              class="border p-2 bg-white text-gray-900 shadow-md placeholder:text-sm
                     focus:scale-105 ease-in-out duration-300 border-gray-300 rounded-lg w-full"
              placeholder="Password" required>
          </div>

          <!-- Confirm Password -->
          <div>
            <label for="kata_sandi_confirmation" class="block mb-1 text-gray-200 text-sm">Konfirmasi kata sandi</label>
            <input id="kata_sandi_confirmation" name="kata_sandi_confirmation" type="password"
              class="border p-2 bg-white text-gray-900 shadow-md placeholder:text-sm
                     focus:scale-105 ease-in-out duration-300 border-gray-300 rounded-lg w-full"
              placeholder="Konfirmasi password" required>
          </div>

          <!-- Submit -->
          <button type="submit"
            class="bg-white shadow-lg mt-3 p-2.5 text-[#1d4657] font-semibold rounded-lg w-full hover:scale-105 transition duration-300 ease-in-out">
            Daftar
          </button>

          <!-- Divider -->
          <div class="flex items-center my-3">
            <div class="flex-grow border-t border-gray-300"></div>
            <span class="mx-2 text-gray-200 text-sm">or</span>
            <div class="flex-grow border-t border-gray-300"></div>
          </div>

          <!-- Register with Google -->
          <a href="{{ url('/auth/google') }}"
            class="flex items-center justify-center gap-2 bg-white text-gray-700 font-medium shadow-md border border-gray-300 rounded-lg py-2 px-4 w-full hover:bg-gray-100 transition text-sm">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google Logo" class="w-4 h-4">
            Daftar dengan Google
          </a>
        </form>

        <!-- Login Link -->
        <div class="flex flex-col mt-3 items-center justify-center text-xs">
          <h3 class="text-gray-200">
            Sudah punya akun?
            <a href="{{ url('/login/user') }}" class="text-blue-300 hover:underline">Masuk</a>
          </h3>
        </div>
      </div>
    </div>

  </body>
</html>
