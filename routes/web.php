<?php

use App\Http\Controllers\Autentikasi;
use App\Http\Controllers\Dasbor;
use App\Http\Controllers\DataDosen;
use App\Http\Controllers\DataMahasiswa;
use App\Http\Controllers\DataPerusahaan;
use App\Http\Controllers\DataProdi;
use App\Http\Controllers\DurasiMagang;
use App\Http\Controllers\LogAktivitas;
use App\Http\Controllers\Lowongan;
use App\Http\Controllers\PeriodeMagang;
use App\Http\Controllers\RekomendasiMagang;
use App\Http\Controllers\Pengajuan;
use App\Http\Controllers\Profil;
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

    Route::get('/keluar', [Autentikasi::class, 'keluar'])->name('keluar');

    Route::middleware(['authorize:ADMIN'])->prefix('admin')->group(function () {
        Route::get('/', [Dasbor::class, 'index'])->name('admin.dasbor');
        Route::get('/grafik', [Dasbor::class, 'chart'])->name('admin.dasbor.grafik');

        Route::get('/lowongan-magang', fn() => view('pages.admin.lowongan-magang'))->name('admin.lowongan-magang');
        Route::get('/pengajuan-magang', [Pengajuan::class, 'index'])->name('admin.pengajuan-magang');

        Route::prefix('aktivitas-magang')->group(function () {
            Route::get('/', [LogAktivitas::class, 'index'])->name('admin.aktivitas-magang');
            Route::get('/{id}/detail', [LogAktivitas::class, 'detail'])->name('admin.aktivitas-magang.detail');
        });

        Route::prefix('data-dosen')->group(function () {
            Route::get('/', [DataDosen::class, 'index'])->name('admin.data-dosen');
            Route::get('/{id}/detail', [DataDosen::class, 'show'])->name('admin.data-dosen.detail');
            Route::get('/{id}/edit', [DataDosen::class, 'edit'])->name('admin.data-dosen.edit');
            Route::get('/ekspor-excel', [DataDosen::class, 'export_excel'])->name('admin.data-dosen.ekspor-excel');
            Route::post('/tambah', [DataDosen::class, 'create'])->name('admin.data-dosen.tambah');
            Route::put('/{id}/perbarui', [DataDosen::class, 'update'])->name('admin.data-dosen.perbarui');
            Route::delete('/{id}/hapus', [DataDosen::class, 'destroy'])->name('admin.data-dosen.hapus');
        });

        Route::prefix('data-mahasiswa')->group(function () {
            Route::get('/', [DataMahasiswa::class, 'index'])->name('admin.data-mahasiswa');
            Route::get('/{id}/detail', [DataMahasiswa::class, 'show'])->name('admin.data-mahasiswa.detail');
            Route::get('/{id}/edit', [DataMahasiswa::class, 'edit'])->name('admin.data-mahasiswa.edit');
            Route::get('/ekspor-excel', [DataMahasiswa::class, 'export_excel'])->name('admin.data-mahasiswa.ekspor-excel');
            Route::post('/tambah', [DataMahasiswa::class, 'create'])->name('admin.data-mahasiswa.tambah');
            Route::put('/{id}/perbarui', [DataMahasiswa::class, 'update'])->name('admin.data-mahasiswa.perbarui');
            Route::delete('/{id}/hapus', [DataMahasiswa::class, 'destroy'])->name('admin.data-mahasiswa.hapus');
        });

        Route::prefix('data-prodi')->group(function () {
            Route::get('/', [DataProdi::class, 'index'])->name('admin.data-prodi');
            Route::get('/{id}/detail', [DataProdi::class, 'show'])->name('admin.data-prodi.detail');
            Route::get('/{id}/edit', [DataProdi::class, 'edit'])->name('admin.data-prodi.edit');
            Route::get('/ekspor-excel', [DataProdi::class, 'export_excel'])->name('admin.data-prodi.ekspor-excel');
            Route::post('/tambah', [DataProdi::class, 'create'])->name('admin.data-prodi.tambah');
            Route::put('/{id}/perbarui', [DataProdi::class, 'update'])->name('admin.data-prodi.perbarui');
            Route::delete('/{id}/hapus', [DataProdi::class, 'destroy'])->name('admin.data-prodi.hapus');
        });

        Route::prefix('data-perusahaan')->group(function () {
            Route::get('/', [DataPerusahaan::class, 'index'])->name('admin.data-perusahaan');
            Route::get('/{id}/detail', [DataPerusahaan::class, 'show'])->name('admin.data-perusahaan.detail');
            Route::get('/{id}/edit', [DataPerusahaan::class, 'edit'])->name('admin.data-perusahaan.edit');
            Route::post('/tambah', [DataPerusahaan::class, 'create'])->name('admin.data-perusahaan.tambah');
            Route::put('/{id}/perbarui', [DataPerusahaan::class, 'update'])->name('admin.data-perusahaan.perbarui');
            Route::delete('/{id}/hapus', [DataPerusahaan::class, 'destroy'])->name('admin.data-perusahaan.hapus');
            Route::get('/ekspor-excel', [DataPerusahaan::class, 'export_excel'])->name('admin.data-perusahaan.ekspor-excel');
        });

        Route::prefix('periode-magang')->group(function () {
            Route::get('/', [PeriodeMagang::class, 'index'])->name('admin.periode-magang');
            Route::post('/tambah', [PeriodeMagang::class, 'create'])->name('admin.periode-magang.tambah');
            Route::get('/{id}/detail', [PeriodeMagang::class, 'show'])->name('admin.periode-magang.detail');
            Route::get('/{id}/edit', [PeriodeMagang::class, 'edit'])->name('admin.periode-magang.edit');
            Route::get('/ekspor-excel', [PeriodeMagang::class, 'export_excel'])->name('admin.periode-magang.ekspor-excel');
            Route::put('/{id}/perbarui', [PeriodeMagang::class, 'update'])->name('admin.periode-magang.perbarui');
            Route::delete('/{id}/hapus', [PeriodeMagang::class, 'destroy'])->name('admin.periode-magang.hapus');

            Route::prefix('durasi')->group(function () {
                Route::post('/', [DurasiMagang::class, 'store'])->name('admin.periode-magang.durasi.tambah');
                Route::get('/{id}/edit', [DurasiMagang::class, 'edit'])->name('admin.periode-magang.durasi.edit');
                Route::put('/{id}', [DurasiMagang::class, 'update'])->name('admin.periode-magang.durasi.perbarui');
                Route::delete('/{id}', [DurasiMagang::class, 'destroy'])->name('admin.periode-magang.durasi.hapus');
                Route::get('/ekspor-excel', [DurasiMagang::class, 'export_excel'])->name('admin.periode-magang.durasi.ekspor-excel');
            });
        });

        Route::prefix('lowongan-magang')->group(function () {
            Route::get('/', [Lowongan::class, 'index'])->name('admin.lowongan-magang');
            Route::post('/tambah', [Lowongan::class, 'store'])->name('admin.lowongan-magang.tambah');
            Route::get('/{id}/detail', [Lowongan::class, 'detail'])->name('admin.lowongan-magang.detail');
            Route::get('/{id}/edit', [Lowongan::class, 'edit'])->name('admin.lowongan-magang.edit');
            Route::post('/{id}/edit', [Lowongan::class, 'update'])->name('admin.lowongan-magang.perbarui');
            Route::delete('/{id}/hapus', [Lowongan::class, 'destroy'])->name('admin.lowongan-magang.hapus');
            Route::get('/ekspor-excel', [Lowongan::class, 'export_excel'])->name('admin.lowongan-magang.ekspor-excel');
        });

        Route::prefix('pengajuan-magang')->group(function () {
            Route::get('/', [Pengajuan::class, 'index'])->name('admin.pengajuan-magang');
            Route::get('/{id}/detail', [Pengajuan::class, 'detail'])->name('admin.pengajuan-magang.detail');
            Route::get('/{id}/edit', [Pengajuan::class, 'edit'])->name('admin.pengajuan-magang.edit');
            Route::put('/{id}/status', [Pengajuan::class, 'update_status'])->name('admin.pengajuan-magang.perbarui-status');
            Route::post('/{id}/edit', [Pengajuan::class, 'update'])->name('admin.pengajuan-magang.perbarui');
            Route::delete('/{id}/hapus', [Pengajuan::class, 'destroy'])->name('admin.pengajuan-magang.hapus');
        });

        Route::prefix('profil')->group(function () {
            Route::get('/', [Profil::class, 'index'])->name('admin.profil');
            Route::get('/edit', [Profil::class, 'edit'])->name('admin.profil.edit');
            Route::post('/edit', [Profil::class, 'update'])->name('admin.profil.perbarui');
        });
    });
    Route::get('/mahasiswa/rekomendasi-magang/{id_mahasiswa}', [Dasbor::class, 'rekomendasiMagang'])->name('mahasiswa.rekomendasi-magang');

    Route::middleware(['authorize:MAHASISWA'])->prefix('mahasiswa')->group(function () {
        Route::get('/', [Dasbor::class, 'index'])->name('mahasiswa.dasbor');
        Route::get('/rekomendasi-magang/{id_mahasiswa}', [Dasbor::class, 'rekomendasiMagang'])->name('mahasiswa.rekomendasi-magang');
        Route::get('/lowongan', fn() => view('pages.student.lowongan'))->name('mahasiswa.lowongan');
        Route::get('/cari-lowongan', [Dasbor::class, 'index'])->name('mahasiswa.cari-lowongan');


        Route::prefix('kelola-lamaran')->group(function () {
            Route::get('/', [Pengajuan::class, 'index'])->name('mahasiswa.kelola-lamaran');
            Route::get('/{id}/detail', [Pengajuan::class, 'detail'])->name('mahasiswa.kelola-lamaran.detail');
            Route::get('/{id}/edit', [Pengajuan::class, 'edit'])->name('mahasiswa.kelola-lamaran.edit');
            Route::post('/{id}/edit', [Pengajuan::class, 'update'])->name('mahasiswa.kelola-lamaran.perbarui');
            Route::delete('/{id}/hapus', [Pengajuan::class, 'destroy'])->name('mahasiswa.kelola-lamaran.hapus');
        });

        Route::prefix('log-aktivitas')->group(function () {
            Route::get('/', [LogAktivitas::class, 'index'])->name('mahasiswa.log-aktivitas');
            Route::get('/tambah', [LogAktivitas::class, 'create'])->name('mahasiswa.log-aktivitas.tambah');
            Route::get('/{id}/detail', [LogAktivitas::class, 'detail'])->name('mahasiswa.log-aktivitas.detail');
            Route::get('/{id}/edit', [LogAktivitas::class, 'edit'])->name('mahasiswa.log-aktivitas.edit');
            Route::post('/{id}/edit', [LogAktivitas::class, 'update'])->name('mahasiswa.log-aktivitas.perbarui');
            Route::delete('/{id}/hapus', [LogAktivitas::class, 'destroy'])->name('mahasiswa.log-aktivitas.hapus');
        });

        Route::prefix('profil')->group(function () {
            Route::get('/', [Profil::class, 'index'])->name('mahasiswa.profil');
            Route::get('/edit', [Profil::class, 'edit'])->name('mahasiswa.profil.edit');
            Route::post('/edit', [Profil::class, 'update'])->name('mahasiswa.profil.perbarui');
        });

        Route::prefix('rekomendasi-magang')->group(function () {
            Route::get('/{id}/detail', [RekomendasiMagang::class, 'index'])->name('mahasiswa.rekomendasi-magang');
            Route::get('/{id}/lamar', [RekomendasiMagang::class, 'store'])->name('mahasiswa.rekomendasi-magang.lamar');
        });
    });

    Route::middleware(['authorize:DOSEN'])->prefix('dosen')->group(function () {
        Route::get('/', [Dasbor::class, 'index'])->name('dosen.dasbor');
        Route::get('/mahasiswa-bimbingan/{id}', [Dasbor::class, 'detail'])->name('dosen.mahasiswa-bimbingan');
        Route::get('/data-mahasiswa', [DataMahasiswa::class, 'index'])->name('dosen.data-mahasiswa');
        Route::get('/data-mahasiswa/{id}', [DataMahasiswa::class, 'show'])->name('dosen.data-mahasiswa.detail');
        Route::get('/log-aktivitas', [LogAktivitas::class, 'index'])->name('dosen.log-aktivitas');
        Route::get('/log-aktivitas/{id}', [LogAktivitas::class, 'show'])->name('dosen.log-aktivitas.detail');

        Route::prefix('profil')->group(function () {
            Route::get('/', [Profil::class, 'index'])->name('dosen.profil');
            Route::get('/edit', [Profil::class, 'edit'])->name('dosen.profil.edit');
            Route::post('/edit', [Profil::class, 'update'])->name('dosen.profil.perbarui');
        });
    });
});
