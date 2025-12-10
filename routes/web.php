<?php

use App\Http\Controllers\ResidentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Redirect ke login jika belum login
Route::get('/', function () {
    return redirect()->route('login.page');
});

// Route Auth
Route::get('/login', [AuthController::class, 'loginPage'])->name('login.page')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'registerPage'])->name('register.page')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Route setelah login
Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

     // Halaman laporan
    Route::get('/resident/laporan', [ResidentController::class, 'laporan'])
        ->name('resident.laporan');

    // Resource route (INI SUDAH TERMASUK show)
    Route::resource('resident', ResidentController::class);

    // Export routes
    Route::prefix('resident/export')->name('resident.')->group(function () {
        Route::get('/excel', [ExportController::class, 'excel'])->name('excel');
        Route::get('/pdf', [ExportController::class, 'pdf'])->name('pdf');
    });

    // Report routes
    Route::resource('reports', ReportController::class)->only(['index']);
});
