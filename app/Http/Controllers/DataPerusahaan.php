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
            $paginasi = Perusahaan::paginate(request('per_page', 10));
            $data = collect($paginasi->items())->map(fn(Perusahaan $perusahaan): array => [
                $perusahaan->id_perusahaan_mitra,
                '<div class="flex items-center gap-2">
                    <img src="' . asset('shared/profil.png') . '" alt="avatar" class="h-8 w-8 rounded-full" /> ' . e($perusahaan->nama) . '
                </div>',
                $perusahaan->nib,
                $perusahaan->email,
                $perusahaan->lokasi->nama_lokasi,
                $perusahaan->status == 'AKTIF' ? '<span class= "rounded px-4 py-2 text-white text-xs font-medium bg-[var(--green-tertiary)]">AKTIF</span>' : '<span class="rounded px-4 py-2 text-white text-xs font-medium bg-[var(--red-tertiary)]">' . e($perusahaan->status) . '</span>',
                view('components.admin.data-perusahaan.aksi', compact('perusahaan'))->render(),
            ])->toArray();
            $perusahaan = Perusahaan::with('lokasi')->get();
            $lokasi = Lokasi::pluck('nama_lokasi', 'id_lokasi')->toArray();
            return view('pages.admin.data-perusahaan', compact('perusahaan', 'data', 'total_perusahaan', 'paginasi', 'lokasi'));
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

    public function edit($id): View
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
            abort(500, "Gagal dalam mengambil informasi perusahaan karena kesalahan pada server.");
        }
    }

    public function update(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'nama'          => 'required|string|max:50',
                'nib'           => 'required|string|max:13',
                'nomor_telepon' => 'required|string|max:15',
                'email'         => 'required|email',
                'website'       => 'required|url',
                'logo'          => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status'        => 'required|in:AKTIF,TIDAK AKTIF',
            ]);

            $perusahaan = Perusahaan::findOrFail($request->id_perusahaan);
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