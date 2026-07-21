@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Edit Jadwal Dokter</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.jadwal.update', $jadwal->id_jadwal) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nama Dokter</label>
            <input type="text" name="nama_dokter" value="{{ old('nama_dokter', $jadwal->nama_dokter) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Hari Praktik</label>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                @php
                    $days = ['senin' => 'Senin', 'selasa' => 'Selasa', 'rabu' => 'Rabu', 'kamis' => 'Kamis', 'jumat' => 'Jumat', 'sabtu' => 'Sabtu', 'minggu' => 'Minggu'];
                    $hari = $jadwal->hari_praktik ?? [];
                @endphp
                @foreach($days as $key => $label)
                    <label class="flex items-center space-x-2 p-2 border rounded hover:bg-gray-50">
                        <input type="checkbox" name="hari[]" value="{{ $key }}" 
                            {{ isset($hari[$key]) && $hari[$key] == 'aktif' ? 'checked' : '' }}
                            class="rounded border-gray-300 text-green-600">
                        <span>{{ $label }}</span>
                    </label>
                @endforeach
            </div>
            <p class="text-xs text-gray-400 mt-1">Centang hari praktik dokter</p>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Jam Mulai</label>
                <input type="time" name="jam_mulai" value="{{ old('jam_mulai', $jadwal->jam_mulai) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Jam Selesai</label>
                <input type="time" name="jam_selesai" value="{{ old('jam_selesai', $jadwal->jam_selesai) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
            </div>
        </div>

        <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800">
            Update
        </button>
        <a href="{{ route('admin.jadwal.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 ml-2">Batal</a>
    </form>
</div>
@endsection