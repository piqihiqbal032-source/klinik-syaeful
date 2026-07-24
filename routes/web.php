<?php

use Illuminate\Support\Facades\Route;

// Import Controller Publik
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KontakController;

// Import Controller Admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfilController as AdminProfilController;
use App\Http\Controllers\Admin\LayananController as AdminLayananController;
use App\Http\Controllers\Admin\JadwalController as AdminJadwalController;
use App\Http\Controllers\Admin\KontakController as AdminKontakController;
use App\Http\Controllers\Admin\AdminController;

/*
|--------------------------------------------------------------------------
| 1. HALAMAN PUBLIK
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');
Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
Route::get('/jadwal/{id}', [JadwalController::class, 'show'])->name('jadwal.detail');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');


/*
|--------------------------------------------------------------------------
| 2. AUTH & REDIRECT
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard');


/*
|--------------------------------------------------------------------------
| 3. HALAMAN ADMIN (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // 3a. Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 3b. Profil Klinik (Update Only)
    Route::get('/profil', [AdminProfilController::class, 'index'])->name('profil');
    Route::put('/profil/{id}', [AdminProfilController::class, 'update'])->name('profil.update');

    // 3c. CRUD Layanan Medis
    Route::resource('layanan', AdminLayananController::class)->except(['show']);

    // 3d. CRUD Jadwal Dokter
    Route::resource('jadwal', AdminJadwalController::class)->except(['show']);
    Route::post('/jadwal/{id}/add-libur', [AdminJadwalController::class, 'addLibur'])->name('jadwal.add-libur');
    Route::delete('/jadwal/libur/{id}', [AdminJadwalController::class, 'deleteLibur'])->name('jadwal.delete-libur');

    // 3e. Kontak Klinik
    Route::get('/kontak', [AdminKontakController::class, 'index'])->name('kontak.index');
    Route::put('/kontak/{id}', [AdminKontakController::class, 'update'])->name('kontak.update');

    // 3f. Kelola Admin
    Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
    Route::get('/admins/create', [AdminController::class, 'create'])->name('admins.create');
    Route::post('/admins', [AdminController::class, 'store'])->name('admins.store');
    Route::delete('/admins/{id}', [AdminController::class, 'destroy'])->name('admins.destroy');
    
    // Fitur Reset Password
    Route::get('/admins/{id}/edit-password', [AdminController::class, 'editPassword'])->name('admins.edit-password');
    Route::put('/admins/{id}/update-password', [AdminController::class, 'updatePassword'])->name('admins.update-password');
    
    // Fitur Transfer / Set Akun Master Utama
    Route::post('/admins/{id}/make-master', [AdminController::class, 'makeMaster'])->name('admins.make-master');

});


/*
|--------------------------------------------------------------------------
| 4. AUTH ROUTES (BAWAAN BREEZE)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';