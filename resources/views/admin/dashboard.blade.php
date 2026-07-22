@extends('layouts.admin')

@section('content')
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