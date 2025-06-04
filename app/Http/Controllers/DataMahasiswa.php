<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\BidangMahasiswa;
use App\Models\KeahlianMahasiswa;
use App\Models\Magang;
use App\Models\Mahasiswa;
use App\Models\Pengguna;
use App\Models\ProgramStudi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Crypt;
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
            $status_aktivitas = array_unique(array_merge(Magang::pluck('status')->toArray(), ['BELUM MAGANG']));

            /** @var LengthAwarePaginator $paginasi */
            $paginasi = Mahasiswa::with('program_studi')->paginate(request('per_page', default: 10));
            $data = $paginasi->getCollection()->map(function (Mahasiswa $mhs) {
                $status = match ($mhs->pengajuan_magang()->get()->sortByDesc('created_at')->first()?->magang?->status ?? 'BELUM MAGANG') {
                    'AKTIF'         => 'bg-green-200 text-green-800',
                    'SELESAI'       => 'bg-yellow-200 text-yellow-800',
                    'BELUM MAGANG'  => 'bg-red-200 text-red-800',
                };
                return [
                    $mhs->id_mahasiswa,
                    '<div class="flex items-center gap-2">
                        <img src="' . asset('shared/profil.png') . '" alt="avatar" class="w-8 h-8 rounded-full" /> ' . e($mhs->nama_lengkap) . '
                    </div>',
                    $mhs->nim,
                    $mhs->program_studi->kode,
                    $mhs->angkatan,
                    $mhs->semester,
                    '<div class="text-xs font-medium px-5 py-2 rounded-2xl ' . $status . '">' . ($mhs->pengajuan_magang->sortByDesc('created_at')->first()?->magang?->status ?? 'BELUM MAGANG') . '</div>',
                    view('components.admin.data-mahasiswa.aksi', compact('mhs'))->render(),
                ];
            })->toArray();
            return view('pages.admin.data-mahasiswa', compact('data', 'paginasi', 'total_mahasiswa', 'total_mahasiswa_magang', 'mahasiswa_belum_magang', 'mahasiswa_sedang_magang', 'mahasiswa_selesai_magang', 'program_studi', 'status_aktivitas'));
        } else if ($pengguna === "DOSEN") {
            return view('pages.lecturer.data-mahasiswa');
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }

    public function create(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'nama_pengguna'     => 'required|string|max:100|unique:pengguna,nama_pengguna',
                'kata_sandi'        => 'required|string|min:6',
                'email'             => 'required|email|unique:pengguna,email',
                'nama_lengkap'      => 'required|string|max:255',
                'nim'               => 'required|numeric|unique:mahasiswa,nim',
                'semester'          => 'required|numeric',
                'program_studi'     => 'required|exists:program_studi,id_prodi',
                'angkatan'          => 'required|numeric',
                'ipk'               => 'required|numeric',
            ]);

            $pengguna = Pengguna::create([
                'nama_pengguna' => $request->nama_pengguna,
                'email'         => $request->email,
                'kata_sandi'    => Crypt::encrypt($request->kata_sandi),
                'tipe'          => 'MAHASISWA',
            ]);

            Mahasiswa::create([
                'id_pengguna'   => $pengguna->id_pengguna,
                'nama_lengkap'  => $request->nama_lengkap,
                'nim'           => $request->nim,
                'semester'      => $request->semester,
                'id_prodi'      => $request->program_studi,
                'angkatan'      => $request->angkatan,
                'ipk'           => $request->ipk,
                'status'        => 'BELUM MAGANG',
            ]);

            return to_route('admin.data-mahasiswa')->with('success', 'Data mahasiswa berhasil ditambahkan.');
        } catch (Exception $e) {
            report($e);
            Log::error($e->getMessage());
            return back()->withErrors($e->getMessage());
        }
    }

    public function edit($id): JsonResponse
    {
        $mahasiswa = Mahasiswa::with(['pengguna', 'program_studi'])->findOrFail($id);

        return response()->json([
            'mahasiswa' => [
                'nama_lengkap'  => $mahasiswa->nama_lengkap,
                'nim'           => $mahasiswa->nim,
                'semester'      => $mahasiswa->semester,
                'angkatan'      => $mahasiswa->angkatan,
                'ipk'           => $mahasiswa->ipk,
                'nama_prodi'    => $mahasiswa->program_studi?->id_prodi ?? '-',
                'status'        => $mahasiswa->status,
            ],
            'pengguna' => [
                'nama_pengguna' => $mahasiswa->pengguna->nama_pengguna,
                'email'         => $mahasiswa->pengguna->email,
                'kata_sandi'    => Crypt::decrypt($mahasiswa->pengguna->kata_sandi),
            ],
        ]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $mahasiswa = Mahasiswa::with('pengguna')->findOrFail($id);

            $pengguna = $mahasiswa->pengguna;
            $pengguna->nama_pengguna = $request->nama_pengguna;
            $pengguna->email = $request->email;
            if ($request->filled('kata_sandi')) $pengguna->kata_sandi = Crypt::encrypt($request->kata_sandi);
            $pengguna->save();

            $mahasiswa->nama_lengkap = $request->nama_lengkap;
            $mahasiswa->nim = $request->nim;
            $mahasiswa->semester = $request->semester;
            $mahasiswa->id_prodi = $request->program_studi;
            $mahasiswa->angkatan = $request->angkatan;
            $mahasiswa->ipk = $request->ipk;
            $mahasiswa->save();
            return to_route('admin.data-mahasiswa')->with('success', 'Data mahasiswa berhasil diubah');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors($exception->getMessage());
        }
    }

    public function show($id): array
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $pengguna = $mahasiswa->pengguna;
        $prodi = $mahasiswa->program_studi->nama;
        $status = $mahasiswa->pengajuan_magang->sortByDesc('created_at')->first()?->magang?->status ?? 'BELUM MAGANG';

        return [
            'mahasiswa' => [
                'nim'           => $mahasiswa->nim,
                'nama_lengkap'  => $mahasiswa->nama_lengkap,
                'angkatan'      => $mahasiswa->angkatan,
                'semester'      => $mahasiswa->semester,
                'ipk'           => $mahasiswa->ipk,
                'status'        => $mahasiswa->status,
            ],
            'pengguna' => [
                'nama_pengguna' => $pengguna->nama_pengguna,
                'email'         => $pengguna->email,
            ],
            'prodi' => ['nama' => $prodi],
            'status' => ['status' => $status],
        ];
    }

    /**
     * @param string $id
     * @return RedirectResponse
     *
     * TODO: Memperbaiki logika penghapusan data mahasiswa karena
     * memiliki banyak relasi terhadap tabel lain.
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            BidangMahasiswa::where('id_mahasiswa', $id)->delete();
            KeahlianMahasiswa::where('id_mahasiswa', $id)->delete();
            $mahasiswa = Mahasiswa::findOrFail($id);
            $mahasiswa->delete();
            Pengguna::findOrFail($mahasiswa->id_pengguna)->delete();
            return to_route('admin.data-mahasiswa')->with('success', 'Data mahasiswa berhasil dihapus.');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Gagal menghapus data mahasiswa karena kesalahan pada server.']);
        }
    }

    public function export_excel(): void
    {
        $mahasiswa = Mahasiswa::select('id_pengguna', 'id_mahasiswa', 'nama_lengkap', 'nim', 'id_prodi', 'angkatan', 'semester', 'ipk', 'status')
            ->with('pengguna:id_pengguna,nama_pengguna,email')
            ->with('program_studi:id_prodi,nama')
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Pengguna');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Nama Lengkap');
        $sheet->setCellValue('E1', 'NIM');
        $sheet->setCellValue('F1', 'Program Studi');
        $sheet->setCellValue('G1', 'Angkatan');
        $sheet->setCellValue('H1', 'Semester');
        $sheet->setCellValue('I1', 'IPK');
        $sheet->setCellValue('J1', 'Status');
        $sheet->getStyle("A1:J1")->getFont()->setBold(true);

        $nomor = 1;
        $baris = 2;
        foreach ($mahasiswa as $value) {
            $sheet->setCellValue("A$baris", $nomor);
            $sheet->setCellValue("B$baris", $value->pengguna ? $value->pengguna->nama_pengguna : '-');
            $sheet->setCellValue("C$baris", $value->pengguna ? $value->pengguna->email : '-');
            $sheet->setCellValue("D$baris", $value->nama_lengkap);
            $sheet->setCellValue("E$baris", $value->nim);
            $sheet->setCellValue("F$baris", $value->program_studi ? $value->program_studi->nama : '-');
            $sheet->setCellValue("G$baris", $value->angkatan);
            $sheet->setCellValue("H$baris", $value->semester);
            $sheet->setCellValue("I$baris", $value->ipk);
            $sheet->setCellValue("J$baris", $value->status);
            $baris++;
            $nomor++;
        }

        foreach (range('A', 'J') as $id) $sheet->getColumnDimension($id)->setAutoSize(true);

        $sheet->setTitle("Data Mahasiswa");
        if (ob_get_length()) ob_end_clean();
        $filename = 'Data Mahasiswa ' . date("Y-m-d_H-i-s") . '.xlsx';

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