@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Ganti Password Admin</h1>
    <p class="text-gray-600 mb-4">Mengganti password untuk: <strong>{{ $admin->name }}</strong> ({{ $admin->email }})</p>

    <form action="{{ route('admin.admins.update-password', $admin->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Password Baru</label>
            <input type="password" name="new_password" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Konfirmasi Password Baru</label>
            <input type="password" name="new_password_confirmation" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>

        <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800">
            Simpan Password
        </button>
        <a href="{{ route('admin.admins.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 ml-2">Batal</a>
    </form>
</div>
@endsection