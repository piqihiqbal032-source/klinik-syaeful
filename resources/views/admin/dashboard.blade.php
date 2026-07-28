@extends('layouts.admin')

@section('content')
<!-- Notifikasi Error -->
@if(session('error'))
<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 flex items-center" role="alert">
    <i class="fas fa-exclamation-triangle text-red-500 mr-3 text-xl"></i>
    <div>
        <p class="font-bold">Akses Ditolak!</p>
        <p>{{ session('error') }}</p>
    </div>
</div>
@endif

<!-- Notifikasi Success -->
@if(session('success'))
<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 flex items-center" role="alert">
    <i class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
    <div>
        <p>{{ session('success') }}</p>
    </div>
</div>
@endif

<!-- Header -->
<div class="mb-8">
    <h2 class="text-3xl font-bold text-[#10453f]">DASHBOARD ADMIN</h2>
    <p class="text-gray-500">Selamat datang di panel admin Klinik Syaeful Majid Medika</p>
</div>

<!-- Statistik -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Total Layanan -->
    <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100 flex items-center gap-4">
        <div class="w-14 h-14 bg-[#10453f]/10 rounded-2xl flex items-center justify-center">
            <i class="fas fa-heartbeat text-[#10453f] text-2xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">TOTAL LAYANAN MEDIS</p>
            <p class="text-3xl font-bold text-[#10453f]">{{ $totalLayanan ?? 0 }}</p>
        </div>
    </div>

    <!-- Total Jadwal -->
    <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100 flex items-center gap-4">
        <div class="w-14 h-14 bg-[#10453f]/10 rounded-2xl flex items-center justify-center">
            <i class="fas fa-calendar text-[#10453f] text-2xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">TOTAL JADWAL DOKTER</p>
            <p class="text-3xl font-bold text-[#10453f]">{{ $totalJadwal ?? 0 }}</p>
        </div>
    </div>
</div>
@endsection