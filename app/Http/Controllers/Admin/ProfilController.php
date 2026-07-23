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
            'moto' => 'nullable',          
            'tujuan' => 'nullable',         
            'visi' => 'nullable',
            'misi' => 'nullable',
            'struktur_organisasi' => 'nullable',
        ]);

        $profil = ProfilKlinik::findOrFail($id);

        $profil->sejarah_singkat = $request->sejarah_singkat;
        $profil->moto = $request->moto;             
        $profil->tujuan = $request->tujuan;         
        $profil->visi = $request->visi;
        $profil->misi = $request->misi;

        // Jika struktur_organisasi berupa Array (dari form input dinamis)
        if (is_array($request->struktur_organisasi)) {
            // Filter agar baris input yang kosong tidak ikut tersimpan
            $strukturFiltered = array_filter($request->struktur_organisasi, function ($item) {
                return !is_null($item) && trim($item) !== '';
            });
            // Ubah array menjadi format JSON string agar bisa disimpan di database
            $profil->struktur_organisasi = json_encode(array_values($strukturFiltered));
        } else {
            // Jika dikirim sebagai string biasa
            $profil->struktur_organisasi = $request->struktur_organisasi;
        }

        $profil->save();

        return redirect()->route('admin.profil')->with('success', 'Profil berhasil diperbarui!');
    }
}