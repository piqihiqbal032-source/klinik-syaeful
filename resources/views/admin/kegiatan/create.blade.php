@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-3xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[#10453f]">Tambah Kegiatan</h1>
        <a href="{{ route('admin.kegiatan.index') }}" class="text-gray-500 hover:text-gray-700">
            &larr; Kembali
        </a>
    </div>

    {{-- TAG <FORM> DIBUKA DI SINI AGAR SEMUA INPUT DI DALAMNYA IKUT TERKIRIM --}}
    <form action="{{ route('admin.kegiatan.store') }}" method="POST">
        @csrf

        {{-- Pilihan Kategori + Tombol Buat Baru --}}
        <div class="form-group mb-4">
            <label for="category_id" class="block font-semibold mb-2">Kategori <span class="text-red-500">*</span></label>
            <div class="flex gap-2">
                <select name="category_id" id="category_select" class="form-control w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#10453f] outline-none" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="button" onclick="toggleCategoryModal()" class="bg-green-600 text-white px-4 py-2 rounded-lg whitespace-nowrap hover:bg-green-700 transition">
                    + Buat Baru
                </button>
            </div>
        </div>

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
    {{-- PENUTUP FORM UTAMA --}}

    {{-- Preview Instagram --}}
    <div class="mt-8 p-4 bg-gray-50 rounded-lg">
        <p class="text-sm text-gray-500 mb-2">📌 Preview tampilan di website:</p>
        <div class="bg-white rounded-lg shadow p-4 text-center text-gray-400 text-sm">
            <i class="fas fa-instagram text-3xl text-pink-500 mb-2 block"></i>
            Postingan Instagram akan tampil di sini
        </div>
    </div>
</div>

<!-- Modal / Kotak Tambah Kategori Cepat -->
<div id="categoryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg w-96 shadow-lg">
        <h3 class="text-lg font-bold mb-4">Buat Kategori Baru</h3>
        
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Nama Kategori</label>
            <input type="text" id="new_category_name" class="w-full border border-gray-300 p-2 rounded outline-none focus:ring-2 focus:ring-[#10453f]" placeholder="Contoh: Pengumuman">
        </div>

        <div class="flex justify-end space-x-2">
            <button type="button" onclick="toggleCategoryModal()" class="bg-gray-400 text-white px-3 py-1 rounded hover:bg-gray-500">Batal</button>
            <button type="button" onclick="saveNewCategory()" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Simpan</button>
        </div>
    </div>
</div>

<!-- JavaScript Sederhana untuk Modal dan Ajax Simpan Kategori -->
<script>
function toggleCategoryModal() {
    const modal = document.getElementById('categoryModal');
    modal.classList.toggle('hidden');
}

function saveNewCategory() {
    const name = document.getElementById('new_category_name').value;
    if (!name) {
        alert('Nama kategori tidak boleh kosong!');
        return;
    }

    fetch("{{ route('admin.categories.store') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ name: name })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            const select = document.getElementById('category_select');
            const option = document.createElement('option');
            option.value = data.category.id;
            option.text = data.category.name;
            option.selected = true;
            select.appendChild(option);

            document.getElementById('new_category_name').value = '';
            toggleCategoryModal();
        } else {
            alert('Gagal menyimpan kategori');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan sistem.');
    });
}
</script>
@endsection