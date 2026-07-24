<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    // Menampilkan daftar jadwal di admin
    public function index()
    {
        $jadwal = JadwalDokter::all();
        return view('admin.jadwal.index', compact('jadwal'));
    }

    // Menampilkan form tambah
    public function create()
    {
        return view('admin.jadwal.create');
    }

    // Menyimpan data jadwal baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_dokter'  => 'required|string|max:100',
            'hari_praktik' => 'required|array',
            'jam_mulai'    => 'required',
            'jam_selesai'  => 'required',
            'catatan'      => 'nullable|string',
        ]);

        // Default status per hari
        $hariDefault = [
            'senin'  => 'libur',
            'selasa' => 'libur',
            'rabu'   => 'libur',
            'kamis'  => 'libur',
            'jumat'  => 'libur',
            'sabtu'  => 'libur',
            'minggu' => 'libur'
        ];

        if (is_array($request->hari_praktik)) {
            foreach ($request->hari_praktik as $dayKey => $statusVal) {
                if (array_key_exists($dayKey, $hariDefault)) {
                    $hariDefault[$dayKey] = $statusVal; // Menyimpan: 'aktif', 'libur', atau 'cuti'
                }
            }
        }

        JadwalDokter::create([
            'nama_dokter'  => $request->nama_dokter,
            'hari_praktik' => $hariDefault,
            'jam_mulai'    => $request->jam_mulai,
            'jam_selesai'  => $request->jam_selesai,
            'catatan'      => $request->catatan,
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal dokter berhasil ditambahkan!');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $jadwal = JadwalDokter::findOrFail($id);
        return view('admin.jadwal.edit', compact('jadwal'));
    }

    // Memperbarui data jadwal (Proses Simpan Perubahan)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_dokter'  => 'required|string|max:100',
            'hari_praktik' => 'required|array',
            'jam_mulai'    => 'required',
            'jam_selesai'  => 'required',
            'catatan'      => 'nullable|string',
        ]);

        $jadwal = JadwalDokter::findOrFail($id);

        $hariUpdated = [
            'senin'  => 'libur',
            'selasa' => 'libur',
            'rabu'   => 'libur',
            'kamis'  => 'libur',
            'jumat'  => 'libur',
            'sabtu'  => 'libur',
            'minggu' => 'libur'
        ];

        if (is_array($request->hari_praktik)) {
            foreach ($request->hari_praktik as $dayKey => $statusVal) {
                if (array_key_exists($dayKey, $hariUpdated)) {
                    $hariUpdated[$dayKey] = $statusVal;
                }
            }
        }

        $jadwal->update([
            'nama_dokter'  => $request->nama_dokter,
            'hari_praktik' => $hariUpdated,
            'jam_mulai'    => $request->jam_mulai,
            'jam_selesai'  => $request->jam_selesai,
            'catatan'      => $request->catatan,
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal dokter berhasil diperbarui!');
    }

    // Menghapus data jadwal
    public function destroy($id)
    {
        JadwalDokter::findOrFail($id)->delete();
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus!');
    }

    // Menampilkan detail publik (ke view jadwal-detail.blade.php)
    public function showPublicDetail($id)
    {
        $dokter = JadwalDokter::findOrFail($id);
        return view('jadwal-detail', compact('dokter'));
    }
}