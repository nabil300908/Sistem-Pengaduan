<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SaranController;

Route::get('/', fn() => redirect()->route('welcome'));
Route::get('/welcome', fn() => view('welcome'))->name('welcome');

Route::get('/login',   [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',  [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Publik kirim saran
Route::post('/saran', [SaranController::class, 'store'])->name('saran.store');

Route::prefix('laporan')->name('publik.')->group(function () {
    Route::get('/',          [SiswaController::class, 'index'])->name('index');
    Route::get('/buat',      [SiswaController::class, 'create'])->name('create');
    Route::post('/',         [SiswaController::class, 'store'])->name('store');
    Route::get('/{id}',      [SiswaController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [SiswaController::class, 'edit'])->name('edit');
    Route::put('/{id}',      [SiswaController::class, 'update'])->name('update');
    Route::delete('/{id}',   [SiswaController::class, 'destroy'])->name('destroy');
});

Route::middleware('auth.role:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',             [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/laporan',               [AdminController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/{id}',          [AdminController::class, 'show'])->name('laporan.show');
    Route::patch('/laporan/{id}/status', [AdminController::class, 'updateStatus'])->name('laporan.status');

    // Saran
    Route::get('/saran',              [SaranController::class, 'index'])->name('saran.index');
    Route::post('/saran/{id}/balas',  [SaranController::class, 'balas'])->name('saran.balas');
    Route::delete('/saran/{id}',      [SaranController::class, 'destroy'])->name('saran.destroy');
});