@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-[#10453f]">Kelola Kegiatan</h1>
        <a href="{{ route('admin.kegiatan.create') }}" class="bg-[#10453f] text-white px-4 py-2 rounded-lg hover:bg-[#1a6b5f] transition">
            <i class="fas fa-plus mr-1"></i> Tambah Kegiatan
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    @if($kegiatans->count() > 0)
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50">
                    <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase">#</th>
                    <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase">Judul</th>
                    <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase">URL Instagram</th>
                    <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                    <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase">Dibuat</th>
                    <th class="p-3 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kegiatans as $kegiatan)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3 text-sm">{{ $loop->iteration }}</td>
                    <td class="p-3 text-sm font-medium">{{ $kegiatan->judul }}</td>
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
                    <td class="p-3 text-sm text-gray-500">{{ $kegiatan->created_at->format('d M Y') }}</td>
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
    <div class="text-center py-12">
        <i class="fas fa-newspaper text-6xl text-gray-300 mb-4"></i>
        <p class="text-gray-500">Belum ada kegiatan.</p>
        <a href="{{ route('admin.kegiatan.create') }}" class="text-[#10453f] hover:underline mt-2 inline-block">
            Tambah kegiatan pertama
        </a>
    </div>
    @endif
</div>
@endsection