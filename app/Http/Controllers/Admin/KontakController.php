<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KontakKlinik;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $kontak = KontakKlinik::first();
        return view('admin.kontak.index', compact('kontak'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'alamat_lengkap' => 'required',
                'nomor_telepon' => 'required|max:20',
                'email' => 'nullable|email|max:100',
                'instagram' => 'nullable|url|max:255',
                'facebook' => 'nullable|url|max:255',
                'twitter' => 'nullable|url|max:255',
                'youtube' => 'nullable|url|max:255',
                'link_peta' => 'nullable|string|max:500',
            ]);

            $kontak = KontakKlinik::findOrFail($id);
            $data = $request->all();
            
            // Bersihkan link_peta dari backslash
            if (isset($data['link_peta'])) {
                $data['link_peta'] = stripslashes($data['link_peta']);
            }
            
            $kontak->update($data);

            return redirect()->route('admin.kontak.index')->with('success', 'Kontak berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}