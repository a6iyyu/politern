<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Autentikasi;
use App\Http\Controllers\Dasbor;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::middleware('guest')->group(function () {
    Route::get('/masuk', fn() => view('pages.auth.masuk'))->name('masuk')->withoutMiddleware('auth');
    Route::post('/masuk', [Autentikasi::class, 'login'])->name('login')->withoutMiddleware('auth');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        $tipe = strtolower(Session::get('tipe_pengguna', 'keluar'));
        return Redirect::route("{$tipe}.dasbor");
    })->name('beranda');

    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::get('/', [Dasbor::class, 'index'])->name('admin.dasbor');
    });

    Route::middleware('mahasiswa')->prefix('mahasiswa')->group(function () {
        Route::get('/', [Dasbor::class, 'index'])->name('mahasiswa.dasbor');
    });

    Route::middleware('perusahaan')->prefix('perusahaan')->group(function () {
        Route::get('/', [Dasbor::class, 'index'])->name('perusahaan.dasbor');
    });

    Route::get('/keluar', [Autentikasi::class, 'logout'])->name('keluar');
});