<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LayananMedis;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = LayananMedis::all();
        return view('admin.layanan.index', compact('layanan'));
    }

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|max:100',
            'deskripsi' => 'required',
            'status_aktif' => 'required|in:aktif,tidak_aktif',
        ]);

        LayananMedis::create($request->all());
        return redirect()->route('admin.layanan')->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $layanan = LayananMedis::findOrFail($id);
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function update(Request $request, $id)
    {
        $layanan = LayananMedis::findOrFail($id);
        
        $request->validate([
            'nama_layanan' => 'required|max:100',
            'deskripsi' => 'required',
            'status_aktif' => 'required|in:aktif,tidak_aktif',
        ]);

        $layanan->update($request->all());
        return redirect()->route('admin.layanan')->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $layanan = LayananMedis::findOrFail($id);
        $layanan->delete();
        return redirect()->route('admin.layanan')->with('success', 'Layanan berhasil dihapus!');
    }
}