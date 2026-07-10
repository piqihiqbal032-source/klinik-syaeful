<?php

namespace App\Http\Controllers;

use App\Models\ProfilKlinik;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = ProfilKlinik::first();
        return view('profil', compact('profil'));
    }
}