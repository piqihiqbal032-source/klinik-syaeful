@extends('layouts.app')

@section('title', 'Kontak dan Lokasi Klinik Syaeful Majid Medika')

@section('content')
<!-- Header Kontak -->
<section class="bg-gradient-to-br from-[#10453f] to-[#1a6b5f] text-white py-16 rounded-b-[60px] mx-4 shadow-2xl">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Kontak dan Lokasi Klinik Syaeful Majid Medika</h1>
        <p class="text-lg md:text-xl text-[#f5fefc]/80">Hubungi Kami</p>
        <div class="w-24 h-1 bg-white/50 mx-auto mt-4 rounded-full"></div>
    </div>
</section>

<!-- Konten Kontak - 2 Kolom -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <!-- KOLOM KIRI: Informasi Kontak -->
            <div class="bg-gray-50 rounded-2xl shadow-lg p-8 border border-gray-100">
                <h2 class="text-2xl font-bold text-[#10453f] mb-6">Hubungi Kami</h2>
                
                <!-- Alamat -->
                <div class="flex items-start gap-4 mb-4">
                    <div class="w-12 h-12 bg-[#10453f]/10 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-map-marker-alt text-[#10453f] text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-700">Alamat</h4>
                        <p class="text-gray-600 text-sm">{{ $kontak->alamat_lengkap ?? 'Belum ada data' }}</p>
                    </div>
                </div>
                
                <!-- Telepon -->
                <div class="flex items-start gap-4 mb-4">
                    <div class="w-12 h-12 bg-[#10453f]/10 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-phone text-[#10453f] text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-700">Telepon</h4>
                        <p class="text-gray-600 text-sm">{{ $kontak->nomor_telepon ?? 'Belum ada data' }}</p>
                    </div>
                </div>
                
                <!-- Email -->
                <div class="flex items-start gap-4 mb-4">
                    <div class="w-12 h-12 bg-[#10453f]/10 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-envelope text-[#10453f] text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-700">Email</h4>
                        <p class="text-gray-600 text-sm">{{ $kontak->email ?? 'Belum ada data' }}</p>
                    </div>
                </div>
                
                <!-- Media Sosial -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h4 class="font-bold text-gray-700 mb-3">Ikuti Kami</h4>
                    <div class="flex flex-wrap gap-3">
                        @if(!empty($kontak->instagram))
                        <a href="{{ $kontak->instagram }}" target="_blank" 
                           class="w-10 h-10 bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600 rounded-full flex items-center justify-center hover:scale-110 transition">
                            <i class="fab fa-instagram text-white text-sm"></i>
                        </a>
                        @endif

                        @if(!empty($kontak->facebook))
                        <a href="{{ $kontak->facebook }}" target="_blank" 
                           class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 hover:scale-110 transition">
                            <i class="fab fa-facebook-f text-white text-sm"></i>
                        </a>

                        @endif
                        @if(!empty($kontak->twitter))
                        <a href="{{ $kontak->twitter }}" target="_blank" 
                        class="w-10 h-10 bg-black rounded-full flex items-center justify-center hover:bg-gray-800 hover:scale-110 transition">
                            <i class="fab fa-x-twitter text-white text-sm"></i>
                        </a>
                        @endif

                        @if(!empty($kontak->youtube))
                        <a href="{{ $kontak->youtube }}" target="_blank" 
                           class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center hover:bg-red-700 hover:scale-110 transition">
                            <i class="fab fa-youtube text-white text-sm"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- KOLOM KANAN: Google Maps -->
            <div class="bg-gray-50 rounded-2xl shadow-lg p-4 border border-gray-100">
                <h2 class="text-xl font-bold text-[#10453f] mb-4 text-center">Lokasi Klinik</h2>
                <div class="rounded-xl overflow-hidden shadow-md" style="height: 400px;">
                    <iframe 
                        src="{{ $kontak->link_peta ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4751.258677969635!2d108.8255205!3d-7.278962600000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f83973733c875%3A0x3b29f725842b9a26!2sKlinik%20Syaeful%20Majid%20Medika!5e1!3m2!1sid!2sid!4v1782824353606!5m2!1sid!2sid' }}" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <p class="text-gray-500 text-xs text-center mt-3">
                    <i class="fas fa-map-pin text-[#10453f] mr-1"></i> 
                    Klinik Syaeful Majid Medika
                </p>
            </div>

        </div>
    </div>
</section>
@endsection