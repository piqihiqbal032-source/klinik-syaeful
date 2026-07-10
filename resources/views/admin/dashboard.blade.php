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

    <!-- Total Pengunjung (contoh) -->
    <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100 flex items-center gap-4">
        <div class="w-14 h-14 bg-[#10453f]/10 rounded-2xl flex items-center justify-center">
            <i class="fas fa-users text-[#10453f] text-2xl"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm">TOTAL PENGUNJUNG WEBSITE</p>
            <p class="text-3xl font-bold text-[#10453f]">154,321</p>
        </div>
    </div>
</div>

<!-- STATISTIK PENGUNJUNG MINGGUAN (contoh grafik) -->
<div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
    <h3 class="text-lg font-bold text-[#10453f] mb-4">
        <i class="fas fa-chart-line mr-2"></i> STATISTIK PENGUNJUNG MINGGUAN
    </h3>
    <div class="flex items-end gap-3 h-40">
        <div class="flex-1 flex flex-col items-center">
            <div class="w-full bg-[#10453f]/20 rounded-t-lg" style="height: 60px;"></div>
            <span class="text-xs text-gray-500 mt-1">Sen</span>
        </div>
        <div class="flex-1 flex flex-col items-center">
            <div class="w-full bg-[#10453f]/30 rounded-t-lg" style="height: 80px;"></div>
            <span class="text-xs text-gray-500 mt-1">Sel</span>
        </div>
        <div class="flex-1 flex flex-col items-center">
            <div class="w-full bg-[#10453f] rounded-t-lg" style="height: 120px;"></div>
            <span class="text-xs text-gray-500 mt-1">Rab</span>
        </div>
        <div class="flex-1 flex flex-col items-center">
            <div class="w-full bg-[#10453f]/40 rounded-t-lg" style="height: 100px;"></div>
            <span class="text-xs text-gray-500 mt-1">Kam</span>
        </div>
        <div class="flex-1 flex flex-col items-center">
            <div class="w-full bg-[#10453f]/50 rounded-t-lg" style="height: 90px;"></div>
            <span class="text-xs text-gray-500 mt-1">Jum</span>
        </div>
        <div class="flex-1 flex flex-col items-center">
            <div class="w-full bg-[#10453f]/60 rounded-t-lg" style="height: 70px;"></div>
            <span class="text-xs text-gray-500 mt-1">Sab</span>
        </div>
        <div class="flex-1 flex flex-col items-center">
            <div class="w-full bg-[#10453f]/20 rounded-t-lg" style="height: 40px;"></div>
            <span class="text-xs text-gray-500 mt-1">Min</span>
        </div>
    </div>
    <p class="text-center text-gray-400 text-sm mt-4">* Data pengunjung mingguan (contoh)</p>
</div>
@endsection