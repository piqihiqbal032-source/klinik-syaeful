@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
        
        <!-- NAMA DOKTER -->
        <h2 class="text-2xl font-bold text-gray-800 mb-1">
            {{ $dokter->nama_dokter ?? $jadwal->nama_dokter }}
        </h2>
        <p class="text-sm text-gray-500 mb-6">Jadwal Praktik Mingguan</p>

        @php
            $days = [
                'senin'  => 'Senin',
                'selasa' => 'Selasa',
                'rabu'   => 'Rabu',
                'kamis'  => 'Kamis',
                'jumat'  => 'Jumat',
                'sabtu'  => 'Sabtu',
                'minggu' => 'Minggu'
            ];

            $dataJadwal = $dokter ?? $jadwal;
            $hariData = $dataJadwal->hari_praktik ?? [];

            // Jika format tersimpan sebagai JSON string
            if (is_string($hariData)) {
                $hariData = json_decode($hariData, true) ?? [];
            }
        @endphp

        <!-- TABEL JADWAL HARI & STATUS -->
        <div class="overflow-x-auto rounded-lg border border-gray-200 mb-6">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-green-800 text-white text-sm">
                        <th class="p-3">Hari</th>
                        <th class="p-3">Jam Mulai</th>
                        <th class="p-3">Jam Selesai</th>
                        <th class="p-3">Status Kehadiran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @foreach($days as $key => $label)
                        @php
                            $st = $hariData[$key] ?? 'libur';
                            // Compatibility dengan boolean/1
                            if ($st === true || $st === '1') { 
                                $st = 'aktif'; 
                            }
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 font-medium text-gray-700">{{ $label }}</td>
                            
                            @if($st == 'aktif')
                                <td class="p-3 text-gray-600">{{ $dataJadwal->jam_mulai }}</td>
                                <td class="p-3 text-gray-600">{{ $dataJadwal->jam_selesai }}</td>
                                <td class="p-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        🟢 Aktif
                                    </span>
                                </td>
                            @elseif($st == 'cuti')
                                <td class="p-3 text-gray-400">-</td>
                                <td class="p-3 text-gray-400">-</td>
                                <td class="p-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                        🟡 Cuti
                                    </span>
                                </td>
                            @else
                                <td class="p-3 text-gray-400">-</td>
                                <td class="p-3 text-gray-400">-</td>
                                <td class="p-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                        🔴 Libur
                                    </span>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- KOTAK CATATAN KHUSUS / PEMBERITAHUAN -->
        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
            @if(!empty($dataJadwal->catatan))
                <p class="font-bold text-yellow-800 text-xs uppercase tracking-wide mb-1">📢 Pemberitahuan Klinik / Informasi Cuti:</p>
                <p class="text-yellow-900 text-sm font-medium">{{ $dataJadwal->catatan }}</p>
            @else
                <p class="text-yellow-700 text-sm">ℹ️ Jadwal sewaktu-waktu dapat berubah, silakan hubungi kontak klinik untuk konfirmasi.</p>
            @endif
        </div>

        <div class="mt-6">
            <a href="{{ url()->previous() }}" class="text-sm font-medium text-green-700 hover:underline">
                &larr; Kembali ke daftar jadwal
            </a>
        </div>

    </div>
</div>
@endsection