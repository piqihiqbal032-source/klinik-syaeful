@extends('layouts.app')

@section('title', 'Berita & Kegiatan Klinik')

@section('content')
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-[#10453f]">Berita & Kegiatan Klinik</h1>
            <p class="text-gray-600 mt-2">Informasi terkini dari Instagram kami</p>
        </div>

        <!-- Tombol Filter Kategori -->
        <div class="flex justify-center flex-wrap gap-2 mb-10">
            <a href="{{ route('kegiatan.index') }}" 
               class="px-5 py-2 rounded-full text-sm font-semibold transition {{ !request('category') ? 'bg-[#10453f] text-white shadow-md' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
               Semua
            </a>
            
            @foreach($categories as $cat)
            <a href="{{ route('kegiatan.index', ['category' => $cat->id]) }}" 
               class="px-5 py-2 rounded-full text-sm font-semibold transition {{ request('category') == $cat->id ? 'bg-[#10453f] text-white shadow-md' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
               {{ ucfirst($cat->name) }}
            </a>
            @endforeach
        </div>

        @if($kegiatans->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($kegiatans as $kegiatan)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-4 bg-[#10453f]/5 border-b">
                    <h3 class="font-bold text-[#10453f] text-center">{{ $kegiatan->judul }}</h3>
                </div>
                <div class="p-2">
                    <div class="relative" style="padding-bottom: 100%; height: 0; overflow: hidden;">
                        <iframe 
                            src="{{ $kegiatan->embed_url }}"
                            frameborder="0"
                            allowfullscreen
                            class="absolute top-0 left-0 w-full h-full"
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
                <div class="p-3 text-center text-xs text-gray-400 border-t">
                    <i class="far fa-calendar-alt mr-1"></i>
                    {{ $kegiatan->created_at->format('d M Y') }}
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <i class="fas fa-instagram text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500">Belum ada kegiatan untuk kategori ini.</p>
            <p class="text-sm text-gray-400 mt-2">Ikuti Instagram kami @klinik_syaefulmajidmedika</p>
        </div>
        @endif
    </div>
</section>
@endsection