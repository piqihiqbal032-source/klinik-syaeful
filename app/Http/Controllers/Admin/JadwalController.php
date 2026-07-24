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
            'nama_dokter'  => 'required|max:100',
            'hari_praktik' => 'nullable|array', // Disesuaikan dengan name="hari_praktik" di Blade
            'jam_mulai'    => 'required',
            'jam_selesai'  => 'required',
            'status'       => 'nullable|string',
            'catatan'      => 'nullable|string',
        ]);

        // Default susunan hari
        $hari = [
            'senin'  => 'libur',
            'selasa' => 'libur',
            'rabu'   => 'libur',
            'kamis'  => 'libur',
            'jumat'  => 'libur',
            'sabtu'  => 'libur',
            'minggu' => 'libur'
        ];

        // Jika dikirim dari form checkbox biasa (Array sederhana: ['senin', 'selasa'])
        if ($request->has('hari_praktik') && is_array($request->hari_praktik)) {
            foreach ($request->hari_praktik as $key => $val) {
                if (is_numeric($key)) {
                    // Jika dikirim dari checkbox biasa (value 'senin', 'selasa')
                    if (array_key_exists($val, $hari)) {
                        $hari[$val] = 'aktif';
                    }
                } else {
                    // Jika dikirim dari select dropdown per hari ('senin' => 'aktif')
                    if (array_key_exists($key, $hari)) {
                        $hari[$key] = $val;
                    }
                }
            }
        }

        JadwalDokter::create([
            'nama_dokter'  => $request->nama_dokter,
            'hari_praktik' => $hari,
            'jam_mulai'    => $request->jam_mulai,
            'jam_selesai'  => $request->jam_selesai,
            'status'       => $request->status ?? 'aktif',
            'catatan'      => $request->catatan,
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
            'nama_dokter'  => 'required|max:100',
            'hari_praktik' => 'nullable|array', // Disesuaikan dengan name="hari_praktik" di Blade
            'jam_mulai'    => 'required',
            'jam_selesai'  => 'required',
            'status'       => 'nullable|string',
            'catatan'      => 'nullable|string',
        ]);

        $jadwal = JadwalDokter::findOrFail($id);

        $hari = [
            'senin'  => 'libur',
            'selasa' => 'libur',
            'rabu'   => 'libur',
            'kamis'  => 'libur',
            'jumat'  => 'libur',
            'sabtu'  => 'libur',
            'minggu' => 'libur'
        ];

        // Membaca input hari_praktik dari form edit
        if ($request->has('hari_praktik') && is_array($request->hari_praktik)) {
            foreach ($request->hari_praktik as $key => $val) {
                if (is_numeric($key)) {
                    // Berasal dari input checkbox biasa
                    if (array_key_exists($val, $hari)) {
                        $hari[$val] = 'aktif';
                    }
                } else {
                    // Berasal dari input dropdown per hari
                    if (array_key_exists($key, $hari)) {
                        $hari[$key] = $val;
                    }
                }
            }
        }

        $jadwal->update([
            'nama_dokter'  => $request->nama_dokter,
            'hari_praktik' => $hari,
            'jam_mulai'    => $request->jam_mulai,
            'jam_selesai'  => $request->jam_selesai,
            'status'       => $request->status ?? 'aktif',
            'catatan'      => $request->catatan,
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        JadwalDokter::findOrFail($id)->delete();
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus!');
    }

    public function addLibur(Request $request, $id)
    {
        $request->validate([
            'tanggal'    => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        $libur = \App\Models\PengumumanLibur::create([
            'dokter_id'  => $id,
            'tanggal'    => $request->tanggal,
            'keterangan' => $request->keterangan ?? 'Libur'
        ]);

        return response()->json([
            'success'    => true,
            'id'         => $libur->id,
            'tanggal'    => date('d/m/Y', strtotime($libur->tanggal)),
            'keterangan' => $libur->keterangan
        ]);
    }

    public function deleteLibur($id)
    {
        $libur = \App\Models\PengumumanLibur::findOrFail($id);
        $libur->delete();

        return response()->json(['success' => true]);
    }
}