<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\PengajuanMagang;
use App\Models\PeriodeMagang;
use App\Models\Perusahaan;
use App\Models\ProgramStudi;
use App\Models\Magang;
use App\Models\Dosen;
use App\Models\LowonganMagang;
use Exception;
use Illuminate\Http\JsonResponse;
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

    public function edit(string $id): JsonResponse
    {
        $pengajuan = PengajuanMagang::with([
            'mahasiswa.program_studi',
            'lowongan.bidang',
            'lowongan.perusahaan.lokasi',
        ])->findOrFail($id);

        $mahasiswa = $pengajuan->mahasiswa;
        $lowongan = $pengajuan->lowongan;

        return response()->json([
            'pengajuan' => [
                'id' => $pengajuan->id_pengajuan_magang,
                'status' => $pengajuan->status,
                'bidang_posisi' => $lowongan->bidang->nama_bidang ?? '-',
                'nama_perusahaan_mitra' => $lowongan->perusahaan->nama,
                'lokasi' => $lowongan->perusahaan->lokasi->nama_lokasi ?? '-',
            ],
            'mahasiswa' => [
                'nim' => $mahasiswa->nim,
                'nama_lengkap' => $mahasiswa->nama_lengkap,
                'program_studi' => $mahasiswa->program_studi->nama,
                'ipk' => $mahasiswa->ipk,
                'nomor_telepon' => $mahasiswa->nomor_telepon,
                'deskripsi' => $mahasiswa->deskripsi,
            ]
        ]);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $status = strtoupper($request->input('status'));
        $request->merge(['status' => $status]);

        $request->validate([
            'status' => 'required|in:MENUNGGU,DISETUJUI,DITOLAK',
            'catatan' => 'nullable|string|max:1000',
        ]);

        try {
            $pengajuan = PengajuanMagang::findOrFail($id);

            $pengajuan->update([
                'status' => $status,
                'catatan' => $request->catatan,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data pengajuan berhasil diperbarui'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data pengajuan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function detail(string $id): JsonResponse
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

        $logo = null;
        if ($lowongan->perusahaan->logo) {
            $logo = str_starts_with($lowongan->perusahaan->logo, 'storage/')
                ? '/' . $lowongan->perusahaan->logo
                : (str_starts_with($lowongan->perusahaan->logo, '/storage/')
                    ? $lowongan->perusahaan->logo
                    : '/storage/' . $lowongan->perusahaan->logo);
        }

        return response()->json([
            'pengajuan' => [
                'bidang_posisi' => $lowongan->bidang->nama_bidang ?? '-',
                'logo' => $logo,
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
                    'nama_file' => $mahasiswa->cv ?? 'CV_' . str_replace(' ', '_', $mahasiswa->nama_lengkap) . '.pdf',
                    'url' => $mahasiswa->cv,
                ],
                'keahlian' => $mahasiswa->keahlian->pluck('nama_keahlian')->toArray(),
            ]
        ]);
    }

    public function confirmation(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'dosen_pembimbing' => 'exists:dosen,id_dosen',
            'status'           => 'in:DISETUJUI,DITOLAK',
        ]);

        $pengajuan = PengajuanMagang::findOrFail($id);
        if ($pengajuan->status !== 'MENUNGGU') return redirect()->back()->with('error', 'Pengajuan ini sudah tidak dalam status "MENUNGGU".');

        try {
            if ($request->status === 'DISETUJUI') {
                $magang = new Magang([
                    'id_pengajuan_magang' => $pengajuan->id_pengajuan_magang,
                    'id_dosen_pembimbing' => $request->dosen_pembimbing,
                    'status'              => 'AKTIF',
                ]);

                $magang->save();
                $pengajuan->status = 'DISETUJUI';
                $pengajuan->save();

                $lowongan = $pengajuan->lowongan;
                if ($lowongan) {
                    $lowongan->kuota = max(0, $lowongan->kuota - 1);
                    $lowongan->save();
                }

                return redirect()->back()->with('success', 'Data pengajuan berhasil diperbarui.');
            }

            if ($request->status === 'DITOLAK') {
                $pengajuan->status = 'DITOLAK';
                $pengajuan->save();
                return redirect()->back()->with('success', 'Data pengajuan berhasil diperbarui.');
            }

            return redirect()->back()->with('error', 'Status tidak valid.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data pengajuan: ' . $e->getMessage());
        }
    }

    public function data(int $id): JsonResponse
    {
        try {
            $user = Auth::user();
            $mahasiswa = $user->mahasiswa;
            $lowongan = LowonganMagang::findOrFail($id);

            if ($mahasiswa == null || $lowongan == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengajuan belum ada untuk lowongan ini.'
                ], 404);
            }

            return response()->json([
                'pengajuan' => [
                    'bidang_posisi' => $lowongan->bidang->nama_bidang ?? '-',
                    'nama_perusahaan_mitra' => $lowongan->perusahaan->nama ?? '-',
                    'logo' => $lowongan->perusahaan->logo ?? null,
                ],
                'lokasi' => [
                    'nama_lokasi' => $lowongan->perusahaan->lokasi->nama_lokasi ?? '-',
                ],
                'mahasiswa' => [
                    'nim' => $mahasiswa->nim ?? '-',
                    'nama_lengkap' => $mahasiswa->nama_lengkap ?? '-',
                    'program_studi' => $mahasiswa->program_studi->nama ?? '-',
                    'ipk' => $mahasiswa->ipk ?? '-',
                    'nomor_telepon' => $mahasiswa->nomor_telepon ?? '-',
                    'angkatan' => $mahasiswa->angkatan ?? '-',
                    'semester' => $mahasiswa->semester ?? '-',
                    'status' => $mahasiswa->status ?? '-',
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data pengajuan: ' . $e->getMessage()
            ], 500);
        }
    }

    private function admin(Request $request): View
    {
        $program_studi = ProgramStudi::all();
        $perusahaan = Perusahaan::all();
        $periode_magang = PeriodeMagang::where('status', 'AKTIF')->first();
        $periodes = PeriodeMagang::orderBy('created_at', 'desc')->get();
        $program_studi_yang_dipilih = $request->program_studi;
        $total_pengajuan_magang = PengajuanMagang::count();
        $dosen_pembimbing = Dosen::pluck('nama', 'id_dosen')->toArray();

        $query = PengajuanMagang::with(['mahasiswa', 'lowongan.perusahaan', 'mahasiswa.program_studi', 'lowongan.periode_magang']);

        if ($request->filled('nama_lengkap')) {
            $query->whereHas('mahasiswa', function ($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
            });
        }

        if ($request->filled('program_studi')) {
            $query->whereHas('mahasiswa', function ($q) use ($request) {
                $q->where('id_prodi', $request->program_studi);
            });
        }

        if ($request->filled('perusahaan')) {
            $query->whereHas('lowongan', function ($q) use ($request) {
                $q->where('id_perusahaan_mitra', $request->perusahaan);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('periode')) {
            $query->whereHas('lowongan', function ($q) use ($request) {
                $q->where('id_periode', $request->periode);
            });
        }

        $baris = 1;
        $paginasi = $query->orderBy('created_at', 'desc')->paginate(request('per_page', 10))->withQueryString();
        $data = $paginasi->getCollection()->map(function (PengajuanMagang $pengajuan) use (&$baris) {
            $keterangan = match ($pengajuan->status) {
                'DISETUJUI' => 'bg-green-200 text-green-800',
                'MENUNGGU'  => 'bg-yellow-200 text-yellow-800',
                'DITOLAK'   => 'bg-red-200 text-red-800',
            };

            $konfirmasi = '';
            if ($pengajuan->status === 'MENUNGGU') $konfirmasi = view('components.admin.pengajuan-magang.konfirmasi', compact('pengajuan'))->render();
            return [
                $baris++,
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

        return view('pages.admin.pengajuan-magang', compact('data', 'paginasi', 'program_studi', 'perusahaan', 'periode_magang', 'periodes', 'program_studi_yang_dipilih', 'total_pengajuan_magang', 'dosen_pembimbing'));
    }

    private function student(): View
    {
        $baris = 1;
        $id_mahasiswa = Auth::user()->mahasiswa->id_mahasiswa;

        /** @var LengthAwarePaginator $paginasi */
        $paginasi = PengajuanMagang::with('mahasiswa', 'lowongan.perusahaan', 'mahasiswa.program_studi')->where('id_mahasiswa', $id_mahasiswa)->paginate(request('per_page', default: 10));
        $data = $paginasi->getCollection()->map(function (PengajuanMagang $pengajuan) use (&$baris): array {
            $keterangan = match ($pengajuan->status) {
                'DISETUJUI' => 'bg-[var(--green-tertiary)]',
                'MENUNGGU'  => 'bg-[var(--yellow-tertiary)]',
                'DITOLAK'   => 'bg-[var(--red-tertiary)]',
            };

            return [
                $baris++,
                $pengajuan->lowongan->perusahaan->nama,
                $pengajuan->lowongan->bidang->nama_bidang ?? '-',
                $pengajuan->lowongan->periode_magang->nama_periode ?? '-',
                $pengajuan->created_at->format('d/m/Y'),
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

    public function apply(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'id_lowongan' => 'required|exists:lowongan_magang,id_lowongan',
            ]);

            $id_mahasiswa = Auth::user()->mahasiswa->id_mahasiswa;
            

            $lowongan = LowonganMagang::findOrFail($request->id_lowongan);
            if ($lowongan->status !== 'DIBUKA') return back()->with('error', 'Lowongan ini sudah ditutup.');

            if($lowongan->kuota <= 0) {
                return back()->with('error', 'Kuota lowongan ini sudah habis.');
            }

            $exist = PengajuanMagang::where('id_mahasiswa', $id_mahasiswa)->where('id_lowongan', $request->id_lowongan)->exists();
            if ($exist) return back()->with('warning', 'Kamu sudah melamar ke lowongan ini.');

            PengajuanMagang::create([
                'id_mahasiswa' => $id_mahasiswa,
                'id_lowongan' => $request->id_lowongan,
                'status' => 'MENUNGGU',
                'keterangan' => null,
            ]);

            return to_route('mahasiswa.kelola-lamaran')->with('success', 'Pengajuan magang berhasil dikirim.');
        } catch (Exception $e) {
            report($e);
            Log::error('Gagal membuat pengajuan magang: ' . $e->getMessage());
            return back()->with('error', 'Gagal membuat pengajuan magang karena kesalahan server.');
        }
    }
}
