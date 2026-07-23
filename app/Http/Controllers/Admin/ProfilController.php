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
        // Ubah validator menjadi 'required' agar sistem menolak jika ada yang kosong
        $request->validate([
            'sejarah_singkat'     => 'required',
            'moto'                => 'required',          
            'tujuan'              => 'required',         
            'visi'                => 'required',
            'misi'                => 'required',
            'struktur_organisasi' => 'required',
        ], [
            // Pesan peringatan kustom dalam bahasa Indonesia
            'sejarah_singkat.required'     => 'Sejarah singkat wajib diisi!',
            'moto.required'                => 'Moto klinik wajib diisi!',
            'tujuan.required'              => 'Tujuan klinik wajib diisi!',
            'visi.required'                => 'Visi wajib diisi!',
            'misi.required'                => 'Misi wajib diisi!',
            'struktur_organisasi.required' => 'Struktur organisasi wajib diisi!',
        ]);

        $profil = ProfilKlinik::findOrFail($id);

        $profil->sejarah_singkat = $request->sejarah_singkat;
        $profil->moto = $request->moto;             
        $profil->tujuan = $request->tujuan;         
        $profil->visi = $request->visi;
        $profil->misi = $request->misi;

        if (is_array($request->struktur_organisasi)) {
            $strukturFiltered = array_filter($request->struktur_organisasi, function ($item) {
                return !is_null($item) && trim($item) !== '';
            });
            $profil->struktur_organisasi = json_encode(array_values($strukturFiltered));
        } else {
            $profil->struktur_organisasi = $request->struktur_organisasi;
        }

        $profil->save();

        return redirect()->route('admin.profil')->with('success', 'Profil berhasil diperbarui!');
    }
}