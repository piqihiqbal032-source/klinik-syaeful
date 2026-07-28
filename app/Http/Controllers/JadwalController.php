<?php

namespace App\Http\Controllers;

use App\Models\JadwalDokter;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = JadwalDokter::all();
        return view('jadwal', compact('jadwals'));
    }

    public function show($id)
    {  
        $jadwal = JadwalDokter::findOrFail($id);
        return view('jadwal-detail', compact('jadwal'));
    }
}