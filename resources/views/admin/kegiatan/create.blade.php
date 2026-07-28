@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-3xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[#10453f]">Tambah Kegiatan</h1>
        <a href="{{ route('admin.kegiatan.index') }}" class="text-gray-500 hover:text-gray-700">
            &larr; Kembali
        </a>
    </div>

    <form action="{{ route('admin.kegiatan.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Judul <span class="text-red-500">*</span></label>
            <input type="text" name="judul" value="{{ old('judul') }}" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#10453f] outline-none" 
                   placeholder="Contoh: Pembagian Hadiah Lomba HUT KPRI" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">URL Instagram <span class="text-red-500">*</span></label>
            <input type="url" name="instagram_url" value="{{ old('instagram_url') }}" 
                   placeholder="https://www.instagram.com/p/xxxxx/" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#10453f] outline-none" required>
            <p class="text-xs text-gray-500 mt-1">
                <i class="fas fa-info-circle mr-1"></i>
                Salin link postingan Instagram dan paste di sini
            </p>
            <div class="mt-2 p-3 bg-blue-50 rounded-lg text-sm text-blue-700">
                <i class="fas fa-lightbulb mr-1"></i>
                <strong>Tips:</strong> Buka Instagram → Postingan → ⋮ → Salin Tautan
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Status</label>
            <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#10453f] outline-none">
                <option value="aktif">Aktif</option>
                <option value="tidak_aktif">Tidak Aktif</option>
            </select>
            <p class="text-xs text-gray-500 mt-1">
                <i class="fas fa-info-circle mr-1"></i>
                Status "Aktif" = tampil di halaman publik
            </p>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-[#10453f] text-white px-6 py-2 rounded-lg hover:bg-[#1a6b5f] transition">
                <i class="fas fa-save mr-1"></i> Simpan
            </button>
            <a href="{{ route('admin.kegiatan.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition">
                Batal
            </a>
        </div>
    </form>

    {{-- Preview Instagram --}}
    <div class="mt-8 p-4 bg-gray-50 rounded-lg">
        <p class="text-sm text-gray-500 mb-2">📌 Preview tampilan di website:</p>
        <div class="bg-white rounded-lg shadow p-4 text-center text-gray-400 text-sm">
            <i class="fas fa-instagram text-3xl text-pink-500 mb-2 block"></i>
            Postingan Instagram akan tampil di sini
        </div>
    </div>
</div>
@endsection