<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Reset Password Baru</h2>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div>
                <input type="password" name="password" placeholder="Password baru" required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>

            <div>
                <input type="password" name="password_confirmation" placeholder="Konfirmasi password" required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>

            <button type="submit"
                    class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-2 rounded-lg transition-colors">
                Reset Password
            </button>
        </form>
    </div>

</body>
</html>
