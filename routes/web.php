<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

// Import semua controller
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ModulController as AdminModulController;
use App\Http\Controllers\Admin\MateriController as AdminMateriController; // Pastikan ini juga diimport
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuizResultController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\MateriController as UserMateriController;
use App\Http\Controllers\User\ModulController as UserModulController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ... (semua rute lain biarkan sama) ...
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') { 
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/quiz', [QuizController::class, 'start'])->name('quiz.start');
    Route::post('/quiz', [QuizController::class, 'submit'])->name('quiz.submit');
    Route::get('/quiz/result', [QuizController::class, 'result'])->name('quiz.result');
    Route::post('/komentar', [KomentarController::class, 'store'])->name('komentar.store');
});


// GRUP RUTE KHUSUS ADMIN (BAGIAN YANG DIPERBAIKI)
Route::middleware(['auth', RoleMiddleware::class . ':admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('modul', AdminModulController::class);
        Route::resource('modul.materi', AdminMateriController::class);
        Route::resource('kategori', KategoriController::class);

        // ===== PERBAIKAN DI SINI =====
        // Dua baris yang membingungkan telah diganti dengan satu baris ini
        Route::resource('questions', QuestionController::class);
        
        Route::get('quiz-results', [QuizResultController::class, 'index'])->name('quiz_results.index');
});


// GRUP RUTE KHUSUS PENGGUNA BIASA (USER)
Route::middleware(['auth', RoleMiddleware::class . ':user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        Route::get('/modul', [UserModulController::class, 'index'])->name('modul.index');
        Route::get('/modul/{modul}', [UserModulController::class, 'show'])->name('modul.show');
        Route::get('/modul/{modul}/materi/{materi}', [UserMateriController::class, 'show'])->name('modul.materi.show');
});


// FILE RUTE OTENTIKASI
require __DIR__ . '/auth.php';