<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KegiatanController extends Controller
{
    public function index()
    {
        // Diubah agar mengambil kategori beserta relasi kegiatannya (untuk tampilan per kotak kategori)
        $categories = Category::with('kegiatans')->get();
        return view('admin.kegiatan.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.kegiatan.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'instagram_url' => 'required|url',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:aktif,tidak_aktif',
        ]);

        Kegiatan::create($request->all());

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $categories = Category::all();
        return view('admin.kegiatan.edit', compact('kegiatan', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'judul' => 'required|max:255',
            'deskripsi' => 'nullable',
            'instagram_url' => 'required|url',
            'category_id' => 'required|exists:categories,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:aktif,tidak_aktif',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
                Storage::disk('public')->delete($kegiatan->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('kegiatan', 'public');
        }

        $kegiatan->update($data);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
            Storage::disk('public')->delete($kegiatan->gambar);
        }

        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil dihapus!');
    }

    // ==========================================
    // TAMBAHAN FUNGSI UNTUK KELOLA KATEGORI
    // ==========================================

    public function categoryIndex()
    {
        $categories = Category::all();
        return view('admin.kegiatan.category', compact('categories'));
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function categoryDestroy($id)
    {
        $category = Category::findOrFail($id);
        
        if ($category->kegiatans()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Kategori tidak dapat dihapus karena sedang digunakan oleh kegiatan!');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}