<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KontakKlinik;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'alamat_lengkap' => 'required',
            'nomor_telepon' => 'required',
            'email' => 'nullable|email|max:100',
            'instagram' => 'nullable|url',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'youtube' => 'nullable|url',
            'link_peta' => 'nullable|string',
        ]);

        $kontak = KontakKlinik::findOrFail($id);

        // Bersihkan link_peta dari karakter backslash
        $data = $request->all();
        if (isset($data['link_peta'])) {
            $data['link_peta'] = stripslashes($data['link_peta']);
        }

        $kontak->update($data);

        return redirect()->route('admin.kontak.index')->with('success', 'Kontak berhasil diperbarui!');
    }
}