<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\ProfileController;

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

    // Profile Routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password');
    });
});
