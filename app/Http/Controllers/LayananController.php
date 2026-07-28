<?php

namespace App\Http\Controllers;

use App\Models\LayananMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LayananController extends Controller
{
    // Halaman publik - daftar layanan
    public function index()
    {
        $layanans = LayananMedis::where('status_aktif', 'aktif')->get();
        return view('layanan', compact('layanans'));
    }

    // Halaman publik - detail layanan
    public function show($slug)
    {
        $layanan = LayananMedis::where('slug', $slug)->firstOrFail();
        return view('layanan-detail', compact('layanan'));
    }

    // ADMIN: Index
    public function adminIndex()
    {
        $layanans = LayananMedis::all();
        return view('admin.layanan.index', compact('layanans'));
    }

    // ADMIN: Create
    public function create()
    {
        return view('admin.layanan.create');
    }

    // ADMIN: Store
    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'deskripsi_singkat' => 'nullable|string',
            'deskripsi_lengkap' => 'nullable|string',
            'persyaratan' => 'nullable|string',
            'status_bpjs' => 'required|in:BPJS,Umum,BPJS & Umum',
            'status_aktif' => 'required|in:aktif,tidak_aktif',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama_layanan);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('layanan', 'public');
            $data['foto'] = $path;
            $data['gambar'] = $path; // untuk kompatibilitas
        }

        LayananMedis::create($data);

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil ditambahkan');
    }

    // ADMIN: Edit
    public function edit($id)
    {
        $layanan = LayananMedis::findOrFail($id);
        return view('admin.layanan.edit', compact('layanan'));
    }

    // ADMIN: Update
    public function update(Request $request, $id)
    {
        $layanan = LayananMedis::findOrFail($id);

        $request->validate([
            'nama_layanan' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'deskripsi_singkat' => 'nullable|string',
            'deskripsi_lengkap' => 'nullable|string',
            'persyaratan' => 'nullable|string',
            'status_bpjs' => 'required|in:BPJS,Umum,BPJS & Umum',
            'status_aktif' => 'required|in:aktif,tidak_aktif',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('layanan', 'public');
            $data['foto'] = $path;
            $data['gambar'] = $path;
        }

        $layanan->update($data);

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil diupdate');
    }

    // ADMIN: Delete
    public function destroy($id)
    {
        $layanan = LayananMedis::findOrFail($id);
        $layanan->delete();

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil dihapus');
    }
}