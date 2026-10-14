<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\ProfileController;

Route::get('/update-profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
Route::get('/admin/dashboard', function () {
    return "Selamat datang di Halaman Rahasia Admin!";
})->middleware(CheckRole::class . ':admin');
