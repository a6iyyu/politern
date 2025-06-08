<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\LogAktivitas as LogAktivitasModel;
use App\Models\Magang;
use App\Models\Mahasiswa;
use App\Models\PengajuanMagang;
use App\Models\Perusahaan;
use App\Models\PeriodeMagang;
use App\Models\EvaluasiMagang;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class LogAktivitas extends Controller
{
    public function index(): View
    {
        $pengguna = Auth::user()->tipe;
        $log_aktivitas = LogAktivitasModel::with([
            'magang.pengajuan_magang.mahasiswa',
            'magang.pengajuan_magang.mahasiswa.program_studi',
            'magang.pengajuan_magang.lowongan.perusahaan'
        ])->get();
        $perusahaan = Perusahaan::pluck('nama', 'id_perusahaan_mitra')->toArray();
        $periode_magang = PeriodeMagang::where('status', 'AKTIF')->first();
        $status_aktivitas = LogAktivitasModel::pluck('status')->unique()->toArray();

        switch ($pengguna) {
            case 'ADMIN':
                return view('pages.admin.aktivitas-magang', compact('log_aktivitas', 'perusahaan', 'periode_magang', 'status_aktivitas'));
            case 'DOSEN':
                return view('pages.lecturer.log-aktivitas', compact('log_aktivitas', 'perusahaan', 'periode_magang', 'status_aktivitas'));
            case 'MAHASISWA':
                $status_magang = Magang::where('id_pengajuan_magang', Auth::user()->id)->first();
                if (!$status_magang || $status_magang->status !== 'AKTIF') return view('pages.student.log-aktivitas');

                $dospem = $this->dospem();
                $periode = $this->periode();
                $perusahaan = $this->perusahaan();
                $posisi = $this->posisi();
                $status = $this->status();

                return view('pages.student.log-aktivitas', compact('dospem', 'periode', 'perusahaan', 'posisi', 'status'));
            default:
                abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }

    public function create(Request $request) {}

    public function edit() {}

    public function update(Request $request) {}

    public function destroy(Request $request) {}

    public function detail() {}

    public function show(string $id): JsonResponse
    {
        try {
            $log_aktivitas = LogAktivitasModel::with([
                'magang.mahasiswa.pengguna',
                'magang.mahasiswa.program_studi',
                'magang.pengajuan_magang.lowongan'
            ])->findOrFail($id);

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

    private function periode(): int
    {
        return 0;
    }

    private function perusahaan(): string
    {
        $mahasiswa = Mahasiswa::where('id_pengguna', Auth::user()->id_pengguna)->first();
        if (!$mahasiswa) return '';
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