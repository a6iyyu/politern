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
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

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
            $perusahaan = Perusahaan::where('status', 'AKTIF')->pluck('nama', 'id_perusahaan_mitra')->toArray();
            $query = LowonganMagang::query();

            if ($id_bidang = request('bidang')) $query->where('id_bidang', $id_bidang);
            if ($id_perusahaan = request('perusahaan')) $query->where('id_perusahaan_mitra', $id_perusahaan);
            if ($id_periode = request('periode')) $query->where('id_periode', $id_periode);

            $paginasi = $query->paginate(request('per_page', 10));
            $baris = 1;
            $data = collect($paginasi->items())->map(function (LowonganMagang $lowongan) use (&$baris) {
                $status = match ($lowongan->status) {
                    'DIBUKA'    => 'bg-green-200 text-green-800',
                    'DITUTUP'   => 'bg-yellow-200 text-yellow-800',
                };

                return [
                    $baris++,
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
        } else if ($pengguna === 'MAHASISWA') {
            $lowongan = LowonganMagang::with(['bidang', 'perusahaan', 'jenis_lokasi', 'periode_magang', 'keahlian', 'jenis_magang', 'durasi'])->where('status', 'DIBUKA')->get();
            return view('pages.student.lowongan', compact('lowongan'));
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'id_perusahaan_mitra'           => 'required|exists:perusahaan_mitra,id_perusahaan_mitra',
                'id_bidang'                     => 'required|exists:bidang,id_bidang',
                'id_keahlian'                   => 'required|array|min:1',
                'id_keahlian.*'                 => 'exists:keahlian,id_keahlian',
                'id_periode'                    => 'required|exists:periode_magang,id_periode',
                'id_jenis_lokasi'               => 'required|exists:jenis_lokasi,id_jenis_lokasi',
                'id_jenis_magang'               => 'required|exists:jenis_magang,id_jenis_magang',
                'id_durasi_magang'              => 'required|exists:durasi_magang,id_durasi_magang',
                'deskripsi'                     => 'required|string|max:255',
                'kuota'                         => 'required|integer|min:1',
                'gaji'                          => 'required|string|max:100',
                'status'                        => 'required|in:DIBUKA,DITUTUP',
                'tanggal_mulai_pendaftaran'     => 'required|date',
                'tanggal_selesai_pendaftaran'   => 'required|date|after_or_equal:tanggal_mulai_pendaftaran',
            ]);

            $lowongan = LowonganMagang::create([
                'id_perusahaan_mitra'           => $request->id_perusahaan_mitra,
                'id_periode'                    => $request->id_periode,
                'id_bidang'                     => $request->id_bidang,
                'id_jenis_lokasi'               => $request->id_jenis_lokasi,
                'id_jenis_magang'               => $request->id_jenis_magang,
                'id_durasi_magang'              => $request->id_durasi_magang,
                'deskripsi'                     => $request->deskripsi,
                'kuota'                         => $request->kuota,
                'gaji'                          => $request->gaji,
                'status'                        => $request->status,
                'tanggal_mulai_pendaftaran'     => $request->tanggal_mulai_pendaftaran,
                'tanggal_selesai_pendaftaran'   => $request->tanggal_selesai_pendaftaran,
            ]);

            $lowongan->keahlian()->sync($request->id_keahlian);

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
            if (method_exists($lowongan, 'keahlian')) $lowongan->keahlian()->detach();
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

    public function edit(string $id): JsonResponse
    {
        try {
            $lowongan = LowonganMagang::with([
                'bidang',
                'perusahaan',
                'jenis_lokasi',
                'periode_magang',
                'keahlian',
                'jenis_magang',
                'durasi',
            ])->findOrFail($id);

            return Response::json([
                'id_lowongan'                  => $lowongan->id_lowongan,
                'id_perusahaan_mitra'          => $lowongan->id_perusahaan_mitra,
                'id_bidang'                    => $lowongan->id_bidang,
                'id_periode'                   => $lowongan->id_periode,
                'id_jenis_lokasi'              => $lowongan->id_jenis_lokasi,
                'id_jenis_magang'              => $lowongan->id_jenis_magang,
                'id_durasi_magang'             => $lowongan->id_durasi_magang,
                'deskripsi'                    => $lowongan->deskripsi,
                'kuota'                        => $lowongan->kuota,
                'gaji'                         => $lowongan->gaji,
                'status'                       => $lowongan->status,
                'tanggal_mulai_pendaftaran'    => $lowongan->tanggal_mulai_pendaftaran,
                'tanggal_selesai_pendaftaran'  => $lowongan->tanggal_selesai_pendaftaran,
                'keahlian'                     => $lowongan->keahlian->map(fn($k) => [
                    'id_keahlian'              => $k->id_keahlian,
                    'nama_keahlian'            => $k->nama_keahlian,
                ])->toArray(),
            ]);
        } catch (ModelNotFoundException $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return Response::json(['errors' => 'Lowongan magang tidak ditemukan.'], 404);
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return Response::json(['errors' => 'Gagal mengambil data lowongan magang karena kesalahan pada server.'], 500);
        }
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            $request->validate([
                'id_perusahaan_mitra'           => 'required|exists:perusahaan_mitra,id_perusahaan_mitra',
                'id_bidang'                     => 'required|exists:bidang,id_bidang',
                'id_keahlian'                   => 'required|array|min:1',
                'id_keahlian.*'                 => 'exists:keahlian,id_keahlian',
                'id_periode'                    => 'required|exists:periode_magang,id_periode',
                'id_jenis_lokasi'               => 'required|exists:jenis_lokasi,id_jenis_lokasi',
                'id_jenis_magang'               => 'required|exists:jenis_magang,id_jenis_magang',
                'id_durasi_magang'              => 'required|exists:durasi_magang,id_durasi_magang',
                'deskripsi'                     => 'required|string|max:255',
                'kuota'                         => 'required|integer|min:1',
                'gaji'                          => 'required|string|max:100',
                'status'                        => 'required|in:DIBUKA,DITUTUP',
                'tanggal_mulai_pendaftaran'     => 'required|date',
                'tanggal_selesai_pendaftaran'   => 'required|date|after_or_equal:tanggal_mulai_pendaftaran',
            ]);

            $lowongan = LowonganMagang::findOrFail($id);

            $lowongan->update([
                'id_perusahaan_mitra'           => $request->id_perusahaan_mitra,
                'id_periode'                    => $request->id_periode,
                'id_bidang'                     => $request->id_bidang,
                'id_jenis_lokasi'               => $request->id_jenis_lokasi,
                'id_jenis_magang'               => $request->id_jenis_magang,
                'id_durasi_magang'              => $request->id_durasi_magang,
                'deskripsi'                     => $request->deskripsi,
                'kuota'                         => $request->kuota,
                'gaji'                          => $request->gaji,
                'status'                        => $request->status,
                'tanggal_mulai_pendaftaran'     => $request->tanggal_mulai_pendaftaran,
                'tanggal_selesai_pendaftaran'   => $request->tanggal_selesai_pendaftaran,
            ]);

            $lowongan->keahlian()->sync($request->id_keahlian);
            return to_route('admin.lowongan-magang')->with('success', 'Lowongan magang berhasil diperbarui');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Gagal memperbarui data lowongan magang karena kesalahan pada server.']);
        }
    }

    public function show(string $id): View
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

            return view('pages.student.detail-lowongan', compact('lowongan'));
        } catch (ModelNotFoundException $exception) {
            report($exception);
            Log::error($exception->getMessage());
            abort(404, 'Lowongan magang tidak ditemukan.');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            abort(500, 'Terjadi kesalahan pada server.');
        }
    }

    public function export_excel(): never
    {
        $lowongan = LowonganMagang::with(['perusahaan', 'periode_magang', 'bidang', 'keahlian', 'jenis_lokasi'])->get();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray([
            ['No', 'Nama Lowongan', 'Nama Perusahaan Mitra', 'Periode', 'Keahlian', 'Jenis Lokasi', 'Kuota', 'Gaji', 'Status', 'Tanggal Mulai Pendaftaran', 'Tanggal Selesai Pendaftaran']
        ]);

        $baris = 2;
        $no = 1;

        foreach ($lowongan as $value) {
            $sheet->setCellValue("A$baris", $no);
            $sheet->setCellValue("B$baris", $value->bidang->nama_bidang ?? '-');
            $sheet->setCellValue("C$baris", $value->perusahaan->nama ?? '-');
            $sheet->setCellValue("D$baris", $value->periode_magang->nama_periode ?? '-');
            $sheet->setCellValue("E$baris", $value->keahlian->pluck('nama_keahlian')->join(', ') ?? '-');
            $sheet->setCellValue("F$baris", $value->jenis_lokasi->nama_jenis_lokasi ?? '-');
            $sheet->setCellValue("G$baris", $value->kuota);
            $sheet->setCellValue("H$baris", $value->gaji);
            $sheet->setCellValue("I$baris", $value->status);
            $sheet->setCellValue("J$baris", $value->tanggal_mulai_pendaftaran);
            $sheet->setCellValue("K$baris", $value->tanggal_selesai_pendaftaran);
            $baris++;
            $no++;
        }

        foreach (range('A', 'K') as $col) $sheet->getColumnDimension($col)->setAutoSize(true);
        $sheet->setTitle("Data Lowongan Magang");

        if (ob_get_length()) ob_end_clean();
        $filename = 'Data Lowongan Magang ' . date("Y-m-d_H-i-s") . '.xlsx';

        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Cache-Control: max-age=0");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate('D, d M Y H:i:s') . ' GMT');
        header("Cache-Control: cache, must-revalidate");
        header("Pragma: public");

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}