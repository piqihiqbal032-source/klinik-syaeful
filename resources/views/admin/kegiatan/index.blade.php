@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-[#10453f]">Kelola Kegiatan & Berita</h1>
        <div class="flex gap-2">
            <a href="{{ route('admin.categories.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                + Kategori
            </a>
            <a href="{{ route('admin.kegiatan.create') }}" class="bg-[#10453f] text-white px-4 py-2 rounded-lg hover:bg-[#1a6b5f] transition">
                <i class="fas fa-plus mr-1"></i> Tambah Kegiatan
            </a>
        </div>
    </div>
    
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    {{-- Perulangan Berdasarkan Kategori (Kotak Terpisah / Contoh Index 1) --}}
    @foreach($categories as $category)
    <div class="mb-8 border border-gray-200 rounded-xl overflow-hidden shadow-sm">
        
        {{-- Header Kotak Kategori (Misal: Berita / Promosi) --}}
        <div class="bg-[#10453f] text-white px-6 py-3 flex justify-between items-center">
            <h2 class="text-lg font-bold uppercase tracking-wider">
                <i class="fas fa-folder-open mr-2"></i> Kategori: {{ $category->name }}
            </h2>
            <span class="bg-white text-[#10453f] text-xs font-bold px-2.5 py-1 rounded-full">
                {{ $category->kegiatans->count() }} Postingan
            </span>
        </div>

        {{-- Tabel Data di Dalam Kotak Kategori Tersebut --}}
        <div class="p-4 bg-white">
            @if($category->kegiatans->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b">
                            <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase">#</th>
                            <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase">Judul</th>
                            <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase">URL Instagram</th>
                            <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                            <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase">Dibuat</th>
                            <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category->kegiatans as $index => $kegiatan)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-3 text-sm">{{ $index + 1 }}</td>
                            <td class="p-3 text-sm font-medium text-gray-800">{{ $kegiatan->judul }}</td>
                            <td class="p-3 text-sm">
                                <a href="{{ $kegiatan->instagram_url }}" target="_blank" class="text-blue-600 hover:underline">
                                    <i class="fab fa-instagram mr-1"></i> Lihat Postingan
                                </a>
                            </td>
                            <td class="p-3">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    {{ $kegiatan->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($kegiatan->status) }}
                                </span>
                            </td>
                            <td class="p-3 text-sm text-gray-500">
                                {{ $kegiatan->created_at ? $kegiatan->created_at->format('d M Y') : '-' }}
                            </td>
                            <td class="p-3">
                                <a href="{{ route('admin.kegiatan.edit', $kegiatan->id) }}" 
                                   class="text-blue-600 hover:text-blue-800 mr-2 text-sm">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.kegiatan.destroy', $kegiatan->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm" 
                                            onclick="return confirm('Yakin hapus kegiatan ini?')">
                                        <i class="fas fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-gray-400 italic text-sm py-4 text-center">Belum ada postingan untuk kategori "{{ $category->name }}".</p>
            @endif
        </div>

    </div>
    @endforeach

</div>
@endsection