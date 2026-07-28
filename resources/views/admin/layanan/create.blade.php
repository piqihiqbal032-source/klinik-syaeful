@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h1 class="text-2xl font-bold text-green-800">Tambah Layanan Medis</h1>
        <a href="{{ route('admin.layanan.index') }}" class="text-gray-600 hover:text-gray-800 text-sm">
            &larr; Kembali ke Daftar
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
            <!-- NAMA LAYANAN (WAJIB) -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Nama Layanan <span class="text-red-500">*</span></label>
                <input type="text" name="nama_layanan" value="{{ old('nama_layanan') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 outline-none" placeholder="Contoh: Poli Gigi / Bedah Minor" required>
            </div>

            <!-- STATUS BPJS / PENJAMINAN -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Penjaminan / BPJS <span class="text-red-500">*</span></label>
                <select name="status_bpjs" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 outline-none">
                    <option value="BPJS & Umum" {{ old('status_bpjs') == 'BPJS & Umum' ? 'selected' : '' }}>BPJS & Umum</option>
                    <option value="BPJS" {{ old('status_bpjs') == 'BPJS' ? 'selected' : '' }}>Hanya BPJS</option>
                    <option value="Umum" {{ old('status_bpjs') == 'Umum' ? 'selected' : '' }}>Pasien Umum</option>
                </select>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Deskripsi <span class="text-red-500">*</span></label>
            <textarea name="deskripsi" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 outline-none" placeholder="Deskripsi lengkap layanan..." required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- UPLOAD FOTO LAYANAN -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Foto Layanan / Fasilitas</label>
            <input type="file" name="foto" class="w-full border border-gray-300 rounded-lg p-2 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
            <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG (Maksimal 2MB)</p>
        </div>

        <!-- DESKRIPSI SINGKAT (UNTUK CARD DEPAN) -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Deskripsi Singkat</label>
            <textarea name="deskripsi_singkat" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 outline-none" placeholder="Ringkasan singkat untuk kartu tampilan di halaman beranda...">{{ old('deskripsi_singkat') }}</textarea>
        </div>

        <!-- DESKRIPSI LENGKAP / PROSEDUR -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Deskripsi Lengkap & Prosedur Medis</label>
            <textarea name="deskripsi_lengkap" id="deskripsi_lengkap" rows="5" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 outline-none" placeholder="Penjelasan lengkap mengenai tindakan medis, jam operasional, dll...">{{ old('deskripsi_lengkap') }}</textarea>
        </div>

        <!-- PERSYARATAN PASIEN -->
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Persyaratan / Persiapan Pasien</label>
            <textarea name="persyaratan" id="persyaratan" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 outline-none" placeholder="Contoh: Membawa Kartu BPJS & KTP, Berpuasa 8 jam sebelum tindakan, dll...">{{ old('persyaratan') }}</textarea>
        </div>

        <!-- TOMBOL SIMPAN -->
        <div class="flex items-center">
            <button type="submit" class="bg-green-700 text-white px-6 py-2.5 rounded-lg hover:bg-green-800 transition duration-200 font-medium">
                Simpan Layanan
            </button>
            <a href="{{ route('admin.layanan.index') }}" class="bg-gray-500 text-white px-6 py-2.5 rounded-lg hover:bg-gray-600 ml-3 transition duration-200 font-medium">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection