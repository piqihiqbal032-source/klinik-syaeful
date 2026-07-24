@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-gray-800 font-weight-bold mb-1">Kelola Admin</h1>
            <p class="text-muted small mb-0">Manajemen akun administrator sistem klinik.</p>
        </div>
        <a href="{{ route('admin.admins.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50 mr-2"></i>Tambah Admin Baru
        </a>
    </div>

    {{-- Alert Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle mr-2"></i>{{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 5%">#</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th style="width: 15%">Role / Status</th>
                            <th style="width: 25%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($admins as $index => $admin)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="font-weight-bold">{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>
                                    @if($admin->is_master)
                                        <span class="badge badge-success px-3 py-2">
                                            <i class="fas fa-crown mr-1"></i> Master Admin
                                        </span>
                                    @else
                                        <span class="badge badge-secondary px-3 py-2">
                                            <i class="fas fa-user-shield mr-1"></i> Admin
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        
                                        {{-- 1. Tombol Reset / Edit Password --}}
                                        <a href="{{ route('admin.admins.edit-password', $admin->id) }}" 
                                           class="btn btn-sm btn-warning mr-1" 
                                           title="Edit Password">
                                            <i class="fas fa-key"></i> Pass
                                        </a>

                                        {{-- 2. Tombol Transfer Master Admin (Jika bukan dirinya & belum jadi master) --}}
                                        @if(!$admin->is_master)
                                            <form action="{{ route('admin.admins.make-master', $admin->id) }}" method="POST" class="d-inline mr-1" onsubmit="return confirm('Apakah Anda yakin ingin menjadikan {{ $admin->name }} sebagai Master Admin Utama? Status Master Anda akan dipindahkan.')">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-info" title="Jadikan Master Admin">
                                                    <i class="fas fa-crown"></i> Set Utama
                                                </button>
                                            </form>
                                        @endif

                                        {{-- 3. Tombol Hapus (Disembunyikan jika akun sendiri atau Master Admin) --}}
                                        @if($admin->id !== Auth::id() && !$admin->is_master)
                                            <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin {{ $admin->name }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus Admin">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Belum ada data admin.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection