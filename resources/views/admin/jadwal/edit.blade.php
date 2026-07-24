@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Edit Jadwal Dokter</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4 border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4 border border-red-300">
            <strong class="font-bold">Gagal Menyimpan!</strong>
            <ul class="list-disc pl-5 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.jadwal.update', $jadwal->id_jadwal ?? $jadwal->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- NAMA DOKTER -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nama Dokter</label>
            <input type="text" name="nama_dokter" value="{{ old('nama_dokter', $jadwal->nama_dokter) }}" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500" required>
        </div>

        <!-- STATUS HARI PRAKTIK DOKTER (3 OPSI) -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Status Hari Praktik Dokter</label>
            <p class="text-xs text-gray-500 mb-3">Tentukan status kehadiran dokter pada setiap hari (Aktif, Libur, atau Cuti).</p>
            
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
                
                $hariData = $jadwal->hari_praktik ?? [];
                if (is_string($hariData)) {
                    $hariData = json_decode($hariData, true) ?? [];
                }
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                @foreach($days as $key => $label)
                    @php
                        $statusHari = $hariData[$key] ?? 'libur';
                        if ($statusHari === true || $statusHari === '1') {
                            $statusHari = 'aktif';
                        }
                    @endphp
                    <div class="flex items-center justify-between p-3 border rounded-lg bg-gray-50">
                        <span class="font-medium text-gray-700">{{ $label }}</span>
                        <select name="hari_praktik[{{ $key }}]" class="border border-gray-300 rounded px-2 py-1 text-sm focus:ring-green-500">
                            <option value="aktif" {{ $statusHari == 'aktif' ? 'selected' : '' }}>🟢 Aktif</option>
                            <option value="libur" {{ $statusHari == 'libur' ? 'selected' : '' }}>🔴 Libur</option>
                            <option value="cuti"  {{ $statusHari == 'cuti'  ? 'selected' : '' }}>🟡 Cuti</option>
                        </select>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- JAM PRAKTIK -->
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Jam Mulai</label>
                <input type="time" name="jam_mulai" value="{{ old('jam_mulai', $jadwal->jam_mulai) }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Jam Selesai</label>
                <input type="time" name="jam_selesai" value="{{ old('jam_selesai', $jadwal->jam_selesai) }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500" required>
            </div>
        </div>

        <!-- CATATAN KHUSUS -->
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Catatan Khusus / Pemberitahuan Kendala</label>
            <textarea name="catatan" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500" placeholder="Contoh: Dokter Cuti dari tanggal 20-25 Juli.">{{ old('catatan', $jadwal->catatan) }}</textarea>
            <p class="text-xs text-gray-500 mt-1">Catatan ini akan langsung ditampilkan di kotak kuning halaman detail jadwal publik.</p>
        </div>

        <!-- BUTTONS -->
        <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800 font-semibold">
            Simpan Perubahan
        </button>
        <a href="{{ route('admin.jadwal.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 ml-2">Batal</a>
    </form>
</div>
@endsection