<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Dosen;
use App\Models\DosenPembimbing;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class DataDosen extends Controller
{
    public function index(Request $request): View
    {
        $pengguna = Auth::user()->tipe;
        if ($pengguna === "ADMIN") {
            $baris = 1;
            $total_dosen = Dosen::count();
            $total_dosen_pembimbing = DosenPembimbing::count();

            $query = Dosen::query();

            if ($request->has('nama') && !empty($request->nama)) {
                $query->where('nama', 'like', "%{$request->nama}%");
            }

            if ($request->has('nip') && !empty($request->nip)) {
                $query->where('nip', 'like', "%{$request->nip}%");
            }

            /** @var LengthAwarePaginator $paginasi */
            $paginasi = $query->paginate(request('per_page', 10))->withQueryString();
            $data = collect($paginasi->items())->map(function(Dosen $dosen) use (&$baris) {
                return [
                    $baris++,
                    '<div class="flex items-center gap-2">
                        <img src="' . asset('shared/profil.png') . '" alt="avatar" class="h-8 w-8 rounded-full" /> ' . e($dosen->nama) . '
                    </div>',
                    $dosen->nip,
                    $dosen->nomor_telepon,
                    $dosen->pembimbing ? $dosen->pembimbing->jumlah_bimbingan : 0,
                    view('components.admin.data-dosen.aksi', compact('dosen'))->render(),
                ];
            })->toArray();
            return view('pages.admin.data-dosen', compact('data', 'paginasi', 'total_dosen', 'total_dosen_pembimbing'));
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
                'nama'              => 'required|string|max:255',
                'nip'               => 'required|numeric|min:12',
                'nomor_telepon'     => 'required|numeric|digits_between:10,15',
            ]);

            $pengguna = Pengguna::create([
                'nama_pengguna' => $request->nama_pengguna,
                'email'         => $request->email,
                'kata_sandi'    => Crypt::encrypt($request->kata_sandi),
                'tipe'          => 'DOSEN',
            ]);

            Dosen::create([
                'nama'          => $request->nama,
                'nip'           => $request->nip,
                'nomor_telepon' => $request->nomor_telepon,
                'id_pengguna'   => $pengguna->id_pengguna,
            ]);

            return to_route('admin.data-dosen')->with('success', 'Data dosen berhasil ditambahkan');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors($exception->getMessage());
        }
    }

    public function show($id): array
    {
        $dosen = Dosen::with('pembimbing')->findOrFail($id);
        $pengguna = $dosen->pengguna;
        
        $dosen->load('pembimbing');
        
        return [
            'dosen' => [
                'nama' => $dosen->nama,
                'nip' => $dosen->nip,
                'nomor_telepon' => $dosen->nomor_telepon,
                'jumlah_bimbingan' => $dosen->pembimbing ? $dosen->pembimbing->jumlah_bimbingan : 0,
            ],
            'pengguna' => [
                'nama_pengguna' => $pengguna->nama_pengguna,
                'email' => $pengguna->email,
            ],
            'jumlah_bimbingan' => $dosen->pembimbing ? $dosen->pembimbing->jumlah_bimbingan : 0
        ];
    }

    public function edit($id): JsonResponse
    {
        $dosen = Dosen::findOrFail($id);

        return response()->json([
            'dosen' => [
                'nama'          => $dosen->nama,
                'nip'           => $dosen->nip,
                'nomor_telepon' => $dosen->nomor_telepon,
            ],

        ]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $dosen = Dosen::findOrFail($id);

            $dosen->nama = $request->nama;
            $dosen->nip = $request->nip;
            $dosen->nomor_telepon = $request->nomor_telepon;
            $dosen->save();
            return to_route('admin.data-dosen')->with('success', 'Data dosen berhasil diubah');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors($exception->getMessage());
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            $dosen = Dosen::findOrFail($id);
            $dosen->delete();
            Pengguna::findOrFail($dosen->id_pengguna)->delete();
            return to_route('admin.data-dosen')->with('success', 'Data dosen berhasil dihapus.');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Gagal menghapus data dosen karena kesalahan pada server.']);
        }
    }

    public function export_excel(): void
    {
        $dosen = Dosen::select('id_dosen', 'nama', 'nip', 'nomor_telepon', 'id_pengguna')->with('pengguna:id_pengguna,nama_pengguna,email,kata_sandi')->get();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Pengguna');
        $sheet->setCellValue('C1', 'Kata Sandi');
        $sheet->setCellValue('D1', 'Email');
        $sheet->setCellValue('E1', 'Nama Dosen');
        $sheet->setCellValue('F1', 'NIP');
        $sheet->setCellValue('G1', 'Nomor Telepon');
        $sheet->getStyle("A1:G1")->getFont()->setBold(true);

        $nomor = 1;
        $baris = 2;
        foreach ($dosen as $value) {
            $sheet->setCellValue("A$baris", $nomor);
            $sheet->setCellValue("B$baris", $value->pengguna ? $value->pengguna->nama_pengguna : '-');
            $sheet->setCellValueExplicit("C$baris", $value->pengguna ? Crypt::decrypt($value->pengguna->kata_sandi) : '-', DataType::TYPE_STRING);
            $sheet->setCellValue("D$baris", $value->pengguna ? $value->pengguna->email : '-');
            $sheet->setCellValue("E$baris", $value->nama);
            $sheet->setCellValueExplicit("F$baris", $value->nip, DataType::TYPE_STRING);
            $sheet->setCellValue("G$baris", $value->nomor_telepon);
            $baris++;
            $nomor++;
        }

        foreach (range('A', 'G') as $id) $sheet->getColumnDimension($id)->setAutoSize(true);

        $sheet->setTitle("Data Dosen");
        if (ob_get_length()) ob_end_clean();
        $filename = 'Data Dosen ' . date("Y-m-d_H-i-s") . '.xlsx';

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