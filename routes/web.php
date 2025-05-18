<?php

use Inertia\Inertia;
use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('dashboard', function () {
//         return Inertia::render('dashboard');
//     })->name('dashboard');
// });

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
