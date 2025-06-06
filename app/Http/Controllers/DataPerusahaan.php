<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use App\Models\Lokasi;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class DataPerusahaan extends Controller
{
    public function index(): View
    {
        $pengguna = Auth::user()->tipe;
        if ($pengguna === "ADMIN") {
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
                    'TIDAK AKTIF'       => 'bg-red-200 text-red-800',
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
            if ($request->hasFile('logo')) $logo = $request->file('logo')->store('logos', 'public');

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

    public function edit($id)
    {
        $perusahaan = Perusahaan::with('lokasi')->findOrFail($id);

        return response()->json([
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
            'lokasi' => Lokasi::pluck('nama_lokasi', 'id_lokasi')->toArray(),
        ]);
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
            ]);

            $perusahaan = Perusahaan::findOrFail($id);
            $perusahaan->update([
                'id_lokasi'     => $request->id_lokasi,
                'nama'          => $request->nama,
                'nib'           => $request->nib,
                'nomor_telepon' => $request->nomor_telepon,
                'email'         => $request->email,
                'website'       => $request->website,
                'logo'          => $request->logo,
                'status'        => $request->status
            ]);
            return to_route('admin.data-perusahaan')->with('success', 'Berhasil memperbarui data perusahaan.');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors('Gagal memperbarui data perusahaan karena kesalahan pada server.');
        }
    }
}