<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Link Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-4">Reset Password</h2>
        <p class="text-center text-gray-500 text-sm mb-6">Masukkan email Anda untuk menerima link reset password.</p>

        <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition-colors">
                Kirim Link Reset Password
            </button>
        </form>
    </div>

</body>
</html>
