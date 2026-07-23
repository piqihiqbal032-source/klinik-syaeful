@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Edit Profil Klinik</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.profil.update', $profil->id_profil ?? 1) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- SEJARAH -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Sejarah Singkat</label>
            <textarea name="sejarah_singkat" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ $profil->sejarah_singkat ?? '' }}</textarea>
        </div>

        <!-- VISI -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Visi</label>
            <textarea name="visi" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ $profil->visi ?? '' }}</textarea>
        </div>

        <!-- MISI -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Misi</label>
            <textarea name="misi" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ $profil->misi ?? '' }}</textarea>
            <p class="text-xs text-gray-500 mt-1">Pisahkan setiap misi dengan tanda enter (baris baru)</p>
        </div>

        <!-- MOTO -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Moto Klinik</label>
            <input type="text" name="moto" value="{{ $profil->moto ?? '' }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>

        <!-- TUJUAN -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Tujuan Klinik</label>
            <textarea name="tujuan" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ $profil->tujuan ?? '' }}</textarea>
        </div>

        <!-- STRUKTUR ORGANISASI (BAGIAN DINAMIS) -->
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Struktur Organisasi</label>
            <p class="text-xs text-gray-500 mb-2">Klik "Tambah Baris" untuk menambah jabatan. Klik "Hapus" untuk menghapus baris.</p>

            <div id="struktur-container" class="space-y-2 mb-3">
                @php
                    $rawStruktur = $profil->struktur_organisasi ?? '';
                    $strukturData = json_decode($rawStruktur, true);
                    if (!is_array($strukturData) && !empty($rawStruktur)) {
                        $strukturData = array_map('trim', explode("\n", $rawStruktur));
                    }
                @endphp

                @if(!empty($strukturData) && is_array($strukturData))
                    @foreach($strukturData as $item)
                        @if(!empty(trim($item)))
                            <div class="flex items-center space-x-2 struktur-row">
                                <input type="text" name="struktur_organisasi[]" value="{{ $item }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="Jabatan : Nama">
                                <button type="button" class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600 remove-row">
                                    🗑️
                                </button>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="flex items-center space-x-2 struktur-row">
                        <input type="text" name="struktur_organisasi[]" value="" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="Jabatan : Nama">
                        <button type="button" class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600 remove-row">
                            🗑️
                        </button>
                    </div>
                @endif
            </div>

            <button type="button" id="add-struktur-btn" class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 font-semibold text-sm">
                + Tambah Baris
            </button>
        </div>

        <!-- TOMBOL SIMPAN HARUS BERADA DI DALAM TAG FORM -->
        <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800 font-semibold">
            Simpan Perubahan
        </button>
    </form>
</div>

<!-- JAVASCRIPT UNTUK TAMBAH & HAPUS BARIS -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('struktur-container');
        const addBtn = document.getElementById('add-struktur-btn');

        if (addBtn && container) {
            addBtn.addEventListener('click', function () {
                const newRow = document.createElement('div');
                newRow.className = 'flex items-center space-x-2 struktur-row';
                // PASTIKAN name="struktur_organisasi[]" ADA DI INPUT BARU INI
                newRow.innerHTML = `
                    <input type="text" name="struktur_organisasi[]" value="" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="Jabatan : Nama">
                    <button type="button" class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600 remove-row">
                        🗑️
                    </button>
                `;
                container.appendChild(newRow);
            });

            container.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-row') || e.target.closest('.remove-row')) {
                    const rows = container.querySelectorAll('.struktur-row');
                    if (rows.length > 1) {
                        e.target.closest('.struktur-row').remove();
                    } else {
                        alert('Minimal harus ada 1 baris!');
                    }
                }
            });
        }
    });
</script>
@endsection