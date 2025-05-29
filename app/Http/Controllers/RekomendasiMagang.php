<?php

namespace App\Http\Controllers;

use App\Models\LowonganMagang;
use App\Models\Perusahaan;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RekomendasiMagang extends Controller
{
    /**
     * @param string $id
     * @return View
     *
     * Fungsi ini bertujuan untuk menampilkan detail data dari rekomendasi
     * magang pada halaman dasbor mahasiswa.
     */
    public function index(string $id): View
    {
        try {
            $lowongan_magang = LowonganMagang::findOrFail($id);
            return view('pages.student.detail-rekomendasi-magang', compact('lowongan_magang'));
        } catch (ModelNotFoundException $exception) {
            report($exception);
            abort(404, 'Rekomendasi magang yang Anda cari tidak ditemukan.');
        } catch (Exception $exception) {
            report($exception);
            abort(500, 'Terjadi kesalahan pada server.');
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     *
     * Fungsi ini bertujuan untuk menampilkan halaman rekomendasi magang
     * dan menghitung metode WASPAS.
     * NB: Ini hanyalah dummy data.
     */
    public function store(Request $request, string $id): RedirectResponse
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

        $this->waspas([], []);
        return to_route('mahasiswa.rekomendasi-magang.lamar');
    }

    /**
     *
     * @param array $alternatif
     * @param array $bobot
     * @param float $lambda
     * @return array
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