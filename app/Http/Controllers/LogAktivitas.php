<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\LogAktivitas as LogAktivitasModel;
use App\Models\Mahasiswa;
use App\Models\PengajuanMagang;
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
        if ($pengguna === 'MAHASISWA') {
            $dospem = $this->dospem();
            $periode = $this->periode();
            $perusahaan = $this->perusahaan();
            $posisi = $this->posisi();
            $status = $this->status();
            return view('pages.student.log-aktivitas', compact('dospem', 'periode', 'perusahaan', 'posisi', 'status'));
        } else if ($pengguna === 'DOSEN') {
            $log_aktivitas = LogAktivitasModel::all();
            return view('pages.lecturer.log-aktivitas', compact('log_aktivitas'));
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }

    public function create(Request $request) {}

    public function edit() {}

    public function update(Request $request) {}

    public function destroy(Request $request) {}

    public function show(string $id): JsonResponse
    {
        try {
            $log_aktivitas = LogAktivitasModel::with([
                'magang.mahasiswa.pengguna',
                'magang.mahasiswa.program_studi',
                'magang.pengajuan_magang.lowongan'
            ])->findOrFail($id);

            return Response::json([
                'nama'          => $log_aktivitas->magang->pengajuan_magang->mahasiswa->nama_lengkap ?? 'N/A',
                'program_studi' => $log_aktivitas->magang->pengajuan_magang->mahasiswa->program_studi->nama ?? 'N/A',
                'judul'         => $log_aktivitas->judul ?? 'N/A',
                'deskripsi'     => $log_aktivitas->deskripsi ?? 'N/A',
                'status'        => $log_aktivitas->magang->pengajuan_magang->status ?? 'N/A',
            ]);
        } catch (ModelNotFoundException $e) {
            report($e);
            return Response::json(['error' => 'Log aktivitas tidak ditemukan.'], 404);
        } catch (Exception $e) {
            report($e);
            return Response::json(['error' => 'Terjadi kesalahan pada server.'], 500);
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

        $pengajuan = PengajuanMagang::with('lowongan.perusahaan')
            ->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->first();

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