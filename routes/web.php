<?php

use App\Http\Controllers\Dashboard\GuruDanTendikController;
use App\Http\Controllers\Dashboard\HomeController as DashboardHomeController;
use App\Http\Controllers\Dashboard\KelasController;
use App\Http\Controllers\Dashboard\SiswaController;
use App\Http\Controllers\LandingPage\HomeController as LandingPageHomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageHomeController::class, 'index'])->name('beranda');
Route::get('/dashboard', [DashboardHomeController::class, 'index'])->name('dashboard');

Route::get('/pembelajaran/guru-dan-tendik', [GuruDanTendikController::class, 'index'])->name('dashboard-pembelajaran-guru-dan-tendik');
Route::get('/pembelajaran/guru-dan-tendik/tambah', [GuruDanTendikController::class, 'create'])->name('dashboard-pembelajaran-guru-dan-tendik-tambah');
Route::post('/pembelajaran/guru-dan-tendik/simpan', [GuruDanTendikController::class, 'store'])->name('dashboard-pembelajaran-guru-dan-tendik-simpan');
Route::get('/pembelajaran/guru-dan-tendik/edit/{id}', [GuruDanTendikController::class, 'edit'])->name('dashboard-pembelajaran-guru-dan-tendik-edit');
Route::put('/pembelajaran/guru-dan-tendik/perbaharui/{id}', [GuruDanTendikController::class, 'update'])->name('dashboard-pembelajaran-guru-dan-tendik-perbaharui');
Route::delete('/pembelajaran/guru-dan-tendik/hapus/{id}', [GuruDanTendikController::class, 'delete'])->name('dashboard-pembelajaran-guru-dan-tendik-hapus');

Route::get('/pembelajaran/siswa', [SiswaController::class, 'index'])->name('dashboard-pembelajaran-siswa');
Route::get('/pembelajaran/siswa/tambah', [SiswaController::class, 'create'])->name('dashboard-pembelajaran-siswa-tambah');
Route::post('/pembelajaran/siswa/simpan', [SiswaController::class, 'store'])->name('dashboard-pembelajaran-siswa-simpan');
Route::get('/pembelajaran/siswa/edit/{id}', [SiswaController::class, 'edit'])->name('dashboard-pembelajaran-siswa-edit');
Route::put('/pembelajaran/siswa/perbaharui/{id}', [SiswaController::class, 'update'])->name('dashboard-pembelajaran-siswa-perbaharui');
Route::delete('/pembelajaran/siswa/hapus/{id}', [SiswaController::class, 'delete'])->name('dashboard-pembelajaran-siswa-hapus');

Route::get('/pembelajaran/kelas', [KelasController::class, 'index'])->name('dashboard-pembelajaran-kelas');
Route::get('/pembelajaran/kelas/pengaturan/{id}', [KelasController::class, 'tahunAjaran'])->name('dashboard-pembelajaran-kelas-tahun-ajaran');
Route::get('/pembelajaran/kelas/pengaturan/{idKelas}/{idTahunAjaran}', [KelasController::class, 'setting'])->name('dashboard-pembelajaran-kelas-tahun-ajaran-pengaturan');
Route::get('/pembelajaran/kelas/perbaharui/{idKelas}/{idTahunAjaran}', [KelasController::class, 'perbaharui'])->name('dashboard-pembelajaran-kelas-tahun-ajaran-perbaharui');