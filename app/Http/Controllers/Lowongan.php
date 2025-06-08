<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\LowonganMagang;
use App\Models\Perusahaan;
use App\Models\Bidang;
use App\Models\DurasiMagang;
use App\Models\JenisLokasi;
use App\Models\JenisMagang;
use App\Models\Keahlian;
use App\Models\PeriodeMagang;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class Lowongan extends Controller
{
    public function index(): View
    {
        $pengguna = Auth::user()->tipe;
        if ($pengguna === "ADMIN") {
            $total_lowongan = LowonganMagang::count();
            $perusahaan_filter = Perusahaan::all();
            $periode_filter = PeriodeMagang::all();
            $bidang_filter = Bidang::all();

            $bidang       = Bidang::pluck('nama_bidang', 'id_bidang')->toArray();
            $durasi       = DurasiMagang::pluck('nama_durasi', 'id_durasi_magang')->toArray();
            $jenis_lokasi = JenisLokasi::pluck('nama_jenis_lokasi', 'id_jenis_lokasi')->toArray();
            $jenis_magang = JenisMagang::pluck('nama_jenis', 'id_jenis_magang')->toArray();
            $keahlian     = Keahlian::pluck('nama_keahlian', 'id_keahlian')->toArray();
            $periode      = PeriodeMagang::pluck('nama_periode', 'id_periode')->toArray();
            $perusahaan   = Perusahaan::pluck('nama', 'id_perusahaan_mitra')->toArray();
            $query = LowonganMagang::query();

            if ($id_bidang = request('bidang')) $query->where('id_bidang', $id_bidang);
            if ($id_perusahaan = request('perusahaan')) $query->where('id_perusahaan_mitra', $id_perusahaan);
            if ($id_periode = request('periode')) $query->where('id_periode', $id_periode);
            $paginasi = $query->paginate(request('per_page', 10));

            $data = collect($paginasi->items())->map(function (LowonganMagang $lowongan): array {
                $status = match ($lowongan->status) {
                    'DIBUKA'         => 'bg-green-200 text-green-800',
                    'DITUTUP'   => 'bg-yellow-200 text-yellow-800',
                };
                return [
                    $lowongan->id_lowongan,
                    $lowongan->perusahaan->nama ?? '-',
                    $lowongan->bidang->nama_bidang ?? '-',
                    $lowongan->periode_magang->nama_periode ?? '-',
                    $lowongan->durasi->nama_durasi ?? '-',
                    $lowongan->kuota ?? '-',
                    '<div class="text-xs font-medium px-5 py-2 rounded-2xl ' . $status . '">' . ($lowongan->status ?? "N/A") . '</div>',
                    view('components.admin.lowongan-magang.aksi', compact('lowongan'))->render(),
                ];
            })->toArray();
            return view('pages.admin.lowongan-magang', compact(
                'data',
                'paginasi',
                'total_lowongan',
                'perusahaan_filter',
                'periode_filter',
                'bidang_filter',
                'perusahaan',
                'bidang',
                'keahlian',
                'jenis_lokasi',
                'periode',
                'jenis_magang',
                'durasi'
            ));
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'id_perusahaan_mitra'           => 'required|string|max:100|unique:perusahaan,nama',
                'id_bidang'                     => 'required|string|max:100|unique:bidang,nama_bidang',
                'id_keahlian'                   => 'required|array|min:1',
                'id_keahlian.*'                 => 'exists:keahlian,id_keahlian',
                'id_periode'                    => 'required|string',
                'id_jenis_lokasi'               => 'required|string',
                'dekripsi'                      => 'required|string|max:255',
                'kuota'                         => 'required|integer|min:10',
                'status'                        => 'required|in:DIBUKA,DITUTUP',
                'tanggal_mulai_pendaftaran'     => 'required|date',
                'tanggal_selesai_pendaftaran'   => 'required|date|after_or_equal:tanggal_mulai_pendaftaran',
            ]);

            $perusahaan = Perusahaan::create([
                'id_lokasi'     => $request->id_lokasi,
                'nama'          => $request->nama,
                'nib'           => $request->nib,
                'nomor_telepon' => $request->nomor_telepon,
                'email'         => $request->email,
                'website'       => $request->website,
            ]);

            $bidang = Bidang::create([
                'nama_bidang' => $request->nama_bidang,
            ]);

            $jenis_lokasi = JenisLokasi::create([
                'nama_jenis_lokasi' => $request->nama_jenis_lokasi,
            ]);

            $periode = PeriodeMagang::create([
                'nama_periode'      => $request->nama_periode,
                'durasi'            => PeriodeMagang::find($request->id_periode)->durasi,
                'tanggal_mulai'     => $request->tanggal_mulai_pendaftaran,
                'tanggal_selesai'   => $request->tanggal_selesai_pendaftaran,
                'status'            => 'DIBUKA',
            ]);

            foreach ($request->id_keahlian as $id_keahlian) {
                LowonganMagang::create([
                    'id_perusahaan_mitra'           => $perusahaan->id_perusahaan_mitra,
                    'id_keahlian'                   => $id_keahlian,
                    'id_bidang'                     => $bidang->id_bidang,
                    'id_jenis_lokasi'               => $jenis_lokasi->id_jenis_lokasi,
                    'id_periode'                    => $periode->id_periode,
                    'deskripsi'                     => $request->dekripsi,
                    'kuota'                         => $request->kuota,
                    'gaji'                          => $request->gaji,
                    'ipk'                           => $request->ipk,
                    'tanggal_mulai_pendaftaran'     => $request->tanggal_mulai_pendaftaran,
                    'tanggal_selesai_pendaftaran'   => $request->tanggal_selesai_pendaftaran,
                    'status'                        => $request->status,
                ]);
            }

            return to_route('admin.lowongan-magang')->with('success', 'Lowongan magang berhasil ditambahkan');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors($exception->getMessage());
        }
    }

    public function detail(string $id): JsonResponse
    {
        try {
            $lowongan = LowonganMagang::with([
                'bidang',
                'perusahaan.lokasi',
                'jenis_lokasi',
                'periode_magang',
                'keahlian',
                'jenis_magang',
                'durasi',
            ])->findOrFail($id);

            return Response::json([
                'lowongan' => [
                    'status'                        => $lowongan->status ?? '-',
                    'deskripsi'                     => $lowongan->deskripsi ?? '-',
                    'kuota'                         => $lowongan->kuota ?? '-',
                    'gaji'                          => $lowongan->gaji ?? '-',
                    'tanggal_mulai_pendaftaran'     => $lowongan->tanggal_mulai_pendaftaran ?? '-',
                    'tanggal_selesai_pendaftaran'   => $lowongan->tanggal_selesai_pendaftaran ?? '-',
                    'bidang'                        => ['nama_bidang' => $lowongan->bidang?->nama_bidang ?? '-'],
                    'perusahaan'        => [
                        'nama'          => $lowongan->perusahaan?->nama ?? '-',
                        'logo'          => $lowongan->perusahaan?->logo ?? '-',
                        'lokasi'        => ['nama_lokasi' => $lowongan->perusahaan?->lokasi?->nama_lokasi ?? '-'],
                    ],
                    'jenis_lokasi'      => ['nama_jenis_lokasi' => $lowongan->jenis_lokasi?->nama_jenis_lokasi ?? '-'],
                    'periode_magang'    => ['nama_periode' => $lowongan->periode_magang?->nama_periode ?? '-'],
                    'keahlian'          => ['nama_keahlian' => $lowongan->keahlian->pluck('nama_keahlian')->implode(', ') ?: '-'],
                    'jenis_magang'      => ['nama_jenis' => $lowongan->jenis_magang?->nama_jenis ?? '-'],
                    'durasi'            => ['nama_durasi' => $lowongan->durasi?->nama_durasi ?? '-'],
                ]
            ]);
        } catch (ModelNotFoundException $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return Response::json(['errors' => 'Lowongan magang tidak ditemukan.'], 404);
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return Response::json(['errors' => 'Terjadi kesalahan pada server.'], 500);
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            $lowongan = LowonganMagang::findOrFail($id);
            $lowongan->delete();
            return to_route('admin.lowongan-magang')->with('success', 'Lowongan magang berhasil dihapus');
        } catch (ModelNotFoundException $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Lowongan magang tidak ditemukan.']);
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Gagal menghapus data lowongan magang karena kesalahan pada server.']);
        }
    }
}