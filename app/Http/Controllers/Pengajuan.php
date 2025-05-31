<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\PengajuanMagang;
use App\Models\Perusahaan;
use App\Models\PeriodeMagang;
use App\Models\ProgramStudi;
use App\Models\Mahasiswa;
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
            $selectedProgramStudi = $request->program_studi;
            $total_pengajuan_magang = PengajuanMagang::count();

            /** @var LengthAwarePaginator $paginasi */
            $paginasi = PengajuanMagang::with('mahasiswa', 'lowongan.perusahaan', 'mahasiswa.program_studi')->paginate(request('per_page', default: 10));
            $data = $paginasi->getCollection()->map(function(PengajuanMagang $pengajuan): array {
                $bgColor = match ($pengajuan->status) {
                    'DISETUJUI' => 'bg-[var(--green-tertiary)]',
                    'MENUNGGU'  => 'bg-[var(--yellow-tertiary)]',
                    'DITOLAK'   => 'bg-[var(--red-tertiary)]',
                };
                return [
                    $pengajuan->id_pengajuan_magang,
                    $pengajuan->created_at->format('d/m/Y'),
                    $pengajuan->mahasiswa->nim,
                    $pengajuan->mahasiswa->nama_lengkap,
                    $pengajuan->lowongan->perusahaan->nama,
                    $pengajuan->lowongan->bidang->nama_bidang ?? '-',
                    '<div class="text-xs text-white font-medium px-5 py-2 rounded-2xl ' . $bgColor . '">'
                        . ($pengajuan->status ?? "N/A") .
                    '</div>',
                    view('components.admin.pengajuan-magang.aksi', compact('pengajuan'))->render(),
                ];
            })->toArray();
            return view('pages.admin.pengajuan-magang', compact('data', 'paginasi', 'program_studi', 'perusahaan', 'periode_magang', 'selectedProgramStudi', 'total_pengajuan_magang'));
        }
        else if ($pengguna === "MAHASISWA") {
            return view('pages.student.pengajuan-magang');
        }
        else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }
}
