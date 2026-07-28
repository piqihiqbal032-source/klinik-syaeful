@extends('layouts.app')

@section('title', 'Jadwal Dokter - Klinik Syaeful Majid Medika')

@section('content')
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-[#10453f]">Jadwal Praktik Dokter</h1>
            <p class="text-gray-600 mt-2">Klik nama dokter untuk melihat jadwal lengkap</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse($jadwals as $item)
            <a href="{{ route('jadwal.detail', $item->id_jadwal) }}" class="block">
                <div class="bg-white rounded-xl shadow-md p-4 hover:shadow-lg transition hover:-translate-y-1 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-[#10453f]/10 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-md text-[#10453f] text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-[#10453f]">{{ $item->nama_dokter }}</h3>
                                <div class="flex items-center gap-2 text-sm text-gray-500">
                                  <span>
                                        @php
                                            // Ambil data hari_praktik
                                            $hariData = $item->hari_praktik;
                                            
                                            // Jika masih string, decode jadi array
                                            if (is_string($hariData)) {
                                                $hariData = json_decode($hariData, true);
                                            }
                                            
                                            // Jika bukan array, gunakan array kosong
                                            if (!is_array($hariData)) {
                                                $hariData = [];
                                            }
                                            
                                            // Cari hari yang aktif
                                            $aktif = [];
                                            $namaHari = [
                                                'senin' => 'Senin',
                                                'selasa' => 'Selasa',
                                                'rabu' => 'Rabu',
                                                'kamis' => 'Kamis',
                                                'jumat' => 'Jumat',
                                                'sabtu' => 'Sabtu',
                                                'minggu' => 'Minggu'
                                            ];
                                            
                                            foreach($hariData as $key => $status) {
                                                if($status == 'aktif' || $status === true || $status == '1') {
                                                    $aktif[] = $namaHari[$key] ?? ucfirst($key);
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
                                $hariData = $item->hari_praktik;
                                
                                // Decode jika masih string
                                if (is_string($hariData)) {
                                    $hariData = json_decode($hariData, true);
                                }
                                
                                if (is_array($hariData)) {
                                    foreach($hariData as $s) {
                                        if($s == 'aktif' || $s === true || $s == '1') { 
                                            $status = 'aktif'; 
                                            break; 
                                        }
                                    }
                                }
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs 
                                {{ $status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($status) }}
                            </span>
                            <i class="fas fa-chevron-right text-[#10453f] text-sm"></i>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-2 text-center py-12">
                <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">Belum ada jadwal dokter.</p>
            </div>
            @endforelse
        </div>

        <p class="text-center text-gray-400 text-sm mt-6">⚠️ Jadwal dapat berubah, hubungi klinik untuk konfirmasi</p>
    </div>
</section>
@endsection