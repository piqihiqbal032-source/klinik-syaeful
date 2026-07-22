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

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Alamat Lengkap</label>
            <textarea name="alamat_lengkap" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ $kontak->alamat_lengkap ?? '' }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nomor Telepon</label>
            <input type="text" name="nomor_telepon" value="{{ $kontak->nomor_telepon ?? '' }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" name="email" value="{{ $kontak->email ?? '' }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Instagram</label>
            <input type="url" name="instagram" value="{{ $kontak->instagram ?? '' }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Facebook</label>
            <input type="url" name="facebook" value="{{ $kontak->facebook ?? '' }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Twitter</label>
            <input type="url" name="twitter" value="{{ $kontak->twitter ?? '' }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">YouTube</label>
            <input type="url" name="youtube" value="{{ $kontak->youtube ?? '' }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Link Peta Google Maps</label>
            <input type="text" name="link_peta" value="{{ $kontak->link_peta ?? '' }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="https://www.google.com/maps/embed?pb=...">
        </div>

        <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection