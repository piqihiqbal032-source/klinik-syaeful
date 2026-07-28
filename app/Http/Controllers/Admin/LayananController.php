<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LayananMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = LayananMedis::latest()->get();
        return view('admin.layanan.index', compact('layanan'));
    }

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan'      => 'required|max:255',
            'deskripsi'         => 'required|string',
            'status_bpjs'       => 'nullable|in:BPJS,Umum,BPJS & Umum',
            'deskripsi_singkat' => 'nullable',
            'deskripsi_lengkap' => 'nullable',
            'persyaratan'       => 'nullable',
            'foto'              => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama_layanan);
        
        if (LayananMedis::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $data['slug'] . '-' . time();
        }

        $data['status_bpjs'] = $request->status_bpjs ?? 'BPJS & Umum';

        if (empty($data['deskripsi'])) {
            $data['deskripsi'] = $request->deskripsi_lengkap ?? $request->deskripsi_singkat ?? 'Deskripsi tidak tersedia';
        }

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('layanan', 'public');
            $data['gambar'] = $data['foto'];
        }

        LayananMedis::create($data);

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil ditambahkan!');
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
            'nama_layanan'      => 'required|max:255',
            'deskripsi'         => 'required|string',
            'status_bpjs'       => 'nullable|in:BPJS,Umum,BPJS & Umum',
            'deskripsi_singkat' => 'nullable',
            'deskripsi_lengkap' => 'nullable',
            'persyaratan'       => 'nullable',
            'foto'              => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();

        $newSlug = Str::slug($request->nama_layanan);
        if ($newSlug !== $layanan->slug) {
            $existingSlug = LayananMedis::where('slug', $newSlug)
                ->where('id_layanan', '!=', $layanan->id_layanan)
                ->exists();
            $data['slug'] = $existingSlug ? $newSlug . '-' . time() : $newSlug;
        }

        $data['status_bpjs'] = $request->status_bpjs ?? 'BPJS & Umum';

        if (empty($data['deskripsi'])) {
            $data['deskripsi'] = $request->deskripsi_lengkap ?? $request->deskripsi_singkat ?? $layanan->deskripsi;
        }

        if ($request->hasFile('foto')) {
            if ($layanan->foto && Storage::disk('public')->exists($layanan->foto)) {
                Storage::disk('public')->delete($layanan->foto);
            }
            if ($layanan->gambar && Storage::disk('public')->exists($layanan->gambar)) {
                Storage::disk('public')->delete($layanan->gambar);
            }
            $data['foto'] = $request->file('foto')->store('layanan', 'public');
            $data['gambar'] = $data['foto'];
        } else {
            unset($data['foto']);
            unset($data['gambar']);
        }

        $layanan->update($data);

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $layanan = LayananMedis::findOrFail($id);

        if ($layanan->foto && Storage::disk('public')->exists($layanan->foto)) {
            Storage::disk('public')->delete($layanan->foto);
        }
        if ($layanan->gambar && Storage::disk('public')->exists($layanan->gambar)) {
            Storage::disk('public')->delete($layanan->gambar);
        }

        $layanan->delete();

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil dihapus!');
    }
}