<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PropertiController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\PesanKontakController;
use App\Http\Controllers\Admin\InformasiPerusahaanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ===================================================================
// ADMIN ROUTES
// ===================================================================

Route::prefix('admin')->name('admin.')->group(function () {

    // Auth routes (guest)
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    // Protected routes
    Route::middleware('admin.active')->group(function () {

        // Logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        // Ubah Password
        Route::get('/password', [AuthController::class, 'showChangePasswordForm'])->name('password');
        Route::put('/password', [AuthController::class, 'changePassword'])->name('password.update');

        // Kategori
        Route::resource('kategori', KategoriController::class)->except(['show']);

        // Properti
        Route::resource('properti', PropertiController::class)->except(['show']);
        Route::patch('/properti/{properti}/toggle-publish', [PropertiController::class, 'togglePublish'])->name('properti.toggle-publish');
        Route::patch('/properti/{properti}/toggle-unggulan', [PropertiController::class, 'toggleUnggulan'])->name('properti.toggle-unggulan');

        // Galeri Properti
        Route::get('/properti/{properti}/galeri', [GaleriController::class, 'index'])->name('galeri.index');
        Route::post('/properti/{properti}/galeri', [GaleriController::class, 'store'])->name('galeri.store');
        Route::patch('/properti/{properti}/galeri/{galeri}/set-cover', [GaleriController::class, 'setCover'])->name('galeri.set-cover');
        Route::patch('/properti/{properti}/galeri/{galeri}/keterangan', [GaleriController::class, 'updateKeterangan'])->name('galeri.update-keterangan');
        Route::delete('/properti/{properti}/galeri/{galeri}', [GaleriController::class, 'destroy'])->name('galeri.destroy');

        // Pesan Kontak
        Route::get('/pesan', [PesanKontakController::class, 'index'])->name('pesan.index');
        Route::get('/pesan/{pesan}', [PesanKontakController::class, 'show'])->name('pesan.show');
        Route::patch('/pesan/{pesan}/toggle-baca', [PesanKontakController::class, 'toggleBaca'])->name('pesan.toggle-baca');
        Route::delete('/pesan/{pesan}', [PesanKontakController::class, 'destroy'])->name('pesan.destroy');

        // Informasi Perusahaan
        Route::get('/informasi', [InformasiPerusahaanController::class, 'edit'])->name('informasi.edit');
        Route::put('/informasi', [InformasiPerusahaanController::class, 'update'])->name('informasi.update');
    });
});

use App\Http\Controllers\Public\BerandaController;
use App\Http\Controllers\Public\PropertiPublikController;
use App\Http\Controllers\Public\InformasiPublikController;

// ===================================================================
// PUBLIC ROUTES
// ===================================================================

Route::get('/', [BerandaController::class, 'index'])->name('home');
Route::get('/properti', [PropertiPublikController::class, 'index'])->name('properti.index');
Route::get('/properti/{slug}', [PropertiPublikController::class, 'show'])->name('properti.detail');
Route::get('/tentang-kami', [InformasiPublikController::class, 'tentangKami'])->name('tentang-kami');
Route::get('/kontak', [InformasiPublikController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [InformasiPublikController::class, 'kirimPesan'])->name('kontak.kirim');
