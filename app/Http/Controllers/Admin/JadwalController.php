<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Tampilkan daftar jadwal dokter di admin
     */
    public function index()
    {
        $jadwal = JadwalDokter::all();
        return view('admin.jadwal.index', compact('jadwal'));
    }

    /**
     * Tampilkan form tambah jadwal
     */
    public function create()
    {
        return view('admin.jadwal.create');
    }

    /**
     * Simpan jadwal baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_dokter'  => 'required|string|max:100',
            'hari_praktik' => 'required|array',
            'jam_mulai'    => 'required',
            'jam_selesai'  => 'required',
            'catatan'      => 'nullable|string',
        ]);

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
                    $hariDefault[$dayKey] = $statusVal;
                }
            }
        }

        JadwalDokter::create([
            'nama_dokter'  => $request->nama_dokter,
            'hari_praktik' => $hariDefault, // Otomatis dicast oleh Model atau tersimpan aman
            'jam_mulai'    => $request->jam_mulai,
            'jam_selesai'  => $request->jam_selesai,
            'catatan'      => $request->catatan,
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal dokter berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit jadwal
     */
    public function edit($id)
    {
        $jadwal = JadwalDokter::findOrFail($id);
        return view('admin.jadwal.edit', compact('jadwal'));
    }

    /**
     * Update data jadwal dokter (Mencegah Error 500)
     */
    public function update(Request $request, $id)
    {
        try {
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

            $jadwal->nama_dokter  = $request->nama_dokter;
            $jadwal->hari_praktik = $hariUpdated;
            $jadwal->jam_mulai    = $request->jam_mulai;
            $jadwal->jam_selesai  = $request->jam_selesai;
            $jadwal->catatan      = $request->catatan;
            
            $jadwal->save();

            return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal dokter berhasil diperbarui!');

        } catch (\Throwable $e) {
            dd([
                'Pesan Error' => $e->getMessage(),
                'File'        => $e->getFile(),
                'Baris'       => $e->getLine(),
            ]);
        }
    }

    /**
     * Hapus data jadwal
     */
    public function destroy($id)
    {
        JadwalDokter::findOrFail($id)->delete();
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus!');
    }
}