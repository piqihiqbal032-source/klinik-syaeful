@extends('layouts.app')

@section('title', 'Jadwal Dokter - Klinik Syaeful Majid Medika')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 max-w-5xl">
        
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-[#10453f]">Jadwal Praktik Dokter</h1>
            <p class="text-gray-600 mt-2">Klik nama dokter untuk melihat jadwal lengkap</p>
        </div>

        <!-- ============================================================ -->
        <!-- DAFTAR DOKTER (Card View)                                     -->
        <!-- ============================================================ -->
        @forelse($jadwal as $item)
        <a href="{{ route('jadwal.detail', $item->id_jadwal) }}" class="block">
            <div class="bg-white rounded-xl shadow-md p-4 mb-4 hover:shadow-lg transition hover:-translate-y-1 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <!-- Icon Dokter -->
                        <div class="w-14 h-14 bg-[#10453f]/10 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-md text-[#10453f] text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-[#10453f]">{{ $item->nama_dokter }}</h3>
                            <div class="flex items-center gap-3 text-sm text-gray-500">
                                <span>
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
                                </span>
                                <span class="text-gray-300">|</span>
                                <span>{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        @php
                            $status = 'libur';
                            foreach($item->hari_praktik ?? [] as $s) {
                                if($s == 'aktif') { $status = 'aktif'; break; }
                            }
                        @endphp
                        <span class="px-3 py-1 rounded-full text-sm 
                            {{ $status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ ucfirst($status) }}
                        </span>
                        <span class="text-[#10453f] text-sm font-medium">
                            Detail <i class="fas fa-chevron-right ml-1 text-xs"></i>
                        </span>
                    </div>
                </div>
            </div>
        </a>
        @empty
        <div class="text-center py-12">
            <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500">Belum ada jadwal dokter.</p>
        </div>
        @endforelse

        <!-- Catatan -->
        <p class="text-center text-gray-400 text-sm mt-6">
            ⚠️ Jadwal dapat berubah, hubungi klinik untuk konfirmasi
        </p>

    </div>
</section>
@endsection