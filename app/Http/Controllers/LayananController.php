<?php

namespace App\Http\Controllers;

use App\Models\LayananMedis;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = LayananMedis::all();
        return view('layanan', compact('layanan'));
    }
}