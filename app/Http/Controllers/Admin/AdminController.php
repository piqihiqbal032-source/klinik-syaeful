<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::all();
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Admin baru berhasil ditambahkan!');
    }

    // ============================================================
    // FITUR GANTI PASSWORD
    // ============================================================
    public function editPassword($id)
    {
        $admin = User::findOrFail($id);
        return view('admin.admins.edit-password', compact('admin'));
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'new_password' => 'required|min:6|confirmed',
        ]);

        $admin = User::findOrFail($id);
        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return redirect()->route('admin.admins.index')->with('success', 'Password berhasil diubah!');
    }

    // ============================================================
    // FITUR HAPUS (CEK JUMLAH ADMIN)
    // ============================================================
    public function destroy($id)
    {
        $admin = User::findOrFail($id);

        // Cegah hapus admin utama (ID 1)
        if ($admin->id == 1) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus admin utama!');
        }

        // Cek jumlah admin, jika hanya 1 admin tersisa, jangan izinkan hapus
        $totalAdmins = User::count();
        if ($totalAdmins <= 1) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus satu-satunya admin yang tersisa!');
        }

        $admin->delete();
        return redirect()->route('admin.admins.index')->with('success', 'Admin berhasil dihapus!');
    }
}