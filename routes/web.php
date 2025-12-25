<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\BarangController;

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// Protected Routes (Auth)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/dashboard/hitung-saw', [DashboardController::class, 'hitungSAW'])->name('dashboard.hitung');

    // Barang Routes (Master Data)
Route::prefix('barang')->name('barang.')->group(function () {
    Route::get('/', [BarangController::class, 'index'])->name('index');
    Route::post('/', [BarangController::class, 'store'])->name('store');
    Route::put('/{id}', [BarangController::class, 'update'])->name('update');
    Route::delete('/{id}', [BarangController::class, 'destroy'])->name('destroy');
});


    // Kriteria Routes
    Route::prefix('kriteria')->name('kriteria.')->group(function () {
        Route::get('/', [KriteriaController::class, 'index'])->name('index');
        Route::post('/', [KriteriaController::class, 'store'])->name('store');
        Route::put('/{id}', [KriteriaController::class, 'update'])->name('update');
        Route::delete('/{id}', [KriteriaController::class, 'destroy'])->name('destroy');
    });

    // Alternatif Routes
    Route::prefix('alternatif')->name('alternatif.')->group(function () {
        Route::get('/', [AlternatifController::class, 'index'])->name('index');
        Route::post('/', [AlternatifController::class, 'store'])->name('store');
        Route::put('/{id}', [AlternatifController::class, 'update'])->name('update');
        Route::delete('/{id}', [AlternatifController::class, 'destroy'])->name('destroy');
    });

    // Penilaian Routes
Route::prefix('penilaian')->name('penilaian.')->group(function () {
    Route::get('/', [PenilaianController::class, 'index'])->name('index');
    Route::get('/create', [PenilaianController::class, 'create'])->name('create');
    Route::post('/', [PenilaianController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [PenilaianController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PenilaianController::class, 'update'])->name('update');
    Route::delete('/{id}', [PenilaianController::class, 'destroy'])->name('destroy');
});

// Perhitungan SAW Routes
Route::prefix('perhitungan')->name('perhitungan.')->group(function () {
    Route::get('/', [PerhitunganController::class, 'index'])->name('index');
    Route::post('/proses', [PerhitunganController::class, 'proses'])->name('proses');
});

// Hasil Routes
Route::prefix('hasil')->name('hasil.')->group(function () {
    Route::get('/', [HasilController::class, 'index'])->name('index');
    Route::delete('/{id}', [HasilController::class, 'destroy'])->name('destroy');
    Route::get('/export-pdf', [HasilController::class, 'exportPDF'])->name('export.pdf');
});


    // Profile Routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
        Route::put('/update-password', [ProfileController::class, 'updatePassword'])->name('updatePassword');
    });
});
