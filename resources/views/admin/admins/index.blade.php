@extends('layouts.admin')

@section('content')
<div class="p-6 space-y-6 max-w-7xl mx-auto">
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Kelola Admin</h1>
            <p class="text-slate-500 text-sm mt-1">Manajemen akun administrator sistem klinik.</p>
        </div>
        <div>
            <a href="{{ route('admin.admins.create') }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition-colors shadow-sm">
                <i class="fas fa-plus text-xs"></i>
                <span>Tambah Admin Baru</span>
            </a>
        </div>
    </div>

    {{-- Alert Notifikasi Success --}}
    @if(session('success'))
        <div class="flex items-center justify-between p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-lg text-sm">
            <div class="flex items-center gap-2">
                <i class="fas fa-check-circle text-emerald-600 text-lg"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    {{-- Alert Notifikasi Error --}}
    @if(session('error'))
        <div class="flex items-center justify-between p-4 bg-red-50 border border-red-200 text-red-800 rounded-lg text-sm">
            <div class="flex items-center gap-2">
                <i class="fas fa-exclamation-triangle text-red-600 text-lg"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Tabel Data Admin -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 border-b border-slate-200 text-xs uppercase font-semibold text-slate-500 tracking-wider">
                    <tr>
                        <th class="px-6 py-4 w-12 text-center">#</th>
                        <th class="px-6 py-4">Nama Lengkap</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Role / Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse($admins as $index => $admin)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-6 py-4 text-center font-medium text-slate-400">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-semibold text-slate-800">{{ $admin->name }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $admin->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($admin->is_master)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                        <i class="fas fa-crown text-amber-500 text-xs"></i> Master Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                        <i class="fas fa-user-shield text-slate-400 text-xs"></i> Admin
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center gap-2">
                                    
                                    {{-- 1. Tombol Edit Password --}}
                                    <a href="{{ route('admin.admins.edit-password', $admin->id) }}" 
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-md transition-colors shadow-sm" 
                                       title="Edit Password">
                                        <i class="fas fa-key text-xs"></i> Pass
                                    </a>

                                    {{-- 2. Tombol Transfer Master Admin --}}
                                    @if(!$admin->is_master)
                                        <form action="{{ route('admin.admins.make-master', $admin->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menjadikan {{ $admin->name }} sebagai Master Admin Utama? Status Master Anda akan dipindahkan.')">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-sky-600 hover:bg-sky-700 text-white text-xs font-medium rounded-md transition-colors shadow-sm" title="Jadikan Master Admin">
                                                <i class="fas fa-crown text-xs"></i> Set Utama
                                            </button>
                                        </form>
                                    @endif

                                    {{-- 3. Tombol Hapus --}}
                                    @if($admin->id !== Auth::id() && !$admin->is_master)
                                        <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin {{ $admin->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white text-xs font-medium rounded-md transition-colors shadow-sm" title="Hapus Admin">
                                                <i class="fas fa-trash text-xs"></i> Hapus
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-400">Belum ada data admin.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection