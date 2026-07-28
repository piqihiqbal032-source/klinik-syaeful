<?php

namespace App\Http\Controllers;

use App\Models\LayananMedis;

class HomeController extends Controller
{
    public function index()
    {
       $layananUnggulan = LayananMedis::latest()->take(3)->get();
        return view('home', compact('layananUnggulan'));
    }
}