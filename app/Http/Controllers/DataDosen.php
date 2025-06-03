<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Dosen;
use App\Models\DosenPembimbing;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

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

    public function create(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'nama_pengguna'     => 'required|string|max:100|unique:pengguna,nama_pengguna',
                'kata_sandi'        => 'required|string|min:6',
                'email'             => 'required|email|unique:pengguna,email',
                'nama'              => 'required|string|max:255',
                'nip'               => 'required|numeric|digits:18',
                'nomor_telepon'     => 'required|numeric|digits_between:10,15',
            ]);

            $pengguna = Pengguna::create([
                'nama_pengguna' => $request->nama_pengguna,
                'email'         => $request->email,
                'kata_sandi'    => bcrypt($request->kata_sandi),
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
        $dosen = Dosen::findOrFail($id);
        $pengguna = $dosen->pengguna;
        return compact('dosen', 'pengguna');
    }

    public function edit($id): JsonResponse
    {
        $dosen = Dosen::with('pengguna')->findOrFail($id);

        return response()->json([
            'dosen' => ['nama' => $dosen->nama, 'nip' => $dosen->nip, 'nomor_telepon' => $dosen->nomor_telepon],
            'pengguna' => ['nama_pengguna' => $dosen->pengguna->nama_pengguna, 'email' => $dosen->pengguna->email, 'kata_sandi' => Crypt::decrypt($dosen->pengguna->kata_sandi)],
        ]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $dosen = Dosen::with('pengguna')->findOrFail($id);

            $pengguna = $dosen->pengguna;
            $pengguna->nama_pengguna = $request->nama_pengguna;
            $pengguna->email = $request->email;
            if ($request->filled('kata_sandi')) $pengguna->kata_sandi = bcrypt($request->kata_sandi);
            $pengguna->save();

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
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();
        return to_route('admin.data-dosen')->with('success', 'Data dosen berhasil dihapus.');
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

        foreach (range('A', 'D') as $id) $sheet->getColumnDimension($id)->setAutoSize(true);

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