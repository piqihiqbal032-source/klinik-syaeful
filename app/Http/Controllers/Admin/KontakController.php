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

        $kontak = KontakKlinik::find($id);
        $kontak->update($request->all());

        return redirect()->route('admin.kontak.index')->with('success', 'Kontak berhasil diperbarui!');
    }
}