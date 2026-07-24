<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Helper privat untuk mengecek apakah user yang login adalah Master Admin.
     */
    private function checkMasterAccess()
    {
        // Masukkan email kamu yang sedang dipakai login saat ini
        $allowedEmails = [
            'admin@klinik.com', // Ganti dengan emailmu
        ];

        // Mengizinkan jika is_master true ATAU emailnya terdaftar di daftar di atas
        $isMaster = Auth::check() && (Auth::user()->is_master || in_array(Auth::user()->email, $allowedEmails));

        if (!$isMaster) {
            redirect()->route('admin.dashboard')->with('error', 'Akses ditolak! Halaman ini khusus Master Admin.')->send();
            exit;
        }
    }

    public function index()
    {
        $this->checkMasterAccess();

        // Urutkan Master Admin paling atas
        $admins = User::orderBy('is_master', 'desc')->latest()->get();
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        $this->checkMasterAccess();

        return view('admin.admins.create');
    }

    public function store(Request $request)
    {
        $this->checkMasterAccess();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_master' => false,
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Admin baru berhasil ditambahkan!');
    }

    // ============================================================
    // FITUR GANTI PASSWORD
    // ============================================================
    public function editPassword($id)
    {
        $this->checkMasterAccess();

        $admin = User::findOrFail($id);
        return view('admin.admins.edit-password', compact('admin'));
    }

    public function updatePassword(Request $request, $id)
    {
        $this->checkMasterAccess();

        $request->validate([
            'new_password' => 'required|min:6|confirmed',
        ]);

        $admin = User::findOrFail($id);
        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return redirect()->route('admin.admins.index')->with('success', 'Password berhasil diubah!');
    }

    // ============================================================
    // FITUR TRANSFER / SET MASTER ADMIN UTAMA
    // ============================================================
    public function makeMaster($id)
    {
        $this->checkMasterAccess();

        $adminBaru = User::findOrFail($id);

        // Ubah semua admin lain menjadi admin biasa
        User::query()->update(['is_master' => false]);

        // Jadikan admin ini sebagai Master Utama
        $adminBaru->is_master = true;
        $adminBaru->save();

        return redirect()->route('admin.admins.index')->with('success', $adminBaru->name . ' sekarang diatur sebagai Akun Utama (Master Admin)!');
    }

    // ============================================================
    // FITUR HAPUS ADMIN (DENGAN PROTEKSI AMAN)
    // ============================================================
    public function destroy($id)
    {
        $this->checkMasterAccess();

        $admin = User::findOrFail($id);

        // 1. Cegah hapus akun sendiri saat sedang login
        if ($admin->id === Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri saat sedang login!');
        }

        // 2. Cegah hapus Master Admin yang sedang aktif
        if ($admin->is_master) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus Master Admin! Pindahkan status Utama ke akun lain terlebih dahulu.');
        }

        // 3. Cegah jika hanya tersisa 1 admin
        if (User::count() <= 1) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus satu-satunya admin yang tersisa!');
        }

        $admin->delete();
        return redirect()->route('admin.admins.index')->with('success', 'Admin berhasil dihapus!');
    }
}