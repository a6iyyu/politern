<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Autentikasi;
use App\Http\Controllers\Dasbor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::middleware('guest')->group(function () {
    Route::get('/masuk', fn() => view('pages.auth.masuk'))->name('masuk');
    Route::post('/masuk', [Autentikasi::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/', fn() => match (Session::get('tipe_pengguna')) {
        'ADMIN'         => route('admin.dasbor'),
        'MAHASISWA'     => route('mahasiswa.dasbor'),
        'PERUSAHAAN'    => route('perusahaan.dasbor'),
        default         => route('keluar'),
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