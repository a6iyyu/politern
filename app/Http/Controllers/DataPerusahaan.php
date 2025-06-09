<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use App\Models\Lokasi;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class DataPerusahaan extends Controller
{
    public function index(): View
    {
        $pengguna = Auth::user()->tipe;
        if ($pengguna === "ADMIN") {
            $baris = 1;
            $total_perusahaan = Perusahaan::count();
            $perusahaan = Perusahaan::with('lokasi')->get();
            $lokasi = Lokasi::pluck('nama_lokasi', 'id_lokasi')->toArray();
            $lokasi_filter = Lokasi::whereHas('perusahaan')
                ->pluck('nama_lokasi', 'id_lokasi')
                ->toArray();

            $paginasi = Perusahaan::paginate(request('per_page', 10));
            $data = collect($paginasi->items())->map(function (Perusahaan $perusahaan) {
                $status = match ($perusahaan->status) {
                    'AKTIF'         => 'bg-green-200 text-green-800',
                    'TIDAK AKTIF'   => 'bg-red-200 text-red-800',
                };
                return [
                    $perusahaan->id_perusahaan_mitra,
                    '<div class="flex items-center gap-2">
                        <img src="' . asset('shared/profil.png') . '" alt="avatar" class="h-8 w-8 rounded-full" /> ' . e($perusahaan->nama) . '
                    </div>',
                    $perusahaan->nib,
                    $perusahaan->email,
                    $perusahaan->lokasi->nama_lokasi,
                    '<div class="text-xs font-medium px-5 py-2 rounded-2xl ' . $status . '">' . e($perusahaan->status) . '</div>',
                    view('components.admin.data-perusahaan.aksi', compact('perusahaan'))->render(),
                ];
            })->toArray();
            return view('pages.admin.data-perusahaan', compact('perusahaan', 'data', 'total_perusahaan', 'paginasi', 'lokasi', 'lokasi_filter'));
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }

    public function create(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'nama'          => 'required|string|max:50',
                'logo'          => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'nib'           => 'required|string|max:13|unique:perusahaan_mitra,nib',
                'email'         => 'required|email|unique:perusahaan_mitra,email',
                'nomor_telepon' => 'required|string|max:15|unique:perusahaan_mitra,nomor_telepon',
                'website'       => 'required|url',
                'status'        => 'required|in:AKTIF,TIDAK AKTIF',
                'id_lokasi'     => 'required|exists:lokasi,id_lokasi',
            ]);

            $logo = null;
            if ($request->hasFile('logo')) $logo = $request->file('logo')->store('logo', 'public');

            Perusahaan::create([
                'nama'          => $request->nama,
                'logo'          => $logo,
                'nib'           => $request->nib,
                'email'         => $request->email,
                'nomor_telepon' => $request->nomor_telepon,
                'website'       => $request->website,
                'status'        => $request->status,
                'id_lokasi'     => $request->id_lokasi,
            ]);

            return to_route('admin.data-perusahaan')->with('success', 'Berhasil menambahkan data perusahaan.');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors('Gagal dalam menambahkan data perusahaan karena kesalahan pada server.');
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            $dosen = Perusahaan::findOrFail($id);
            $dosen->delete();
            return to_route('admin.data-perusahaan')->with('success', 'Data perusahaan berhasil dihapus.');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors('Gagal dalam menghapus data perusahaan kesalahan pada server.');
        }
    }

    public function edit(string $id): JsonResponse
    {
        try {
            $perusahaan = Perusahaan::with('lokasi')->findOrFail($id);

            return response()->json([
                'lokasi' => Lokasi::pluck('nama_lokasi', 'id_lokasi')->toArray(),
                'perusahaan' => [
                    'nama'           => $perusahaan->nama,
                    'nib'            => $perusahaan->nib,
                    'nomor_telepon'  => $perusahaan->nomor_telepon,
                    'email'          => $perusahaan->email,
                    'website'        => $perusahaan->website,
                    'logo'           => $perusahaan->logo,
                    'status'         => $perusahaan->status,
                    'id_lokasi'      => $perusahaan->id_lokasi,
                ],
            ]);
        } catch (ModelNotFoundException $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return Response::json(['errors' => 'Data perusahaan tidak ditemukan.'], 404);
        }
    }

    public function show(Request $request, string $id): array
    {
        try {
            $perusahaan = Perusahaan::findOrFail($id);
            return compact('perusahaan');
        } catch (Exception $exception) {
            report($exception);
            Log::warning($exception->getMessage());
            abort(500, "Gagal dalam mengambil informasi perusahaan karena kesalahan pada server.");
        }
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            $request->validate([
                'nama'          => 'required|string|max:50',
                'nib'           => 'required|string|max:13',
                'nomor_telepon' => 'required|string|max:15',
                'email'         => 'required|email',
                'website'       => 'required|url',
                'logo'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status'        => 'required|in:AKTIF,TIDAK AKTIF',
                'id_lokasi'     => 'required|exists:lokasi,id_lokasi',
            ]);

            $perusahaan = Perusahaan::findOrFail($id);

            $perusahaan->nama          = $request->nama;
            $perusahaan->nib           = $request->nib;
            $perusahaan->nomor_telepon = $request->nomor_telepon;
            $perusahaan->email         = $request->email;
            $perusahaan->website       = $request->website;
            $perusahaan->status        = $request->status;
            $perusahaan->id_lokasi     = $request->id_lokasi;

            if ($request->hasFile('logo')) {
                $logo = $request->file('logo')->store('logo', 'public');
                $perusahaan->logo = $logo;
            }

            $perusahaan->save();
            return to_route('admin.data-perusahaan')->with('success', 'Berhasil memperbarui data perusahaan.');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors('Gagal memperbarui data perusahaan karena kesalahan pada server.');
        }
    }

    public function export_excel()
    {
        $perusahaan = Perusahaan::with('lokasi')->select('id_perusahaan_mitra', 'id_lokasi', 'nama', 'nib', 'nomor_telepon', 'email', 'website', 'status')->get();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Lokasi');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'NIB');
        $sheet->setCellValue('E1', 'Nomor Telepon');
        $sheet->setCellValue('F1', 'Surel');
        $sheet->setCellValue('G1', 'Website');
        $sheet->setCellValue('H1', 'Status');
        $sheet->getStyle("A1:H1")->getFont()->setBold(true);

        $nomor = 1;
        $baris = 2;
        foreach ($perusahaan as $value) {
            $sheet->setCellValue("A$baris", $nomor);
            $sheet->setCellValue("B$baris", $value->lokasi->nama_lokasi ?? '-');
            $sheet->setCellValue("C$baris", $value->nama);
            $sheet->setCellValue("D$baris", $value->nib);
            $sheet->setCellValue("E$baris", $value->nomor_telepon);
            $sheet->setCellValue("F$baris", $value->email);
            $sheet->setCellValue("G$baris", $value->website);
            $sheet->setCellValue("H$baris", $value->status);
            $baris++;
            $nomor++;
        }

        foreach (range('A', 'H') as $id) $sheet->getColumnDimension($id)->setAutoSize(true);

        $sheet->setTitle("Data Perusahaan Mitra");
        if (ob_get_length()) ob_end_clean();
        $filename = 'Data Perusahaan Mitra ' . date("Y-m-d_H-i-s") . '.xlsx';

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