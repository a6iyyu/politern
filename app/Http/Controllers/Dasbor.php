<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\LowonganMagang;
use App\Models\Mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
                $nama = $pengguna->admin->nama;
                $nip = $pengguna->admin->nip;
                return view('pages.admin.dasbor', compact('nama', 'nip'));
            })(),
            'MAHASISWA' => (function () use ($pengguna): View {
                $lowongan = LowonganMagang::with('perusahaan')->orderBy('tanggal_posting', 'desc')->get();
                $mahasiswa = $this->mahasiswa();
                if ($mahasiswa === null || !$mahasiswa->program_studi) abort(404, 'Data mahasiswa tidak ditemukan.');

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
     * @param \Illuminate\Http\Request $request
     * @return void
     *
     * Fungsi ini bertujuan untuk menampilkan halaman rekomendasi magang
     * dan menghitung metode WASPAS.
     * NB: Ini hanyalah dummy data.
     */
    public function rekomendasi_magang(Request $request): View
    {
        $request->validate([
            'ipk' => ['required', 'numeric', 'min:0', 'max:4'],
            'semester' => ['required', 'numeric', 'min:1', 'max:8'],
            'jenjang' => ['required', 'numeric', 'min:1', 'max:2'],
            'status' => ['required', 'numeric', 'min:1', 'max:2'],
            'lokasi' => ['required', 'numeric', 'min:1', 'max:2'],
        ], [
            'ipk.required'      => 'IPK wajib diisi.',
            'ipk.numeric'       => 'IPK harus berupa angka.',
            'ipk.min'           => 'IPK minimal 0.',
            'ipk.max'           => 'IPK maksimal 4.',
            'semester.required' => 'Semester wajib diisi.',
            'semester.numeric'  => 'Semester harus berupa angka.',
            'semester.min'      => 'Semester minimal 1.',
            'semester.max'      => 'Semester maksimal 8.',
            'jenjang.required'  => 'Jenjang wajib diisi.',
            'jenjang.numeric'   => 'Jenjang harus berupa angka.',
            'jenjang.min'       => 'Jenjang minimal 1.',
            'jenjang.max'       => 'Jenjang maksimal 2.',
            'status.required'   => 'Status wajib diisi.',
            'status.numeric'    => 'Status harus berupa angka.',
            'status.min'        => 'Status minimal 1.',
            'status.max'        => 'Status maksimal 2.',
        ]);

        $ipk = $request->ipk;
        $semester = $request->semester;
        $jenjang = $request->jenjang;
        $status = $request->status;
        $lokasi = $request->lokasi;

        $this->waspas([$ipk, $semester, $jenjang, $status, $lokasi], [0.2, 0.2, 0.2, 0.2, 0.2], 0.5);
        return view('pages.student.dasbor', compact('ipk', 'semester', 'jenjang', 'status', 'lokasi'));
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
     * @return int
     *
     * Mengambil seluruh data log aktivitas beserta relasi terkait.
     */
    private function log_aktivitas(): int
    {
        $mahasiswa = $this->mahasiswa();
        if ($mahasiswa === null) return 0;

        return LogAktivitas::whereHas('kegiatan_magang.pengajuan_magang', function ($query) use ($mahasiswa) {
            $query->where('id_mahasiswa', $mahasiswa->id_mahasiswa);
        })->count();
    }

    /**
     *
     * @param array $alternatif
     * @param array $bobot
     * @param float $lambda
     * @return void
     *
     * Fungsi ini bertujuan untuk melakukan perhitungan metode WASPAS untuk
     * menentukan alternatif terbaik pada rekomendasi magang.
     */
    private function waspas(array $alternatif, array $bobot, float $lambda = 0.5): array
    {
        $jumlah_kriteria = count($bobot);
        $normalisasi = [];

        /** Menghitung nilai maksimum */
        $maks_per_kriteria = [];
        for ($j = 0; $j < $jumlah_kriteria; $j++) {
            $maks_per_kriteria[$j] = max(array_column($alternatif, $j));
        }

        /** Menghitung nilai normalisasi */
        foreach ($alternatif as $i => $a) {
            for ($j = 0; $j < $jumlah_kriteria; $j++) {
                $normalisasi[$i][$j] = $maks_per_kriteria[$j] > 0 ? $a[$j] / $maks_per_kriteria[$j] : 0;
            }
        }

        /** Menghitung nilai Q */
        $hasil = [];
        foreach ($normalisasi as $i => $nilai) {
            $q1 = 0;
            $q2 = 1;
            foreach ($nilai as $j => $v) {
                $q1 += $bobot[$j] * $v;
                $q2 *= pow($v, $bobot[$j]);
            }
            $qi = $lambda * $q1 + (1 - $lambda) * $q2;
            $hasil[$i] = compact('q1', 'q2', 'qi');
        }

        return $hasil;
    }
}