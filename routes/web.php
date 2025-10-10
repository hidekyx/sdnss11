<?php

use App\Http\Controllers\Dashboard\GuruDanTendikController;
use App\Http\Controllers\Dashboard\HomeController as DashboardHomeController;
use App\Http\Controllers\LandingPage\HomeController as LandingPageHomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageHomeController::class, 'index'])->name('beranda');
Route::get('/dashboard', [DashboardHomeController::class, 'index'])->name('dashboard');

Route::get('/pembelajaran/guru-dan-tendik', [GuruDanTendikController::class, 'index'])->name('dashboard-pembelajaran-guru-dan-tendik');