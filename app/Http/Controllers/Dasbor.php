<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\LowonganMagang;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Dasbor extends Controller
{
    /**
     * @return callable|RedirectResponse|View
     *
     * Fungsi ini bertujuan untuk menampilkan halaman dasbor berdasarkan
     * tipe pengguna yang sedang masuk ke dalam sistem.
     */
    public function index(): callable|RedirectResponse|View
    {
        /**
         * @var mixed $pengguna
         *
         * Inisialisasi variabel $pengguna, bertujuan untuk menyimpan data
         * pengguna yang sedang masuk sistem dengan menggunakan fungsi
         * Auth::user().
         */
        $pengguna = Auth::user();
        if (!$pengguna) return to_route('masuk');
        if (!in_array($pengguna->tipe, ['ADMIN', 'MAHASISWA'])) abort(403, 'Anda tidak memiliki akses.');

        return match ($pengguna->tipe) {
            'ADMIN' => (function () use ($pengguna): View {
                $jabatan = $pengguna->jabatan;
                $nama = $pengguna->admin->nama;
                $nip = $pengguna->admin->nip;
                return view('pages.admin.dasbor', compact('jabatan', 'nama', 'nip'));
            })(),
            'MAHASISWA' => (function () use ($pengguna): View {
                $lowongan = LowonganMagang::with('perusahaan')->orderBy('tanggal_posting', 'desc')->get();
                $mahasiswa = $this->mahasiswa();
                if (!$mahasiswa || !$mahasiswa->program_studi) abort(404, 'Data mahasiswa tidak ditemukan.');

                $prodi = $mahasiswa->program_studi;
                $ipk = $mahasiswa->ipk;
                $jenjang = $prodi->jenjang;
                $log_aktivitas = $this->log_aktivitas();
                $nama_pengguna = $pengguna->nama_pengguna;
                $nama_prodi = $prodi->nama;
                $semester = ucfirst(strtolower($mahasiswa->semester));
                $status = $mahasiswa->status;
                return view('pages.student.dasbor', compact('ipk', 'jenjang', 'log_aktivitas', 'lowongan', 'nama_pengguna', 'nama_prodi', 'semester', 'status'));
            })(),
            default => abort(403),
        };
    }

    /**
     * @return Mahasiswa
     *
     * Mengambil data mahasiswa beserta relasi program studi berdasarkan
     * pengguna yang sedang masuk.
     */
    private function mahasiswa(): Mahasiswa
    {
        return Mahasiswa::with('program_studi')->where('id_pengguna', Auth::user()->id_pengguna)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection<\App\Models\LogAktivitas>
     *
     * Mengambil seluruh data log aktivitas beserta relasi terkait.
     */
    private function log_aktivitas(): Collection
    {
        return LogAktivitas::with([
            'kegiatan_magang.pengajuan_magang.mahasiswa',
            'kegiatan_magang.pengajuan_magang.lowongan_magang',
            'kegiatan_magang.pengajuan_magang.dosen_pembimbing',
            'kegiatan_magang.periode_magang',
            'kegiatan_magang.dosen_pembimbing',
        ])->get();
    }
}