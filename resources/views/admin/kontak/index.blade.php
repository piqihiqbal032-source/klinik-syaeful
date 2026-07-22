@extends('layouts.admin')

<div class="bg-white rounded-lg shadow-lg p-6">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Edit Kontak Klinik</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="color: red; background: #f8d7da; padding: 10px; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kontak.update', $kontak->id_kontak ?? 1) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- ALAMAT -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Alamat Lengkap</label>
            <textarea name="alamat_lengkap" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>{{ $kontak->alamat_lengkap ?? '' }}</textarea>
        </div>

        <!-- TELEPON -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nomor Telepon</label>
            <input type="text" name="nomor_telepon" value="{{ $kontak->nomor_telepon ?? '' }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>

        <!-- EMAIL -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" name="email" value="{{ $kontak->email ?? '' }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>

        <!-- ============================================================ -->
        <!-- MEDIA SOSIAL -->
        <!-- ============================================================ -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Media Sosial</label>
            <p class="text-xs text-gray-400 mb-2">Isi link atau kosongkan untuk menyembunyikan icon</p>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Instagram -->
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-pink-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fab fa-instagram text-white"></i>
                    </div>
                    <input type="url" name="instagram" value="{{ $kontak->instagram ?? '' }}" 
                           class="flex-1 border border-gray-300 rounded-lg px-3 py-2" 
                           placeholder="https://instagram.com/...">
                </div>

                <!-- Facebook -->
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fab fa-facebook-f text-white"></i>
                    </div>
                    <input type="url" name="facebook" value="{{ $kontak->facebook ?? '' }}" 
                           class="flex-1 border border-gray-300 rounded-lg px-3 py-2" 
                           placeholder="https://facebook.com/...">
                </div>

                <!-- Twitter -->
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-black rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fab fa-x-twitter text-white"></i>
                    </div>
                    <input type="url" name="twitter" value="{{ $kontak->twitter ?? '' }}" 
                           class="flex-1 border border-gray-300 rounded-lg px-3 py-2" 
                           placeholder="https://twitter.com/...">
                </div>

                <!-- YouTube -->
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fab fa-youtube text-white"></i>
                    </div>
                    <input type="url" name="youtube" value="{{ $kontak->youtube ?? '' }}" 
                           class="flex-1 border border-gray-300 rounded-lg px-3 py-2" 
                           placeholder="https://youtube.com/...">
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-2">Kosongkan link jika tidak ingin menampilkan icon tersebut</p>
        </div>

        <!-- LINK MAP -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Link Peta Google Maps</label>
            <textarea name="link_peta" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-2" 
                    placeholder="https://www.google.com/maps/embed?pb=...">{{ $kontak->link_peta ?? '' }}</textarea>
            <p class="text-xs text-gray-400 mt-1">Masukkan link embed dari Google Maps (tanpa tanda kutip)</p>
        </div>

        <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection