@extends('layouts.app')

@section('title', 'Jadwal Dokter - Klinik Syaeful Majid Medika')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-[#10453f]">Jadwal Praktik Dokter</h1>
            <p class="text-gray-600 mt-2">Informasi hari dan jam praktik dokter yang bertugas</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#10453f] text-white">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm">No</th>
                            <th class="px-4 py-3 text-left text-sm">Nama Dokter</th>
                            <th class="px-4 py-3 text-left text-sm">Hari Praktik</th>
                            <th class="px-4 py-3 text-left text-sm">Jam</th>
                            <th class="px-4 py-3 text-left text-sm">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwal as $index => $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-sm font-medium">{{ $item->nama_dokter }}</td>
                            <td class="px-4 py-3 text-sm">
                                @php
                                    $hari = $item->hari_praktik ?? [];
                                    $aktif = [];
                                    foreach($hari as $key => $status) {
                                        if($status == 'aktif') {
                                            $aktif[] = ucfirst($key);
                                        }
                                    }
                                    echo implode(', ', $aktif);
                                @endphp
                            </td>
                            <td class="px-4 py-3 text-sm">{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                            <td class="px-4 py-3 text-sm">
                                @php
                                    $status = 'libur';
                                    foreach($item->hari_praktik ?? [] as $s) {
                                        if($s == 'aktif') { $status = 'aktif'; break; }
                                    }
                                @endphp
                                <span class="px-2 py-1 rounded-full text-xs 
                                    {{ $status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500">Belum ada jadwal dokter.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <p class="text-center text-gray-400 text-sm mt-4">⚠️ Jadwal dapat berubah, hubungi klinik untuk konfirmasi</p>
    </div>
</section>
@endsection