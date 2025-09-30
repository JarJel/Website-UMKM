<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login BUMDES</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
        <!-- Header -->
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">
            Login BUMDES
        </h2>

        <!-- Alert sukses -->
        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <!-- Alert error -->
        @if ($errors->any())
            <div class="mb-4 p-3 rounded bg-red-100 text-red-700">
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('bumdes.login.submit') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       required autofocus
                       autocomplete="username"
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Kata Sandi -->
            <div>
                <label for="kata_sandi" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                <input type="password" id="kata_sandi" name="kata_sandi"
                       required
                       autocomplete="current-password"
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Tombol -->
            <div>
                <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                    Login
                </button>
            </div>
        </form>
    </div>

</body>
</html>
