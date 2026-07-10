<?php

namespace App\Http\Controllers;

use App\Models\KontakKlinik;

class KontakController extends Controller
{
    public function index()
    {
        $kontak = KontakKlinik::first();
        return view('kontak', compact('kontak'));
    }
}