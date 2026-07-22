@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Edit Kontak Klinik</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kontak.update', $kontak->id_kontak ?? 1) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- ALAMAT -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Alamat Lengkap</label>
            <textarea name="alamat_lengkap" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ $kontak->alamat_lengkap ?? '' }}</textarea>
        </div>

        <!-- TELEPON -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nomor Telepon</label>
            <input type="text" name="nomor_telepon" value="{{ $kontak->nomor_telepon ?? '' }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>

        <!-- EMAIL -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" name="email" value="{{ $kontak->email ?? '' }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>

        <!-- INSTAGRAM -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Instagram</label>
            <input type="text" name="instagram" value="{{ $kontak->instagram ?? '' }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>

        <!-- FACEBOOK -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Facebook</label>
            <input type="text" name="facebook" value="{{ $kontak->facebook ?? '' }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>

        <!-- TWITTER / X -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Twitter / X</label>
            <input type="text" name="twitter" value="{{ $kontak->twitter ?? '' }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>

        <!-- YOUTUBE -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">YouTube</label>
            <input type="text" name="youtube" value="{{ $kontak->youtube ?? '' }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>

        <!-- LINK MAPS -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Link Peta Google Maps</label>
            <textarea name="link_peta" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="https://www.google.com/maps/embed?pb=...">{{ $kontak->link_peta ?? '' }}</textarea>
            <p class="text-xs text-gray-400 mt-1">Copy link embed dari Google Maps (tanpa tanda kutip)</p>
        </div>

        <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection