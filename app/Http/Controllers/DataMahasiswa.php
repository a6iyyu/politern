<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Magang;
use App\Models\Mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DataMahasiswa extends Controller
{
    public function index(): View
    {
        $pengguna = Auth::user()->tipe;
        if ($pengguna === "ADMIN") {
            $total_mahasiswa = Mahasiswa::count();
            $total_mahasiswa_magang = Magang::count();
            $mahasiswa_belum_magang = Mahasiswa::where('status', 'BELUM MAGANG')->count();
            $mahasiswa_sedang_magang = Mahasiswa::where('status', 'SEDANG MAGANG')->count();
            $mahasiswa_selesai_magang = Mahasiswa::where('status', 'SELESAI')->count();

            /** @var LengthAwarePaginator $paginasi */
            $paginasi = Mahasiswa::with('program_studi')->paginate(request('per_page', default: 10));
            $data = $paginasi->getCollection()->map(fn($mhs) => [
                $mhs->id_mahasiswa,
                '<div class="flex items-center gap-2">
                    <img src="' . asset('shared/profil.png') . '" alt="avatar" class="w-8 h-8 rounded-full" /> ' . e($mhs->nama_lengkap) . '
                </div>',
                $mhs->nim,
                $mhs->program_studi->nama,
                $mhs->angkatan,
                $mhs->semester,
                $mhs->status,
                view('components.admin.data-mahasiswa.aksi', compact('mhs'))->render(),
            ])->toArray();
            return view('pages.admin.data-mahasiswa', compact('data', 'paginasi', 'total_mahasiswa', 'total_mahasiswa_magang', 'mahasiswa_belum_magang', 'mahasiswa_sedang_magang', 'mahasiswa_selesai_magang'));
        } else if ($pengguna === "DOSEN") {
            return view('pages.lecturer.data-mahasiswa');
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }

    public function create() {}

    public function destroy(string $id): RedirectResponse
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return to_route('admin.data-mahasiswa')->with('success', 'Data mahasiswa berhasil dihapus');
    }

    public function export_excel()
    {
        $mahasiswa = Mahasiswa::select("id_mahasiswa", "nama_lengkap", "nim", "id_prodi", "angkatan", "semester")
                    ->with('program_studi:id_prodi,nama')
                    ->get();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Lengkap');
        $sheet->setCellValue('C1', 'NIM');
        $sheet->setCellValue('D1', 'Program Studi');
        $sheet->setCellValue('E1', 'Angkatan');
        $sheet->setCellValue('F1', 'Semester');

        $sheet->getStyle("A1:F1")->getFont()->setBold(true);

        $no = 1;
        $baris = 2;
        foreach ($mahasiswa as $key => $value) {
            $sheet->setCellValue('A'.$baris, $no);
            $sheet->setCellValue('B'.$baris, $value->nama_lengkap);
            $sheet->setCellValue('C'.$baris, $value->nim);
            $sheet->setCellValue('D'.$baris, $value->program_studi->nama);
            $sheet->setCellValue('E'.$baris, $value->angkatan);
            $sheet->setCellValue('F'.$baris, $value->semester);
            $baris++;
            $no++;
        }   

        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $sheet->setTitle("Data Mahasiswa"); // set title sheet

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Mahasiswa ' . date("Y-m-d H:i:s") . '.xlsx';

        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header("Cache-Control: max-age=0");
        header("Cache-Control: max-age=1");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate('D, d M Y H:i:s') . ' GMT');
        header("Cache-Control: cache, must-revalidate");
        header("Pragma: public");

        $writer->save('php://output');
        exit;
        // end function export_excel
    }
}