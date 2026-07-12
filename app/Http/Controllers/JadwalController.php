<?php

namespace App\Http\Controllers;

use App\Models\JadwalDokter;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = JadwalDokter::all();
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }
}