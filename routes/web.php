<?php

use App\Http\Controllers\PenilaianSiswaController;
use Illuminate\Support\Facades\Auth;
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
    return redirect()->route('login');
});

Auth::routes();
Route::middleware('auth')->group(function () {

    Route::resource('kriteria', App\Http\Controllers\KriteriaController::class);
    Route::resource('siswa', App\Http\Controllers\SiswaController::class);
    Route::resource('penilaian', App\Http\Controllers\PenilaianSiswaController::class);
    Route::resource('perhitungan', App\Http\Controllers\PerhitunganController::class);
    Route::get('hasil-akhir', [App\Http\Controllers\PerhitunganController::class, 'hasilAkhir'])->name('hasil-akhir.index');
    Route::post('/penilaian/createOrUpdate', [PenilaianSiswaController::class, 'createOrUpdate'])->name('penilaian.createOrUpdate');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/simpan-perhitungan', [App\Http\Controllers\PerhitunganController::class, 'simpanPerhitungan'])->name('perhitungan.simpan');
    Route::get('/riwayat-perhitungan', [App\Http\Controllers\PerhitunganController::class, 'riwayatPerhitungan'])->name('riwayat.perhitungan');
    Route::get('/riwayat-perhitungan/pdf', [App\Http\Controllers\PerhitunganController::class, 'cetakPdf'])->name('riwayat.perhitungan.pdf');
    Route::post('/siswa/import', [App\Http\Controllers\SiswaController::class, 'import'])->name('siswa.import');
    Route::post('/siswa/reset', [App\Http\Controllers\SiswaController::class, 'reset'])->name('siswa.reset');

});
