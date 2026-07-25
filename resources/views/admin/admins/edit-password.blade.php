<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Password Admin - Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen font-sans text-slate-800">

    <div class="max-w-2xl mx-auto px-4 py-8">
        
        <!-- Header & Navigasi Kembali -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Ubah Password Admin</h1>
                <p class="text-sm text-slate-500 mt-1">Perbarui password keamanan untuk akun ini.</p>
            </div>
            <a href="{{ route('admin.admins.index') }}" 
                class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 transition shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-6 md:p-8">
            
            <!-- Ringkasan Info Akun Admin -->
            <div class="flex items-center space-x-4 bg-slate-50 border border-slate-200 p-4 rounded-xl mb-6">
                <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-full flex items-center justify-center font-bold text-lg">
                    {{ strtoupper(substr($admin->name, 0, 1)) }}
                </div>
                <div>
                    <h3 class="font-semibold text-slate-800">{{ $admin->name }}</h3>
                    <p class="text-xs text-slate-500">{{ $admin->email }}</p>
                    <span class="inline-block mt-1 text-[10px] font-medium px-2 py-0.5 rounded {{ $admin->is_master ? 'bg-amber-100 text-amber-700' : 'bg-slate-200 text-slate-700' }}">
                        {{ $admin->is_master ? 'Master Admin' : 'Admin Biasa' }}
                    </span>
                </div>
            </div>

            <!-- Alert Pesan Error Umum -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                    <div class="font-semibold mb-1">Terjadi kesalahan:</div>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.admins.update-password', $admin->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Input Password Baru -->
                <div>
                    <label for="new_password" class="block text-sm font-medium text-slate-700 mb-1">
                        Password Baru <span class="text-red-500">*</span>
                    </label>
                    <input type="password" id="new_password" name="new_password" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition @error('new_password') border-red-500 @enderror"
                        placeholder="Masukkan password baru (minimal 6 karakter)">
                    @error('new_password')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konfirmasi Password Baru -->
                <div>
                    <label for="new_password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">
                        Konfirmasi Password Baru <span class="text-red-500">*</span>
                    </label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" required
                        class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white transition"
                        placeholder="Ulangi password baru di atas">
                </div>

                <!-- Tombol Aksi -->
                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-slate-100">
                    <a href="{{ route('admin.admins.index') }}" 
                        class="px-5 py-2.5 rounded-lg border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50 transition">
                        Batal
                    </a>
                    <button type="submit" 
                        class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition">
                        Update Password
                    </button>
                </div>

            </form>
        </div>

    </div>

</body>
</html>