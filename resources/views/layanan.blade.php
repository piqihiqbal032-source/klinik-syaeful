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
            
            @foreach($layanan as $item)
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition duration-300 hover:-translate-y-2">
                
                <!-- Icon di Atas -->
                <div class="w-16 h-16 bg-[#10453f]/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
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
                        ];
                        $defaultIcon = 'fa-notes-medical';
                    @endphp
                    <i class="fas {{ $icons[$item->nama_layanan] ?? $defaultIcon }} text-[#10453f] text-2xl"></i>
                </div>

                <!-- Nama Layanan -->
                <h3 class="text-lg font-bold text-[#10453f] text-center">{{ $item->nama_layanan }}</h3>
                
                <!-- Deskripsi -->
                <p class="text-gray-600 text-sm leading-relaxed mt-2 text-center">{{ $item->deskripsi }}</p>
                
                <!-- Status -->
                @if($item->status_aktif == 'aktif')
                    <span class="inline-block mt-3 text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full mx-auto block w-fit">Tersedia</span>
                @else
                    <span class="inline-block mt-3 text-xs bg-red-100 text-red-700 px-3 py-1 rounded-full mx-auto block w-fit">Tidak Tersedia</span>
                @endif
                
            </div>
            @endforeach

        </div>

        <!-- Jika belum ada data -->
        @if($layanan->isEmpty())
        <div class="text-center py-12">
            <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500">Belum ada layanan yang tersedia.</p>
        </div>
        @endif

    </div>
</section>
@endsection