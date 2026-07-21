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

        <!-- SEJARAH SINGKAT -->       
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Sejarah Singkat</label>
            <textarea name="sejarah_singkat" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ $profil->sejarah_singkat ?? '' }}</textarea>
        </div>

        <!-- VISI -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Visi</label>
            <textarea name="visi" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ old('visi', $profil->visi ?? '') }}</textarea>
        </div>

        <!-- MISI -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Misi</label>
            <textarea name="misi" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ old('misi', $profil->misi ?? '') }}</textarea>
            <p class="text-xs text-gray-400 mt-1">Pisahkan setiap misi dengan tanda enter (baris baru)</p>
        </div>

        <!-- MOTO  -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Moto Klinik</label>
            <input type="text" name="moto" value="{{ $profil->moto ?? '' }}" 
                class="w-full border border-gray-300 rounded-lg px-4 py-2" 
                placeholder="Melayani dengan hati, mengobati dengan ilmu">
            <p class="text-xs text-gray-400 mt-1">Slogan atau moto klinik</p>
        </div>

        <!-- TUJUAN  -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Tujuan Klinik</label>
            <textarea name="tujuan" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2" 
                    placeholder="Tujuan didirikannya klinik...">{{ $profil->tujuan ?? '' }}</textarea>
            <p class="text-xs text-gray-400 mt-1">Tujuan utama didirikannya klinik</p>
        </div>

       <!-- STRUKTUR ORGANISASI -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Struktur Organisasi</label>
            <p class="text-xs text-gray-400 mb-2">Klik "Tambah Baris" untuk menambah jabatan. Klik "Hapus" untuk menghapus baris.</p>
            
            <div id="struktur-container">
                @php
                    $struktur = [];
                    if (!empty($profil->struktur_organisasi)) {
                        $struktur = explode("\n", trim($profil->struktur_organisasi));
                    }
                    if (empty($struktur) || (count($struktur) == 1 && empty($struktur[0]))) {
                        $struktur = ['Ketua Yayasan: KH. Syaeful Majid Darkino', 'Kepala Klinik: Dr. [Nama Dokter]', 'Koordinator Admin: Amelia Kusniawati'];
                    }
                @endphp
                
                @foreach($struktur as $index => $item)
        <div class="struktur-item flex items-center gap-2 mb-2">
            <input type="text" name="struktur[]" value="{{ trim($item) }}" 
                   class="flex-1 border border-gray-300 rounded-lg px-4 py-2" 
                   placeholder="Jabatan: Nama">
            <button type="button" onclick="hapusStruktur(this)" 
                    class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600">
                <i class="fas fa-trash"></i>
            </button>
        </div>
        @endforeach
        </div>
                <button type="button" onclick="tambahStruktur()" 
                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 mt-2">
                <i class="fas fa-plus mr-2"></i> Tambah Baris
            </button>
        </div>
    
        <!-- TOMBOL SIMPAN -->
        <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800">
            Simpan Perubahan
        </button>
    </form>
</div>

<!-- JAVASCRIPT UNTUK TAMBAH & HAPUS STRUKTUR -->

<script>
    function tambahStruktur() {
        const container = document.getElementById('struktur-container');
        const newItem = document.createElement('div');
        newItem.className = 'struktur-item flex items-center gap-2 mb-2';
        newItem.innerHTML = `
            <input type="text" name="struktur[]" class="flex-1 border border-gray-300 rounded-lg px-4 py-2" placeholder="Jabatan: Nama">
            <button type="button" onclick="hapusStruktur(this)" class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600">
                <i class="fas fa-trash"></i>
            </button>
        `;
        container.appendChild(newItem);
    }

    function hapusStruktur(button) {
        const item = button.closest('.struktur-item');
        if (document.querySelectorAll('.struktur-item').length > 1) {
            item.remove();
        } else {
            alert('Minimal harus ada 1 baris struktur organisasi.');
        }
    }
</script>
@endsection