<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilKlinik;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = ProfilKlinik::first();
        return view('admin.profil.index', compact('profil'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sejarah_singkat' => 'required',
            'visi' => 'nullable',
            'misi' => 'nullable',
            'struktur' => 'nullable|array',
            'nomor_izin' => 'required',
        ]);

        $profil = ProfilKlinik::find($id);

        // Gabungkan array struktur menjadi string dengan newline
        $strukturString = '';
        if ($request->has('struktur') && is_array($request->struktur)) {
            $strukturString = implode("\n", array_filter($request->struktur));
        }

        $profil->sejarah_singkat = $request->sejarah_singkat;
        $profil->visi = $request->visi;
        $profil->misi = $request->misi;
        $profil->struktur_organisasi = $strukturString;  // ← Simpan sebagai string
        $profil->nomor_izin = $request->nomor_izin;
        $profil->save();

        return redirect()->route('admin.profil')->with('success', 'Profil berhasil diperbarui!');
    }
}