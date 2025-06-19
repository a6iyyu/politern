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
use App\Models\BobotKriteria;
use App\Models\Perusahaan;
use Illuminate\Http\RedirectResponse;
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
            $baris['C6'] = ($mahasiswa->gaji === 'BEBAS') ? 1 : (($mahasiswa->gaji === $lowongan->gaji) ? 1 : 0);
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
        $bobot = $this->getBobotKriteria($id);

        //Debug bobot - tampilkan bobot yang digunakan
        // dd([
        //     'id_mahasiswa' => $mahasiswa->id_mahasiswa,
        //     'data_ditemukan' => $bobot !== null,
        //     'bobot_array' => $bobot,
        //     'bobot_detail' => [
        //         'C1_Keahlian' => $bobot['C1'],
        //         'C2_Lokasi' => $bobot['C2'],
        //         'C3_Jenis_Lokasi' => $bobot['C3'],
        //         'C4_Bidang' => $bobot['C4'],
        //         'C5_Durasi' => $bobot['C5'],
        //         'C6_Gaji' => $bobot['C6']
        //     ],
        //     'total_bobot' => array_sum($bobot),
        //     'kolom_yang_ada' => $kolom
        // ]);

        // Langkah 4: Matriks terbobot
        $matriks_terbobot = [];
        foreach ($matriks_normalisasi as $id_lowongan => $baris) {
            foreach ($baris as $kol => $nilai) {
                // Pastikan key bobot sesuai dengan kolom
                if (isset($bobot[$kol])) {
                    $matriks_terbobot[$id_lowongan][$kol] = $nilai * $bobot[$kol];
                } else {
                    // Fallback jika key tidak ditemukan
                    Log::warning("Key bobot tidak ditemukan: {$kol}");
                    $matriks_terbobot[$id_lowongan][$kol] = $nilai * (1 / 6); // default equal weight
                }
            }
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
                'bobot' => $bobot,
            ]
        ];
    }

    private function getBobotKriteria(int $id_mahasiswa): array
    {
        // Mapping prioritas ke bobot (Total = 1.0000)
        $priorityWeights = [
            1 => 0.2742,
            2 => 0.2174,
            3 => 0.1736,
            4 => 0.1382,
            5 => 0.1103,
            6 => 0.0879
        ];

        $currentUserId = auth()->id(); // ID dari tabel pengguna

        // Ambil ID mahasiswa berdasarkan ID pengguna yang login
        $mahasiswa = \App\Models\Mahasiswa::where('id_pengguna', $currentUserId)->first();

        if (!$mahasiswa) {
            Log::error("Data mahasiswa tidak ditemukan untuk ID pengguna: {$currentUserId}");
            // Return bobot default jika mahasiswa tidak ditemukan
            return [
                'C1' => 1 / 6,
                'C2' => 1 / 6,
                'C3' => 1 / 6,
                'C4' => 1 / 6,
                'C5' => 1 / 6,
                'C6' => 1 / 6,
            ];
        }

        $id_mahasiswa_benar = $mahasiswa->id_mahasiswa; // atau $mahasiswa->id

        // Debug untuk memastikan mapping yang benar
        // dd([
        //     'ID pengguna dari auth' => $currentUserId,
        //     'ID mahasiswa dari parameter' => $id_mahasiswa,
        //     'ID mahasiswa yang benar' => $id_mahasiswa_benar,
        //     'Data mahasiswa' => $mahasiswa,
        //     'Data bobot_kriteria dengan ID yang benar' => \App\Models\BobotKriteria::where('id_mahasiswa', $id_mahasiswa_benar)->first(),
        // ]);

        // GANTI INI:
        $bobotMahasiswa = BobotKriteria::where('id_mahasiswa', $id_mahasiswa_benar)->first();

        // dd([
        //     'raw' => $bobotMahasiswa,
        //     'is_all_empty' => $this->isAllWeightsEmpty($bobotMahasiswa),
        // ]);
        if (!$bobotMahasiswa || $this->isAllWeightsEmpty($bobotMahasiswa)) {
            return [
                'C1' => 1 / 6,
                'C2' => 1 / 6,
                'C3' => 1 / 6,
                'C4' => 1 / 6,
                'C5' => 1 / 6,
                'C6' => 1 / 6,
            ];
        }

        return [
            'C1' => $bobotMahasiswa->prioritas_keahlian ? $priorityWeights[$bobotMahasiswa->prioritas_keahlian] : 0,
            'C2' => $bobotMahasiswa->prioritas_lokasi ? $priorityWeights[$bobotMahasiswa->prioritas_lokasi] : 0,
            'C3' => $bobotMahasiswa->prioritas_jenis_lokasi ? $priorityWeights[$bobotMahasiswa->prioritas_jenis_lokasi] : 0,
            'C4' => $bobotMahasiswa->prioritas_bidang ? $priorityWeights[$bobotMahasiswa->prioritas_bidang] : 0,
            'C5' => $bobotMahasiswa->prioritas_durasi ? $priorityWeights[$bobotMahasiswa->prioritas_durasi] : 0,
            'C6' => $bobotMahasiswa->prioritas_gaji ? $priorityWeights[$bobotMahasiswa->prioritas_gaji] : 0,
        ];
    }


    /**
     * Cek apakah semua bobot kosong
     */
    private function isAllWeightsEmpty($bobot): bool
    {
        return empty($bobot->prioritas_keahlian) &&
            empty($bobot->prioritas_lokasi) &&
            empty($bobot->prioritas_jenis_lokasi) &&
            empty($bobot->prioritas_bidang) &&
            empty($bobot->prioritas_durasi) &&
            empty($bobot->prioritas_gaji);
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

    public function edit(): View
    {
        $mahasiswa = auth()->user()->mahasiswa;
        if (!$mahasiswa) abort(403, 'Mahasiswa tidak ditemukan');

        $id = $mahasiswa->id_mahasiswa;

        $preferensi = [
            'bidang'        => BidangMahasiswa::where('id_mahasiswa', $id)->pluck('id_bidang')->toArray(),
            'keahlian'      => KeahlianMahasiswa::where('id_mahasiswa', $id)->pluck('id_keahlian')->toArray(),
            'lokasi'        => PreferensiLokasiMagang::where('id_mahasiswa', $id)->pluck('id_lokasi')->toArray(),
            'jenis_lokasi'  => PreferensiJenisLokasiMagang::where('id_mahasiswa', $id)->pluck('id_jenis_lokasi')->toArray(),
            'durasi'        => PreferensiDurasiMahasiswa::where('id_mahasiswa', $id)->pluck('id_durasi_magang')->toArray(),
        ];

        $lokasiIds = Perusahaan::distinct()->pluck('id_lokasi')->toArray();

        $data = [
            'bidang_all'        => Bidang::all(),
            'keahlian_all'      => Keahlian::all(),         
            'lokasi_all' => Lokasi::whereIn('id_lokasi', $lokasiIds)->get(),
            'jenis_lokasi_all'  => JenisLokasi::all(),
            'durasi_all'        => DurasiMagang::all(),
        ];

        return view('components.student.dasbor.edit-preferensi', compact('preferensi', 'data', 'mahasiswa'));
    }

    public function update(Request $request): RedirectResponse
    {
        $mahasiswa = Auth::user()->mahasiswa;

        if (!$mahasiswa) abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        $id = $mahasiswa->id_mahasiswa;

        $request->validate([
            'bidang' => 'array',
            'keahlian' => 'required|array',
            'keahlian.*' => 'exists:keahlian,id_keahlian',
            'lokasi' => 'array',
            'jenis_lokasi' => 'array',
            'durasi' => 'array',
            'gaji' => 'required|in:PAID,UNPAID,BEBAS',
            'prioritas_keahlian' => 'nullable|integer|between:1,6',
            'prioritas_lokasi' => 'nullable|integer|between:1,6',
            'prioritas_jenis_lokasi' => 'nullable|integer|between:1,6',
            'prioritas_bidang' => 'nullable|integer|between:1,6',
            'prioritas_durasi' => 'nullable|integer|between:1,6',
            'prioritas_gaji' => 'nullable|integer|between:1,6',
        ]);

        // dd((new \App\Models\BidangMahasiswa)->getFillable());

        // Update gaji di tabel mahasiswa
        $mahasiswa->update([
            'gaji' => $request->gaji
        ]);

        BobotKriteria::updateOrCreate(
            ['id_mahasiswa' => $id],
            [
                'prioritas_keahlian' => $request->input('prioritas_keahlian'),
                'prioritas_lokasi' => $request->input('prioritas_lokasi'),
                'prioritas_jenis_lokasi' => $request->input('prioritas_jenis_lokasi'),
                'prioritas_bidang' => $request->input('prioritas_bidang'),
                'prioritas_durasi' => $request->input('prioritas_durasi'),
                'prioritas_gaji' => $request->input('prioritas_gaji'),
            ]
        );

        // Sync data
        BidangMahasiswa::where('id_mahasiswa', $id)->delete();
        foreach ($request->input('bidang', []) as $item) BidangMahasiswa::create(['id_mahasiswa' => $id, 'id_bidang' => $item]);

        KeahlianMahasiswa::where('id_mahasiswa', $id)->delete();
        foreach ($request->input('keahlian', []) as $id_keahlian) KeahlianMahasiswa::create(['id_mahasiswa' => $id, 'id_keahlian' => $id_keahlian]);

        PreferensiLokasiMagang::where('id_mahasiswa', $id)->delete();
        foreach ($request->input('lokasi', []) as $item) PreferensiLokasiMagang::create(['id_mahasiswa' => $id, 'id_lokasi' => $item]);

        PreferensiJenisLokasiMagang::where('id_mahasiswa', $id)->delete();
        foreach ($request->input('jenis_lokasi', []) as $item) PreferensiJenisLokasiMagang::create(['id_mahasiswa' => $id, 'id_jenis_lokasi' => $item]);

        PreferensiDurasiMahasiswa::where('id_mahasiswa', $id)->delete();
        foreach ($request->input('durasi', []) as $item) PreferensiDurasiMahasiswa::create(['id_mahasiswa' => $id, 'id_durasi_magang' => $item]);

        return to_route('mahasiswa.dasbor')->with('success', 'Preferensi berhasil diperbarui');
    }
}