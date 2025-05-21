<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Autentikasi;
use App\Http\Controllers\Dasbor;
use App\Http\Controllers\LogAktivitas;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::middleware('guest')->group(function () {
    Route::get('/lupa-kata-sandi', fn() => view('pages.auth.lupa-kata-sandi'))->name('lupa-kata-sandi')->withoutMiddleware('auth');
    Route::get('/masuk', fn() => view('pages.auth.masuk'))->name('masuk')->withoutMiddleware('auth');
    Route::post('/masuk', [Autentikasi::class, 'masuk'])->name('login')->withoutMiddleware('auth');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        $tipe = strtolower(Session::get('tipe'));
        if (!in_array($tipe, ['admin', 'mahasiswa', 'dosen'])) return Redirect::route('keluar');
        return Redirect::route("{$tipe}.dasbor");
    })->name('beranda');

    Route::middleware(['authorize:ADMIN'])->prefix('admin')->group(function () {
        Route::get('/', [Dasbor::class, 'index'])->name('admin.dasbor');
        Route::get('/data-mahasiswa', fn() => view('pages.admin.data-mahasiswa'))->name('admin.data-mahasiswa');
        Route::get('/data-dosen', fn() => view('pages.admin.data-dosen'))->name('admin.data-dosen');
        Route::get('/data-perusahaan', fn() => view('pages.admin.data-perusahaan'))->name('admin.data-perusahaan');
        Route::get('/periode-magang', fn() => view('pages.admin.periode-magang'))->name('admin.periode-magang');
        Route::get('/lowongan-magang', fn() => view('pages.admin.lowongan-magang'))->name('admin.lowongan-magang');
        Route::get('/pengajuan-magang', fn() => view('pages.admin.pengajuan-magang'))->name('admin.pengajuan-magang');
        Route::get('/aktivitas-magang', fn() => view('pages.admin.aktivitas-magang'))->name('admin.aktivitas-magang');
    });

    Route::middleware(['authorize:MAHASISWA'])->prefix('mahasiswa')->group(function () {
        Route::get('/', [Dasbor::class, 'index'])->name('mahasiswa.dasbor');
        Route::get('/lowongan', fn() => view('pages.student.lowongan'))->name('mahasiswa.lowongan');
        Route::get('/kelola-lamaran', fn() => view('pages.student.kelola-lamaran'))->name('mahasiswa.kelola-lamaran');
        Route::get('/cari-lowongan', [Dasbor::class, 'index'])->name('mahasiswa.cari-lowongan');

        Route::resource('log-aktivitas', LogAktivitas::class)->parameters(['log-aktivitas' => 'log'])->names([
            'index'     => 'mahasiswa.log-aktivitas',
            'create'    => 'mahasiswa.log-aktivitas.tambah',
            'edit'      => 'mahasiswa.log-aktivitas.ubah',
            'update'    => 'mahasiswa.log-aktivitas.perbarui',
            'destroy'   => 'mahasiswa.log-aktivitas.hapus',
        ]);
    });

    Route::middleware(['authorize:DOSEN'])->prefix('dosen')->group(function () {
        Route::get('/', [Dasbor::class, 'index'])->name('dosen.dasbor');
        Route::get('/data-mahasiswa', fn() => view('pages.dosen.data-mahasiswa'))->name('dosen.data-mahasiswa');
        Route::get('/log-aktivitas', fn() => view('pages.dosen.log-aktivitas'))->name('dosen.log-aktivitas');
    });

    Route::get('/keluar', [Autentikasi::class, 'keluar'])->name('keluar');
});