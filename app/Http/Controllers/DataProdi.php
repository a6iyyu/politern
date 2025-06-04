<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class DataProdi extends Controller
{
    public function index(): View
    {
        $pengguna = Auth::user()->tipe;
        if ($pengguna === "ADMIN") {
            $total_prodi = ProgramStudi::count();
            $jenjang = ProgramStudi::distinct()->pluck('jenjang')->toArray();

            $paginasi = ProgramStudi::paginate(request('per_page', 10));
            $data = collect($paginasi->items())->map(function (ProgramStudi $prodi): array {
                $status = match ($prodi->status) {
                    'AKTIF' => 'bg-green-200 text-green-800',
                    'NONAKTIF'  => 'bg-red-200 text-yellow-800',
                };
                return [
                    $prodi->id_prodi,
                    $prodi->nama,
                    $prodi->jenjang,
                    $prodi->jurusan,
                    Mahasiswa::where('id_prodi', $prodi->id_prodi)->count(),
                    '<div class="text-xs font-medium px-5 py-2 rounded-2xl ' . $status . '">' . ($prodi->status ?? "N/A") . '</div>',
                    view('components.admin.data-prodi.aksi', compact('prodi'))->render(),
                ];
            })->toArray();
            return view('pages.admin.data-prodi', compact('data', 'paginasi', 'total_prodi', 'jenjang'));
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }

    public function create(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'kode_prodi'      => 'required|string|max:10|unique:program_studi,kode',
                'nama'            => 'required|string|max:100|unique:program_studi,nama',
                'jenjang_prodi'   => 'required|string|in:D2,D3,D4,S2',
                'jurusan_prodi'   => 'required|string|max:255',
            ]);

            $jenjang = match ($request->jenjang_prodi) {
                'D2'    => 'D2',
                'D3'    => 'D3',
                'D4'    => 'D4',
                'S2'    => 'S2',
                default => 'D4',
            };

            ProgramStudi::create([
                'kode'    => $request->kode_prodi,
                'nama'    => $request->nama,
                'jenjang' => $jenjang,
                'jurusan' => $request->jurusan_prodi,
                'status'  => 'AKTIF'
            ]);

            return to_route('admin.data-prodi')->with('success', 'Data program studi berhasil ditambahkan.');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Gagal menambahkan data program studi karena kesalahan pada server.']);
        }
    }

    public function edit($id): JsonResponse
    {
        $prodi = ProgramStudi::findOrFail($id);

        return response()->json([
            'prodi' => [
                'nama'               => $prodi->nama,
                'kode_prodi'         => $prodi->kode,
                'jenjang_prodi_edit' => $prodi->jenjang,
                'jurusan_prodi'      => $prodi->jurusan,
                'status_prodi_edit'  => $prodi->status,
            ],
        ]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $prodi = ProgramStudi::findOrFail($id);
            $prodi->nama = $request->nama;
            $prodi->kode = $request->kode_prodi;
            $prodi->jenjang = $request->jenjang_prodi;
            $prodi->jurusan = $request->jurusan_prodi;
            $prodi->status = $request->status_prodi;
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
            'prodi' => [
                'kode_prodi' => $prodi->kode,
                'nama' => $prodi->nama,
                'jenjang_prodi' => $prodi->jenjang,
                'jurusan_prodi' => $prodi->jurusan,
                'status_prodi' => $prodi->status,
            ],
            'mahasiswa' => Mahasiswa::where('id_prodi', $id)->get(),
        ];
    }
}