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
        $periode_magang = PeriodeMagang::where('status', 'AKTIF')->first();
        $status_aktivitas = LogAktivitasModel::pluck('status')->unique()->toArray();

        switch ($pengguna) {
            case 'ADMIN':
                return view('pages.admin.aktivitas-magang', compact('log_aktivitas', 'perusahaan', 'periode_magang', 'status_aktivitas'));
            case 'DOSEN':
                $perusahaan = $log_aktivitas->pluck('magang.pengajuan_magang.lowongan.perusahaan')->unique('id_perusahaan_mitra')->mapWithKeys(fn($p) => [$p['id_perusahaan_mitra'] => $p['nama']])->toArray();
                return view('pages.lecturer.log-aktivitas', compact('log_aktivitas', 'perusahaan', 'periode_magang', 'status_aktivitas'));
            case 'MAHASISWA':
                $mahasiswa = DB::table('mahasiswa')->where('id_pengguna', Auth::user()->id_pengguna)->first();
                if (!$mahasiswa) return view('pages.student.log-aktivitas', ['log_aktivitas' => null]);

                $pengajuan = DB::table('pengajuan_magang')->where('id_mahasiswa', $mahasiswa->id_mahasiswa)->first();
                if (!$pengajuan) return view('pages.student.log-aktivitas', ['log_aktivitas' => null]);

                $magang = DB::table('magang')->where('id_pengajuan_magang', $pengajuan->id_pengajuan_magang)->where('status', 'AKTIF')->first();
                if (!$magang) return view('pages.student.log-aktivitas', ['log_aktivitas' => null]);

                $lowongan = DB::table('lowongan_magang')->where('id_lowongan', $pengajuan->id_lowongan)->first();

                $perusahaan = "N/A";
                if ($lowongan && $lowongan->id_perusahaan_mitra) {
                    $perusahaan_mitra = DB::table('perusahaan_mitra')->where('id_perusahaan_mitra', $lowongan->id_perusahaan_mitra)->first();
                    $perusahaan = $perusahaan_mitra->nama ?? "N/A";
                }

                $lokasi = "N/A";
                if (isset($perusahaan_mitra) && $perusahaan_mitra && $perusahaan_mitra->id_lokasi) {
                    $lokasi = DB::table('lokasi')->where('id_lokasi', $perusahaan_mitra->id_lokasi)->first();
                    $lokasi = $lokasi->nama_lokasi ?? "N/A";
                }

                $periode = "N/A";
                if ($lowongan && $lowongan->id_periode) {
                    $periode = DB::table('periode_magang')->where('id_periode', $lowongan->id_periode)->first();
                    $periode = $periode->nama_periode ?? "N/A";
                }

                $posisi = "N/A";
                if ($lowongan && $lowongan->id_bidang) {
                    $bidang = DB::table('bidang')->where('id_bidang', $lowongan->id_bidang)->first();
                    $posisi = $bidang->nama_bidang ?? "N/A";
                }

                $dospem = "N/A";
                if ($magang->id_dosen_pembimbing) {
                    $dosen = DB::table('dosen')->where('id_dosen', $magang->id_dosen_pembimbing)->first();
                    if ($dosen && $dosen->id_pengguna) $dospem = DB::table('pengguna')->where('id_pengguna', $dosen->id_pengguna)->first()->nama_pengguna ?? "N/A";
                }

                $status = $magang->status ?? "N/A";
                $total_log = DB::table('log_aktivitas')->where('id_magang', $magang->id_magang)->count();
                $log_aktivitas = LogAktivitasModel::where('id_magang', $magang->id_magang)->get();

                return view('pages.student.log-aktivitas', compact('dospem', 'log_aktivitas', 'periode', 'perusahaan', 'posisi', 'status', 'total_log', 'lokasi'));
            default:
                abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }

    public function create(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'minggu'     => 'required|integer|min:1',
                'judul'      => 'required|string|max:255',
                'deskripsi'  => 'required|string',
                'foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $mahasiswa = DB::table('mahasiswa')->where('id_pengguna', Auth::user()->id_pengguna)->first();
            if (!$mahasiswa) return back()->withErrors(['errors' => 'Mahasiswa tidak ditemukan.']);

            $pengajuan = DB::table('pengajuan_magang')->where('id_mahasiswa', $mahasiswa->id_mahasiswa)->first();
            if (!$pengajuan) return back()->withErrors(['errors' => 'Pengajuan magang tidak ditemukan.']);

            $magang = DB::table('magang')->where('id_pengajuan_magang', $pengajuan->id_pengajuan_magang)->where('status', 'AKTIF')->first();
            if (!$magang) return back()->withErrors(['errors' => 'Magang aktif tidak ditemukan.']);

            $foto = null;
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto')->storeAs('shared/log-aktivitas', $request->file('foto')->getClientOriginalName(), 'public');
                $foto = '/shared/log-aktivitas/' . $request->file('foto')->getClientOriginalName();
            }

            DB::table('log_aktivitas')->insert([
                'id_magang'  => $magang->id_magang,
                'minggu'     => $validated['minggu'],
                'judul'      => $validated['judul'],
                'deskripsi'  => $validated['deskripsi'],
                'foto'       => $foto,
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

    public function update(Request $request): RedirectResponse
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
}