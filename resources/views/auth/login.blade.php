<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Klinik Syaeful Majid Medika</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-white min-h-screen flex items-center justify-center">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 mx-4">
        <!-- Logo -->
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo-klinik.jpeg') }}" alt="Logo Klinik" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover border-4 border-green-200">
            <h1 class="text-2xl font-bold text-[#000000]">Klinik Syaeful Majid Medika</h1>
            <p class="text-[#000000] text-sm mt-1">Login Admin Panel</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-envelope mr-2 text-[#000000]"></i> Email
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-lock mr-2 text-[#10453f]"></i> Password
                </label>
                <div class="relative">
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10453f] focus:border-transparent transition pr-12"
                        placeholder="Masukkan Password Anda">
                    <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-[#10453f]">
                        <i id="eye-icon" class="fas fa-eye"></i>
                    </button>
                </div>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center text-sm text-[#000000]">
                    <input type="checkbox" name="remember" class="mr-2 rounded border-gray-300 text-green-600">
                    Remember me
                </label>
            </div>

            <button type="submit"
                class="w-full bg-[#29a195] text-white py-3 rounded-lg font-semibold hover:bg-green-800 transition">
                <i class="fas fa-sign-in-alt mr-2"></i> Login
            </button>
        </form>

    </div>
    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            
            if (password.type === 'password') {
                // Ubah password menjadi teks (terlihat)
                password.type = 'text';
                // Ubah icon mata menjadi mata dicoret
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                // Ubah password menjadi tersembunyi
                password.type = 'password';
                // Ubah icon mata dicoret menjadi mata biasa
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>