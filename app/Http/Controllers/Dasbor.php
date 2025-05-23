<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\LowonganMagang;
use App\Models\Mahasiswa;
use App\Models\Magang;
use App\Models\EvaluasiMagang;
use Illuminate\Database\Eloquent\Collection;
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
        if (!in_array($pengguna->tipe, ['ADMIN', 'MAHASISWA', 'DOSEN'])) abort(403, 'Anda tidak memiliki akses.');

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
            'DOSEN' => (function () use ($pengguna): View {
                $nama = $pengguna->dosen->nama;
                $nidn = $pengguna->dosen->nidn;
                $id_dosen = $pengguna->dosen->id_dosen;

                $total_mahasiswa = Mahasiswa::count();
                $total_bimbingan = Magang::where('id_dosen_pembimbing', $id_dosen)->count();
                $mahasiswa_aktif = Magang::where('id_dosen_pembimbing', $id_dosen)->where('status', 'AKTIF')->count();
                $mahasiswa_selesai = Magang::where('id_dosen_pembimbing', $id_dosen)->where('status', 'SELESAI')->count();
                $menunggu_evaluasi = EvaluasiMagang::whereHas('magang', fn($q) => $q->where('id_dosen_pembimbing', $id_dosen))->where('status', 'MENUNGGU')->count();
                $evaluasi_magang = $this->evaluasi_magang();
                $mahasiswa_bimbingan = $this->mahasiswa_bimbingan();
                $aktivitas_terbaru = LogAktivitas::whereHas('magang.pengajuan_magang', fn($q) => $q->where('id_dosen_pembimbing', $id_dosen))->latest()->take(4)->get();
                $total_aktivitas = LogAktivitas::whereHas('magang.pengajuan_magang', fn($q) => $q->where('id_dosen_pembimbing', $id_dosen))->count();

                $rows = $mahasiswa_bimbingan->map(function ($mhs): array {
                    $pengajuan = $mhs->pengajuan_magang->first();
                    $lowongan = $pengajuan?->lowongan;
                    $perusahaan = $lowongan?->perusahaan;

                    return [
                        '<div class="flex items-center gap-2">
                            <img src="' . asset('shared/profil.png') . '" alt="avatar" class="w-8 h-8 rounded-full" /> ' . e($mhs->nama_lengkap) . '
                        </div>',
                        $mhs->nim,
                        $perusahaan?->nama ?? '-',
                        $lowongan?->judul ?? '-',
                        $mhs->status ?? '-',
                        view('components.lecturer.dasbor.aksi', compact('mhs'))->render(),
                    ];
                })->toArray();

                return view('pages.lecturer.dasbor', compact(
                    'nama',
                    'nidn',
                    'total_mahasiswa',
                    'total_bimbingan',
                    'mahasiswa_aktif',
                    'mahasiswa_selesai',
                    'menunggu_evaluasi',
                    'evaluasi_magang',
                    'mahasiswa_bimbingan',
                    'aktivitas_terbaru',
                    'total_aktivitas',
                    'rows',
                ));
            })(),
            default => abort(403),
        };
    }

    public function detail() {}

    /**
     * @param Request $request
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
     * @return Collection|\Illuminate\Database\Eloquent\Builder[]
     *
     * Mengambil data mahasiswa yang sedang bimbingan dosen pembimbing saat ini.
     */
    private function mahasiswa_bimbingan(): array|Collection
    {
        $pengguna = Auth::user();
        $id_dosen = $pengguna->dosen->id_dosen;
        return Mahasiswa::with(['pengajuan_magang.lowongan.perusahaan', 'pengajuan_magang.magang'])
            ->whereHas('pengajuan_magang.magang', fn($q) => $q->where('id_dosen_pembimbing', $id_dosen))
            ->take(8)
            ->get();
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
        return LogAktivitas::whereHas('magang.pengajuan_magang', fn($q) => $q->where('id_mahasiswa', $mahasiswa->id_mahasiswa))->count();
    }

    /**
     * Menghitung jumlah mahasiswa yang masih menunggu evaluasi magang
     * berdasarkan dosen pembimbing saat ini.
     *
     * @return int Jumlah mahasiswa yang menunggu evaluasi
     */
    private function evaluasi_magang(): int
    {
        $pengguna = Auth::user();
        $id_dosen = $pengguna->dosen->id_dosen;
        return EvaluasiMagang::whereHas('magang', fn($q) => $q->where('id_dosen_pembimbing', $id_dosen))
            ->where('evaluasi_magang.status', 'MENUNGGU')
            ->join('magang', 'evaluasi_magang.id_magang', '=', 'magang.id_magang')
            ->join('pengajuan_magang', 'magang.id_pengajuan_magang', '=', 'pengajuan_magang.id_pengajuan_magang')
            ->select('pengajuan_magang.id_mahasiswa')
            ->distinct()
            ->count();
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