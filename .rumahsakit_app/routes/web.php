<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RumahSakitController;
use App\Http\Controllers\PasienController;
use Illuminate\Support\Facades\Route;

// Halaman Awal, arahkan ke halaman login
Route::get('/', function () {
    return view('auth.login');
});

// Grup route yang hanya bisa diakses setelah login
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Arahkan dashboard ke daftar rumah sakit
    Route::get('/dashboard', function () {
        return redirect()->route('rumah_sakit.index');
    })->name('dashboard');

    // Route untuk Profile (bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route untuk CRUD Rumah Sakit (menggunakan resource controller)
    Route::resource('rumah_sakit', RumahSakitController::class);

    // Route untuk CRUD Pasien
    Route::resource('pasien', PasienController::class);

    // Route khusus untuk filter pasien via AJAX
    Route::get('/filter-pasiens', [PasienController::class, 'filter'])->name('pasien.filter');
});


require __DIR__.'/auth.php';
