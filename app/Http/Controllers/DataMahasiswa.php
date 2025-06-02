<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Magang;
use App\Models\Mahasiswa;
use App\Models\PengajuanMagang;
use App\Models\Pengguna;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\ModelNotFoundException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class DataMahasiswa extends Controller
{
    public function index(): View
    {
        $pengguna = Auth::user()->tipe;
        if ($pengguna === "ADMIN") {
            $total_mahasiswa = Mahasiswa::count();
            $total_mahasiswa_magang = Magang::count();
            $mahasiswa_belum_magang = Mahasiswa::where('status', 'BELUM MAGANG')->count();
            $mahasiswa_sedang_magang = Magang::where('status', 'AKTIF')->count();
            $mahasiswa_selesai_magang = Magang::where('status', 'SELESAI')->count();
            $program_studi = ProgramStudi::all();
            $status_aktivitas = array_unique(array_merge(
                Magang::pluck('status')->toArray(),
                ['BELUM MAGANG']
            ));

            /** @var LengthAwarePaginator $paginasi */
            $paginasi = Mahasiswa::with('program_studi')->paginate(request('per_page', default: 10));
            $data = $paginasi->getCollection()->map(fn(Mahasiswa $mhs) => [
                $mhs->id_mahasiswa,
                '<div class="flex items-center gap-2">
                    <img src="' . asset('shared/profil.png') . '" alt="avatar" class="w-8 h-8 rounded-full" /> ' . e($mhs->nama_lengkap) . '
                </div>',
                $mhs->nim,
                $mhs->program_studi->nama,
                $mhs->angkatan,
                $mhs->semester,
                $mhs->pengajuan_magang->sortByDesc('created_at')->first()?->magang?->status ?? 'BELUM MAGANG',
                view('components.admin.data-mahasiswa.aksi', compact('mhs'))->render(),
            ])->toArray();
            return view('pages.admin.data-mahasiswa', compact('data', 'paginasi', 'total_mahasiswa', 'total_mahasiswa_magang', 'mahasiswa_belum_magang', 'mahasiswa_sedang_magang', 'mahasiswa_selesai_magang', 'program_studi', 'status_aktivitas'));
        } else if ($pengguna === "DOSEN") {
            return view('pages.lecturer.data-mahasiswa');
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }

    public function create(Request $request)
    {
        try {
            Log::info('Data Mahasiswa mau divalidasi');
            $request->validate([
                'nama_pengguna' => 'required|string|max:100|unique:pengguna,nama_pengguna',
                'kata_sandi' => 'required|string|min:6',
                'email' => 'required|email|unique:pengguna,email',
                'nama_lengkap' => 'required|string|max:255',
                'nim' => 'required|numeric|unique:mahasiswa,nim',
                'semester' => 'required|numeric',
                'program_studi' => 'required|exists:program_studi,id_prodi',
                'angkatan' => 'required|numeric',
                'ipk' => 'required|numeric',
            ]);
            Log::info('Data Mahasiswa sudah divalidasi');

            $pengguna = Pengguna::create([
                'nama_pengguna' => $request->nama_pengguna,
                'email' => $request->email,
                'kata_sandi' => bcrypt($request->kata_sandi),
                'tipe' => 'MAHASISWA',
            ]);

            Mahasiswa::create([
                'id_pengguna' => $pengguna->id_pengguna,
                'nama_lengkap' => $request->nama_lengkap,
                'nim' => $request->nim,
                'semester' => $request->semester,
                'id_prodi' => $request->program_studi,
                'angkatan' => $request->angkatan,
                'ipk' => $request->ipk,
                'status' => 'BELUM MAGANG',
            ]);

            return to_route('admin.data-mahasiswa')->with('success', 'Data mahasiswa berhasil ditambahkan.');
        } catch (\Exception $e) {
            report($e);
            Log::error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }
    }

    public function show($id): array {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $pengguna = $mahasiswa->pengguna;
        $prodi = $mahasiswa->program_studi->nama;
        $status = $mahasiswa->pengajuan_magang->sortByDesc('created_at')->first()?->magang?->status ?? 'BELUM MAGANG';
    
        return [
            'mahasiswa' => [
                'nim' => $mahasiswa->nim,
                'nama_lengkap' => $mahasiswa->nama_lengkap,
                'angkatan' => $mahasiswa->angkatan,
                'semester' => $mahasiswa->semester,
                'ipk' => $mahasiswa->ipk,
                'status' => $mahasiswa->status,
            ],
            'pengguna' => [
                'nama_pengguna' => $pengguna->nama_pengguna,
                'email' => $pengguna->email,
            ],
            'prodi' => [
                'nama' => $prodi
            ],
            'status' => [
                'status' => $status
            ]
        ];
    }
    

    public function destroy(string $id): RedirectResponse
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();
        return to_route('admin.data-mahasiswa')->with('success', 'Data mahasiswa berhasil dihapus');
    }

    public function export_excel(): never
    {
        $mahasiswa = Mahasiswa::select('id_mahasiswa', 'nama_lengkap', 'nim', 'id_prodi', 'angkatan', 'semester')->with('program_studi:id_prodi,nama')->get();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Lengkap');
        $sheet->setCellValue('C1', 'NIM');
        $sheet->setCellValue('D1', 'Program Studi');
        $sheet->setCellValue('E1', 'Angkatan');
        $sheet->setCellValue('F1', 'Semester');
        $sheet->getStyle("A1:F1")->getFont()->setBold(true);

        $nomor = 1;
        $baris = 2;
        foreach ($mahasiswa as $key => $value) {
            $sheet->setCellValue('A' . $baris, $nomor);
            $sheet->setCellValue('B' . $baris, $value->nama_lengkap);
            $sheet->setCellValue('C' . $baris, $value->nim);
            $sheet->setCellValue('D' . $baris, $value->program_studi->nama);
            $sheet->setCellValue('E' . $baris, $value->angkatan);
            $sheet->setCellValue('F' . $baris, $value->semester);
            $baris++;
            $nomor++;
        }

        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $sheet->setTitle("Data Mahasiswa");
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Disposition: attachment; filename="' . 'Data Mahasiswa ' . date("Y-m-d H:i:s") . '.xlsx' . '"');
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