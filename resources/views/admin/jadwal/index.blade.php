@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-green-800">Daftar Jadwal Dokter</h1>
        <a href="{{ route('admin.jadwal.create') }}" class="bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800">
            + Tambah Jadwal
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">Nama Dokter</th>
                    <th class="px-4 py-2 text-left">Hari</th>
                    <th class="px-4 py-2 text-left">Jam</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwal as $index => $item)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                    <td class="px-4 py-2">{{ $item->nama_dokter }}</td>
                    <td class="px-4 py-2">{{ $item->hari_praktik }}</td>
                    <td class="px-4 py-2">{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded text-sm {{ $item->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td class="px-4 py-2">
                        <a href="{{ route('admin.jadwal.edit', $item->id_jadwal) }}" class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
                        <form action="{{ route('admin.jadwal.destroy', $item->id_jadwal) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection