<?php

use App\Http\Controllers\Autentikasi;
use App\Http\Controllers\Dasbor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/masuk', fn() => view('pages.auth.masuk'))->name('masuk');
    Route::post('/masuk', [Autentikasi::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return match (Auth::user()->tipe) {
            'admin' => route('admin'),
            'mahasiswa' => route('mahasiswa'),
            default => route('keluar'),
        };
    });

    Route::get('/', [Dasbor::class, 'index'])->name('mahasiswa');

    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::get('/', [Dasbor::class, 'index'])->name('admin');
    });

    Route::get('/keluar', [Autentikasi::class, 'logout'])->name('keluar');
});