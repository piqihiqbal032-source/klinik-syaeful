@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Edit Jadwal Dokter</h1>

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

    <form action="{{ route('admin.jadwal.update', $jadwal->id_jadwal) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- NAMA DOKTER -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Nama Dokter</label>
            <input type="text" name="nama_dokter" value="{{ old('nama_dokter', $jadwal->nama_dokter) }}" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
        </div>

        <!-- HARI PRAKTIK (Checkbox Aktif/Libur) -->
            <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Hari Praktik</label>
            <p class="text-xs text-gray-400 mb-2">Centang "Aktif" atau "Libur" untuk setiap hari</p>
            
            @php
                $days = ['senin' => 'Senin', 'selasa' => 'Selasa', 'rabu' => 'Rabu', 
                         'kamis' => 'Kamis', 'jumat' => 'Jumat', 'sabtu' => 'Sabtu', 'minggu' => 'Minggu'];
                $hariData = $jadwal->hari_praktik ?? [];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                @foreach($days as $key => $label)
                <div class="flex items-center justify-between p-3 border rounded-lg bg-gray-50">
                    <span class="font-medium text-gray-700 w-20">{{ $label }}</span>
                    <div class="flex items-center space-x-4">
                        <label class="flex items-center space-x-1 cursor-pointer">
                            <input type="radio" name="hari[{{ $key }}]" value="aktif" 
                                {{ isset($hariData[$key]) && $hariData[$key] == 'aktif' ? 'checked' : '' }}
                                class="text-green-600">
                            <span class="text-sm text-green-600">Aktif</span>
                        </label>
                        <label class="flex items-center space-x-1 cursor-pointer">
                            <input type="radio" name="hari[{{ $key }}]" value="libur" 
                                {{ isset($hariData[$key]) && $hariData[$key] == 'libur' ? 'checked' : '' }}
                                class="text-red-600">
                            <span class="text-sm text-red-600">Libur</span>
                        </label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- JAM PRAKTIK -->
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Jam Mulai</label>
                <input type="time" name="jam_mulai" value="{{ old('jam_mulai', $jadwal->jam_mulai) }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Jam Selesai</label>
                <input type="time" name="jam_selesai" value="{{ old('jam_selesai', $jadwal->jam_selesai) }}" 
                       class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
            </div>
        </div>

        <!-- TAMBAH LIBUR KHUSUS (Opsional) -->
        <div class="mt-6 p-4 border border-gray-200 rounded-lg bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-700 mb-3">
                <i class="fas fa-calendar-plus mr-2 text-red-500"></i> Tambah Libur Khusus (Opsional)
            </h3>
            
            <div class="grid grid-cols-2 gap-4 mb-3">
                <div>
                    <label class="block text-gray-600 text-sm font-semibold mb-1">Tanggal Libur</label>
                    <input type="date" name="libur_tanggal" id="libur_tanggal" 
                           class="w-full border border-gray-300 rounded-lg px-3 py-2">
                </div>
                <div>
                    <label class="block text-gray-600 text-sm font-semibold mb-1">Alasan Libur</label>
                    <input type="text" name="libur_keterangan" id="libur_keterangan" 
                           class="w-full border border-gray-300 rounded-lg px-3 py-2" 
                           placeholder="Dinas Luar / Cuti / Sakit">
                </div>
            </div>
            <button type="button" onclick="tambahLibur()" 
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm">
                <i class="fas fa-plus mr-1"></i> Tambah Libur
            </button>

            <!-- Daftar Libur yang Sudah Ada -->
            <div class="mt-4">
                <h4 class="text-sm font-semibold text-gray-600 mb-2">Daftar Libur Khusus:</h4>
                <div id="libur-list" class="space-y-2">
                    @if($jadwal->pengumumanLibur && $jadwal->pengumumanLibur->count() > 0)
                        @foreach($jadwal->pengumumanLibur as $libur)
                        <div class="flex items-center justify-between bg-white p-2 rounded border border-gray-200 libur-item" 
                             data-id="{{ $libur->id }}">
                            <div>
                                <span class="text-sm font-medium">📅 {{ \Carbon\Carbon::parse($libur->tanggal)->format('d/m/Y') }}</span>
                                <span class="text-sm text-gray-600 ml-3">{{ $libur->keterangan ?? 'Tidak ada keterangan' }}</span>
                            </div>
                            <button type="button" onclick="hapusLibur(this, {{ $libur->id }})" 
                                    class="text-red-500 hover:text-red-700 text-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        @endforeach
                    @else
                        <p class="text-sm text-gray-400" id="no-libur">Belum ada libur khusus.</p>
                    @endif
                </div>
            </div>
        </div>

        
        <!-- TOMBOL SIMPAN -->
        <div class="mt-6">
            <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.jadwal.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 ml-2">
                Batal
            </a>
        </div>
    </form>
</div>

<!-- JAVASCRIPT UNTUK TAMBAH & HAPUS LIBUR -->
<script>
    function tambahLibur() {
        const tanggal = document.getElementById('libur_tanggal').value;
        const keterangan = document.getElementById('libur_keterangan').value;

        if (!tanggal) {
            alert('Silakan pilih tanggal libur.');
            return;
        }

        // Kirim request ke server
        fetch('{{ route("admin.jadwal.add-libur", $jadwal->id_jadwal) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                tanggal: tanggal,
                keterangan: keterangan || 'Libur'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Tambahkan ke daftar
                const list = document.getElementById('libur-list');
                const noLibur = document.getElementById('no-libur');
                if (noLibur) noLibur.remove();

                const div = document.createElement('div');
                div.className = 'flex items-center justify-between bg-white p-2 rounded border border-gray-200 libur-item';
                div.dataset.id = data.id;
                div.innerHTML = `
                    <div>
                        <span class="text-sm font-medium">📅 ${data.tanggal}</span>
                        <span class="text-sm text-gray-600 ml-3">${data.keterangan}</span>
                    </div>
                    <button type="button" onclick="hapusLibur(this, ${data.id})" 
                            class="text-red-500 hover:text-red-700 text-sm">
                        <i class="fas fa-trash"></i>
                    </button>
                `;
                list.appendChild(div);

                // Reset form
                document.getElementById('libur_tanggal').value = '';
                document.getElementById('libur_keterangan').value = '';
            }
        })
        .catch(error => {
            alert('Gagal menambahkan libur. Silakan coba lagi.');
            console.error(error);
        });
    }

    function hapusLibur(button, id) {
        if (!confirm('Yakin ingin menghapus libur ini?')) return;

        fetch('{{ route("admin.jadwal.delete-libur", "") }}/' + id, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const item = button.closest('.libur-item');
                item.remove();
                
                // Jika tidak ada libur lagi, tampilkan pesan
                const list = document.getElementById('libur-list');
                if (list.children.length === 0) {
                    list.innerHTML = '<p class="text-sm text-gray-400" id="no-libur">Belum ada libur khusus.</p>';
                }
            }
        })
        .catch(error => {
            alert('Gagal menghapus libur. Silakan coba lagi.');
            console.error(error);
        });
    }
</script>
@endsection