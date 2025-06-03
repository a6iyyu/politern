    <?php

    use App\Http\Controllers\Autentikasi;
    use App\Http\Controllers\Dasbor;
    use App\Http\Controllers\DataDosen;
    use App\Http\Controllers\DataMahasiswa;
    use App\Http\Controllers\DataPerusahaan;
    use App\Http\Controllers\LogAktivitas;
    use App\Http\Controllers\Lowongan;
    use App\Http\Controllers\PeriodeMagang;
    use App\Http\Controllers\RekomendasiMagang;
    use App\Http\Controllers\Pengajuan;
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
            Route::get('/grafik', [Dasbor::class, 'grafik'])->name('admin.dasbor.grafik');

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
            Route::put('/{id}/update', [DataDosen::class, 'update'])->name('admin.data-dosen.update');
            Route::delete('/{id}/hapus', [DataDosen::class, 'destroy'])->name('admin.data-dosen.hapus');
        });

            Route::prefix('data-mahasiswa')->group(function () {
                Route::get('/', [DataMahasiswa::class, 'index'])->name('admin.data-mahasiswa');
                Route::post('/tambah', [DataMahasiswa::class, 'create'])->name('admin.data-mahasiswa.tambah');
                Route::get('/{id}/detail', [DataMahasiswa::class, 'show'])->name('admin.data-mahasiswa.detail');
                Route::get('/{id}/edit', [DataMahasiswa::class, 'edit'])->name('admin.data-mahasiswa.edit');
                Route::post('/{id}/edit', [DataMahasiswa::class, 'update'])->name('admin.data-mahasiswa.perbarui');
                Route::delete('/{id}/hapus', [DataMahasiswa::class, 'destroy'])->name('admin.data-mahasiswa.hapus');
                Route::get('/ekspor-excel', [DataMahasiswa::class, 'export_excel'])->name('admin.data-mahasiswa.ekspor-excel');
            });

            Route::prefix('data-perusahaan')->group(function () {
                Route::get('/', [DataPerusahaan::class, 'index'])->name('admin.data-perusahaan');
                Route::get('/tambah', [DataPerusahaan::class, 'create'])->name('admin.data-perusahaan.tambah');
                Route::get('/{id}/detail', [DataPerusahaan::class, 'show'])->name('admin.data-perusahaan.detail');
                Route::get('/{id}/edit', [DataPerusahaan::class, 'edit'])->name('admin.data-perusahaan.edit');
                Route::post('/{id}/edit', [DataPerusahaan::class, 'update'])->name('admin.data-perusahaan.perbarui');
                Route::delete('/uri: {id}/edit', [DataPerusahaan::class, 'destroy'])->name('admin.data-perusahaan.hapus');
            });

        Route::prefix('periode-magang')->group(function () {
            Route::get('/', [PeriodeMagang::class, 'index'])->name('admin.periode-magang');
            Route::post('/tambah', [PeriodeMagang::class, 'create'])->name('admin.periode-magang.tambah');
            Route::get('/{id}/detail', [PeriodeMagang::class, 'show'])->name('admin.periode-magang.detail');
            Route::get('/{id}/edit', [PeriodeMagang::class, 'edit'])->name('admin.periode-magang.edit');
            Route::delete('/{id}/hapus', [PeriodeMagang::class, 'destroy'])->name('admin.periode-magang.hapus');
            Route::get('/ekspor-excel', [PeriodeMagang::class, 'export_excel'])->name('admin.periode-magang.ekspor-excel');
        });

            Route::prefix('lowongan-magang')->group(function () {
                Route::get('/', [Lowongan::class, 'index'])->name('admin.lowongan-magang');
                Route::get('/tambah', [Lowongan::class, 'create'])->name('admin.lowongan-magang.tambah');
                Route::get('/{id}/detail', [Lowongan::class, 'detail'])->name('admin.lowongan-magang.detail');
                Route::get('/{id}/edit', [Lowongan::class, 'edit'])->name('admin.lowongan-magang.edit');
                Route::post('/{id}/edit', [Lowongan::class, 'update'])->name('admin.lowongan-magang.perbarui');
                Route::delete('/{id}/hapus', [Lowongan::class, 'destroy'])->name('admin.lowongan-magang.hapus');
            });

            Route::prefix('pengajuan-magang')->group(function () {
                Route::get('/', [Pengajuan::class, 'index'])->name('admin.pengajuan-magang');
                Route::get('/{id}/detail', [Pengajuan::class, 'detail'])->name('admin.pengajuan-magang.detail');
                Route::get('/{id}/edit', [Pengajuan::class, 'edit'])->name('admin.pengajuan-magang.edit');
                Route::post('/{id}/edit', [Pengajuan::class, 'update'])->name('admin.pengajuan-magang.perbarui');
                Route::delete('/{id}/hapus', [Pengajuan::class, 'destroy'])->name('admin.pengajuan-magang.hapus');
            });
        });

        Route::middleware(['authorize:MAHASISWA'])->prefix('mahasiswa')->group(function () {
            Route::get('/', [Dasbor::class, 'index'])->name('mahasiswa.dasbor');
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
        });

        Route::get('/keluar', [Autentikasi::class, 'keluar'])->name('keluar');
    });