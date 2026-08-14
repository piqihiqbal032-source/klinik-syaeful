<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Category; 
use Illuminate\Http\Request; 

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua kategori untuk tombol filter di view
        $categories = Category::all();

        // Cek apakah ada parameter 'category' yang dikirim dari URL
        if ($request->has('category') && $request->category != '') {
            $kegiatans = Kegiatan::aktif()
                ->where('category_id', $request->category)
                ->latest()
                ->get();
        } else {
            // Jika tidak ada filter, tampilkan semua kegiatan aktif
            $kegiatans = Kegiatan::aktif()->latest()->get();
        }

        return view('kegiatan', compact('kegiatans', 'categories'));
    }
}