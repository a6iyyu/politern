<?php

use App\Http\Controllers\Autentikasi;
use App\Http\Controllers\Dasbor;
use App\Http\Controllers\DataDosen;
use App\Http\Controllers\DataMahasiswa;
use App\Http\Controllers\DataPerusahaan;
use App\Http\Controllers\DataProdi;
use App\Http\Controllers\LogAktivitas;
use App\Http\Controllers\Lowongan;
use App\Http\Controllers\Periode;
use App\Http\Controllers\RekomendasiMagang;
use App\Http\Controllers\Pengajuan;
use App\Http\Controllers\PengalamanMahasiswa;
use App\Http\Controllers\Profil;
use App\Http\Controllers\ProyekMahasiswa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::middleware('guest')->group(function () {
    Route::get('/beranda', fn() => view('pages.unregistered.index'))->name('beranda')->withoutMiddleware('auth');
    Route::get('/lupa-kata-sandi', fn() => view('pages.auth.lupa-kata-sandi'))->name('lupa-kata-sandi')->withoutMiddleware('auth');
    Route::get('/masuk', fn() => view('pages.auth.masuk'))->name('masuk')->withoutMiddleware('auth');
    Route::post('/masuk', [Autentikasi::class, 'masuk'])->name('login')->withoutMiddleware('auth');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        $tipe = strtolower(Session::get('tipe'));
        if (!in_array($tipe, ['admin', 'mahasiswa', 'dosen'])) return Redirect::route('keluar');
        return Redirect::route("{$tipe}.dasbor");
    });

    Route::get('/keluar', [Autentikasi::class, 'keluar'])->name('keluar');

    Route::middleware(['authorize:ADMIN'])->prefix('admin')->group(function () {
        Route::get('/', [Dasbor::class, 'index'])->name('admin.dasbor');
        Route::get('/grafik', [Dasbor::class, 'chart'])->name('admin.dasbor.grafik');
        Route::get('/lowongan-magang', fn() => view('pages.admin.lowongan-magang'))->name('admin.lowongan-magang');

        Route::prefix('aktivitas-magang')->group(function () {
            Route::get('/', [LogAktivitas::class, 'index'])->name('admin.aktivitas-magang');
            Route::get('/{id}/detail', [LogAktivitas::class, 'detailForAdmin'])->name('admin.aktivitas-magang.detail');
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

        Route::prefix('periode')->group(function () {
            Route::get('/', [Periode::class, 'index'])->name('admin.periode');
            Route::post('/tambah', [Periode::class, 'create'])->name('admin.periode.tambah');
            Route::get('/{id}/detail', [Periode::class, 'show'])->name('admin.periode.detail');
            Route::get('/{id}/edit', [Periode::class, 'edit'])->name('admin.periode.edit');
            Route::get('/ekspor-excel', [Periode::class, 'export_excel'])->name('admin.periode.ekspor-excel');
            Route::put('/{id}/perbarui', [Periode::class, 'update'])->name('admin.periode.perbarui');
            Route::delete('/{id}/hapus', [Periode::class, 'destroy'])->name('admin.periode.hapus');
        });

        Route::prefix('lowongan-magang')->group(function () {
            Route::get('/', [Lowongan::class, 'index'])->name('admin.lowongan-magang');
            Route::get('/ekspor-excel', [Lowongan::class, 'export_excel'])->name('admin.lowongan-magang.ekspor-excel');
            Route::get('/{id}/detail', [Lowongan::class, 'detail'])->name('admin.lowongan-magang.detail');
            Route::get('/{id}/edit', [Lowongan::class, 'edit'])->name('admin.lowongan-magang.edit');
            Route::put('/{id}/edit', [Lowongan::class, 'update'])->name('admin.lowongan-magang.perbarui');
            Route::post('/tambah', [Lowongan::class, 'store'])->name('admin.lowongan-magang.tambah');
            Route::delete('/{id}/hapus', [Lowongan::class, 'destroy'])->name('admin.lowongan-magang.hapus');
        });

        Route::prefix('pengajuan-magang')->group(function () {
            Route::get('/', [Pengajuan::class, 'index'])->name('admin.pengajuan-magang');
            Route::get('/{id}/detail', [Pengajuan::class, 'detail'])->name('admin.pengajuan-magang.detail');
            Route::get('/{id}/edit', [Pengajuan::class, 'edit'])->name('admin.pengajuan-magang.edit');
            Route::put('/{id}/perbarui', [Pengajuan::class, 'update'])->name('admin.pengajuan-magang.perbarui');
            Route::put('/{id}/status', [Pengajuan::class, 'update_status'])->name('admin.pengajuan-magang.perbarui-status');
            Route::put('/{id}/konfirmasi', [Pengajuan::class, 'confirmation'])->name('admin.pengajuan-magang.konfirmasi');
        });

        Route::prefix('profil')->group(function () {
            Route::get('/', [Profil::class, 'index'])->name('admin.profil');
            Route::get('/edit', [Profil::class, 'edit'])->name('admin.profil.edit');
            Route::post('/edit', [Profil::class, 'update'])->name('admin.profil.perbarui');
        });
    });

    Route::middleware(['authorize:MAHASISWA'])->prefix('mahasiswa')->group(function () {
        Route::get('/', [Dasbor::class, 'index'])->name('mahasiswa.dasbor');

        Route::prefix('rekomendasi-magang')->group(function () {
            Route::get('/{id}/perhitungan', [RekomendasiMagang::class, 'calculation'])->name('mahasiswa.rekomendasi-magang.perhitungan-lowongan')->where('lowongan', '[0-9]+');
            Route::get('/topsis', [RekomendasiMagang::class, 'topsis'])->name('mahasiswa.rekomendasi-magang.perhitungan-keseluruhan')->where('lowongan', '[0-9]+');
            Route::get('/{id}/detail', [Dasbor::class, 'detail'])->name('mahasiswa.rekomendasi-magang.detail')->where('id', '[0-9]+');
            Route::get('/{id?}', [RekomendasiMagang::class, 'index'])->name('mahasiswa.rekomendasi-magang')->where('id', '[0-9]+');
            Route::get('/edit', [RekomendasiMagang::class, 'edit'])->name('mahasiswa.preferensi.edit');
            Route::post('/update', [RekomendasiMagang::class, 'update'])->name('mahasiswa.preferensi.update');
        });

        Route::prefix('kelola-lamaran')->group(function () {
            Route::get('/', [Pengajuan::class, 'index'])->name('mahasiswa.kelola-lamaran');
            Route::get('/{id}/detail', [Pengajuan::class, 'detail'])->name('mahasiswa.kelola-lamaran.detail');
            Route::get('/{id}/edit', [Pengajuan::class, 'edit'])->name('mahasiswa.kelola-lamaran.edit');
            Route::post('/{id}/edit', [Pengajuan::class, 'update'])->name('mahasiswa.kelola-lamaran.perbarui');
            Route::delete('/{id}/hapus', [Pengajuan::class, 'destroy'])->name('mahasiswa.kelola-lamaran.hapus');
        });

        Route::prefix('log-aktivitas')->group(function () {
            Route::get('/', [LogAktivitas::class, 'index'])->name('mahasiswa.log-aktivitas');
            Route::get('/{id}/detail', [LogAktivitas::class, 'detail'])->name('mahasiswa.log-aktivitas.detail');
            Route::get('/{id}/edit', [LogAktivitas::class, 'detail'])->name('mahasiswa.log-aktivitas.edit');
            Route::post('/tambah', [LogAktivitas::class, 'create'])->name('mahasiswa.log-aktivitas.tambah');
            Route::put('/{id}/perbarui', [LogAktivitas::class, 'update'])->name('mahasiswa.log-aktivitas.perbarui');
            Route::delete('/{id}/hapus', [LogAktivitas::class, 'destroy'])->name('mahasiswa.log-aktivitas.hapus');
        });

        Route::prefix('lowongan')->group(function () {
            Route::get('/', [Lowongan::class, 'index'])->name('mahasiswa.lowongan');
            Route::get('/{id}/detail', [Lowongan::class, 'show'])->name('mahasiswa.lowongan.detail');
            Route::get('/cari', [Dasbor::class, 'index'])->name('mahasiswa.lowongan.cari');
        });

        Route::prefix('profil')->group(function () {
            Route::get('/', [Profil::class, 'index'])->name('mahasiswa.profil');

            Route::prefix('pengalaman')->group(function () {
                Route::get('{id}/edit', [PengalamanMahasiswa::class, 'edit'])->name('mahasiswa.profil.pengalaman.edit');
                Route::post('/tambah', [PengalamanMahasiswa::class, 'create'])->name('mahasiswa.profil.pengalaman.tambah');
                Route::put('{id}/edit', [PengalamanMahasiswa::class, 'update'])->name('mahasiswa.profil.pengalaman.perbarui');
                Route::delete('/{id}/hapus', [PengalamanMahasiswa::class, 'destroy'])->name('mahasiswa.profil.pengalaman.hapus');
            });

            Route::prefix('sertifikasi')->group(function () {
                Route::get('/edit', [Profil::class, 'edit'])->name('mahasiswa.profil.sertifikasi.edit');
                Route::get('/tambah', [Profil::class, 'create'])->name('mahasiswa.profil.sertifikasi.buat');
                Route::post('/edit', [Profil::class, 'update'])->name('mahasiswa.profil.sertifikasi.perbarui');
                Route::post('/tambah', [Profil::class, 'store'])->name('mahasiswa.profil.sertifikasi.tambah');
                Route::delete('/hapus', [Profil::class, 'destroy'])->name('mahasiswa.profil.sertifikasi.hapus');
            });

            Route::prefix('proyek')->group(function () {
                Route::get('{id}/edit', [ProyekMahasiswa::class, 'edit'])->name('mahasiswa.profil.proyek.edit');
                Route::post('/tambah', [ProyekMahasiswa::class, 'create'])->name('mahasiswa.profil.proyek.tambah');
                Route::put('{id}/edit', [ProyekMahasiswa::class, 'update'])->name('mahasiswa.profil.proyek.perbarui');
                Route::delete('{id}/hapus', [ProyekMahasiswa::class, 'destroy'])->name('mahasiswa.profil.proyek.hapus');
            });
        });
    });

    Route::middleware(['authorize:DOSEN'])->prefix('dosen')->group(function () {
        Route::get('/', [Dasbor::class, 'index'])->name('dosen.dasbor');
        Route::get('/mahasiswa-bimbingan/{id}', [Dasbor::class, 'detail'])->name('dosen.mahasiswa-bimbingan');
        Route::get('/data-mahasiswa', [DataMahasiswa::class, 'index'])->name('dosen.data-mahasiswa');
        Route::get('/data-mahasiswa/detail/{id}', [DataMahasiswa::class, 'showDetailBimbingan'])->name('dosen.data-mahasiswa.detail');
        Route::get('/log-aktivitas', [LogAktivitas::class, 'index'])->name('dosen.log-aktivitas');
        Route::get('/log-aktivitas/{id}', [LogAktivitas::class, 'showLog'])->name('dosen.log-aktivitas.detail');
        Route::get('/log-aktivitas/{id}/detail', [LogAktivitas::class, 'detailForLecturer'])->name('dosen.log-aktivitas.detail-modal');

        Route::prefix('profil')->group(function () {
            Route::get('/', [Profil::class, 'index'])->name('dosen.profil');
            Route::get('/edit', [Profil::class, 'edit'])->name('dosen.profil.edit');
            Route::post('/edit', [Profil::class, 'update'])->name('dosen.profil.perbarui');
        });
    });
});