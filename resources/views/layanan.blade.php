@extends('layouts.app')

@section('title', 'Layanan Medis Klinik Syaeful Majid Medika')

@section('content')
<!-- Header Layanan -->
<section class="bg-gradient-to-br from-[#10453f] to-[#1a6b5f] text-white py-16 rounded-b-[60px] mx-4 shadow-2xl">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Layanan Medis Klinik Syaeful Majid Medika</h1>
        <p class="text-lg md:text-xl text-[#f5fefc]/80">Berikut adalah layanan kesehatan yang tersedia di klinik kami</p>
        <div class="w-24 h-1 bg-white/50 mx-auto mt-4 rounded-full"></div>
    </div>
</section>

<!-- Daftar Layanan - GRID 3 KOLOM -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            
            @foreach($layanans as $item)
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition duration-300 hover:-translate-y-2 flex flex-col justify-between overflow-hidden">
                
                <div>
                    
                    <div class="w-20 h-20 bg-[#10453f]/10 rounded-2xl flex items-center justify-center mx-auto mt-6 mb-2">
                        @php
                            $icons = [
                                'IGD 24 Jam' => 'fa-truck-medical',
                                'Rawat Jalan' => 'fa-stethoscope',
                                'Rawat Inap' => 'fa-bed-pulse',
                                'Laboratorium' => 'fa-flask',
                                'EKG' => 'fa-heartbeat',
                                'KB Suntik & Implan' => 'fa-syringe',
                                'Bedah Minor' => 'fa-kit-medical',
                                'Khitan' => 'fa-cut',
                                'Swab Antigen' => 'fa-vial',
                                'Home Care' => 'fa-house-medical',
                                'Antar Jemput Pasien' => 'fa-ambulance',
                                'pangkas rambut' => 'fa-cut',
                                'potong rambut' => 'fa-cut',
                            ];
                            $defaultIcon = 'fa-notes-medical';
                            
                            // Cari icon berdasarkan nama layanan (case insensitive)
                            $matchedIcon = $defaultIcon;
                            foreach($icons as $key => $icon) {
                                if(stripos($item->nama_layanan, $key) !== false) {
                                    $matchedIcon = $icon;
                                    break;
                                }
                            }
                        @endphp
                        <i class="fas {{ $matchedIcon }} text-[#10453f] text-3xl"></i>
                    </div>

                    <div class="p-6">
                        <!-- Status BPJS -->
                        <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full mb-3
                            {{ $item->status_bpjs == 'BPJS' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $item->status_bpjs == 'Umum' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $item->status_bpjs == 'BPJS & Umum' || !$item->status_bpjs ? 'bg-purple-100 text-purple-800' : '' }}">
                            <i class="fas fa-shield-halved mr-1"></i> {{ $item->status_bpjs ?? 'BPJS & Umum' }}
                        </span>

                        <!-- Nama Layanan -->
                        <h3 class="text-xl font-bold text-[#10453f] mb-2">{{ $item->nama_layanan }}</h3>
                        
                        <!-- Deskripsi Singkat -->
                        <p class="text-gray-600 text-sm leading-relaxed">
                            {{ Str::limit($item->deskripsi_singkat ?? $item->deskripsi ?? 'Deskripsi tidak tersedia', 100, '...') }}
                        </p>
                    </div>
                </div>

                <!-- Tombol Detail Layanan -->
                <div class="p-6 pt-0 mt-auto">
                    <a href="{{ route('layanan.detail', $item->slug ?? $item->id_layanan ?? $item->id) }}" 
                       class="block w-full text-center bg-[#10453f] text-white py-2.5 rounded-xl font-semibold hover:bg-[#1a6b5f] transition duration-200 text-sm shadow">
                        Detail Layanan &rarr;
                    </a>
                </div>

            </div>
            @endforeach

        </div>

        @if($layanans->isEmpty())
        <div class="text-center py-12">
            <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500">Belum ada layanan yang tersedia.</p>
        </div>
        @endif

    </div>
</section>
@endsection