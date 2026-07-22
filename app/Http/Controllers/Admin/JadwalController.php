<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = JadwalDokter::all();
        return view('admin.jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        return view('admin.jadwal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dokter' => 'required|max:100',
            'hari' => 'required|array',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        $hari = [
            'senin' => 'libur',
            'selasa' => 'libur',
            'rabu' => 'libur',
            'kamis' => 'libur',
            'jumat' => 'libur',
            'sabtu' => 'libur',
            'minggu' => 'libur'
        ];

        foreach ($request->hari as $h) {
            if (array_key_exists($h, $hari)) {
                $hari[$h] = 'aktif';
            }
        }

        JadwalDokter::create([
            'nama_dokter' => $request->nama_dokter,
            'hari_praktik' => $hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $jadwal = JadwalDokter::findOrFail($id);
        return view('admin.jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalDokter::findOrFail($id);

        $request->validate([
            'nama_dokter' => 'required|max:100',
            'hari' => 'required|array',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        $hari = [
            'senin' => 'libur',
            'selasa' => 'libur',
            'rabu' => 'libur',
            'kamis' => 'libur',
            'jumat' => 'libur',
            'sabtu' => 'libur',
            'minggu' => 'libur'
        ];

        foreach ($request->hari as $h) {
            if (array_key_exists($h, $hari)) {
                $hari[$h] = 'aktif';
            }
        }

        $jadwal->update([
            'nama_dokter' => $request->nama_dokter,
            'hari_praktik' => $hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui!');
    }

    // ============================================================
    // 🔥 TAMBAH LIBUR KHUSUS
    // ============================================================
    public function addLibur(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        $libur = \App\Models\PengumumanLibur::create([
            'dokter_id' => $id,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan ?? 'Libur'
        ]);

        return response()->json([
            'success' => true,
            'id' => $libur->id,
            'tanggal' => date('d/m/Y', strtotime($libur->tanggal)),
            'keterangan' => $libur->keterangan
        ]);
    }

    // ============================================================
    // 🔥 HAPUS LIBUR KHUSUS
    // ============================================================
    public function deleteLibur($id)
    {
        $libur = \App\Models\PengumumanLibur::findOrFail($id);
        $libur->delete();

        return response()->json(['success' => true]);
    }

    // ============================================================
    // 🔥 HAPUS JADWAL
    // ============================================================
    public function destroy($id)
    {
        JadwalDokter::findOrFail($id)->delete();
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus!');
    }
}