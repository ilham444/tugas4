<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KomentarController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MateriController as AdminMateriController;
use App\Http\Controllers\Admin\KategoriController;

// User Controllers
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\MateriController as UserMateriController;

// ==============================
// Halaman Awal
// ==============================
Route::get('/', function () {
    return view('welcome');
});

// ==============================
// Redirect Dashboard sesuai Role
// ==============================
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->user()->role === 'user') {
        return redirect()->route('user.dashboard');
    }
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==============================
// Grup Rute ADMIN
// ==============================
Route::middleware([RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('materi', AdminMateriController::class);
    Route::resource('kategori', KategoriController::class)->except('show');
});

// ==============================
// Grup Rute USER
// ==============================
Route::middleware(['auth', RoleMiddleware::class . ':user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/materi/{materi:slug}', [UserMateriController::class, 'show'])->name('materi.show');
});

// ==============================
// Rute Profil (Breeze) + Komentar
// ==============================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/komentar', [KomentarController::class, 'store'])->name('komentar.store');
});

// ==============================
// Auth Routes (Login, Register, etc.)
// ==============================
require __DIR__.'/auth.php';
