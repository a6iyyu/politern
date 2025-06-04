<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\PengajuanMagang;
use App\Models\Perusahaan;
use App\Models\PeriodeMagang;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class Pengajuan extends Controller
{
    public function index(Request $request): View
    {
        $pengguna = Auth::user()->tipe;

        return match ($pengguna) {
            'ADMIN'     => $this->admin($request),
            'MAHASISWA' => $this->student(),
            default     => abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini."),
        };
    }

    private function admin(Request $request): View
    {
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
                $pengajuan->lowongan->perusahaan->nama,
                $pengajuan->lowongan->bidang->nama_bidang ?? '-',
                '<div class="text-xs text-white font-medium px-5 py-2 rounded-2xl ' . $keterangan . '">'
                    . ($pengajuan->status ?? "N/A") .
                '</div>',
                view('components.admin.pengajuan-magang.aksi', compact('pengajuan'))->render(),
            ];
        })->toArray();

        return view('pages.admin.pengajuan-magang', compact('data', 'paginasi', 'program_studi', 'perusahaan', 'periode_magang', 'program_studi_yang_dipilih', 'total_pengajuan_magang'));
    }

    private function student(): View
    {
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
                    'DISETUJUI' => 'bg-green-200 text-green-800',
                    'MENUNGGU'  => 'bg-yellow-200 text-yellow-800',
                    'DITOLAK'   => 'bg-red-200 text-red-800',
                };
                
                $konfirmasiView = '-';
                if ($pengajuan->status === 'MENUNGGU') {
                    $konfirmasiView = view('components.admin.pengajuan-magang.konfirmasi', compact('pengajuan'))->render();
                }
                return [
                    $pengajuan->created_at->format('d/m/Y'),
                    $pengajuan->mahasiswa->nama_lengkap,
                    $pengajuan->lowongan->perusahaan_mitra->nama,
                    $pengajuan->lowongan->bidang->nama_bidang ?? '-',
                    '<div class="text-xs font-medium px-5 py-2 rounded-2xl ' . $keterangan . '">'
                        . ($pengajuan->status ?? "N/A") .
                    '</div>',
                    $konfirmasiView,
                    view('components.admin.pengajuan-magang.aksi', compact('pengajuan'))->render(),
                ];
            })->toArray();
            
            return view('pages.admin.pengajuan-magang', compact('data', 'paginasi', 'program_studi', 'perusahaan', 'periode_magang', 'program_studi_yang_dipilih', 'total_pengajuan_magang'));
            
        } else if ($pengguna === "MAHASISWA") {
            /** @var LengthAwarePaginator $paginasi */
            $paginasi = PengajuanMagang::with('mahasiswa', 'lowongan.perusahaan', 'mahasiswa.program_studi')->paginate(request('per_page', default: 10));
            
            $data = $paginasi->getCollection()->map(function (PengajuanMagang $pengajuan): array {
                $keterangan = match ($pengajuan->status) {
                    'DISETUJUI' => 'bg-green-300 text-green-800',
                    'MENUNGGU'  => 'bg-yellow-300 text-yellow-800',
                    'DITOLAK'   => 'bg-red-300 text-red-800',
                };
                return [
                    $pengajuan->created_at->format('d/m/Y'),
                    $pengajuan->lowongan->perusahaan->nama,
                    $pengajuan->lowongan->bidang->nama_bidang ?? '-',
                    '<div class="text-xs font-medium px-5 py-2 rounded-2xl ' . $keterangan . '">' . ($pengajuan->status ?? "N/A") . '</div>',
                    view('components.student.kelola-lamaran.aksi', compact('pengajuan'))->render(),
                ];
            })->toArray();
            
            $periode_magang = PeriodeMagang::where('status', 'AKTIF')->pluck('nama_periode', 'id_periode')->toArray();
            return view('pages.student.kelola-lamaran', compact('data', 'paginasi', 'periode_magang'));
            
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }

    public function updateStatus(Request $request, string $id): RedirectResponse
    {
        try {
            $pengajuan = PengajuanMagang::findOrFail($id);
            
            $status = $request->input('status');
            
            if (!in_array($status, ['DISETUJUI', 'DITOLAK'])) {
                return back()->withErrors('Status tidak valid');
            }
            
            $pengajuan->status = $status;
            $pengajuan->save();
            
            $message = $status === 'DISETUJUI' ? 'disetujui' : 'ditolak';
            return to_route('admin.pengajuan-magang')
                ->with('success', "Pengajuan magang berhasil {$message}");
                
        } catch (Exception $exception) {
            report($exception);
            return back()->withErrors($exception->getMessage());
        }
    }
}