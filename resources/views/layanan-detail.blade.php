@extends('layouts.app')

@section('title', $layanan->nama_layanan . ' - Klinik Syaeful Majid Medika')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <!-- Breadcrumb -->
    <nav class="text-sm mb-6">
        <a href="{{ route('home') }}" class="text-[#10453f] hover:underline">Beranda</a>
        <span class="mx-2">/</span>
        <a href="{{ route('layanan') }}" class="text-[#10453f] hover:underline">Layanan</a>
        <span class="mx-2">/</span>
        <span class="text-gray-600">{{ $layanan->nama_layanan }}</span>
    </nav>

    <!-- Card Detail -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <!-- Foto -->
        @if($layanan->foto)
            <div class="w-full h-80 overflow-hidden bg-gray-100">
                <img src="{{ asset('storage/' . $layanan->foto) }}" 
                     alt="{{ $layanan->nama_layanan }}" 
                     class="w-full h-full object-cover">
            </div>
        @elseif($layanan->gambar)
            <div class="w-full h-80 overflow-hidden bg-gray-100">
                <img src="{{ asset('storage/' . $layanan->gambar) }}" 
                     alt="{{ $layanan->nama_layanan }}" 
                     class="w-full h-full object-cover">
            </div>
        @else
            <div class="w-full h-64 bg-gradient-to-r from-[#10453f]/10 to-[#1a6b5f]/10 flex items-center justify-center">
                <i class="fas fa-notes-medical text-[#10453f] text-8xl opacity-30"></i>
            </div>
        @endif
        
        <!-- Content -->
        <div class="p-8">
            <!-- Header -->
            <div class="flex flex-wrap items-start justify-between gap-4 mb-6">
                <h1 class="text-3xl font-bold text-[#10453f]">
                    {{ $layanan->nama_layanan }}
                </h1>
                <div class="flex flex-wrap gap-2">
                    <span class="px-4 py-2 rounded-full text-sm font-semibold
                        {{ ($layanan->status_aktif ?? 'aktif') == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ($layanan->status_aktif ?? 'aktif') == 'aktif' ? '✅ Tersedia' : '❌ Tidak Tersedia' }}
                    </span>
                    @if($layanan->status_bpjs)
                    <span class="px-4 py-2 rounded-full text-sm font-semibold
                        {{ $layanan->status_bpjs == 'BPJS' ? 'bg-green-100 text-green-800' : '' }}
                        {{ $layanan->status_bpjs == 'Umum' ? 'bg-blue-100 text-blue-800' : '' }}
                        {{ $layanan->status_bpjs == 'BPJS & Umum' ? 'bg-purple-100 text-purple-800' : '' }}">
                        {{ $layanan->status_bpjs }}
                    </span>
                    @endif
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-[#10453f] mb-3">Deskripsi & Prosedur Medis</h2>
                <div class="text-gray-700 leading-relaxed bg-gray-50 p-6 rounded-xl">
                    <p>{{ $layanan->deskripsi_lengkap ?? $layanan->deskripsi_singkat ?? $layanan->deskripsi ?? 'Deskripsi tidak tersedia' }}</p>
                </div>
            </div>

            <!-- Persyaratan -->
            @if($layanan->persyaratan)
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-[#10453f] mb-3">Persyaratan / Persiapan Pasien</h2>
                <div class="text-gray-700 leading-relaxed bg-amber-50 p-6 rounded-xl border border-amber-100">
                    <p>{{ $layanan->persyaratan }}</p>
                </div>
            </div>
            @endif

            <!-- Informasi Tambahan -->
            <div class="flex flex-wrap gap-4 p-4 bg-[#10453f]/5 rounded-xl mt-6">
                <div class="flex items-center gap-2">
                    <i class="fas fa-shield-halved text-[#10453f]"></i>
                    <span class="text-sm text-gray-600">Penjaminan: <strong>{{ $layanan->status_bpjs ?? 'BPJS & Umum' }}</strong></span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fas fa-calendar-check text-[#10453f]"></i>
                    <span class="text-sm text-gray-600">Status: <strong>{{ ($layanan->status_aktif ?? 'aktif') == 'aktif' ? 'Tersedia' : 'Tidak Tersedia' }}</strong></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Kembali ke Layanan (BUKAN HOME) -->
    <div class="mt-6">
        <a href="{{ route('layanan') }}" class="inline-flex items-center text-[#10453f] hover:text-[#1a6b5f] font-medium">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Daftar Layanan
        </a>
    </div>
</div>
@endsection