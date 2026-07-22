@extends('layouts.app')

@section('title', 'Detail Jadwal - ' . $dokter->nama_dokter)

@section('content')
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 max-w-4xl">
        
        <!-- Tombol Kembali -->
        <a href="{{ route('jadwal') }}" class="inline-flex items-center text-[#10453f] hover:underline mb-6">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Dokter
        </a>

        <!-- Card Detail -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-16 h-16 bg-[#10453f]/10 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-md text-[#10453f] text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-[#10453f]">{{ $dokter->nama_dokter }}</h1>
                    <p class="text-gray-500">Jadwal Praktik</p>
                </div>
            </div>
            <div class="w-full h-1 bg-[#10453f]/20 mb-6 rounded-full"></div>

            <!-- Tabel Jadwal -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#10453f] text-white">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm">Hari</th>
                            <th class="px-4 py-3 text-left text-sm">Jam Mulai</th>
                            <th class="px-4 py-3 text-left text-sm">Jam Selesai</th>
                            <th class="px-4 py-3 text-left text-sm">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $hariList = ['senin' => 'Senin', 'selasa' => 'Selasa', 'rabu' => 'Rabu', 
                                          'kamis' => 'Kamis', 'jumat' => 'Jumat', 'sabtu' => 'Sabtu', 
                                          'minggu' => 'Minggu'];
                            $hariData = $dokter->hari_praktik ?? [];
                        @endphp
                        @foreach($hariList as $key => $label)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm font-medium">{{ $label }}</td>
                            @if(isset($hariData[$key]) && $hariData[$key] == 'aktif')
                            <td class="px-4 py-3 text-sm">{{ $dokter->jam_mulai }}</td>
                            <td class="px-4 py-3 text-sm">{{ $dokter->jam_selesai }}</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 rounded-full text-xs bg-green-100 text-green-700">
                                    🟢 Aktif
                                </span>
                            </td>
                            @else
                            <td class="px-4 py-3 text-sm text-gray-400">-</td>
                            <td class="px-4 py-3 text-sm text-gray-400">-</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-400">
                                    ⚪ Libur
                                </span>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                <p class="text-sm text-yellow-700">
                    <i class="fas fa-info-circle mr-2"></i>
                    Jadwal dapat berubah, hubungi klinik untuk konfirmasi
                </p>
            </div>
        </div>
    </div>
</section>
@endsection