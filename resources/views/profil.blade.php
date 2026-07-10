@extends('layouts.app')

@section('title', 'Profil Klinik Syaeful Majid Medika')

@section('content')
<!-- Header Profil -->
<section class="bg-gradient-to-br from-[#10453f] to-[#1a6b5f] text-white py-16 rounded-b-[60px] mx-4 shadow-2xl">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Profil Klinik Syaeful Majid Medika</h1>
        <div class="w-24 h-1 bg-white/50 mx-auto rounded-full"></div>
    </div>
</section>

<!-- ============================================================ -->
<!-- KONTEN 2 KOLOM -->
<!-- ============================================================ -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-6xl">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
            
            <!-- ============================================================ -->
            <!-- KOLOM KIRI -->
            <!-- ============================================================ -->
            <div>
                
                <!-- SEJARAH -->
                <div class="mb-10">
                    <h2 class="text-2xl md:text-3xl font-bold text-[#10453f] mb-2">Sejarah Singkat Klinik</h2>
                    <div class="w-16 h-1 bg-[#10453f] mb-4 rounded-full"></div>
                    <p class="text-gray-700 leading-relaxed text-justify">
                        {{ $profil->sejarah_singkat ?? 'Belum ada data sejarah.' }}
                    </p>
                </div>

                <!-- STRUKTUR ORGANISASI -->
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-[#10453f] mb-2">Struktur Organisasi Klinik</h2>
                    <div class="w-16 h-1 bg-[#10453f] mb-4 rounded-full"></div>
                    
                    @php
                        $strukturList = explode("\n", trim($profil->struktur_organisasi ?? ''));
                    @endphp
                    
                    @if(!empty($strukturList) && !empty(trim($strukturList[0])))
                        <div class="space-y-2">
                            @foreach($strukturList as $item)
                                @if(!empty(trim($item)))
                                    <p class="text-gray-700 leading-relaxed">{{ trim($item) }}</p>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Belum ada data struktur organisasi.</p>
                    @endif
                </div>

            </div>

            <!-- ============================================================ -->
            <!-- KOLOM KANAN -->
            <!-- ============================================================ -->
            <div>
                
                <!-- VISI -->
                <div class="mb-6">
                    <h2 class="text-2xl md:text-3xl font-bold text-[#10453f] mb-2">Visi</h2>
                    <div class="w-16 h-1 bg-[#10453f] mb-4 rounded-full"></div>
                    <p class="text-gray-700 leading-relaxed">
                        {{ $profil->visi ?? 'Belum ada data visi.' }}
                    </p>
                </div>

                <!-- MISI -->
                <div class="mb-10">
                    <h2 class="text-2xl md:text-3xl font-bold text-[#10453f] mb-2">Misi</h2>
                    <div class="w-16 h-1 bg-[#10453f] mb-4 rounded-full"></div>
                    
                    @php
                        $misiList = explode("\n", trim($profil->misi ?? ''));
                    @endphp
                    
                    @if(!empty($misiList) && !empty(trim($misiList[0])))
                        <ul class="text-gray-700 leading-relaxed list-disc list-inside space-y-1">
                            @foreach($misiList as $misi)
                                @if(!empty(trim($misi)))
                                    <li>{{ trim($misi) }}</li>
                                @endif
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">Belum ada data misi.</p>
                    @endif
                </div>

                <!-- NOMOR IZIN -->
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-[#10453f] mb-2 flex items-center">
                        <i class="fas fa-certificate mr-3 text-[#10453f]"></i> NOMOR IZIN OPERASIONAL
                    </h2>
                    <div class="w-16 h-1 bg-[#10453f] mb-4 rounded-full"></div>
                    <p class="text-xl font-bold text-[#10453f] tracking-wider">
                        {{ $profil->nomor_izin ?? 'Belum ada data' }}
                    </p>
                </div>

            </div>

        </div>

    </div>
</section>
@endsection