<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Klinik Syaeful Majid Medika</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        }
    </script>
</head>
<body>
    <div class="min-h-screen bg-gray-50 flex">
        
        <!-- ============================================================ -->
        <!-- SIDEBAR KIRI -->
        <!-- ============================================================ -->
        <aside id="sidebar" class="fixed md:relative z-40 w-64 bg-white shadow-lg min-h-screen p-4 flex flex-col border-r border-gray-100 transition-transform duration-300 -translate-x-full md:translate-x-0">
            
            <!-- Logo & Judul -->
            <div class="flex items-center gap-3 mb-8 pb-4 border-b border-gray-100">
                <img src="{{ asset('images/logo-klinik.jpeg') }}" alt="Logo" class="w-10 h-10 rounded-xl object-cover">
                <div>
                    <h1 class="text-lg font-bold text-[#10453f] leading-tight">DASHBOARD</h1>
                    <p class="text-xs text-gray-400">Klinik Syaeful Majid Medika</p>
                </div>
            </div>

            <!-- Menu -->
            <ul class="space-y-1 flex-1">
                <li>
                    <a href="{{ route('admin.dashboard') }}" 
                    class="block px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'text-[#10453f] bg-green-50 border-l-4 border-[#10453f] font-semibold' : 'text-gray-600 hover:text-[#10453f] hover:bg-green-50 transition' }}">
                        <i class="fas fa-home mr-3 w-5 text-center"></i> DASHBOARD
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.profil') }}" 
                    class="block px-4 py-3 rounded-lg {{ request()->routeIs('admin.profil') ? 'text-[#10453f] bg-green-50 border-l-4 border-[#10453f] font-semibold' : 'text-gray-600 hover:text-[#10453f] hover:bg-green-50 transition' }}">
                        <i class="fas fa-building mr-3 w-5 text-center"></i> PROFIL KLINIK
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.layanan.index') }}" 
                    class="block px-4 py-3 rounded-lg {{ request()->routeIs('admin.layanan*') ? 'text-[#10453f] bg-green-50 border-l-4 border-[#10453f] font-semibold' : 'text-gray-600 hover:text-[#10453f] hover:bg-green-50 transition' }}">
                        <i class="fas fa-heartbeat mr-3 w-5 text-center"></i> LAYANAN MEDIS
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.jadwal.index') }}" 
                    class="block px-4 py-3 rounded-lg {{ request()->routeIs('admin.jadwal*') ? 'text-[#10453f] bg-green-50 border-l-4 border-[#10453f] font-semibold' : 'text-gray-600 hover:text-[#10453f] hover:bg-green-50 transition' }}">
                        <i class="fas fa-calendar mr-3 w-5 text-center"></i> JADWAL DOKTER
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kontak.index') }}" 
                    class="block px-4 py-3 rounded-lg {{ request()->routeIs('admin.kontak*') ? 'text-[#10453f] bg-green-50 border-l-4 border-[#10453f] font-semibold' : 'text-gray-600 hover:text-[#10453f] hover:bg-green-50 transition' }}">
                        <i class="fas fa-phone mr-3 w-5 text-center"></i> KONTAK KLINIK
                    </a>
                </li>
            </ul>
            <li>
                <a href="{{ route('admin.admins.index') }}" 
                class="block px-4 py-3 rounded-lg {{ request()->routeIs('admin.admins*') ? 'text-[#10453f] bg-green-50 border-l-4 border-[#10453f] font-semibold' : 'text-gray-600 hover:text-[#10453f] hover:bg-green-50 transition' }}">
                    <i class="fas fa-users-cog mr-3 w-5 text-center"></i> KELOLA ADMIN
                </a>
            </li>

            <!-- Logout -->
            <div class="border-t border-gray-100 pt-4 mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-3 rounded-lg text-red-500 hover:bg-red-50 transition">
                        <i class="fas fa-sign-out-alt mr-3 w-5 text-center"></i> LOGOUT
                    </button>
                </form>
            </div>
        </aside>

        <!-- ============================================================ -->
        <!-- OVERLAY (GELAPKAN LAYAR SAAT SIDEBAR TERBUKA DI HP) -->
        <!-- ============================================================ -->
        <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-30 hidden md:hidden"></div>

        <!-- ============================================================ -->
        <!-- KONTEN UTAMA -->
        <!-- ============================================================ -->
        <main class="flex-1 min-h-screen">
            
            <!-- NAVBAR ATAS (Hanya untuk HP: Logo + Tombol Hamburger) -->
            <nav class="md:hidden bg-[#10453f] text-white shadow-lg sticky top-0 z-20">
                <div class="px-4 py-3 flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo-klinik.jpeg') }}" alt="Logo" class="w-10 h-10 rounded-xl object-cover">
                        <div>
                            <h1 class="text-lg font-bold leading-tight">DASHBOARD</h1>
                            <p class="text-xs text-green-200">Klinik Syaeful Majid Medika</p>
                        </div>
                    </div>
                    <button onclick="toggleSidebar()" class="text-white text-2xl focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </nav>

            <!-- ISI KONTEN -->
            <div class="p-4 md:p-8 max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>

    </div>

    <!-- JAVASCRIPT UNTUK OVERLAY -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            // Saat sidebar muncul, overlay muncul
            // Saat sidebar sembunyi, overlay sembunyi
            const observer = new MutationObserver(function() {
                if (sidebar.classList.contains('-translate-x-full')) {
                    overlay.classList.add('hidden');
                } else {
                    overlay.classList.remove('hidden');
                }
            });
            observer.observe(sidebar, { attributes: true, attributeFilter: ['class'] });
        });
    </script>
</body>
</html>