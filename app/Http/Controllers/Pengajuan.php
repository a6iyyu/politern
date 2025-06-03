<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\PengajuanMagang;
use App\Models\Perusahaan;
use App\Models\PeriodeMagang;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Auth;

class Pengajuan extends Controller
{
    public function index(Request $request): View
    {
        $pengguna = Auth::user()->tipe;
        if ($pengguna === "ADMIN") {
            $program_studi = ProgramStudi::all();
            $perusahaan = Perusahaan::all();
            $periode_magang = PeriodeMagang::where('status', 'AKTIF')->first();
            $program_studi_yang_dipilih = $request->program_studi;
            $total_pengajuan_magang = PengajuanMagang::count();

            /** @var LengthAwarePaginator $paginasi */
            $paginasi = PengajuanMagang::with('mahasiswa', 'lowongan.perusahaan_mitra', 'mahasiswa.program_studi')->paginate(request('per_page', default: 10));
            $data = $paginasi->getCollection()->map(function (PengajuanMagang $pengajuan): array {
                $keterangan = match ($pengajuan->status) {
                    'DISETUJUI' => 'bg-[var(--green-tertiary)]',
                    'MENUNGGU'  => 'bg-[var(--yellow-tertiary)]',
                    'DITOLAK'   => 'bg-[var(--red-tertiary)]',
                };
                return [
                    $pengajuan->created_at->format('d/m/Y'),
                    $pengajuan->mahasiswa->nim,
                    $pengajuan->mahasiswa->nama_lengkap,
                    $pengajuan->lowongan->perusahaan_mitra->nama,
                    $pengajuan->lowongan->bidang->nama_bidang ?? '-',
                    '<div class="text-xs text-white font-medium px-5 py-2 rounded-2xl ' . $keterangan . '">'
                        . ($pengajuan->status ?? "N/A") .
                    '</div>',
                    view('components.admin.pengajuan-magang.aksi', compact('pengajuan'))->render(),
                ];
            })->toArray();
            return view('pages.admin.pengajuan-magang', compact('data', 'paginasi', 'program_studi', 'perusahaan', 'periode_magang', 'program_studi_yang_dipilih', 'total_pengajuan_magang'));
        } else if ($pengguna === "MAHASISWA") {
            /** @var LengthAwarePaginator $paginasi */
            $paginasi = PengajuanMagang::with('mahasiswa', 'lowongan.perusahaan', 'mahasiswa.program_studi')->paginate(request('per_page', default: 10));
            $data = $paginasi->getCollection()->map(function (PengajuanMagang $pengajuan): array {
                $keterangan = match ($pengajuan->status) {
                    'DISETUJUI' => 'bg-[var(--green-tertiary)]',
                    'MENUNGGU'  => 'bg-[var(--yellow-tertiary)]',
                    'DITOLAK'   => 'bg-[var(--red-tertiary)]',
                };
                return [
                    $pengajuan->created_at->format('d/m/Y'),
                    $pengajuan->lowongan->perusahaan->nama,
                    $pengajuan->lowongan->bidang->nama_bidang ?? '-',
                    '<div class="text-xs text-white font-medium px-5 py-2 rounded-2xl ' . $keterangan . '">'
                        . ($pengajuan->status ?? "N/A") .
                    '</div>',
                    view('components.student.kelola-lamaran.aksi', compact('pengajuan'))->render(),
                ];
            })->toArray();
            $periode_magang = PeriodeMagang::where('status', 'AKTIF')->pluck('nama_periode', 'id_periode')->toArray();
            return view('pages.student.kelola-lamaran', compact('data', 'paginasi', 'periode_magang'));
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }
}