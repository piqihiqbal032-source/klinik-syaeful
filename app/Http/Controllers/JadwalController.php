<?php

namespace App\Http\Controllers;

use App\Models\JadwalDokter;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = JadwalDokter::all();
        return view('jadwal', compact('jadwal'));
    }
    public function show($id)
    {
        $dokter = JadwalDokter::findOrFail($id);
        $hari = $dokter->hari_praktik;
        $libur = PengumumanLibur::where('dokter_id', $id)->get();
        
        return view('jadwal-detail', compact('dokter', 'hari', 'libur'));
    }
}
