<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        // Cukup ambil semua data jadwal tanpa perlu relasi libur
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
            'hari' => 'nullable|array', 
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'status' => 'nullable|string',
            'catatan' => 'nullable|string',
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

        if ($request->has('hari') && is_array($request->hari)) {
            foreach ($request->hari as $h) {
                if (array_key_exists($h, $hari)) {
                    $hari[$h] = 'aktif';
                }
            }
        }

        // TAMBAHKAN status & catatan ke array penciptaan
        JadwalDokter::create([
            'nama_dokter' => $request->nama_dokter,
            'hari_praktik' => $hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $request->status ?? 'aktif',
            'catatan' => $request->catatan,
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
        $request->validate([
            'nama_dokter' => 'required|max:100',
            'hari' => 'nullable|array', 
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'status' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        $jadwal = JadwalDokter::findOrFail($id);

        $hari = [
            'senin' => 'libur',
            'selasa' => 'libur',
            'rabu' => 'libur',
            'kamis' => 'libur',
            'jumat' => 'libur',
            'sabtu' => 'libur',
            'minggu' => 'libur'
        ];

        if ($request->has('hari') && is_array($request->hari)) {
            foreach ($request->hari as $h) {
                if (array_key_exists($h, $hari)) {
                    $hari[$h] = 'aktif';
                }
            }
        }

        // TAMBAHKAN status & catatan ke array update
        $jadwal->update([
            'nama_dokter' => $request->nama_dokter,
            'hari_praktik' => $hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $request->status ?? 'aktif',
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        JadwalDokter::findOrFail($id)->delete();
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus!');
    }

    // TAMBAH LIBUR KHUSUS
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

    // HAPUS LIBUR KHUSUS
    public function deleteLibur($id)
    {
        $libur = \App\Models\PengumumanLibur::findOrFail($id);
        $libur->delete();

        return response()->json(['success' => true]);
    }
}