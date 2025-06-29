<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
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

class DataProdi extends Controller
{
    public function index(Request $request): View
    {
        $pengguna = Auth::user()->tipe;
        if ($pengguna === "ADMIN") {
            $baris = 1;
            $total_prodi = ProgramStudi::count();
            $jenjang = ['D1' => 'D1', 'D2' => 'D2', 'D3' => 'D3', 'D4' => 'D4', 'S2' => 'S2', 'S3' => 'S3'];
            $status = ['AKTIF' => 'Aktif', 'NONAKTIF' => 'Nonaktif'];
            
            // Build the query with filters
            $query = ProgramStudi::query();
            
            // Filter by program name
            if ($request->has('nama_prodi') && !empty($request->nama_prodi)) {
                $query->where('nama', 'like', '%' . $request->nama_prodi . '%');
            }
            
            // Filter by education level
            if ($request->has('jenjang') && !empty($request->jenjang)) {
                $query->where('jenjang', $request->jenjang);
            }
            
            $paginasi = $query->paginate(request('per_page', 10))->withQueryString();
            $data = collect($paginasi->items())->map(function (ProgramStudi $prodi) use (&$baris) {
                $status = match ($prodi->status) {
                    'AKTIF'     => 'bg-green-200 text-green-800',
                    'NONAKTIF'  => 'bg-red-200 text-yellow-800',
                };
                return [
                    $baris++,
                    $prodi->kode,
                    $prodi->nama,
                    $prodi->jenjang,
                    $prodi->jurusan,
                    Mahasiswa::where('id_prodi', $prodi->id_prodi)->count(),
                    '<div class="text-xs font-medium px-5 py-2 rounded-2xl ' . $status . '">' . ($prodi->status ?? "N/A") . '</div>',
                    view('components.admin.data-prodi.aksi', compact('prodi'))->render(),
                ];
            })->toArray();
            return view('pages.admin.data-prodi', compact('data', 'paginasi', 'total_prodi', 'jenjang', 'status'));
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }

    public function create(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'kode'      => 'required|string|max:10|unique:program_studi,kode',
                'nama'      => 'required|string|max:100|unique:program_studi,nama',
                'jenjang'   => 'required|string|in:D2,D3,D4,S2',
                'jurusan'   => 'required|string|max:255',
            ]);

            $jenjang = match ($request->jenjang) {
                'D2'    => 'D2',
                'D3'    => 'D3',
                'D4'    => 'D4',
                'S2'    => 'S2',
                default => 'D4',
            };

            ProgramStudi::create([
                'kode'    => $request->kode,
                'nama'    => $request->nama,
                'jenjang' => $jenjang,
                'jurusan' => $request->jurusan,
                'status'  => 'AKTIF'
            ]);

            return to_route('admin.data-prodi')->with('success', 'Data program studi berhasil ditambahkan.');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors('Gagal menambahkan data program studi karena kesalahan pada server.');
        }
    }

    public function edit(string $id): JsonResponse|RedirectResponse
    {
        try {
            $prodi = ProgramStudi::findOrFail($id);
            return Response::json($prodi);
        } catch (ModelNotFoundException $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Data program studi yang Anda cari tidak ditemukan.']);
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Gagal mengambil data program studi karena kesalahan pada server.']);
        }
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        try {
            $prodi = ProgramStudi::findOrFail($id);
            $prodi->nama = $request->nama;
            $prodi->kode = $request->kode;
            $prodi->jenjang = $request->jenjang;
            $prodi->jurusan = $request->jurusan;
            $prodi->status = $request->status;
            $prodi->save();
            return to_route('admin.data-prodi')->with('success', 'Data program studi berhasil diubah.');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Gagal mengubah data program studi karena kesalahan pada server.']);
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            $prodi = ProgramStudi::findOrFail($id);
            $prodi->delete();
            return to_route('admin.data-prodi')->with('success', 'Data program studi berhasil dihapus.');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Gagal menghapus data program studi karena kesalahan pada server.']);
        }
    }

    public function show(string $id): array
    {
        $prodi = ProgramStudi::findOrFail($id);

        return [
            'mahasiswa' => Mahasiswa::where('id_prodi', $id)->get(),
            'prodi' => [
                'kode_prodi' => $prodi->kode,
                'nama' => $prodi->nama,
                'jenjang_prodi' => $prodi->jenjang,
                'jurusan_prodi' => $prodi->jurusan,
                'status_prodi' => $prodi->status,
            ],
        ];
    }

    public function export_excel()
    {
        $prodi = ProgramStudi::all();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Jenjang');
        $sheet->setCellValue('E1', 'Jurusan');
        $sheet->setCellValue('F1', 'Status');
        $sheet->getStyle("A1:F1")->getFont()->setBold(true);

        $nomor = 1;
        $baris = 2;
        foreach ($prodi as $value) {
            $sheet->setCellValue("A$baris", $nomor);
            $sheet->setCellValue("B$baris", $value->kode ?? '-');
            $sheet->setCellValue("C$baris", $value->nama ?? '-');
            $sheet->setCellValue("D$baris", $value->jenjang ?? '-');
            $sheet->setCellValue("E$baris", $value->jurusan ?? '-');
            $sheet->setCellValue("F$baris", $value->status ?? '-');
            $baris++;
            $nomor++;
        }

        foreach (range('A', 'F') as $id) $sheet->getColumnDimension($id)->setAutoSize(true);

        $sheet->setTitle("Data Program Studi");
        if (ob_get_length()) ob_end_clean();
        $filename = 'Data Program Studi ' . date("Y-m-d_H-i-s") . '.xlsx';

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