@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-green-800">Kelola Admin</h1>
        <a href="{{ route('admin.admins.create') }}" class="bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800">
            + Tambah Admin
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">{{ session('error') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Nama</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $admin->id }}</td>
                    <td class="px-4 py-2">{{ $admin->name }}</td>
                    <td class="px-4 py-2">{{ $admin->email }}</td>
                    <td class="px-4 py-2">
                        @if($admin->id == 1)
                            <span class="text-gray-400 text-sm">Admin Utama</span>
                        @else
                            <a href="{{ route('admin.admins.edit-password', $admin->id) }}" class="text-blue-600 hover:text-blue-800 mr-2">
                                Ganti Password
                            </a>
                            <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus admin ini?')">
                                    Hapus
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection