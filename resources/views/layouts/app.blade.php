<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Klinik Syaeful Majid Medika')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- JAVASCRIPT UNTUK TOGGLE MOBILE MENU -->
    <script>
        function toggleMobileMenu() {
            var menu = document.getElementById('mobile-menu');
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
            } else {
                menu.classList.add('hidden');
            }
        }
    </script>
</head>
<body>
    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed w-full z-50">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo-klinik.jpeg') }}" alt="Logo Klinik" class="w-10 h-10 rounded-full object-cover">
                    <div>
                        <h1 class="text-lg font-bold text-green-800">Klinik Syaeful</h1>
                        <p class="text-xs text-gray-500">Majid Medika</p>
                    </div>
                </div>

               <!-- Menu Desktop -->
                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" 
                    class="nav-link text-gray-700 hover:text-green-700 font-medium {{ request()->routeIs('home') ? 'text-green-700 border-b-2 border-green-700' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('profil') }}" 
                    class="nav-link text-gray-700 hover:text-green-700 font-medium {{ request()->routeIs('profil') ? 'text-green-700 border-b-2 border-green-700' : '' }}">
                        Profil Klinik
                    </a>
                    <a href="{{ route('layanan') }}" 
                    class="nav-link text-gray-700 hover:text-green-700 font-medium {{ request()->routeIs('layanan') ? 'text-green-700 border-b-2 border-green-700' : '' }}">
                        Layanan Medis
                    </a>
                    <a href="{{ route('jadwal') }}" 
                    class="nav-link text-gray-700 hover:text-green-700 font-medium {{ request()->routeIs('jadwal') ? 'text-green-700 border-b-2 border-green-700' : '' }}">
                        Jadwal Dokter
                    </a>
                    <a href="{{ route('kontak') }}" 
                    class="nav-link text-gray-700 hover:text-green-700 font-medium {{ request()->routeIs('kontak') ? 'text-green-700 border-b-2 border-green-700' : '' }}">
                        Kontak
                    </a>
                    <a href="{{ route('login') }}" 
                    class="text-green-700 font-semibold {{ request()->routeIs('login') ? 'border-b-2 border-green-700' : '' }}">
                        Admin
                    </a>
                </div>

                <!-- Tombol Mobile (Hamburger) -->
                <button onclick="toggleMobileMenu()" class="md:hidden text-gray-700 text-2xl focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>

            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4 border-t border-gray-100 pt-4">
                <a href="{{ route('home') }}" 
                class="block py-2 {{ request()->routeIs('home') ? 'text-green-700 font-semibold' : 'text-gray-700 hover:text-green-700' }}">
                    Beranda
                </a>
                <a href="{{ route('profil') }}" 
                class="block py-2 {{ request()->routeIs('profil') ? 'text-green-700 font-semibold' : 'text-gray-700 hover:text-green-700' }}">
                    Profil Klinik
                </a>
                <a href="{{ route('layanan') }}" 
                class="block py-2 {{ request()->routeIs('layanan') ? 'text-green-700 font-semibold' : 'text-gray-700 hover:text-green-700' }}">
                    Layanan Medis
                </a>
                <a href="{{ route('jadwal') }}" 
                class="block py-2 {{ request()->routeIs('jadwal') ? 'text-green-700 font-semibold' : 'text-gray-700 hover:text-green-700' }}">
                    Jadwal Dokter
                </a>
                <a href="{{ route('kontak') }}" 
                class="block py-2 {{ request()->routeIs('kontak') ? 'text-green-700 font-semibold' : 'text-gray-700 hover:text-green-700' }}">
                    Kontak
                </a>
                <a href="{{ route('login') }}" 
                class="block py-2 {{ request()->routeIs('login') ? 'text-green-700 font-semibold' : 'text-green-700 hover:text-green-800' }}">
                    Admin
                </a>
            </div>

        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#10453f] text-[#f5fefc] rounded-t-[40px] mt-8 py-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div>
                    <h4 class="font-bold"><i class="fas fa-map-marker-alt mr-2"></i>Alamat</h4>
                    <p class="text-sm opacity-80">RT.03/RW.01, Pesahangan,<br>Kecamatan Cimanggu,<br>Kabupaten Cilacap</p>
                </div>
                <div>
                    <h4 class="font-bold"><i class="fas fa-phone mr-2"></i>Telepon</h4>
                    <p class="text-sm opacity-80">0812-3456-7890</p>
                </div>
                <div>
                    <h4 class="font-bold"><i class="fas fa-envelope mr-2"></i>Email</h4>
                    <p class="text-sm opacity-80">syaefulmajid.medika@gmail.com</p>
                </div>
            </div>
            <div class="border-t border-white/20 mt-6 pt-6 text-center text-sm opacity-60">
                &copy; 2026 Klinik Syaeful Majid Medika. All Rights Reserved.
            </div>
        </div>
    </footer>

</body>
</html>