<?php

use App\Http\Controllers\Dashboard\AgendaController;
use App\Http\Controllers\Dashboard\AutentikasiController;
use App\Http\Controllers\Dashboard\BeritaController;
use App\Http\Controllers\Dashboard\GuruDanTendikController;
use App\Http\Controllers\Dashboard\HomeController as DashboardHomeController;
use App\Http\Controllers\Dashboard\KelasController;
use App\Http\Controllers\Dashboard\SiswaController;
use App\Http\Controllers\LandingPage\HomeController as LandingPageHomeController;
use App\Http\Controllers\LandingPage\KesiswaanController;
use App\Http\Controllers\LandingPage\ProfilController;
use App\Http\Controllers\LandingPage\PublikasiController;
use App\Http\Middleware\Authenticated;
use App\Http\Middleware\Unauthenticated;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageHomeController::class, 'index'])->name('beranda');

Route::get('/berita', [PublikasiController::class, 'beritaList'])->name('berita-list');
Route::get('/berita/{slug}', [PublikasiController::class, 'beritaDetail'])->name('berita-detail');
Route::get('/agenda', [PublikasiController::class, 'agendaList'])->name('agenda-list');

Route::get('/guru-dan-tendik', [ProfilController::class, 'guruDanTendik'])->name('guru-dan-tendik');

Route::get('/kelas-dan-siswa', [KesiswaanController::class, 'kelasDanSiswa'])->name('kelas-dan-siswa');

Route::middleware(Unauthenticated::class)->group(function () {
    Route::get('/login', [AutentikasiController::class, 'login'])->name('login');
    Route::post('/login-attempt', [AutentikasiController::class, 'loginAttempt'])->name('login-attempt');
});

Route::prefix('/dashboard')->middleware(Authenticated::class)->group(function () {
    Route::get('/', [DashboardHomeController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AutentikasiController::class, 'logout'])->name('logout');

    Route::prefix('/pembelajaran')->group(function () {
        Route::get('/guru-dan-tendik', [GuruDanTendikController::class, 'index'])->name('dashboard-pembelajaran-guru-dan-tendik');
        Route::get('/guru-dan-tendik/tambah', [GuruDanTendikController::class, 'create'])->name('dashboard-pembelajaran-guru-dan-tendik-tambah');
        Route::post('/guru-dan-tendik/simpan', [GuruDanTendikController::class, 'store'])->name('dashboard-pembelajaran-guru-dan-tendik-simpan');
        Route::get('/guru-dan-tendik/edit/{id}', [GuruDanTendikController::class, 'edit'])->name('dashboard-pembelajaran-guru-dan-tendik-edit');
        Route::put('/guru-dan-tendik/perbaharui/{id}', [GuruDanTendikController::class, 'update'])->name('dashboard-pembelajaran-guru-dan-tendik-perbaharui');
        Route::delete('/guru-dan-tendik/hapus/{id}', [GuruDanTendikController::class, 'delete'])->name('dashboard-pembelajaran-guru-dan-tendik-hapus');

        Route::get('/siswa', [SiswaController::class, 'index'])->name('dashboard-pembelajaran-siswa');
        Route::get('/siswa/tambah', [SiswaController::class, 'create'])->name('dashboard-pembelajaran-siswa-tambah');
        Route::post('/siswa/simpan', [SiswaController::class, 'store'])->name('dashboard-pembelajaran-siswa-simpan');
        Route::get('/siswa/edit/{id}', [SiswaController::class, 'edit'])->name('dashboard-pembelajaran-siswa-edit');
        Route::put('/siswa/perbaharui/{id}', [SiswaController::class, 'update'])->name('dashboard-pembelajaran-siswa-perbaharui');
        Route::delete('/siswa/hapus/{id}', [SiswaController::class, 'delete'])->name('dashboard-pembelajaran-siswa-hapus');

        Route::get('/kelas', [KelasController::class, 'index'])->name('dashboard-pembelajaran-kelas');
        Route::get('/kelas/pengaturan/{id}', [KelasController::class, 'tahunAjaran'])->name('dashboard-pembelajaran-kelas-tahun-ajaran');
        Route::get('/kelas/pengaturan/{idKelas}/{idTahunAjaran}', [KelasController::class, 'setting'])->name('dashboard-pembelajaran-kelas-tahun-ajaran-pengaturan');
        Route::get('/kelas/perbaharui/{idKelas}/{idTahunAjaran}', [KelasController::class, 'perbaharui'])->name('dashboard-pembelajaran-kelas-tahun-ajaran-perbaharui');
    });

    Route::prefix('/publikasi')->group(function () {
        Route::get('/berita', [BeritaController::class, 'index'])->name('dashboard-publikasi-berita');
        Route::get('/berita/tambah', [BeritaController::class, 'create'])->name('dashboard-publikasi-berita-tambah');
        Route::post('/berita/simpan', [BeritaController::class, 'store'])->name('dashboard-publikasi-berita-simpan');
        Route::get('/berita/edit/{id}', [BeritaController::class, 'edit'])->name('dashboard-publikasi-berita-edit');
        Route::put('/berita/perbaharui/{id}', [BeritaController::class, 'update'])->name('dashboard-publikasi-berita-perbaharui');
        Route::delete('/berita/hapus/{id}', [BeritaController::class, 'delete'])->name('dashboard-publikasi-berita-hapus');

        Route::get('/agenda', [AgendaController::class, 'index'])->name('dashboard-publikasi-agenda');
        Route::get('/agenda/tambah', [AgendaController::class, 'create'])->name('dashboard-publikasi-agenda-tambah');
        Route::post('/agenda/simpan', [AgendaController::class, 'store'])->name('dashboard-publikasi-agenda-simpan');
        Route::get('/agenda/edit/{id}', [AgendaController::class, 'edit'])->name('dashboard-publikasi-agenda-edit');
        Route::put('/agenda/perbaharui/{id}', [AgendaController::class, 'update'])->name('dashboard-publikasi-agenda-perbaharui');
        Route::delete('/agenda/hapus/{id}', [AgendaController::class, 'delete'])->name('dashboard-publikasi-agenda-hapus');
    });
});