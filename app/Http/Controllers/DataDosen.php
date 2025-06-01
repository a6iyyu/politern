<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\DosenPembimbing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class DataDosen extends Controller
{
    public function index(): View
    {
        $pengguna = Auth::user()->tipe;
        if ($pengguna === "ADMIN") {
            $total_dosen = Dosen::count();
            $total_dosen_pembimbing = DosenPembimbing::count();

            $paginasi = Dosen::paginate(request('per_page', 10));
            $data = collect($paginasi->items())->map(fn(Dosen $dosen): array => [
                $dosen->id_dosen,
                '<div class="flex items-center gap-2">
                    <img src="' . asset('shared/profil.png') . '" alt="avatar" class="h-8 w-8 rounded-full" /> ' . e($dosen->nama) . '
                </div>',
                $dosen->nip,
                $dosen->nomor_telepon,
                view('components.admin.data-dosen.aksi', compact('dosen'))->render(),
            ])->toArray();
            return view('pages.admin.data-dosen', compact('data', 'paginasi', 'total_dosen', 'total_dosen_pembimbing'));
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }

    public function create() {}

    public function show($id): array
    {
        $dosen = Dosen::findOrFail($id);
        $pengguna = $dosen->pengguna;
        return compact('dosen', 'pengguna');
    }

    public function edit($id): View
    {
        $dosen = Dosen::findOrFail($id);
        return view('pages.admin.edit-data-dosen', compact('dosen'));
    }

    public function destroy($id): RedirectResponse
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();
        return redirect()->route('admin.data-dosen')->with('success', 'Data Dosen berhasil dihapus.');
    }

    public function export_excel(): never
    {
        $dosen = Dosen::select('id_dosen', 'nama', 'nip', 'nomor_telepon')->get();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'NIP');
        $sheet->setCellValue('D1', 'Nomor Telepon');
        $sheet->getStyle("A1:D1")->getFont()->setBold(true);

        $nomor = 1;
        $baris = 2;
        foreach ($dosen as $key => $value) {
            $sheet->setCellValue("A$baris", $nomor);
            $sheet->setCellValue("B$baris", $value->nama);
            $sheet->setCellValueExplicit("C$baris", $value->nip, DataType::TYPE_STRING);
            $sheet->setCellValue("D$baris", $value->nomor_telepon);
            $baris++;
            $nomor++;
        }

        foreach (range('A', 'D') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $sheet->setTitle("Data Dosen");
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Disposition: attachment; filename="' . 'Data Dosen ' . date("Y-m-d H:i:s") . '.xlsx' . '"');
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