<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Kode OTP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Verifikasi Email Anda</h2>
        <p class="text-gray-500 text-sm mb-6 text-center">
            Masukkan kode OTP yang dikirim ke email <strong>{{ $email }}</strong>
        </p>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('verify.code') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">

            <div>
                <input type="text" name="code" placeholder="Masukkan kode 6 digit" required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('code')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition-colors">
                Verifikasi & Login
            </button>
        </form>
    </div>

</body>
</html>
