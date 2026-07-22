<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\LayananController as AdminLayananController;
use App\Http\Controllers\Admin\JadwalController as AdminJadwalController;
use App\Http\Controllers\Admin\KontakController as AdminKontakController;
use App\Http\Controllers\Admin\AdminController;

// ============================================================
// 1. HALAMAN PUBLIK
// ============================================================

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [App\Http\Controllers\ProfilController::class, 'index'])->name('profil');
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');
Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
Route::get('/jadwal/{id}', [JadwalController::class, 'show'])->name('jadwal.detail');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');


// ============================================================
// 2. HALAMAN LOGIN
// ============================================================

Route::get('/login', function () {
    return view('auth.login');
})->name('login');


// ============================================================
// 3. REDIRECT SETELAH LOGIN
// ============================================================

Route::get('/dashboard', function () {
    return redirect('/admin/dashboard');
})->name('dashboard');


// ============================================================
// 4. HALAMAN ADMIN (WAJIB LOGIN)
// ============================================================

Route::middleware(['auth'])->prefix('admin')->group(function () {

    // 4a. Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // 4b. CRUD Profil Klinik
    Route::get('/profil', [ProfilController::class, 'index'])->name('admin.profil');
    Route::put('/profil/{id}', [ProfilController::class, 'update'])->name('admin.profil.update');

    // 4c. CRUD Layanan Medis
    Route::get('/layanan', [AdminLayananController::class, 'index'])->name('admin.layanan.index');
    Route::get('/layanan/create', [AdminLayananController::class, 'create'])->name('admin.layanan.create');
    Route::post('/layanan', [AdminLayananController::class, 'store'])->name('admin.layanan.store');
    Route::get('/layanan/{id}/edit', [AdminLayananController::class, 'edit'])->name('admin.layanan.edit');
    Route::put('/layanan/{id}', [AdminLayananController::class, 'update'])->name('admin.layanan.update');
    Route::delete('/layanan/{id}', [AdminLayananController::class, 'destroy'])->name('admin.layanan.destroy');

    // 4d. CRUD Jadwal Dokter
    Route::get('/jadwal', [AdminJadwalController::class, 'index'])->name('admin.jadwal.index');
    Route::get('/jadwal/create', [AdminJadwalController::class, 'create'])->name('admin.jadwal.create');
    Route::post('/jadwal', [AdminJadwalController::class, 'store'])->name('admin.jadwal.store');
    Route::get('/jadwal/{id}/edit', [AdminJadwalController::class, 'edit'])->name('admin.jadwal.edit');
    Route::put('/jadwal/{id}', [AdminJadwalController::class, 'update'])->name('admin.jadwal.update');
    Route::delete('/jadwal/{id}', [AdminJadwalController::class, 'destroy'])->name('admin.jadwal.destroy');

    // 4e. CRUD Kontak Klinik
    Route::get('/kontak', [AdminKontakController::class, 'index'])->name('admin.kontak.index');
    Route::put('/kontak/{id}', [AdminKontakController::class, 'update'])->name('admin.kontak.update');

    // 4f. Route untuk tambah/hapus libur (AJAX)
    Route::post('/jadwal/{id}/add-libur', [AdminJadwalController::class, 'addLibur'])->name('admin.jadwal.add-libur');
    Route::delete('/jadwal/libur/{id}', [AdminJadwalController::class, 'deleteLibur'])->name('admin.jadwal.delete-libur');

    // 4g. Kelola Admin
    Route::get('/admins', [AdminController::class, 'index'])->name('admin.admins.index');
    Route::get('/admins/create', [AdminController::class, 'create'])->name('admin.admins.create');
    Route::post('/admins', [AdminController::class, 'store'])->name('admin.admins.store');
    Route::delete('/admins/{id}', [AdminController::class, 'destroy'])->name('admin.admins.destroy');

    // 4h. Ganti Password Admin
    Route::get('/admins/{id}/edit-password', [AdminController::class, 'editPassword'])->name('admin.admins.edit-password');
    Route::put('/admins/{id}/update-password', [AdminController::class, 'updatePassword'])->name('admin.admins.update-password');

});


// ============================================================
// 5. AUTH ROUTES (BAWAAN BREEZE)
// ============================================================

require __DIR__.'/auth.php';