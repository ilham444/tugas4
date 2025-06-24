<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

// Auth & Profile Controllers
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
// Halaman Awal (Landing Page)
// ==============================
Route::get('/', function () {
    return view('welcome');
});

// ==============================
// Redirect ke Dashboard berdasarkan Role
// ==============================
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'user') {
        return redirect()->route('user.dashboard');
    }
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==============================
// Grup Rute ADMIN
// ==============================
Route::middleware(['auth', RoleMiddleware::class . ':admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard Admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // CRUD Materi
        Route::resource('materi', AdminMateriController::class); // route name otomatis: admin.materi.index, etc.

        // CRUD Kategori
        Route::resource('kategori', KategoriController::class); // route name otomatis: admin.kategori.index, etc.
    });

// ==============================
// Grup Rute USER
// ==============================
Route::middleware(['auth', RoleMiddleware::class . ':user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        // Dashboard User
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

        // Materi hanya bisa diakses `show` oleh user
        Route::resource('materi', UserMateriController::class)->only(['show']);
    });

// ==============================
// Rute untuk Profile & Komentar
// ==============================
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Komentar
    Route::post('/komentar', [KomentarController::class, 'store'])->name('komentar.store');
});

// ==============================
// Auth Routes (Breeze Default)
// ==============================
require __DIR__.'/auth.php';
