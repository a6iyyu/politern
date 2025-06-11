<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\BidangMahasiswa;
use App\Models\KeahlianMahasiswa;
use App\Models\LowonganMagang;
use App\Models\Mahasiswa;
use App\Models\PreferensiDurasiMahasiswa;
use App\Models\PreferensiJenisLokasiMagang;
use App\Models\PreferensiLokasiMagang;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class RekomendasiMagang extends Controller
{
    /**
     * @param int $id
     * @return array{lowongan: Collection<int, mixed>, skor: Collection<int, float>}
     */
    public function index(int $id): array
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Ambil data preferensi dan bidang mahasiswa
        $bidang_mahasiswa = BidangMahasiswa::where('id_mahasiswa', $id)->pluck('id_bidang')->toArray();
        $keahlian_mahasiswa = KeahlianMahasiswa::where('id_mahasiswa', $id)->pluck('id_keahlian')->toArray();
        $preferensi_lokasi = PreferensiLokasiMagang::where('id_mahasiswa', $id)->pluck('id_lokasi')->toArray();
        $preferensi_jenis_lokasi = PreferensiJenisLokasiMagang::where('id_mahasiswa', $id)->pluck('id_jenis_lokasi')->toArray();
        $preferensi_durasi = PreferensiDurasiMahasiswa::where('id_mahasiswa', $id)->pluck('id_durasi_magang')->toArray();

        $lowongan_magang = LowonganMagang::with(['keahlian:id_keahlian,nama_keahlian', 'perusahaan.lokasi', 'jenis_lokasi:id_jenis_lokasi,nama_jenis_lokasi', 'bidang:id_bidang,nama_bidang', 'durasi:id_durasi_magang'])
            ->where('status', 'DIBUKA')
            ->where('tanggal_selesai_pendaftaran', '>=', now())
            ->get();

        $matriks_alternatif = [];

        foreach ($lowongan_magang as $lowongan) {
            $baris = [];

            // C1: Keahlian (jumlah keahlian yang cocok / total keahlian lowongan)
            $keahlian_lowongan = $lowongan->keahlian->pluck('id_keahlian')->toArray();
            $jumlah_cocok = count(array_intersect($keahlian_mahasiswa, $keahlian_lowongan));
            $baris['C1'] = count($keahlian_lowongan) > 0 ? $jumlah_cocok / count($keahlian_lowongan) : 0;

            // C2: Lokasi (sesuai preferensi lokasi mahasiswa)
            $lokasi_perusahaan = $lowongan->perusahaan->lokasi->id_lokasi ?? null;
            $baris['C2'] = in_array($lokasi_perusahaan, $preferensi_lokasi) ? 1 : 0;

            // C3: Jenis Lokasi (sesuai preferensi jenis lokasi mahasiswa)
            $jenis_lokasi_lowongan = $lowongan->jenis_lokasi->id_jenis_lokasi ?? null;
            $baris['C3'] = in_array($jenis_lokasi_lowongan, $preferensi_jenis_lokasi) ? 1 : 0;

            // C4: Bidang (cek apakah bidang lowongan ada di bidang mahasiswa)
            $bidang_lowongan = $lowongan->bidang->id_bidang ?? null;
            $baris['C4'] = in_array($bidang_lowongan, $bidang_mahasiswa) ? 1 : 0;

            // C5: Durasi (sesuai preferensi durasi mahasiswa)
            $durasi_lowongan = $lowongan->durasi->id_durasi_magang ?? null;
            $baris['C5'] = in_array($durasi_lowongan, $preferensi_durasi) ? 1 : 0;

            // C6: Gaji (1 jika sama, 0 jika beda)
            $baris['C6'] = ($mahasiswa->gaji === $lowongan->gaji) ? 1 : 0;
            $matriks_alternatif[$lowongan->id_lowongan] = $baris;
        }

        if (empty($matriks_alternatif)) return ['lowongan' => collect(), 'skor' => collect()];

        // Langkah 2: Normalisasi matriks
        $kolom = array_keys(reset($matriks_alternatif));
        $matriks_normalisasi = [];

        foreach ($kolom as $kol) {
            $nilai_kolom = array_column($matriks_alternatif, $kol);
            $jumlah_kuadrat = array_sum(array_map(fn($nilai) => pow($nilai, 2), $nilai_kolom));
            $penyebut = $jumlah_kuadrat > 0 ? sqrt($jumlah_kuadrat) : 1;
            foreach ($matriks_alternatif as $id => $baris) $matriks_normalisasi[$id][$kol] = $baris[$kol] / $penyebut;
        }

        // Langkah 3: Bobot kriteria
        $bobot = [
            'C1' => 0.25, // Keahlian
            'C2' => 0.25, // Lokasi
            'C3' => 0.1,  // Jenis Lokasi
            'C4' => 0.2,  // Bidang
            'C5' => 0.1,  // Durasi
            'C6' => 0.1,  // Gaji
        ];

        // Langkah 4: Matriks terbobot
        $matriks_terbobot = [];
        foreach ($matriks_normalisasi as $id => $baris) {
            foreach ($baris as $kol => $nilai) $matriks_terbobot[$id][$kol] = $nilai * $bobot[$kol];
        }

        // Langkah 5: Tentukan solusi ideal positif & negatif (semua benefit)
        $solusi_ideal_positif = [];
        $solusi_ideal_negatif = [];
        foreach ($kolom as $kol) {
            $nilai_kolom = array_column($matriks_terbobot, $kol);
            $solusi_ideal_positif[$kol] = max($nilai_kolom);
            $solusi_ideal_negatif[$kol] = min($nilai_kolom);
        }

        // Langkah 6: Hitung jarak D+ dan D-
        $nilai_preferensi = [];
        foreach ($matriks_terbobot as $id => $baris) {
            $d_plus = 0;
            $d_minus = 0;
            foreach ($baris as $kol => $nilai) {
                $d_plus += pow($nilai - $solusi_ideal_positif[$kol], 2);
                $d_minus += pow($nilai - $solusi_ideal_negatif[$kol], 2);
            }

            $d_plus = sqrt($d_plus);
            $d_minus = sqrt($d_minus);
            $nilai_preferensi[$id] = ($d_plus + $d_minus) > 0 ? $d_minus / ($d_plus + $d_minus) : 0;
        }

        // Langkah 7: Urutkan hasil rekomendasi berdasarkan nilai preferensi
        arsort($nilai_preferensi);

        $rekomendasi = [];
        foreach ($nilai_preferensi as $id => $skor) {
            $lowongan = $lowongan_magang->find($id);
            if ($lowongan) $rekomendasi[] = ['lowongan' => $lowongan, 'skor' => round($skor, 4)];
        }

        return [
            'lowongan' => collect($rekomendasi)->pluck('lowongan'),
            'skor'     => collect($rekomendasi)->pluck('skor'),
        ];
    }

    public function tampilkan(int $id): View
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $bidang_mahasiswa = BidangMahasiswa::where('id_mahasiswa', $id)->pluck('id_bidang')->toArray();
        $keahlian_mahasiswa = KeahlianMahasiswa::where('id_mahasiswa', $id)->pluck('id_keahlian')->toArray();
        $preferensi_lokasi = PreferensiLokasiMagang::where('id_mahasiswa', $id)->pluck('id_lokasi')->toArray();
        $preferensi_jenis_lokasi = PreferensiJenisLokasiMagang::where('id_mahasiswa', $id)->pluck('id_jenis_lokasi')->toArray();
        $preferensi_durasi = PreferensiDurasiMahasiswa::where('id_mahasiswa', $id)->pluck('id_durasi_magang')->toArray();

        $lowongan_magang = LowonganMagang::with([
            'keahlian:id_keahlian,nama_keahlian',
            'perusahaan.lokasi',
            'jenis_lokasi:id_jenis_lokasi,nama_jenis_lokasi',
            'bidang:id_bidang,nama_bidang',
            'durasi:id_durasi_magang'
        ])
            ->where('status', 'DIBUKA')
            ->where('tanggal_selesai_pendaftaran', '>=', now())
            ->get();

        $matriks_alternatif = [];

        foreach ($lowongan_magang as $lowongan) {
            $baris = [];

            // C1: Keahlian (jumlah keahlian yang cocok / total keahlian lowongan)
            $keahlian_lowongan = $lowongan->keahlian->pluck('id_keahlian')->toArray();
            $jumlah_cocok = count(array_intersect($keahlian_mahasiswa, $keahlian_lowongan));
            $baris['C1'] = count($keahlian_lowongan) > 0 ? $jumlah_cocok / count($keahlian_lowongan) : 0;

            // C2: Lokasi (sesuai preferensi lokasi mahasiswa)
            $lokasi_perusahaan = $lowongan->perusahaan->lokasi->id_lokasi ?? null;
            $baris['C2'] = in_array($lokasi_perusahaan, $preferensi_lokasi) ? 1 : 0;

            // C3: Jenis Lokasi (sesuai preferensi jenis lokasi mahasiswa)
            $jenis_lokasi_lowongan = $lowongan->jenis_lokasi->id_jenis_lokasi ?? null;
            $baris['C3'] = in_array($jenis_lokasi_lowongan, $preferensi_jenis_lokasi) ? 1 : 0;

            // C4: Bidang (cek apakah bidang lowongan ada di bidang mahasiswa)
            $bidang_lowongan = $lowongan->bidang->id_bidang ?? null;
            $baris['C4'] = in_array($bidang_lowongan, $bidang_mahasiswa) ? 1 : 0;

            // C5: Durasi (sesuai preferensi durasi mahasiswa)
            $durasi_lowongan = $lowongan->durasi->id_durasi_magang ?? null;
            $baris['C5'] = in_array($durasi_lowongan, $preferensi_durasi) ? 1 : 0;

            // C6: Gaji (1 jika sama, 0 jika beda)
            $baris['C6'] = ($mahasiswa->gaji === $lowongan->gaji) ? 1 : 0;
            $matriks_alternatif[$lowongan->id_lowongan] = $baris;
        }

        return view('student.dasbor.table', [
            'matriks_alternatif' => $matriks_alternatif,
            'lowongan_magang' => $lowongan_magang,
        ]);
    }
}