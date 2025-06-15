<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\BidangMahasiswa;
use App\Models\LogAktivitas;
use App\Models\PeriodeMagang;
use App\Models\LowonganMagang;
use App\Models\Mahasiswa;
use App\Models\Magang;
use App\Models\Dosen;
use App\Models\Perusahaan;
use App\Models\PengajuanMagang;
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
                
                // Get active period and log activities count
                $periodeAktif = PeriodeMagang::where('status', 'AKTIF')->first();
                $total_aktivitas = 0;
                
                if ($periodeAktif) {
                    $total_aktivitas = LogAktivitas::join('magang', 'log_aktivitas.id_magang', '=', 'magang.id_magang')
                        ->join('pengajuan_magang', 'magang.id_pengajuan_magang', '=', 'pengajuan_magang.id_pengajuan_magang')
                        ->join('lowongan_magang', 'pengajuan_magang.id_lowongan', '=', 'lowongan_magang.id_lowongan')
                        ->where('lowongan_magang.id_periode', $periodeAktif->id_periode)
                        ->count();
                }

                return view('pages.admin.dasbor', compact(
                    'nama', 
                    'nip', 
                    'total_mahasiswa', 
                    'total_dosen', 
                    'total_perusahaan_mitra', 
                    'total_lowongan',
                    'periodeAktif',
                    'total_aktivitas'
                ));
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
                $status = 'Belum Magang';
                $pengajuan_terakhir = $mahasiswa->pengajuan_magang->sortByDesc('created_at')->first();
                if ($pengajuan_terakhir && $pengajuan_terakhir->magang) $status = $pengajuan_terakhir->magang->status;
                $rekomendasi = (new RekomendasiMagang())->index($mahasiswa->id_mahasiswa);
                return view('pages.student.dasbor', compact('ipk', 'jenjang', 'log_aktivitas', 'lowongan', 'nama_pengguna', 'nama_prodi', 'semester', 'status', 'rekomendasi', 'id_mahasiswa'));
            })(),
            'DOSEN' => (function () use ($pengguna): View {
                $nama = $pengguna->dosen->nama;
                $nip = $pengguna->dosen->nip;
                $id_dosen = $pengguna->dosen->id_dosen;

                $aktivitas_terbaru = LogAktivitas::whereHas('magang.pengajuan_magang', fn($q) => $q->where('id_dosen_pembimbing', $id_dosen))->latest()->take(4)->get();
                $evaluasi_magang = LogAktivitas::where('status', 'menunggu')->with('magang.pengajuan_magang.mahasiswa')->get()->pluck('magang.pengajuan_magang.mahasiswa')->unique()->count();
                $mahasiswa_aktif = Magang::where('id_dosen_pembimbing', $id_dosen)->where('status', 'AKTIF')->count();
                $mahasiswa_bimbingan = $this->mahasiswa_bimbingan();
                $mahasiswa_selesai = Magang::where('id_dosen_pembimbing', $id_dosen)->where('status', 'SELESAI')->count();
                $menunggu_evaluasi = LogAktivitas::where('status', 'menunggu')->whereHas('magang.pengajuan_magang', fn($q) => $q->where('id_dosen_pembimbing', $id_dosen))->count();
                $total_aktivitas = LogAktivitas::whereHas('magang.pengajuan_magang', fn($q) => $q->where('id_dosen_pembimbing', $id_dosen))->count();
                $total_bimbingan = Magang::where('id_dosen_pembimbing', $id_dosen)->count();
                $total_mahasiswa = Mahasiswa::count();

                $log_aktivitas = LogAktivitas::with([
                        'magang.pengajuan_magang.mahasiswa', 
                        'magang.pengajuan_magang.mahasiswa.program_studi', 
                        'magang.pengajuan_magang.lowongan.perusahaan'
                    ])
                    ->whereHas('magang', function($q) use ($id_dosen) {
                        $q->where('id_dosen_pembimbing', $id_dosen);
                    })
                    ->latest()
                    ->take(3)
                    ->get();
                $perusahaan = Perusahaan::pluck('nama', 'id_perusahaan_mitra')->toArray();
                $periode_magang = PeriodeMagang::where('status', 'AKTIF')->first();
                $status_aktivitas = LogAktivitas::pluck('status')->unique()->toArray();

                /** @var SupportCollection<int, Mahasiswa> $mahasiswa_bimbingan */
                $data = $mahasiswa_bimbingan->map(function (Mahasiswa $mhs): array {
                    $status = match ($mhs->pengajuan_magang()->get()->sortByDesc('created_at')->first()?->magang?->status) {
                        'AKTIF'   => 'bg-green-200 text-green-800',
                        'SELESAI' => 'bg-yellow-200 text-yellow-800',
                        default   => 'bg-gray-200 text-gray-800',
                    };

                    $pengajuan = $mhs->pengajuan_magang->first();
                    $magang = $pengajuan?->magang;
                    $lowongan = $pengajuan?->lowongan;
                    $perusahaan = $lowongan?->perusahaan;

                    return [
                        '<div class="flex items-center gap-2">
                            <img src="' . asset('shared/profil.png') . '" alt="avatar" class="w-8 h-8 rounded-full" /> ' . $mhs->nama_lengkap . '
                        </div>',
                        $perusahaan?->nama ?? '-',
                        $lowongan?->bidang->nama_bidang ?? '-',
                        '<div class="text-xs font-medium px-5 py-2 rounded-2xl ' . $status . '">' . ($magang?->status ?? 'BELUM MAGANG') . '</div>',
                    ];
                })->toArray();

                return view('pages.lecturer.dasbor', compact('aktivitas_terbaru', 'data', 'evaluasi_magang', 'mahasiswa_aktif', 'mahasiswa_bimbingan', 'mahasiswa_selesai', 'menunggu_evaluasi', 'nama', 'nip', 'total_aktivitas', 'total_bimbingan', 'total_mahasiswa', 'log_aktivitas'));
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
            if ($pengguna === 'DOSEN') {
                $mahasiswa = $this->mahasiswa_bimbingan($id)->firstOrFail();
                return view('pages.lecturer.detail-mahasiswa-bimbingan', compact('mahasiswa'));
            } else if ($pengguna === 'MAHASISWA') {
                $lowongan = LowonganMagang::with(['keahlian', 'perusahaan.lokasi', 'jenis_lokasi', 'bidang', 'durasi'])->findOrFail($id);
                return view('pages.student.detail-lowongan', compact('lowongan'));
            }

            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        } catch (ModelNotFoundException $exception) {
            report($exception);
            abort(404, "Data mahasiswa tidak ditemukan atau bukan bimbingan Anda.");
        } catch (Exception $e) {
            report($e);
            abort(500, "Terjadi kesalahan pada server.");
        }
    }

    /**
     * @return View
     *
     * Fungsi di bawah ini bertujuan untuk mengembalikan semua data-data
     * yang nantinya akan divisualisasikan dalam berbagai bentuk grafik. 
     * 
     * TODO: Memeriksa ulang apakah datanya sudah sesuai dengan visual.
     */
    public function chart(): JsonResponse|View
    {
        try {
            $total = PengajuanMagang::count();
            $kategori_bidang_magang_terbanyak = PengajuanMagang::with('lowongan.bidang')
                ->get()
                ->groupBy('lowongan.bidang.id_bidang')
                ->take(5)
                ->map(fn($bidang) => [
                    'id_bidang'     => $bidang->first()->lowongan->bidang->id_bidang,
                    'jumlah_bidang' => $bidang->count(),
                    'nama_bidang'   => $bidang->first()->lowongan->bidang->nama_bidang ?? 'N/A',
                    'persentase'    => round($bidang->count() / $total * 100, 2),
                ])
                ->values();

            $progres_magang_mingguan = DB::table('log_aktivitas')
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
            Log::error($exception->getMessage());
            return Response::json(['error' => 'Data tidak ditemukan.'], 404);
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
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
    public function mahasiswa_bimbingan(?string $id_mahasiswa = null): Collection
    {
        $pengguna = Auth::user();
        $id_dosen = $pengguna->dosen->id_dosen;
        $mahasiswa_bimbingan = Mahasiswa::with(['pengajuan_magang.lowongan.perusahaan', 'pengajuan_magang.magang'])->whereHas('pengajuan_magang.magang', fn($q) => $q->where('id_dosen_pembimbing', $id_dosen));

        if ($id_mahasiswa) $mahasiswa_bimbingan->where('id_mahasiswa', $id_mahasiswa);
        return $mahasiswa_bimbingan->get();
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
}