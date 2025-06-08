<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\PengajuanMagang;
use App\Models\PeriodeMagang;
use App\Models\Perusahaan;
use App\Models\ProgramStudi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class Pengajuan extends Controller
{
    public function index(Request $request): View
    {
        $pengguna = Auth::user()->tipe;

        try {
            return match ($pengguna) {
                'ADMIN'     => $this->admin($request),
                'MAHASISWA' => $this->student(),
                default     => abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini."),
            };
        } catch (Exception $exception) {
            report($exception);
            Log::error('Terjadi kesalahan pada server: ' . $exception->getMessage());
            abort(500, $exception->getMessage());
        }
    }

    private function admin(Request $request): View
    {
        $program_studi = ProgramStudi::all();
        $perusahaan = Perusahaan::all();
        $periode_magang = PeriodeMagang::where('status', 'AKTIF')->first();
        $program_studi_yang_dipilih = $request->program_studi;
        $total_pengajuan_magang = PengajuanMagang::count();

        /** @var LengthAwarePaginator $paginasi */
        $paginasi = PengajuanMagang::with('mahasiswa', 'lowongan.perusahaan', 'mahasiswa.program_studi')->paginate(request('per_page', default: 10));
        $data = $paginasi->getCollection()->map(function (PengajuanMagang $pengajuan): array {
            $keterangan = match ($pengajuan->status) {
                'DISETUJUI' => 'bg-green-200 text-green-800',
                'MENUNGGU'  => 'bg-yellow-200 text-yellow-800',
                'DITOLAK'   => 'bg-red-200 text-red-800',
            };

            $konfirmasi = '';
            if ($pengajuan->status === 'MENUNGGU') $konfirmasi = view('components.admin.pengajuan-magang.konfirmasi', compact('pengajuan'))->render();
            return [
                $pengajuan->created_at->format('d/m/Y'),
                $pengajuan->mahasiswa->nama_lengkap,
                $pengajuan->mahasiswa->program_studi->kode,
                $pengajuan->lowongan->perusahaan->nama,
                $pengajuan->lowongan->bidang->nama_bidang ?? '-',
                '<div class="text-xs font-medium px-5 py-2 rounded-2xl ' . $keterangan . '">'
                    . ($pengajuan->status ?? "N/A") .
                '</div>',
                view('components.admin.pengajuan-magang.aksi', compact('pengajuan'))->render(),
                $konfirmasi,
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
        $total_pengajuan_magang = PengajuanMagang::count();
        return view('pages.student.kelola-lamaran', compact('data', 'paginasi', 'periode_magang', 'total_pengajuan_magang'));
    }

    public function update_status(Request $request, string $id): RedirectResponse
    {
        try {
            $pengajuan = PengajuanMagang::findOrFail($id);
            $status = $request->input('status');
            if (!in_array($status, ['DISETUJUI', 'DITOLAK'])) return back()->withErrors('Status tidak valid!');

            $pengajuan->status = $status;
            $pengajuan->save();

            $message = $status === 'DISETUJUI' ? 'disetujui' : 'ditolak';
            return to_route('admin.pengajuan-magang')->with('success', "Pengajuan magang berhasil {$message}");
        } catch (Exception $exception) {
            report($exception);
            return back()->withErrors('Gagal memperbarui status pengajuan magang.');
        }
    }
}