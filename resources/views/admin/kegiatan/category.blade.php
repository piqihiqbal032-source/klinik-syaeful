@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6 max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[#10453f]">Kelola Kategori Kegiatan</h1>
        <a href="{{ route('admin.kegiatan.index') }}" class="text-gray-500 hover:text-gray-700">&larr; Kembali ke Kegiatan</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">{{ session('success') }}</div>
    @endif

    {{-- Form Tambah Kategori Baru --}}
    <form action="{{ route('admin.categories.store') }}" method="POST" class="bg-gray-50 p-4 rounded-lg mb-6 border">
        @csrf
        <label class="block text-gray-700 font-semibold mb-2">Tambah Kategori Baru</label>
        <div class="flex gap-3">
            <input type="text" name="name" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-[#10453f] outline-none" placeholder="Masukkan nama kategori..." required>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition whitespace-nowrap">
                Simpan
            </button>
        </div>
    </form>

    {{-- List / Tabel Kategori --}}
    <div class="bg-white rounded-lg border overflow-hidden">
        <h2 class="text-lg font-semibold p-4 bg-gray-50 border-b">List Kategori</h2>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b text-gray-600 text-sm">
                    <th class="p-3 w-16">#</th>
                    <th class="p-3">Nama Kategori</th>
                    <th class="p-3">Slug</th>
                    <th class="p-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $index => $category)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $index + 1 }}</td>
                    <td class="p-3 font-medium text-gray-800">{{ $category->name }}</td>
                    <td class="p-3 text-gray-500 text-sm">{{ $category->slug }}</td>
                    <td class="p-3 text-right">
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">Belum ada kategori tersedia.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection