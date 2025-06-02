<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class DataPerusahaan extends Controller
{
    public function index(): View
    {
        $perusahaan = Perusahaan::with('lokasi')->get();
        return view('pages.admin.data-perusahaan', compact('perusahaan'));
    }

    public function create(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'nama'          => 'required|string|max:50',
                'nib'           => 'required|string|max:13|unique:nib',
                'nomor_telepon' => 'required|string|max:15|unique:nomor_telepon',
                'email'         => 'required|email|unique:email',
                'website'       => 'required|url',
                'logo'          => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status'        => 'required|in:AKTIF,TIDAK AKTIF',
            ]);

            Perusahaan::create([
                'id_lokasi'     => $request->id_lokasi,
                'nama'          => $request->nama,
                'nib'           => $request->nib,
                'nomor_telepon' => $request->nomor_telepon,
                'email'         => $request->email,
                'website'       => $request->website,
                'logo'          => $request->logo,
                'status'        => $request->status
            ]);

            return to_route('admin.data-perusahaan')->with('success', 'Berhasil menambahkan data perusahaan.');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors('Terjadi kesalahan pada server.');
        }
    }

    public function destroy(string $id)
    {
        try {
            $dosen = Perusahaan::findOrFail($id);
            $dosen->delete();
            return to_route('admin.data-perusahaan')->with('success', 'Data Dosen berhasil dihapus.');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors('Terjadi kesalahan pada server.');
        }
    }

    public function edit(): View
    {
        try {
            $perusahaan = Perusahaan::with('lokasi')->get();
            return view('components.admin.data-perusahaan.edit', compact('perusahaan'));
        } catch (ModelNotFoundException $exception) {
            report($exception);
            abort(404, 'Data perusahaan yang Anda cari tidak ditemukan.');
        } catch (Exception $exception) {
            report($exception);
            abort(500, 'Terjadi kesalahan pada sistem.');
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
            abort(500, "Terjadi kesalahan pada server.");
        }
    }

    public function update()
    {
        try {
            
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors('Terjadi kesalahan pada server.');
        }
    }
}