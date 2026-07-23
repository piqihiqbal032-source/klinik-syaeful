@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-green-800">Daftar Jadwal Dokter</h1>
        <a href="{{ route('admin.jadwal.create') }}" class="bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800 font-semibold">
            + Tambah Jadwal
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4 border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Nama Dokter</th>
                    <th class="px-4 py-3">Hari Praktik</th>
                    <th class="px-4 py-3">Jam</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Catatan / Kendala</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwal as $index => $item)
                <tr class="border-b hover:bg-gray-50">
                    <!-- 1. NO -->
                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                    
                    <!-- 2. NAMA DOKTER -->
                    <td class="px-4 py-3 font-semibold text-gray-800">{{ $item->nama_dokter }}</td>
                    
                    <!-- 3. HARI PRAKTIK -->
                    <td class="px-4 py-3">
                        @php
                            $hari = $item->hari_praktik ?? [];
                            // Jika data berupa JSON string, ubah ke array
                            if(is_string($hari)) {
                                $hari = json_decode($hari, true) ?? [];
                            }
                            
                            $aktif = [];
                            if(is_array($hari)) {
                                foreach($hari as $key => $status) {
                                    if($status == 'aktif' || $status == '1' || $status === true) {
                                        $aktif[] = ucfirst($key);
                                    }
                                }
                                echo implode(', ', $aktif);
                            } else {
                                echo $item->hari_praktik;
                            }
                        @endphp
                    </td>
                    
                    <!-- 4. JAM -->
                    <td class="px-4 py-3 whitespace-nowrap">{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                    
                    <!-- 5. STATUS -->
                    <td class="px-4 py-3">
                        @if(($item->status ?? 'aktif') == 'aktif')
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-1 rounded-full border border-green-300">
                                🟢 Aktif
                            </span>
                        @elseif(($item->status ?? '') == 'libur')
                            <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-1 rounded-full border border-red-300">
                                🔴 Libur / Cuti
                            </span>
                        @else
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-1 rounded-full border border-yellow-300">
                                🟡 Ada Kendala
                            </span>
                        @endif
                    </td>

                    <!-- 6. CATATAN / KENDALA -->
                    <td class="px-4 py-3 text-sm text-gray-600 max-w-xs">
                        {{ $item->catatan ?? '-' }}
                    </td>

                    <!-- 7. AKSI -->
                    <td class="px-4 py-3 text-center whitespace-nowrap">
                        <a href="{{ route('admin.jadwal.edit', $item->id_jadwal) }}" class="text-blue-600 hover:text-blue-800 font-medium mr-3">Edit</a>
                        <form action="{{ route('admin.jadwal.destroy', $item->id_jadwal) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection