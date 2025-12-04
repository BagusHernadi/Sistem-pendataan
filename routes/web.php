<?php

use App\Http\Controllers\ResidentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExportController;
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
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Route setelah login
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');

     // Halaman laporan
    Route::get('/resident/laporan', [ResidentController::class, 'laporan'])
        ->name('resident.laporan');

    // Resource route (INI SUDAH TERMASUK show)
    Route::resource('resident', ResidentController::class);

    // Export
    Route::get('/resident/export/excel', [ExportController::class, 'excel'])->name('resident.excel');
    Route::get('/resident/export/pdf', [ExportController::class, 'pdf'])->name('resident.pdf');
});
