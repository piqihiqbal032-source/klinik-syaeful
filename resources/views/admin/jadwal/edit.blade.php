@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Edit Jadwal Dokter</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.jadwal.update', $jadwal->id_jadwal) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- NAMA DOKTER (WAJIB) -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nama Dokter <span class="text-red-500">*</span></label>
            <input type="text" name="nama_dokter" value="{{ old('nama_dokter', $jadwal->nama_dokter) }}" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>

        <!-- HARI PRAKTIK (WAJIB) -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Hari Praktik <span class="text-red-500">*</span></label>
            <select name="hari_praktik" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                <option value="">Pilih Hari</option>
                @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $hari)
                    <option value="{{ $hari }}" {{ old('hari_praktik', $jadwal->hari_praktik) == $hari ? 'selected' : '' }}>
                        {{ $hari }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- JAM MULAI (WAJIB) -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Jam Mulai <span class="text-red-500">*</span></label>
            <input type="time" name="jam_mulai" value="{{ old('jam_mulai', $jadwal->jam_mulai) }}" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>

        <!-- JAM SELESAI (WAJIB) -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Jam Selesai <span class="text-red-500">*</span></label>
            <input type="time" name="jam_selesai" value="{{ old('jam_selesai', $jadwal->jam_selesai) }}" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>

        <!-- STATUS -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Status</label>
            <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                <option value="aktif" {{ old('status', $jadwal->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="libur" {{ old('status', $jadwal->status) == 'libur' ? 'selected' : '' }}>Libur</option>
            </select>
        </div>

        <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800">
            Update
        </button>
        <a href="{{ route('admin.jadwal.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 ml-2">Batal</a>
    </form>
</div>
@endsection