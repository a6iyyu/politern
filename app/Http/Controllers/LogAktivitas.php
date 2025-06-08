<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\LogAktivitas as LogAktivitasModel;
use App\Models\Magang;
use App\Models\Mahasiswa;
use App\Models\PengajuanMagang;
use App\Models\Perusahaan;
use App\Models\PeriodeMagang;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class LogAktivitas extends Controller
{
    public function index(): View
    {
        $pengguna = Auth::user()->tipe;
        $log_aktivitas = LogAktivitasModel::with(['magang.pengajuan_magang.mahasiswa', 'magang.pengajuan_magang.mahasiswa.program_studi', 'magang.pengajuan_magang.lowongan.perusahaan'])->get();
        $perusahaan = Perusahaan::pluck('nama', 'id_perusahaan_mitra')->toArray();
        $periode_magang = PeriodeMagang::where('status', 'AKTIF')->first();
        $status_aktivitas = LogAktivitasModel::pluck('status')->unique()->toArray();

        switch ($pengguna) {
            case 'ADMIN':
                return view('pages.admin.aktivitas-magang', compact('log_aktivitas', 'perusahaan', 'periode_magang', 'status_aktivitas'));
            case 'DOSEN':
                return view('pages.lecturer.log-aktivitas', compact('log_aktivitas', 'perusahaan', 'periode_magang', 'status_aktivitas'));
            case 'MAHASISWA':
                // Ambil data magang aktif mahasiswa
                $mahasiswa = DB::table('mahasiswa')->where('id_pengguna', Auth::user()->id_pengguna)->first();
                if (!$mahasiswa) {
                    return view('pages.student.log-aktivitas', ['log_aktivitas' => null]);
                }
                $pengajuan = DB::table('pengajuan_magang')->where('id_mahasiswa', $mahasiswa->id_mahasiswa)->first();
                if (!$pengajuan) {
                    return view('pages.student.log-aktivitas', ['log_aktivitas' => null]);
                }
                $magang = DB::table('magang')->where('id_pengajuan_magang', $pengajuan->id_pengajuan_magang)->where('status', 'AKTIF')->first();
                if (!$magang) {
                    return view('pages.student.log-aktivitas', ['log_aktivitas' => null]);
                }

                // Ambil data lowongan
                $lowongan = DB::table('lowongan_magang')->where('id_lowongan', $pengajuan->id_lowongan)->first();

                // Perusahaan
                $perusahaan = "N/A";
                if ($lowongan && $lowongan->id_perusahaan_mitra) {
                    $perusahaanRow = DB::table('perusahaan_mitra')->where('id_perusahaan_mitra', $lowongan->id_perusahaan_mitra)->first();
                    $perusahaan = $perusahaanRow->nama ?? "N/A";
                }

                // Lokasi
                $lokasi = "N/A";
                if (isset($perusahaanRow) && $perusahaanRow && $perusahaanRow->id_lokasi) {
                    $lokasiRow = DB::table('lokasi')->where('id_lokasi', $perusahaanRow->id_lokasi)->first();
                    $lokasi = $lokasiRow->nama_lokasi ?? "N/A";
                }

                // Periode
                $periode = "N/A";
                if ($lowongan && $lowongan->id_periode) {
                    $periodeRow = DB::table('periode_magang')->where('id_periode', $lowongan->id_periode)->first();
                    $periode = $periodeRow->nama_periode ?? "N/A";
                }

                // Posisi
                $posisi = "N/A";
                if ($lowongan && $lowongan->id_bidang) {
                    $bidangRow = DB::table('bidang')->where('id_bidang', $lowongan->id_bidang)->first();
                    $posisi = $bidangRow->nama_bidang ?? "N/A";
                }

                // Dosen Pembimbing
                $dospem = "N/A";
                if ($magang->id_dosen_pembimbing) {
                    $dosen = DB::table('dosen')->where('id_dosen', $magang->id_dosen_pembimbing)->first();
                    if ($dosen && $dosen->id_pengguna) {
                        $penggunaDosen = DB::table('pengguna')->where('id_pengguna', $dosen->id_pengguna)->first();
                        $dospem = $penggunaDosen->nama_pengguna ?? "N/A";
                    }
                }

                // Status
                $status = $magang->status ?? "N/A";

                // Total log
                $total_log = DB::table('log_aktivitas')->where('id_magang', $magang->id_magang)->count();

                // Log aktivitas untuk mahasiswa ini
                $log_aktivitas = LogAktivitasModel::where('id_magang', $magang->id_magang)->get();

                return view('pages.student.log-aktivitas', compact(
                    'dospem', 'log_aktivitas', 'periode', 'perusahaan', 'posisi', 'status', 'total_log', 'lokasi'
                ));
            default:
                abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }

    public function create(Request $request): RedirectResponse
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'minggu'     => 'required|integer|min:1',
                'judul'      => 'required|string|max:255',
                'deskripsi'  => 'required|string',
                'foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            // Ambil mahasiswa yang sedang login
            $mahasiswa = DB::table('mahasiswa')->where('id_pengguna', Auth::user()->id_pengguna)->first();
            if (!$mahasiswa) {
                return back()->withErrors(['errors' => 'Mahasiswa tidak ditemukan.']);
            }

            // Ambil pengajuan magang aktif
            $pengajuan = DB::table('pengajuan_magang')->where('id_mahasiswa', $mahasiswa->id_mahasiswa)->first();
            if (!$pengajuan) {
                return back()->withErrors(['errors' => 'Pengajuan magang tidak ditemukan.']);
            }

            // Ambil magang aktif
            $magang = DB::table('magang')->where('id_pengajuan_magang', $pengajuan->id_pengajuan_magang)->where('status', 'AKTIF')->first();
            if (!$magang) {
                return back()->withErrors(['errors' => 'Magang aktif tidak ditemukan.']);
            }

            // Handle upload foto jika ada
            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->storeAs(
                    'shared/log-aktivitas',
                    $request->file('foto')->getClientOriginalName(),
                    'public'
                );
                $fotoPath = '/storage/shared/log-aktivitas/' . $request->file('foto')->getClientOriginalName();
            }

            // Simpan log aktivitas baru
            DB::table('log_aktivitas')->insert([
                'id_magang'  => $magang->id_magang,
                'minggu'     => $validated['minggu'],
                'judul'      => $validated['judul'],
                'deskripsi'  => $validated['deskripsi'],
                'foto'       => $fotoPath,
                'status'     => 'MENUNGGU',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return to_route('mahasiswa.log-aktivitas')->with('success', 'Log aktivitas berhasil ditambahkan.');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Gagal dalam membuat log aktivitas baru karena kesalahan pada server.']);
        }
    }

    public function edit() {}

    public function update(Request $request)
    {
        try {
            $request->validate([]);

            return to_route('mahasiswa.log-aktivitas');
        } catch (ModelNotFoundException $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Log aktivitas tidak ditemukan.']);
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Gagal dalam memperbarui log aktivitas karena kesalahan pada server.']);
        }
    }

    public function destroy(Request $request): RedirectResponse
    {
        try {
            LogAktivitasModel::findOrFail($request->id)->delete();
            return to_route('mahasiswa.log-aktivitas');
        } catch (ModelNotFoundException $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Log aktivitas tidak ditemukan.']);
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Gagal dalam menghapus log aktivitas karena kesalahan pada server.']);
        }
    }

    public function detail() {}

    public function show(string $id): JsonResponse
    {
        try {
            $log_aktivitas = LogAktivitasModel::with(['magang.mahasiswa.pengguna', 'magang.mahasiswa.program_studi', 'magang.pengajuan_magang.lowongan'])->findOrFail($id);

            return response()->json([
                'nama'          => $log_aktivitas->magang->pengajuan_magang->mahasiswa->nama_lengkap ?? 'N/A',
                'program_studi' => $log_aktivitas->magang->pengajuan_magang->mahasiswa->program_studi->nama ?? 'N/A',
                'judul'         => $log_aktivitas->judul ?? 'N/A',
                'deskripsi'     => $log_aktivitas->deskripsi ?? 'N/A',
                'status'        => $log_aktivitas->magang->pengajuan_magang->status ?? 'N/A',
            ]);
        } catch (ModelNotFoundException $e) {
            report($e);
            return response()->json(['error' => 'Log aktivitas tidak ditemukan.'], 404);
        } catch (Exception $e) {
            report($e);
            return response()->json(['error' => 'Terjadi kesalahan pada server.'], 500);
        }
    }

    private function dospem(): int
    {
        return 0;
    }

    private function log_aktivitas(): array|Collection
    {
        return LogAktivitasModel::whereHas('magang.pengajuan_magang.mahasiswa.pengguna', function ($query) {
            $query->where('id_pengguna', Auth::user()->id_pengguna);
        })->with(['magang.pengajuan_magang.mahasiswa', 'magang.pengajuan_magang.mahasiswa.program_studi', 'magang.pengajuan_magang.lowongan.perusahaan'])->get();
    }

    private function periode(): int
    {
        return 0;
    }

    private function perusahaan(): ?string
    {
        $mahasiswa = Mahasiswa::where('id_pengguna', Auth::user()->id_pengguna)->first();
        if (!$mahasiswa) return null;

        $pengajuan = PengajuanMagang::with('lowongan.perusahaan')->where('id_mahasiswa', $mahasiswa->id_mahasiswa)->first();
        return $pengajuan?->lowongan?->perusahaan?->nama_perusahaan ?? "N/A";
    }

    private function posisi()
    {
        return 0;
    }

    private function status()
    {
        return 0;
    }
}