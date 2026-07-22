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
        // Validasi sederhana
        $validated = $request->validate([
            'alamat_lengkap' => 'required',
            'nomor_telepon' => 'required',
            'email' => 'nullable|email',
            'link_peta' => 'nullable|string',
        ]);

        // Update data
        $kontak = KontakKlinik::findOrFail($id);
        $kontak->alamat_lengkap = $request->alamat_lengkap;
        $kontak->nomor_telepon = $request->nomor_telepon;
        $kontak->email = $request->email;
        $kontak->instagram = $request->instagram;
        $kontak->facebook = $request->facebook;
        $kontak->twitter = $request->twitter;
        $kontak->youtube = $request->youtube;
        $kontak->link_peta = $request->link_peta;
        $kontak->save();

        return redirect()->route('admin.kontak.index')->with('success', 'Kontak berhasil diperbarui!');
    }
}