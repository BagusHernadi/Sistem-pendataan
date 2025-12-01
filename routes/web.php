<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\Route;

// Redirect ke login jika belum login
Route::get('/', function () {
    return redirect()->route('login.page');
});

// Halaman Dashboard (hanya untuk user login)
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    Route::resource('resident', ResidentController::class);
    
    Route::get('/resident/export/resident.excel',[ExportController::class,'excel'])->name('resident.excel');
    Route::get('/resident/export/resident.pdf', [ExportController::class, 'Pdf'])->name('resident.pdf');
});

// Route Auth
Route::get('/login', [AuthController::class, 'loginPage'])->name('login.page')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'registerPage'])->name('register.page')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
