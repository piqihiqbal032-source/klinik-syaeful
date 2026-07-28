<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::aktif()->latest()->get();
        return view('kegiatan', compact('kegiatans'));
    }
}