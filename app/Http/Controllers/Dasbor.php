<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\BidangMahasiswa;
use App\Models\LogAktivitas;
use App\Models\LowonganMagang;
use App\Models\Mahasiswa;
use App\Models\Magang;
use App\Models\EvaluasiMagang;
use App\Models\Dosen;
use App\Models\Perusahaan;
use App\Models\PreferensiJenisLokasiMagang;
use App\Models\PreferensiDurasiMahasiswa;
use App\Models\PreferensiLokasiMagang;
use App\Models\KeahlianLowongan;
use App\Models\KeahlianMahasiswa;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
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
        $pengguna = Auth::user();
        if (!$pengguna) return to_route('masuk');
        if (!in_array($pengguna->tipe, ['ADMIN', 'MAHASISWA', 'DOSEN'])) abort(403, 'Anda tidak memiliki akses.');

        return match ($pengguna->tipe) {
            'ADMIN' => (function () use ($pengguna): View {
                $nama = $pengguna->admin->nama;
                $nip = $pengguna->admin->nip;

                $total_mahasiswa = Mahasiswa::count();
                $total_dosen = Dosen::count();
                $total_perusahaan_mitra = Perusahaan::count();
                $total_lowongan = LowonganMagang::count();
                return view('pages.admin.dasbor', compact('nama', 'nip', 'total_mahasiswa', 'total_dosen', 'total_perusahaan_mitra', 'total_lowongan'));
            })(),
            'MAHASISWA' => (function () use ($pengguna): View {
                $lowongan = LowonganMagang::with('perusahaan')->orderBy('created_at', 'desc')->get();
                $mahasiswa = $this->mahasiswa();
                if ($mahasiswa === null || !$mahasiswa->program_studi) abort(404, 'Data mahasiswa tidak ditemukan.');

                $id_mahasiswa = $mahasiswa->id_mahasiswa;
                $prodi = $mahasiswa->program_studi;
                $ipk = $mahasiswa->ipk;
                $jenjang = $prodi->jenjang;
                $log_aktivitas = $this->log_aktivitas();
                $nama_pengguna = $pengguna->nama_pengguna;
                $nama_prodi = $prodi->nama;
                $semester = $mahasiswa->semester;
                $status = $mahasiswa->status;
                $rekomendasi = $this->rekomendasiMagang($mahasiswa->id_mahasiswa);
                // dd($rekomendasi);
                return view('pages.student.dasbor', compact('ipk', 'jenjang', 'log_aktivitas', 'lowongan', 'nama_pengguna', 'nama_prodi', 'semester', 'status', 'rekomendasi', 'id_mahasiswa'));
            })(),
            'DOSEN' => (function () use ($pengguna): View {
                $nama = $pengguna->dosen->nama;
                $nip = $pengguna->dosen->nip;
                $id_dosen = $pengguna->dosen->id_dosen;

                $aktivitas_terbaru = LogAktivitas::whereHas('magang.pengajuan_magang', fn($q) => $q->where('id_dosen_pembimbing', $id_dosen))->latest()->take(4)->get();
                $evaluasi_magang = $this->evaluasi_magang();
                $mahasiswa_aktif = Magang::where('id_dosen_pembimbing', $id_dosen)->where('status', 'AKTIF')->count();
                $mahasiswa_bimbingan = $this->mahasiswa_bimbingan();
                $mahasiswa_selesai = Magang::where('id_dosen_pembimbing', $id_dosen)->where('status', 'SELESAI')->count();
                $menunggu_evaluasi = EvaluasiMagang::whereHas('magang', fn($q) => $q->where('id_dosen_pembimbing', $id_dosen))->where('status', 'MENUNGGU')->count();
                $total_aktivitas = LogAktivitas::whereHas('magang.pengajuan_magang', fn($q) => $q->where('id_dosen_pembimbing', $id_dosen))->count();
                $total_bimbingan = Magang::where('id_dosen_pembimbing', $id_dosen)->count();
                $total_mahasiswa = Mahasiswa::count();

                /** @var SupportCollection<int, Mahasiswa> $mahasiswa_bimbingan */
                $data = $mahasiswa_bimbingan->map(function (Mahasiswa $mhs): array {
                    $pengajuan = $mhs->pengajuan_magang->first();
                    $lowongan = $pengajuan?->lowongan;
                    $perusahaan = $lowongan?->perusahaan;

                    return [
                        '<div class="flex items-center gap-2">
                            <img src="' . asset('shared/profil.png') . '" alt="avatar" class="w-8 h-8 rounded-full" /> ' . $mhs->nama_lengkap . '
                        </div>',
                        $mhs->nim,
                        $perusahaan?->nama ?? '-',
                        $lowongan?->judul ?? '-',
                        $mhs->status ?? '-',
                        view('components.lecturer.dasbor.aksi', compact('mhs'))->render(),
                    ];
                })->toArray();

                return view('pages.lecturer.dasbor', compact('aktivitas_terbaru', 'data', 'evaluasi_magang', 'mahasiswa_aktif', 'mahasiswa_bimbingan', 'mahasiswa_selesai', 'menunggu_evaluasi', 'nama', 'nip', 'total_aktivitas', 'total_bimbingan', 'total_mahasiswa'));
            })(),
        };
    }

    /**
     * @param string $id
     * @return View
     *
     * Fungsi di bawah ini bertujuan untuk menampilkan data mahasiswa bimbingan
     * pada peran dosen berdasarkan ID mahasiswa.
     */
    public function detail(string $id): View
    {
        $pengguna = Auth::user()->tipe;
        try {
            $mahasiswa = $this->mahasiswa_bimbingan($id)->firstOrFail();
            return view('pages.lecturer.detail-mahasiswa-bimbingan', compact('mahasiswa'));
        } catch (ModelNotFoundException $exception) {
            report($exception);
            abort(404, "Data mahasiswa tidak ditemukan atau bukan bimbingan Anda.");
        } catch (Exception $e) {
            report($e);
            abort(500, "Terjadi kesalahan pada server.");
        }
    }

    public function rekomendasiMagang($id_mahasiswa)
    {
        // Get mahasiswa data with relationships
        $mahasiswa = Mahasiswa::findOrFail($id_mahasiswa);
    
        $keahlianMahasiswa = KeahlianMahasiswa::where('id_mahasiswa', $id_mahasiswa)->pluck('id_keahlian')->toArray();
        $bidangMahasiswa = BidangMahasiswa::where('id_mahasiswa', $id_mahasiswa)->pluck('id_bidang')->toArray();
        $lokasiMahasiswa = PreferensiLokasiMagang::where('id_mahasiswa', $id_mahasiswa)->pluck('id_lokasi')->toArray();
        $jenisLokasiMahasiswa = PreferensiJenisLokasiMagang::where('id_mahasiswa', $id_mahasiswa)->pluck('id_jenis_lokasi')->toArray();
        $durasiMahasiswa = PreferensiDurasiMahasiswa::where('id_mahasiswa', $id_mahasiswa)->pluck('id_durasi_magang')->toArray();

        // Get all active lowongan with required relationships
        $lowongans = LowonganMagang::with([
            'perusahaan.lokasi',
            'jenis_lokasi:id_jenis_lokasi',
            'bidang:id_bidang',
            'keahlian:id_keahlian' // Eager load the keahlian relationship
        ])
        ->where('status', 'DIBUKA')
        ->where('tanggal_selesai_pendaftaran', '>=', now())
        ->get();

        Log::info(json_encode($lowongans));

        $alternatif = [];
        foreach ($lowongans as $lowongan) {
            $row = [];

            // C1: Skill (jumlah skill yang cocok / total skill lowongan)
            $mhsSkills = $keahlianMahasiswa;
            $lowonganSkills = $lowongan->keahlian->pluck('id_keahlian')->toArray();
            $matchedSkills = count(array_intersect($mhsSkills, $lowonganSkills));
            $row['C1'] = count($lowonganSkills) > 0 ? $matchedSkills / count($lowonganSkills) : 0;

            // C2: Lokasi (menggunakan preferensi lokasi mahasiswa)
            $perusahaanLokasi = $lowongan->perusahaan->lokasi->id_lokasi ?? null;
            $row['C2'] = in_array($perusahaanLokasi, $lokasiMahasiswa) ? 1 : 0;

            // C3: Jenis Lokasi (menggunakan preferensi jenis lokasi mahasiswa)
            $lowonganJenisLokasi = $lowongan->jenis_lokasi->id_jenis_lokasi ?? null;
            $row['C3'] = in_array($lowonganJenisLokasi, $jenisLokasiMahasiswa) ? 1 : 0;

            // C4: Bidang
            $lowonganBidang = $lowongan->bidang->id_bidang ?? null;
            $row['C4'] = in_array($lowonganBidang, $bidangMahasiswa) ? 1 : 0;

            // C5: Durasi (menggunakan preferensi durasi mahasiswa)
            $lowonganDurasi = $lowongan->durasi->id_durasi_magang ?? null;
            $row['C5'] = in_array($lowonganDurasi, $durasiMahasiswa) ? 1 : 0;

            // C6: Gaji - 1 jika status gaji mahasiswa dan lowongan sama (sama-sama 'ada' atau sama-sama 'tidak')
            $row['C6'] = ($mahasiswa->gaji === $lowongan->gaji) ? 1 : 0;

            $alternatif[$lowongan->id_lowongan] = $row;
        }

        dump($alternatif);
        
        // Check if there are any alternatives
        if (empty($alternatif)) {
            return []; // Return empty array if no lowongan available
        }
        dump('Matrix Original:', $alternatif);
    
        // STEP 2: Normalisasi
        $matrix = $alternatif;
        $columns = array_keys(reset($matrix));
        $normal = [];
    
        foreach ($columns as $col) {
            $values = array_column($matrix, $col);
            $sum = array_sum(array_map(fn($v) => pow($v, 2), $values));
            $sum = $sum > 0 ? $sum : 1; // Prevent division by zero
            foreach ($matrix as $id => $row) {
                $normal[$id][$col] = $row[$col] / sqrt($sum);
            }
        }
        dump('Matrix Normal:', $normal);
    
        // STEP 3: Bobot
        $bobot = [
            'C1' => 0.25, // Skill
            'C2' => 0.25, // Lokasi
            'C3' => 0.1, // Jenis Lokasi
            'C4' => 0.2, // Bidang
            'C5' => 0.1, // Durasi
            'C6' => 0.1, // Gaji
        ];
    
        // STEP 4: Matriks Terbobot
        $terbobot = [];
        foreach ($normal as $id => $row) {
            foreach ($row as $col => $val) {
                $terbobot[$id][$col] = $val * $bobot[$col];
            }
        }
        dump('Matriks Terbobot:', $terbobot);
    
        // STEP 5: Solusi ideal positif & negatif
        $idealPos = $idealNeg = [];
        foreach ($columns as $col) {
            $values = array_column($terbobot, $col);
            // Semua kriteria (C1-C6) adalah benefit (semakin tinggi semakin baik)
            $idealPos[$col] = max($values);
            $idealNeg[$col] = min($values);
        }
        dump('Solusi Ideal Positif:', $idealPos);
        dump('Solusi Ideal Negatif:', $idealNeg);
    
        // STEP 6: Hitung D+ dan D-
        $distances = [];
        foreach ($terbobot as $id => $row) {
            $dPos = 0;
            $dNeg = 0;
            
            foreach ($columns as $col) {
                $dPos += pow($idealPos[$col] - $row[$col], 2);
                $dNeg += pow($row[$col] - $idealNeg[$col], 2);
            }
            
            $dPos = sqrt($dPos);
            $dNeg = sqrt($dNeg);
                
            // $v = ($dPos + $dNeg) > 0 ? $dNeg / ($dPos + $dNeg) : 0;
            $v = $dNeg / ($dPos + $dNeg);
                
            $distances[$id] = [
                'dPos' => $dPos,
                'dNeg' => $dNeg,
                'preference' => $v
            ];
        }
        dump('Jarak Positif & Jarak Negatif:', $distances);
        
        // STEP 7: Rekomendasi
        uasort($distances, function($a, $b) {
            return $b['preference'] <=> $a['preference'];
        });
        
        // Convert to array with numeric indices
        $result = [];
        foreach ($distances as $id => $data) {
            $lowongan = $lowongans->find($id);
            if ($lowongan) {
                $result[] = [
                    'lowongan' => $lowongan,
                    'skor' => round($data['preference'], 4)
                ];
            }
        }
        dump($result);
        return $result;
    }

    /**
     * @return View
     *
     * Fungsi di bawah ini bertujuan untuk mengembalikan semua data-data
     * yang nantinya akan divisualisasikan dalam berbagai bentuk grafik. 
     */
    public function chart(): JsonResponse|View
    {
        try {
            /** Mengembalikan semua data yang dibutuhkan pada grafik lingkaran */
            $total = BidangMahasiswa::count();
            $kategori_bidang_magang_terbanyak = BidangMahasiswa::with('bidang')
                ->get()
                ->groupBy('id_bidang')
                ->take(5)
                ->map(fn ($bidang) => [
                    'id_bidang'     => $bidang->first()->id_bidang,
                    'jumlah_bidang' => $bidang->count(),
                    'nama_bidang'   => $bidang->first()->bidang->nama_bidang ?? 'N/A',
                    'persentase'    => round($bidang->count() / $total * 100, 2),
                ])
                ->values();
            
            $progres_magang_mingguan = DB::table('evaluasi_magang')
                ->select(DB::raw('DATE(tanggal_evaluasi) as tanggal'), DB::raw('COUNT(*) as jumlah'))
                ->groupBy('tanggal')
                ->orderBy('tanggal')
                ->get();

            return Response::json([
                'kategori_bidang_magang_terbanyak' => $kategori_bidang_magang_terbanyak,
                'progres_magang_mingguan'          => $progres_magang_mingguan,
            ]);
        } catch (ModelNotFoundException $exception) {
            report($exception);
            return Response::json(['error' => 'Data tidak ditemukan.'], 404);
        } catch (Exception $exception) {
            report($exception);
            return Response::json(['error' => 'Terjadi kesalahan pada server.'], 500);
        }
    }

    /**
     * @return Mahasiswa|null
     *
     * Mengambil data mahasiswa beserta relasi program studi berdasarkan
     * pengguna yang sedang masuk.
     */
    private function mahasiswa(): ?Mahasiswa
    {
        return Mahasiswa::with('program_studi')->where('id_pengguna', Auth::user()->id_pengguna)->first();
    }

    /**
     * @return Collection
     *
     * Mengambil data mahasiswa yang sedang bimbingan dosen pembimbing saat ini.
     */
    private function mahasiswa_bimbingan(?string $id_mahasiswa = null): Collection
    {
        $pengguna = Auth::user();
        $id_dosen = $pengguna->dosen->id_dosen;
        $mahasiswa_bimbingan = Mahasiswa::with(['pengajuan_magang.lowongan.perusahaan', 'pengajuan_magang.magang'])->whereHas('pengajuan_magang.magang', fn($q) => $q->where('id_dosen_pembimbing', $id_dosen));

        if ($id_mahasiswa) $mahasiswa_bimbingan->where('id_mahasiswa', $id_mahasiswa);
        return $mahasiswa_bimbingan->take(8)->get();
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
     * @return int
     *
     * Menghitung jumlah mahasiswa yang masih menunggu evaluasi magang
     * berdasarkan dosen pembimbing saat ini.
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
}