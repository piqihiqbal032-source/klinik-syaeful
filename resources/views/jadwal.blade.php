@extends('layouts.app')

@section('title', 'Jadwal Dokter')

@section('content')
<section class="py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-[#000000] text-center mb-8">Jadwal Praktik Dokter</h1>
        <p class="text-[#000000] text-center mb-8">Berikut adalah jadwal praktik dokter di Klinik Syaeful Majid Medika:</p>
        
        <div class="bg-white rounded-lg shadow-lg overflow-hidden p-4">
        
            <!-- TAMPILAN TABEL DI KOMPUTER -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#10453f] text-white">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm">No</th>
                            <th class="px-4 py-3 text-left text-sm">Nama Dokter</th>
                            <th class="px-4 py-3 text-left text-sm">Hari</th>
                            <th class="px-4 py-3 text-left text-sm">Jam</th>
                            <th class="px-4 py-3 text-left text-sm">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwal as $index => $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 text-sm font-medium">{{ $item->nama_dokter }}</td>
                            <td class="px-4 py-3 text-sm">{{ $item->hari_praktik }}</td>
                            <td class="px-4 py-3 text-sm">{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 rounded-full text-xs 
                                    {{ $item->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $item->status }}
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

            <!-- TAMPILAN CARD DI HP -->
            <div class="md:hidden space-y-4">
                @forelse($jadwal as $index => $item)
                <div class="border border-gray-200 rounded-xl p-4 bg-gray-50">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs text-gray-400">No. {{ $index + 1 }}</p>
                            <h4 class="font-bold text-[#10453f] text-base">{{ $item->nama_dokter }}</h4>
                        </div>
                        <span class="px-2 py-1 rounded-full text-xs 
                            {{ $item->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $item->status }}
                        </span>
                    </div>
                    <div class="grid grid-cols-2 gap-2 mt-2 text-sm text-gray-600">
                        <div>
                            <span class="text-gray-400">Hari</span>
                            <p class="font-medium">{{ $item->hari_praktik }}</p>
                        </div>
                        <div>
                            <span class="text-gray-400">Jam</span>
                            <p class="font-medium">{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center text-gray-500 py-4">Belum ada jadwal dokter.</p>
                @endforelse
            </div>
        </div>
     </div>
</section>
@endsection