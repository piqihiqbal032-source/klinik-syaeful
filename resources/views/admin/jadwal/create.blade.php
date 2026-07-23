@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Tambah Jadwal Dokter</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4 border border-red-300">
            <strong class="font-bold">Gagal Menyimpan Data!</strong>
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
            <input type="text" name="nama_dokter" value="{{ old('nama_dokter') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500" placeholder="dr. Ahmad Farid, Sp.PD" required>
        </div>

        <!-- HARI PRAKTIK -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Hari Praktik</label>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                @php
                    $days = ['senin' => 'Senin', 'selasa' => 'Selasa', 'rabu' => 'Rabu', 'kamis' => 'Kamis', 'jumat' => 'Jumat', 'sabtu' => 'Sabtu', 'minggu' => 'Minggu'];
                @endphp
                @foreach($days as $key => $label)
                    <label class="flex items-center space-x-2 p-2 border rounded hover:bg-gray-50 cursor-pointer">
                        <input type="checkbox" name="hari[]" value="{{ $key }}" 
                            {{ is_array(old('hari')) && in_array($key, old('hari')) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                        <span>{{ $label }}</span>
                    </label>
                @endforeach
            </div>
            <p class="text-xs text-gray-400 mt-1">Centang hari praktik rutin dokter</p>
        </div>

        <!-- JAM PRAKTIK -->
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Jam Mulai</label>
                <input type="time" name="jam_mulai" value="{{ old('jam_mulai') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Jam Selesai</label>
                <input type="time" name="jam_selesai" value="{{ old('jam_selesai') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
            </div>
        </div>

        <!-- TAMBAHAN 1: STATUS DOKTER -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Status Praktik Dokter</label>
            <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500" required>
                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>🟢 Aktif (Praktik Normal)</option>
                <option value="libur" {{ old('status') == 'libur' ? 'selected' : '' }}>🔴 Libur / Cuti</option>
                <option value="kendala" {{ old('status') == 'kendala' ? 'selected' : '' }}>🟡 Ada Kendala / Perubahan Jam</option>
            </select>
        </div>

        <!-- TAMBAHAN 2: CATATAN KENDALA -->
        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">Catatan / Pemberitahuan Khusus (Opsional)</label>
            <textarea name="catatan" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-green-500" placeholder="Contoh: Dokter terlambat hadir karena ada penanganan pasien gawat di RS lain.">{{ old('catatan') }}</textarea>
            <p class="text-xs text-gray-400 mt-1">Catatan ini akan tampil di bagian bawah halaman detail jadwal publik.</p>
        </div>

        <!-- BUTTONS -->
        <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800 font-semibold">
            Simpan
        </button>
        <a href="{{ route('admin.jadwal.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 ml-2">Batal</a>
    </form>
</div>
@endsection