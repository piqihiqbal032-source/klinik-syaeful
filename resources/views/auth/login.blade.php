<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Klinik Syaeful Majid Medika</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-green-700 to-green-500 min-h-screen flex items-center justify-center">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 mx-4">
        <!-- Logo -->
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo-klinik.jpeg') }}" alt="Logo Klinik" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover border-4 border-green-200">
            <h1 class="text-2xl font-bold text-[#10453f]">Login Admin</h1>
            <p class="text-gray-500 text-sm mt-1">Klinik Syaeful Majid Medika</p>
        </div>

        <!-- PESAN ERROR -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-4 border border-red-200">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-4 border border-red-200">
                {{ session('error') }}
            </div>
        @endif

        <!-- FORM LOGIN -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-envelope mr-2 text-[#10453f]"></i> Email
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10453f] focus:border-transparent transition"
                    placeholder="admin@klinik.com">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
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

            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center text-sm text-gray-600">
                    <input type="checkbox" name="remember" class="mr-2 rounded border-gray-300 text-[#10453f] focus:ring-[#10453f]">
                    Remember me
                </label>
                <a href="{{ route('password.request') }}" class="text-sm text-[#10453f] hover:text-[#0d362f]">
                    Lupa Password?
                </a>
            </div>

            <!-- Tombol Login -->
            <button type="submit"
                class="w-full bg-[#10453f] text-white py-3 rounded-lg font-semibold hover:bg-[#0d362f] transition duration-300 transform hover:scale-[1.02]">
                <i class="fas fa-sign-in-alt mr-2"></i> Log In
            </button>
        </form>

        <!-- Link Register -->
        <p class="text-center text-sm text-gray-500 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-[#10453f] hover:text-[#0d362f] font-semibold">Register</a>
        </p>
    </div>

    <!-- JAVASCRIPT SHOW/HIDE PASSWORD -->
    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>