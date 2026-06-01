<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TpsMasukController;
use App\Http\Controllers\Admin\HasilPilahController;
use App\Http\Controllers\Admin\RekapBankSampahController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\JenisSampahController;
use App\Http\Controllers\Admin\NamaSampahController;
use App\Http\Controllers\Admin\HargaSampahController;
use App\Http\Controllers\Admin\BankSampahMitraController;
use App\Http\Controllers\Admin\InfoTpsController;
use App\Http\Controllers\Admin\ApiController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'index'])->name('public.index');
Route::get('/profil', [PublicController::class, 'profil'])->name('public.profil');
Route::get('/data-sampah', [PublicController::class, 'dataSampah'])->name('public.data-sampah');
Route::get('/bank-sampah', [PublicController::class, 'bankSampah'])->name('public.bank-sampah');
Route::get('/galeri', [PublicController::class, 'galeri'])->name('public.galeri');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    // FIX: nama route adalah 'admin.dashboard' (dengan prefix 'admin.')
    // Sebelumnya terdaftar sebagai 'dashboard' (tanpa prefix)
    // yang menyebabkan middleware 'guest' mendeteksinya dan
    // me-redirect user yang sudah login ke route 'dashboard' tersebut,
    // yaitu /admin — sehingga /login tidak pernah bisa diakses
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Sampah Masuk TPS
    Route::get('/tps-masuk', [TpsMasukController::class, 'index'])->name('tps-masuk.index');
    Route::post('/tps-masuk', [TpsMasukController::class, 'store'])->name('tps-masuk.store');
    Route::get('/tps-masuk/{tpsMasuk}/edit', [TpsMasukController::class, 'edit'])->name('tps-masuk.edit');
    Route::put('/tps-masuk/{tpsMasuk}', [TpsMasukController::class, 'update'])->name('tps-masuk.update');
    Route::delete('/tps-masuk/{tpsMasuk}', [TpsMasukController::class, 'destroy'])->name('tps-masuk.destroy');

    // Hasil Pilah
    Route::get('/hasil-pilah', [HasilPilahController::class, 'index'])->name('hasil-pilah.index');
    Route::get('/hasil-pilah/create', [HasilPilahController::class, 'create'])->name('hasil-pilah.create');
    Route::post('/hasil-pilah', [HasilPilahController::class, 'store'])->name('hasil-pilah.store');
    Route::get('/hasil-pilah/{hasilPilah}/edit', [HasilPilahController::class, 'edit'])->name('hasil-pilah.edit');
    Route::put('/hasil-pilah/{hasilPilah}', [HasilPilahController::class, 'update'])->name('hasil-pilah.update');
    Route::delete('/hasil-pilah/{hasilPilah}', [HasilPilahController::class, 'destroy'])->name('hasil-pilah.destroy');

    // Rekap Bank Sampah
    Route::get('/rekap-bank-sampah', [RekapBankSampahController::class, 'index'])->name('rekap-bank-sampah.index');
    Route::get('/rekap-bank-sampah/create', [RekapBankSampahController::class, 'create'])->name('rekap-bank-sampah.create');
    Route::post('/rekap-bank-sampah', [RekapBankSampahController::class, 'store'])->name('rekap-bank-sampah.store');
    Route::get('/rekap-bank-sampah/{rekapBankSampah}/edit', [RekapBankSampahController::class, 'edit'])->name('rekap-bank-sampah.edit');
    Route::put('/rekap-bank-sampah/{rekapBankSampah}', [RekapBankSampahController::class, 'update'])->name('rekap-bank-sampah.update');
    Route::delete('/rekap-bank-sampah/{rekapBankSampah}', [RekapBankSampahController::class, 'destroy'])->name('rekap-bank-sampah.destroy');

    // Galeri
    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
    Route::post('/galeri', [GaleriController::class, 'store'])->name('galeri.store');
    Route::get('/galeri/{galeri}/edit', [GaleriController::class, 'edit'])->name('galeri.edit');
    Route::put('/galeri/{galeri}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::delete('/galeri/{galeri}', [GaleriController::class, 'destroy'])->name('galeri.destroy');

    // Master Data — Jenis Sampah
    Route::get('/master/jenis-sampah', [JenisSampahController::class, 'index'])->name('jenis-sampah.index');
    Route::post('/master/jenis-sampah', [JenisSampahController::class, 'store'])->name('jenis-sampah.store');
    Route::get('/master/jenis-sampah/{jenisSampah}/edit', [JenisSampahController::class, 'edit'])->name('jenis-sampah.edit');
    Route::put('/master/jenis-sampah/{jenisSampah}', [JenisSampahController::class, 'update'])->name('jenis-sampah.update');
    Route::delete('/master/jenis-sampah/{jenisSampah}', [JenisSampahController::class, 'destroy'])->name('jenis-sampah.destroy');
    Route::patch('/master/jenis-sampah/{jenisSampah}/toggle', [JenisSampahController::class, 'toggle'])->name('jenis-sampah.toggle');

    // Master Data — Nama Sampah
    Route::get('/master/nama-sampah', [NamaSampahController::class, 'index'])->name('nama-sampah.index');
    Route::post('/master/nama-sampah', [NamaSampahController::class, 'store'])->name('nama-sampah.store');
    Route::get('/master/nama-sampah/{namaSampah}/edit', [NamaSampahController::class, 'edit'])->name('nama-sampah.edit');
    Route::put('/master/nama-sampah/{namaSampah}', [NamaSampahController::class, 'update'])->name('nama-sampah.update');
    Route::delete('/master/nama-sampah/{namaSampah}', [NamaSampahController::class, 'destroy'])->name('nama-sampah.destroy');
    Route::patch('/master/nama-sampah/{namaSampah}/toggle', [NamaSampahController::class, 'toggle'])->name('nama-sampah.toggle');

    // Master Data — Harga Sampah
    Route::get('/master/harga-sampah', [HargaSampahController::class, 'index'])->name('harga-sampah.index');
    Route::post('/master/harga-sampah', [HargaSampahController::class, 'store'])->name('harga-sampah.store');
    Route::get('/master/harga-sampah/{hargaSampah}/edit', [HargaSampahController::class, 'edit'])->name('harga-sampah.edit');
    Route::put('/master/harga-sampah/{hargaSampah}', [HargaSampahController::class, 'update'])->name('harga-sampah.update');
    Route::delete('/master/harga-sampah/{hargaSampah}', [HargaSampahController::class, 'destroy'])->name('harga-sampah.destroy');

    // Master Data — Bank Sampah Mitra
    Route::get('/master/bank-sampah-mitra', [BankSampahMitraController::class, 'index'])->name('bank-sampah-mitra.index');
    Route::post('/master/bank-sampah-mitra', [BankSampahMitraController::class, 'store'])->name('bank-sampah-mitra.store');
    Route::get('/master/bank-sampah-mitra/{bankSampahMitra}/edit', [BankSampahMitraController::class, 'edit'])->name('bank-sampah-mitra.edit');
    Route::put('/master/bank-sampah-mitra/{bankSampahMitra}', [BankSampahMitraController::class, 'update'])->name('bank-sampah-mitra.update');
    Route::delete('/master/bank-sampah-mitra/{bankSampahMitra}', [BankSampahMitraController::class, 'destroy'])->name('bank-sampah-mitra.destroy');
    Route::patch('/master/bank-sampah-mitra/{bankSampahMitra}/toggle', [BankSampahMitraController::class, 'toggle'])->name('bank-sampah-mitra.toggle');

    // Info TPS
    Route::get('/info-tps', [InfoTpsController::class, 'edit'])->name('info-tps.edit');
    Route::put('/info-tps', [InfoTpsController::class, 'update'])->name('info-tps.update');

    // Internal API (JSON) — protected by auth middleware
    Route::prefix('api')->name('api.')->group(function () {
        Route::get('/nama-sampah', [ApiController::class, 'namaSampah'])->name('nama-sampah');
        Route::get('/harga-sampah', [ApiController::class, 'hargaSampah'])->name('harga-sampah');
    });
});
