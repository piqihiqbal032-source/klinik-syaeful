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

       <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Struktur Organisasi</label>
            <p class="text-xs text-gray-500 mb-2">Klik "Tambah Baris" untuk menambah jabatan. Klik "Hapus" untuk menghapus baris.</p>

            <!-- Container tempat baris-baris input muncul -->
            <div id="struktur-container" class="space-y-2 mb-3">
                @php
                    // Mengubah data JSON dari database menjadi Array
                    $strukturData = json_decode($profil->struktur_organisasi ?? '[]', true);
                    if(!is_array($strukturData) && !empty($profil->struktur_organisasi)) {
                        // Jika data lama masih berupa teks biasa (bukan JSON)
                        $strukturData = explode("\n", $profil->struktur_organisasi);
                    }
                @endphp

                @forelse($strukturData as $item)
                    <div class="flex items-center space-x-2 struktur-row">
                        <input type="text" name="struktur_organisasi[]" value="{{ is_array($item) ? ($item['jabatan'] ?? '') : $item }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="Contoh: Perawat : Nama Perawat">
                        <button type="button" class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600 remove-row">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                @empty
                    <div class="flex items-center space-x-2 struktur-row">
                        <input type="text" name="struktur_organisasi[]" value="" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="Contoh: Kepala Klinik : Dr. Syaeful">
                        <button type="button" class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600 remove-row">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                @endforelse
            </div>

            <!-- Tombol Tambah Baris -->
            <button type="button" id="add-struktur-btn" class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 flex items-center text-sm font-semibold">
                <span class="mr-1">+</span> Tambah Baris
            </button>
        </div>

        <!-- JavaScript untuk Tambah & Hapus Baris -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const container = document.getElementById('struktur-container');
                const addBtn = document.getElementById('add-struktur-btn');

                // Fungsi Tambah Baris Baru
                addBtn.addEventListener('click', function () {
                    const newRow = document.createElement('div');
                    newRow.className = 'flex items-center space-x-2 struktur-row';
                    newRow.innerHTML = `
                        <input type="text" name="struktur_organisasi[]" value="" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="Jabatan : Nama">
                        <button type="button" class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600 remove-row">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    `;
                    container.appendChild(newRow);
                });

                // Fungsi Hapus Baris
                container.addEventListener('click', function (e) {
                    if (e.target.closest('.remove-row')) {
                        const rows = container.querySelectorAll('.struktur-row');
                        if (rows.length > 1) {
                            e.target.closest('.struktur-row').remove();
                        } else {
                            alert('Minimal harus ada 1 baris!');
                        }
                    }
                });
            });
        </script>

        <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection