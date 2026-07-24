@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Tambah Jadwal Dokter</h1>

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

    <form action="{{ route('admin.jadwal.store') }}" method="POST">
        @csrf

        <!-- NAMA DOKTER -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nama Dokter</label>
            <input type="text" name="nama_dokter" value="{{ old('nama_dokter') }}" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500" placeholder="dr. Nama Dokter, Sp.X" required>
        </div>

        <!-- STATUS HARI PRAKTIK -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Status Hari Praktik Dokter</label>
            <p class="text-xs text-gray-500 mb-3">Tentukan status awal kehadiran dokter pada setiap hari.</p>
            
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
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                @foreach($days as $key => $label)
                    <div class="flex items-center justify-between p-3 border rounded-lg bg-gray-50">
                        <span class="font-medium text-gray-700">{{ $label }}</span>
                        <select name="hari_praktik[{{ $key }}]" class="border border-gray-300 rounded px-2 py-1 text-sm focus:ring-green-500">
                            <option value="aktif">🟢 Aktif</option>
                            <option value="libur" {{ in_array($key, ['sabtu', 'minggu']) ? 'selected' : '' }}>🔴 Libur</option>
                            <option value="cuti">🟡 Cuti</option>
                        </select>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- JAM PRAKTIK -->
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Jam Mulai</label>
                <input type="time" name="jam_mulai" value="{{ old('jam_mulai', '08:00') }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Jam Selesai</label>
                <input type="time" name="jam_selesai" value="{{ old('jam_selesai', '12:00') }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500" required>
            </div>
        </div>

        <!-- CATATAN KHUSUS -->
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Catatan Khusus / Pemberitahuan Kendala</label>
            <textarea name="catatan" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500" placeholder="Contoh: Dokter terlambat hadir pada hari Senin.">{{ old('catatan') }}</textarea>
        </div>

        <!-- BUTTONS -->
        <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800 font-semibold">
            Simpan Jadwal
        </button>
        <a href="{{ route('admin.jadwal.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 ml-2">Batal</a>
    </form>
</div>
@endsection