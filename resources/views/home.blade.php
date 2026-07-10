@extends('layouts.app')

@section('title', 'Beranda - Klinik Syaeful Majid Medika')

@section('content')
<!-- Hero Section dengan Gambar -->
<section class="relative text-white py-32 rounded-b-[60px]"
         style="background-image: url('{{ asset('images/banner-klinik.jpeg') }}'); 
                background-size: cover; 
                background-position: center 80%; 
                min-height: 500px;">

    <!-- Konten di Atas Overlay -->
    <div class="relative z-10 container mx-auto px-4 text-center">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 drop-shadow-lg">
                Selamat Datang di 
            </h2>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 drop-shadow-lg">
                Klinik Syaeful Majid Medika
            </h2>
            <a href="{{ route('layanan') }}" 
               class="inline-block mt-6 bg-[#29a195] text-[#fefefe] px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition">
                Lihat Layanan Kami
            </a>
        </div>
    </div>
</section>

<!-- Ringkasan Profil -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <div class="w-24 h-1 bg-[#000000] mx-auto mb-6"></div>
            <h2 class="text-3xl font-bold text-[#000000] mb-6">Klinik profil summary</h2>
            <p class="text-[#000000] text-lg leading-relaxed">
                Klinik Syaeful Majid Medika merupakan salah satu klinik yang memberikan pelayanan kesehatan 
                terbaik dan terjangkau bagi masyarakat Kecamatan Cimanggu dan sekitarnya. 
                Kami berkomitmen untuk memberikan pelayanan yang profesional, ramah, dan berkualitas.
            </p>
        </div>
    </div>
</section>

<!-- Layanan Unggulan -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-[#000000] mb-12">Layanan Medis</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
            
            <!-- IGD 24 Jam -->
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition transform hover:-translate-y-1">
                 <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-solid fa-circle-plus text-[#0e514a] text-5xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-center text-[#000000]">IGD 24 Jam</h3>
                <p class="text-[#000000] text-center text-sm mt-2">Pelayanan gawat darurat 24 jam setiap hari</p>
            </div>

            <!-- Rawat Inap -->
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-solid fa-bed-pulse text-[#0e514a] text-5xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-center text-[#000000]">Rawat Inap</h3>
                <p class="text-[#000000] text-center text-sm mt-2">Fasilitas rawat inap dengan kamar yang nyaman</p>
            </div>

            <!-- Laboratorium -->
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-solid fa-flask text-[#0e514a] text-5xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-center text-[#000000]">Laboratorium</h3>
                <p class="text-[#000000] text-center text-sm mt-2">Pemeriksaan laboratorium klinik lengkap</p>
            </div>

            <!-- Home Care -->
            <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-solid fa-truck-medical text-[#0e514a] text-5xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-center text-[#000000]">Home Care</h3>
                <p class="text-[#000000] text-center text-sm mt-2">Pelayanan kesehatan di rumah pasien</p>
            </div>

        </div>
        
        <!-- Tombol Lihat Semua Layanan -->
        <div class="text-center mt-10">
            <a href="{{ route('layanan') }}" 
               class="bg-[#29a195] text-white px-8 py-3 rounded-full font-semibold hover:bg-green-800 transition">
                Lihat Semua Layanan
            </a>
        </div>
    </div>
</section>
@endsection