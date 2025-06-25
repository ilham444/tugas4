<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware; // Pastikan ini ada

// Import semua controller
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\MateriController as AdminMateriController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ModulController as AdminModulController;
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

// RUTE UNTUK PENGUNJUNG (GUEST)
Route::get('/', function () {
    return view('welcome');
})->name('home');


// RUTE UMUM UNTUK PENGGUNA YANG SUDAH LOGIN
Route::middleware(['auth', 'verified'])->group(function () {
    
    // 1. Redirect ke Dashboard berdasarkan Role
    //    (DIUBAH AGAR KONSISTEN DENGAN MIDDLEWARE)
    Route::get('/dashboard', function () {
        // Menggunakan kolom 'role' (string) agar sama dengan RoleMiddleware
        if (auth()->user()->role === 'admin') { 
            return redirect()->route('admin.dashboard');
        }
        // Jika bukan admin, arahkan ke dashboard user
        return redirect()->route('user.dashboard');
    })->name('dashboard');

    // 2. Profile Pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 3. Sistem Quiz
    Route::get('/quiz', [QuizController::class, 'start'])->name('quiz.start');
    Route::post('/quiz', [QuizController::class, 'submit'])->name('quiz.submit');
    Route::get('/quiz/result', [QuizController::class, 'result'])->name('quiz.result'); // Pastikan method 'result' ada di QuizController

    // 4. Komentar
    Route::post('/komentar', [KomentarController::class, 'store'])->name('komentar.store');
});


// GRUP RUTE KHUSUS ADMIN
Route::middleware(['auth', RoleMiddleware::class . ':admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('modul', AdminModulController::class);
        Route::resource('modul.materi', AdminMateriController::class);
        Route::resource('kategori', KategoriController::class);
        Route::get('questions/create', [QuestionController::class, 'create'])->name('questions.create');
        Route::resource('questions', QuestionController::class)->except(['create']);
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