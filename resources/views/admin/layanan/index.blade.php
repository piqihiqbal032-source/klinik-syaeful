@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-green-800">Daftar Layanan Medis</h1>
        <a href="{{ route('admin.layanan.create') }}" class="bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800 transition duration-200">
            + Tambah Layanan
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4 border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">Foto</th>
                    <th class="px-4 py-3 text-left">Nama Layanan</th>
                    <th class="px-4 py-3 text-left">Penjaminan (BPJS)</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($layanan as $index => $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                    
                    {{-- Thumbnail Foto --}}
                    <td class="px-4 py-3">
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_layanan }}" class="w-12 h-12 object-cover rounded">
                        @else
                            <span class="text-xs text-gray-400 italic">Tanpa foto</span>
                        @endif
                    </td>

                    {{-- Nama & Slug --}}
                    <td class="px-4 py-3">
                        <div class="font-semibold text-gray-800">{{ $item->nama_layanan }}</div>
                        <div class="text-xs text-gray-500">/layanan/{{ $item->slug }}</div>
                    </td>

                    {{-- Status BPJS --}}
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded text-xs font-semibold 
                            {{ $item->status_bpjs == 'BPJS' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $item->status_bpjs == 'Umum' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $item->status_bpjs == 'BPJS & Umum' ? 'bg-purple-100 text-purple-800' : '' }}">
                            {{ $item->status_bpjs ?? 'BPJS & Umum' }}
                        </span>
                    </td>

                    {{-- Tombol Aksi --}}
                    <td class="px-4 py-3 text-center">
                        <div class="flex justify-center items-center space-x-2">
                            {{-- Ubah $item->id_layanan ke $item->id jika primary key Anda 'id' --}}
                            <a href="{{ route('admin.layanan.edit', $item->id_layanan ?? $item->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs px-3 py-1.5 rounded">
                                Edit
                            </a>
                            <form action="{{ route('admin.layanan.destroy', $item->id_layanan ?? $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1.5 rounded" onclick="return confirm('Yakin ingin menghapus layanan ini?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-6 text-gray-500">Belum ada data layanan medis. Klik tombol di atas untuk menambah.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection