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
use App\Models\Bidang;
use App\Models\Keahlian;
use App\Models\Lokasi;
use App\Models\JenisLokasi;
use App\Models\DurasiMagang;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\Request;

class RekomendasiMagang extends Controller
{
    /**
     * @param int $id
     * @return array{lowongan: Collection<int, mixed>, skor: Collection<int, float>}
     */
    public function index(int $id): array
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        if ($mahasiswa == null) {
            Log::error("Mahasiswa dengan ID {$id} tidak ditemukan");
            return ['lowongan' => collect(), 'skor' => collect()];
        }

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

        if ($lowongan_magang->count() == 0) {
            Log::warning("Tidak ada lowongan tersedia untuk mahasiswa ID {$id}");
            return ['lowongan' => collect(), 'skor' => collect()];
        }

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
            'C1' => 0.2196, // Keahlian
            'C2' => 0.1463, // Lokasi
            'C3' => 0.1219,  // Jenis Lokasi
            'C4' => 0.2439,  // Bidang
            'C5' => 0.0976,  // Durasi
            'C6' => 0.1707,  // Gaji
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
        $jarak_data = []; // Tambahan untuk debug
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

            // Simpan data jarak untuk debug
            $jarak_data[$id] = [
                'd_plus' => $d_plus,
                'd_minus' => $d_minus,
                'preferensi' => $nilai_preferensi[$id]
            ];
        }

        // Langkah 7: Urutkan hasil rekomendasi berdasarkan nilai preferensi
        arsort($nilai_preferensi);

        // Tambahkan peringkat berdasarkan urutan hasil preferensi
        $rekomendasi = [];
        $peringkat = 1; // Mulai dari peringkat 1
        foreach ($nilai_preferensi as $id => $skor) {
            $lowongan = $lowongan_magang->find($id);
            if ($lowongan) {
                $rekomendasi[] = [
                    'lowongan' => $lowongan,
                    'skor' => round($skor, 4),
                    'peringkat' => $peringkat, // Menambahkan peringkat
                ];
                $peringkat++; // Increment peringkat untuk lowongan berikutnya
            }
        }

        Log::info('Rekomendasi:', $rekomendasi);
        return [
            'lowongan' => collect($rekomendasi)->pluck('lowongan'),
            'skor'     => collect($rekomendasi)->pluck('skor'),
            'peringkat' => collect($rekomendasi)->pluck('peringkat'),
            'debug'    => [
                'matriks_alternatif' => $matriks_alternatif,
                'matriks_normalisasi' => $matriks_normalisasi,
                'matriks_terbobot' => $matriks_terbobot,
                'solusi_ideal_positif' => $solusi_ideal_positif,
                'solusi_ideal_negatif' => $solusi_ideal_negatif,
                'jarak_data' => $jarak_data,
                'nilai_preferensi' => $nilai_preferensi,
            ]
        ];
    }

    public function calculation(LowonganMagang $id): View
    {
        $hasil = $this->index(Auth::user()->mahasiswa->id_mahasiswa);

        if (!array_key_exists($id->id_lowongan, $hasil['debug']['nilai_preferensi'])) {
            Log::error("Lowongan tidak ditemukan dalam hasil rekomendasi untuk mahasiswa ini. ID Lowongan: {$id->id_lowongan}");
            abort(404, "Lowongan tidak ditemukan dalam hasil rekomendasi untuk mahasiswa ini.");
        }

        return view('pages.student.perhitungan-lowongan', [
            'lowongan' => $hasil['lowongan']->firstWhere('id_lowongan', $id->id_lowongan),
            'skor' => $hasil['skor']->get($id->id_lowongan),
            'matriks_alternatif' => [$id->id_lowongan => $hasil['debug']['matriks_alternatif'][$id->id_lowongan]],
            'matriks_normalisasi' => [$id->id_lowongan => $hasil['debug']['matriks_normalisasi'][$id->id_lowongan]],
            'matriks_terbobot' => [$id->id_lowongan => $hasil['debug']['matriks_terbobot'][$id->id_lowongan]],
            'solusi_ideal_positif' => $hasil['debug']['solusi_ideal_positif'],
            'solusi_ideal_negatif' => $hasil['debug']['solusi_ideal_negatif'],
            'jarak_data' => [$id->id_lowongan => $hasil['debug']['jarak_data'][$id->id_lowongan]],
            'nilai_preferensi' => [$id->id_lowongan => $hasil['debug']['nilai_preferensi'][$id->id_lowongan]],
        ]);
    }

    public function topsis(): View
    {
        $mahasiswa = Auth::user()->mahasiswa;
        $hasil = $this->index($mahasiswa->id_mahasiswa);

        return view('pages.student.perhitungan-keseluruhan', [
            'lowongan' => $hasil['lowongan'],
            'skor'     => $hasil['skor'],
            'debug'    => $hasil['debug'],
        ]);
    }

    public function edit()
    {
        $mahasiswa = auth()->user()->mahasiswa;

        if (!$mahasiswa) {
            abort(403, 'Mahasiswa tidak ditemukan');
        }

        $id = $mahasiswa->id_mahasiswa;

        $preferensi = [
            'bidang' => BidangMahasiswa::where('id_mahasiswa', $id)->pluck('id_bidang')->toArray(),
            'keahlian' => KeahlianMahasiswa::where('id_mahasiswa', $id)->pluck('id_keahlian')->toArray(),
            'lokasi' => PreferensiLokasiMagang::where('id_mahasiswa', $id)->pluck('id_lokasi')->toArray(),
            'jenis_lokasi' => PreferensiJenisLokasiMagang::where('id_mahasiswa', $id)->pluck('id_jenis_lokasi')->toArray(),
            'durasi' => PreferensiDurasiMahasiswa::where('id_mahasiswa', $id)->pluck('id_durasi_magang')->toArray(),
        ];

        // Ambil data untuk form
        $data = [
            'bidang_all' => Bidang::all(),
            'keahlian_all' => Keahlian::all(),
            'lokasi_all' => Lokasi::all(),
            'jenis_lokasi_all' => JenisLokasi::all(),
            'durasi_all' => DurasiMagang::all(),
        ];

        return view('components.student.dasbor.edit-preferensi', compact('preferensi', 'data', 'mahasiswa'));
    }

    public function update(Request $request)
    {
        $mahasiswa = auth()->user()->mahasiswa;

        if (!$mahasiswa) {
            abort(403, 'Mahasiswa tidak ditemukan');
        }

        $id = $mahasiswa->id_mahasiswa;

        // Validasi
        $request->validate([
            'bidang' => 'array',
            'keahlian' => 'required|array',
            'keahlian.*' => 'exists:keahlian,id_keahlian',
            'lokasi' => 'array',
            'jenis_lokasi' => 'array',
            'durasi' => 'array',
        ]);

        // dd((new \App\Models\BidangMahasiswa)->getFillable());

        // Sync data
        BidangMahasiswa::where('id_mahasiswa', $id)->delete();
        foreach ($request->bidang as $item) {
            BidangMahasiswa::create(['id_mahasiswa' => $id, 'id_bidang' => $item]);
        }

        KeahlianMahasiswa::where('id_mahasiswa', $id)->delete();
        foreach ($request->input('keahlian', []) as $id_keahlian) {
            KeahlianMahasiswa::create([
                'id_mahasiswa' => $id,
                'id_keahlian' => $id_keahlian
            ]);
        }


        PreferensiLokasiMagang::where('id_mahasiswa', $id)->delete();
        foreach ($request->lokasi as $item) {
            PreferensiLokasiMagang::create(['id_mahasiswa' => $id, 'id_lokasi' => $item]);
        }

        PreferensiJenisLokasiMagang::where('id_mahasiswa', $id)->delete();
        foreach ($request->jenis_lokasi as $item) {
            PreferensiJenisLokasiMagang::create(['id_mahasiswa' => $id, 'id_jenis_lokasi' => $item]);
        }

        PreferensiDurasiMahasiswa::where('id_mahasiswa', $id)->delete();
        foreach ($request->durasi as $item) {
            PreferensiDurasiMahasiswa::create(['id_mahasiswa' => $id, 'id_durasi_magang' => $item]);
        }

        return redirect()->route('mahasiswa.dasbor')->with('success', 'Preferensi berhasil diperbarui');
    }
}