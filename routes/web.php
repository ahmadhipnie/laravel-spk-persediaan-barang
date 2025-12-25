<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');

Route::get('/alternatif', [AlternatifController::class, 'index'])->name('alternatif.index');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
