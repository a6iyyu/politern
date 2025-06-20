<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\PeriodeMagang as PeriodeMagangModel;
use App\Models\Magang;
use App\Models\LowonganMagang;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Periode extends Controller
{
    public function index(): View
    {
        $pengguna = Auth::user()->tipe;
        if ($pengguna === "ADMIN") {
            $total_periode = PeriodeMagangModel::count();
            $status = ['AKTIF' => 'Aktif', 'SELESAI' => 'Selesai'];

            $today = now()->toDateString();
            $periods = PeriodeMagangModel::all();
            foreach ($periods as $period) {
                $new_status = ($today <= $period->tanggal_selesai) ? 'AKTIF' : 'SELESAI';
                if ($period->status !== $new_status) {
                    $period->status = $new_status;
                    $period->save();
                }
            }

            $query = PeriodeMagangModel::query();
            if (request()->has('nama_periode') && !empty(request('nama_periode'))) {
                $query->where('nama_periode', 'like', '%' . request('nama_periode') . '%');
            }

            $baris = 1;
            $paginasi = $query->paginate(request('per_page', 10));
            $data = collect($paginasi->items())->map(function (PeriodeMagangModel $periode) use (&$baris) {
                $status = match ($periode->status) {
                    'AKTIF' => 'bg-green-200 text-green-800',
                    'SELESAI' => 'bg-red-200 text-yellow-800',
                };

                return [
                    $baris++,
                    $periode->nama_periode,
                    $periode->tanggal_mulai,
                    $periode->tanggal_selesai,
                    '<div class="text-xs font-medium px-5 py-2 rounded-2xl ' . $status . '">' . ($periode->status ?? "N/A") . '</div>',
                    view('components.admin.periode.aksi', compact('periode'))->render(),
                ];
            })->toArray();

            return view('pages.admin.periode', compact('data', 'paginasi', 'total_periode', 'status'));
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
            ]);

            PeriodeMagangModel::create([
                'nama_periode'      => $request->nama_periode,
                'tanggal_mulai'     => $request->tanggal_mulai,
                'tanggal_selesai'   => $request->tanggal_selesai,
            ]);

            return to_route('admin.periode')->with('success', 'Periode Magang berhasil ditambahkan');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors($exception->getMessage());
        }
    }

    public function show(string $id): array
    {
        try {
            $periode = PeriodeMagangModel::findOrFail($id);
            return compact('periode');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return [];
        }
    }

    public function edit(string $id): array
    {
        $periode = PeriodeMagangModel::findOrFail($id);
        return compact('periode');
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            $periode = PeriodeMagangModel::findOrFail($id);

            $request->validate([
                'nama_periode'    => "required|string|max:200|unique:periode_magang,nama_periode,{$id},id_periode",
                'tanggal_mulai'   => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            ]);

            $periode->nama_periode      = $request->nama_periode;
            $periode->tanggal_mulai     = $request->tanggal_mulai;
            $periode->tanggal_selesai   = $request->tanggal_selesai;
            $periode->save();

            $today = now()->toDateString();
            if ($periode->tanggal_selesai <= $today) {
                Magang::whereIn('id_pengajuan_magang', function($query) use ($id) {
                        $query->select('pengajuan_magang.id_pengajuan_magang')
                            ->from('pengajuan_magang')
                            ->join('lowongan_magang', 'pengajuan_magang.id_lowongan', '=', 'lowongan_magang.id_lowongan')
                            ->where('lowongan_magang.id_periode', $id);
                    })
                    ->where('status', '!=', 'SELESAI')
                    ->update([
                        'status' => 'SELESAI',
                        'updated_at' => now()
                    ]);

                LowonganMagang::where('id_periode', $id)
                    ->update([
                        'status' => 'DITUTUP',
                        'updated_at' => now()
                    ]);
            } else {
                Magang::whereIn('id_pengajuan_magang', function($query) use ($id) {
                        $query->select('pengajuan_magang.id_pengajuan_magang')
                            ->from('pengajuan_magang')
                            ->join('lowongan_magang', 'pengajuan_magang.id_lowongan', '=', 'lowongan_magang.id_lowongan')
                            ->where('lowongan_magang.id_periode', $id);
                    })
                    ->update([
                        'status' => 'AKTIF',
                        'updated_at' => now()
                    ]);
                    
                LowonganMagang::where('id_periode', $id)
                    ->update([
                        'status' => 'DIBUKA',
                        'updated_at' => now()
                    ]);
            }

            return to_route('admin.periode')->with('success', 'Data periode berhasil diubah.');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Gagal dalam memperbarui data periode karena kesalahan pada server.']);
        }
    }

    public function destroy($id): RedirectResponse
    {
        try {
            $periode = PeriodeMagangModel::findOrFail($id);
            $periode->delete();
            return to_route('admin.periode')->with('success', 'Periode Magang berhasil dihapus.');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors('Terjadi kesalahan pada server.');
        }
    }

    public function export_excel(): never
    {
        $periode = PeriodeMagangModel::select('periode_magang.id_periode', 'periode_magang.nama_periode', 'periode_magang.tanggal_mulai', 'periode_magang.tanggal_selesai', 'periode_magang.status')->get();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Periode');
        $sheet->setCellValue('C1', 'Tanggal Mulai');
        $sheet->setCellValue('D1', 'Tanggal Selesai');
        $sheet->setCellValue('E1', 'Status');
        $sheet->getStyle("A1:E1")->getFont()->setBold(true);

        $nomor = 1;
        $baris = 2;
        foreach ($periode as $key => $value) {
            $sheet->setCellValue("A$baris", $nomor);
            $sheet->setCellValue("B$baris", $value->nama_periode);
            $sheet->setCellValue("C$baris", $value->tanggal_mulai);
            $sheet->setCellValue("D$baris", $value->tanggal_selesai);
            $sheet->setCellValue("E$baris", $value->status);
            $baris++;
            $nomor++;
        }

        foreach (range('A', 'E') as $id) $sheet->getColumnDimension($id)->setAutoSize(true);

        $sheet->setTitle("Data Periode Magang");
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Disposition: attachment; filename="' . 'Data Periode Magang ' . date("Y-m-d H:i:s") . '.xlsx' . '"');
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