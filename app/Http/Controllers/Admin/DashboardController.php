<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LayananMedis;
use App\Models\JadwalDokter;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLayanan = LayananMedis::count();
        $totalJadwal = JadwalDokter::count();
        
        return view('admin.dashboard', compact('totalLayanan', 'totalJadwal'));
    }
}