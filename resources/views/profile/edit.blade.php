@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Edit Profil Klinik</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.profil.update', $profil->id_profil ?? 1) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Sejarah Singkat</label>
            <textarea name="sejarah_singkat" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ $profil->sejarah_singkat ?? '' }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Visi & Misi</label>
            <textarea name="visi_misi" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ $profil->visi_misi ?? '' }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Struktur Organisasi</label>
            <textarea name="struktur_organisasi" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ $profil->struktur_organisasi ?? '' }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nomor Izin</label>
            <input type="text" name="nomor_izin" value="{{ $profil->nomor_izin ?? '' }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>

        <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection