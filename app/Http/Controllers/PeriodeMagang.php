<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\DurasiMagang as DurasiMagangModel;
use App\Models\PeriodeMagang as PeriodeMagangModel;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Http\JsonResponse;

class PeriodeMagang extends Controller
{
    public function index(): View
    {
        $pengguna = Auth::user()->tipe;
        if ($pengguna === "ADMIN") {
            $total_periode = PeriodeMagangModel::count();
            $perusahaan_filter = Perusahaan::whereHas('lokasi')
                ->pluck('nama', 'id_perusahaan_mitra')
                ->toArray();
            $durasi = DurasiMagangModel::all();

            $paginasi = PeriodeMagangModel::paginate(request('per_page', 10));
            $data = collect($paginasi->items())->map(fn(PeriodeMagangModel $periode): array => [
                $periode->id_periode,
                $periode->nama_periode,
                $periode->tanggal_mulai,
                $periode->tanggal_selesai,
                $periode->status,
                view('components.admin.periode-magang.aksi', compact('periode'))->render(),
            ])->toArray();

            $data_durasi = collect($durasi)->map(fn(DurasiMagangModel $durasi): array => [
                $durasi->id_durasi_magang,
                $durasi->nama_durasi,
                view('components.admin.durasi-magang.aksi', compact('durasi'))->render(),
            ])->toArray();

            return view('pages.admin.periode-magang', compact('data', 'paginasi', 'total_periode', 'data_durasi', 'perusahaan_filter'));
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }

    public function create(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'nama_periode'      => 'required|string|max:200|unique:periode_magang,nama_periode',
                'tanggal_mulai'     => 'required|date',
                'tanggal_selesai'   => 'required|date|after_or_equal:tanggal_mulai',
                'status'            => 'required|in:AKTIF,SELESAI',
            ]);

            PeriodeMagangModel::create([
                'nama_periode'      => $request->nama_periode,
                'durasi'            => $request->durasi,
                'tanggal_mulai'     => $request->tanggal_mulai,
                'tanggal_selesai'   => $request->tanggal_selesai,
            ]);

            return to_route('admin.periode-magang')->with('success', 'Periode Magang berhasil ditambahkan');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors($exception->getMessage());
        }
    }

    public function show($id): array
    {
        $periode = PeriodeMagangModel::findOrFail($id);
        return compact('periode');
    }


    public function edit($id): JsonResponse
    {
        $periode = PeriodeMagangModel::findOrFail($id);

        return response()->json([
            'periode' => [
                'nama_periode'    => $periode->nama_periode,
                'durasi'          => $periode->durasi,
                'tanggal_mulai'   => $periode->tanggal_mulai,
                'tanggal_selesai' => $periode->tanggal_selesai,
                'status'          => $periode->status,
                'created_at'      => $periode->created_at,
            ],
        ]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $periode = PeriodeMagangModel::findOrFail($id);

            $request->validate([
                'nama_periode'    => "required|string|max:200|unique:periode_magang,nama_periode,{$id}",
                'tanggal_mulai'   => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
                'status'          => 'required|in:AKTIF,SELESAI',
            ]);

            $periode->nama_periode    = $request->nama_periode;
            $periode->durasi          = $request->durasi;
            $periode->tanggal_mulai   = $request->tanggal_mulai;
            $periode->tanggal_selesai = $request->tanggal_selesai;
            $periode->status          = $request->status;
            $periode->save();

            return to_route('admin.periode-magang')->with('success', 'Data periode magang berhasil diubah');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors($exception->getMessage());
        }
    }

    public function destroy($id): RedirectResponse
    {
        try {
            $periode = PeriodeMagangModel::findOrFail($id);
            $periode->delete();
            return to_route('admin.periode-magang')->with('success', 'Periode Magang berhasil dihapus.');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors('Terjadi kesalahan pada server.');
        }
    }

    public function export_excel(): never
    {
        $periode = PeriodeMagangModel::select('id_periode', 'nama_periode', 'durasi', 'tanggal_mulai', 'tanggal_selesai', 'status')->get();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Periode');
        $sheet->setCellValue('C1', 'Durasi');
        $sheet->setCellValue('D1', 'Tanggal Mulai');
        $sheet->setCellValue('E1', 'Tanggal Selesai');
        $sheet->setCellValue('F1', 'Status');
        $sheet->getStyle("A1:F1")->getFont()->setBold(true);

        $nomor = 1;
        $baris = 2;
        foreach ($periode as $key => $value) {
            $sheet->setCellValue("A$baris", $nomor);
            $sheet->setCellValue("B$baris", $value->nama_periode);
            $sheet->setCellValue("C$baris", $value->durasi);
            $sheet->setCellValue("D$baris", $value->tanggal_mulai);
            $sheet->setCellValue("E$baris", $value->tanggal_selesai);
            $sheet->setCellValue("F$baris", $value->status);
            $baris++;
            $nomor++;
        }

        foreach (range('A', 'F') as $id) $sheet->getColumnDimension($id)->setAutoSize(true);

        $sheet->setTitle("Data periode Magang");
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Disposition: attachment; filename="' . 'Data periode Magang' . date("Y-m-d H:i:s") . '.xlsx' . '"');
        header("Cache-Control: max-age=0");
        header("Cache-Control: max-age=1");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate('D, d M Y H:i:s') . ' GMT');
        header("Cache-Control: cache, must-revalidate");
        header("Pragma: public");

        $writer->save('php://output');
        exit;
    }
}