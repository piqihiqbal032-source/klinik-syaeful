@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Tambah Layanan Medis</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.layanan.store') }}" method="POST">
        @csrf

        <!-- NAMA LAYANAN (WAJIB) -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nama Layanan <span class="text-red-500">*</span></label>
            <input type="text" name="nama_layanan" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="Contoh: IGD 24 Jam" required>
        </div>

        <!-- DESKRIPSI (WAJIB) -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Deskripsi <span class="text-red-500">*</span></label>
            <textarea name="deskripsi" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="Deskripsi layanan..." required></textarea>
        </div>

        <!-- STATUS -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Status</label>
            <select name="status_aktif" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                <option value="aktif">Aktif</option>
                <option value="tidak_aktif">Tidak Aktif</option>
            </select>
        </div>

        <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800">
            Simpan
        </button>
        <a href="{{ route('admin.layanan.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 ml-2">Batal</a>
    </form>
</div>
@endsection