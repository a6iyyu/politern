<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\PengajuanMagang;
use App\Models\PeriodeMagang;
use App\Models\Perusahaan;
use App\Models\ProgramStudi;
use App\Models\Magang;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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
                $pengajuan->id_pengajuan_magang,
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
                $pengajuan->id_pengajuan_magang,
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

    public function detail($id)
    {
        $pengajuan = PengajuanMagang::with([
            'mahasiswa.program_studi',
            'mahasiswa.keahlian',
            'mahasiswa.pengalaman',
            'mahasiswa.sertifikasi_pelatihan',
            'mahasiswa.proyek',
            'lowongan.bidang',
            'lowongan.perusahaan.lokasi',
        ])->findOrFail($id);

        $mahasiswa = $pengajuan->mahasiswa;
        $lowongan = $pengajuan->lowongan;

        $logoUrl = null;
        if ($lowongan->perusahaan->logo) {
            $logoUrl = str_starts_with($lowongan->perusahaan->logo, 'storage/') 
                ? '/'.$lowongan->perusahaan->logo 
                : (str_starts_with($lowongan->perusahaan->logo, '/storage/') 
                    ? $lowongan->perusahaan->logo 
                    : '/storage/'.$lowongan->perusahaan->logo);
        }

        return response()->json([
            'pengajuan' => [
                'bidang_posisi' => $lowongan->bidang->nama_bidang ?? '-',
                'logo' => $logoUrl,
                'nama_perusahaan_mitra' => $lowongan->perusahaan->nama,
                'lokasi' => $lowongan->perusahaan->lokasi->nama_lokasi ?? '-',
            ],
            'mahasiswa' => [
                'nim' => $mahasiswa->nim,
                'nama_lengkap' => $mahasiswa->nama_lengkap,
                'angkatan' => $mahasiswa->angkatan,
                'semester' => $mahasiswa->semester,
                'program_studi' => $mahasiswa->program_studi->nama,
                'ipk' => $mahasiswa->ipk,
                'nomor_telepon' => $mahasiswa->nomor_telepon,
                'deskripsi' => $mahasiswa->deskripsi,
                'status' => $mahasiswa->status,
                'cv' => [
                    'nama_file' => $mahasiswa->cv_file ?? 'CV_' . str_replace(' ', '_', $mahasiswa->nama_lengkap) . '.pdf',
                    'url' => $mahasiswa->cv_file,
                ],
                'keahlian' => $mahasiswa->keahlian->pluck('nama_keahlian')->toArray(),
                // 'pengalaman' => $mahasiswa->pengalaman->map(function ($pengalaman) {
                //     return [
                //         'jenis' => $pengalaman->jenis,
                //         'posisi' => $pengalaman->posisi,
                //         'perusahaan' => $pengalaman->perusahaan,
                //         'deskripsi' => $pengalaman->deskripsi,
                //         'tanggal_mulai' => $pengalaman->tanggal_mulai,
                //         'tanggal_selesai' => $pengalaman->tanggal_selesai,
                //         'dokumen_pendukung' => $pengalaman->dokumen_pendukung,
                //     ];
                // })->toArray(),
                // 'sertifikasi' => $mahasiswa->sertifikasi_pelatihan->map(function ($sertifikat) {
                //     return [
                //         'nama' => $sertifikat->nama,
                //         'penyelenggara' => $sertifikat->penyelenggara,
                //         'deskripsi' => $sertifikat->deskripsi,
                //         'tanggal_terbit' => $sertifikat->tanggal_terbit,
                //         'tanggal_kadaluwarsa' => $sertifikat->tanggal_kadaluwarsa,
                //         'dokumen_pendukung' => $sertifikat->dokumen_pendukung,
                //     ];
                // })->toArray(),
                // 'proyek' => $mahasiswa->proyek->map(function ($proyek) {
                //     return [
                //         'nama' => $proyek->nama,
                //         'role' => $proyek->role,
                //         'deskripsi' => $proyek->deskripsi,
                //         'url' => $proyek->url,
                //         'tanggal_mulai' => $proyek->tanggal_mulai,
                //         'tanggal_selesai' => $proyek->tanggal_selesai,
                //         'tools' => json_decode($proyek->tools, true) ?? [],
                //     ];
                // })->toArray(),
            ]
        ]);
    }

    public function konfirmasi(Request $request, $id)
    {
        $request->validate([
            'dosen_pembimbing_id' => 'required_if:status,DISETUJUI|exists:dosen,id_dosen',
            'status' => 'required|in:DISETUJUI,DITOLAK',
        ]);

        $pengajuan = PengajuanMagang::findOrFail($id);
        
        try {
            \DB::beginTransaction();

            if ($request->status === 'DISETUJUI') {
                // Create new magang record
                $magang = new Magang();
                $magang->id_mahasiswa = $pengajuan->id_mahasiswa;
                $magang->id_lowongan = $pengajuan->id_lowongan;
                $magang->id_dosen = $request->dosen_pembimbing_id;
                $magang->status = 'AKTIF';
                $magang->tgl_mulai = now();
                $magang->save();

                // Update pengajuan status
                $pengajuan->status = 'DISETUJUI';
                $pengajuan->save();

                // Send notification to student
                // Add your notification logic here if needed

                \DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Pengajuan magang berhasil disetujui'
                ]);
            } else {
                // Reject the application
                $pengajuan->status = 'DITOLAK';
                $pengajuan->save();

                // Send rejection notification
                // Add your notification logic here if needed

                \DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Pengajuan magang berhasil ditolak'
                ]);
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}