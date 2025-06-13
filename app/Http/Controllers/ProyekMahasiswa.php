<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Proyek;
use App\Models\ProyekMahasiswa as ProyekMahasiswaModel;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProyekMahasiswa extends Controller
{
    public function create(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'tambah_nama_proyek'            => 'required|string|max:255',
                'tambah_peran_proyek'           => 'required|string|max:100',
                'tambah_deskripsi_proyek'       => 'required|string|max:255',
                'tambah_tautan_proyek'          => 'required|url',
                'tambah_alat_proyek'            => 'required|array',
                'tambah_tanggal_mulai_proyek'   => 'required|date',
                'tambah_tanggal_selesai_proyek' => 'required|date',
            ]);

            $proyek = Proyek::create([
                'nama_proyek'           => $request->input('tambah_nama_proyek'),
                'peran'                 => $request->input('tambah_peran_proyek'),
                'deskripsi'             => $request->input('tambah_deskripsi_proyek'),
                'tautan'                => $request->input('tambah_tautan_proyek'),
                'alat'                  => $request->input('tambah_alat_proyek'),
                'tanggal_mulai'         => $request->input('tambah_tanggal_mulai_proyek'),
                'tanggal_selesai'       => $request->input('tambah_tanggal_selesai_proyek'),
            ]);

            $mahasiswa = Mahasiswa::where('id_pengguna', Auth::id())->firstOrFail();

            ProyekMahasiswaModel::create([
                'id_mahasiswa'   => $mahasiswa->id_mahasiswa,
                'id_proyek'      => $proyek->id_proyek,
            ]);

            DB::commit();
            return to_route('mahasiswa.profil')->with('success', 'Proyek berhasil ditambahkan!');
        } catch (Exception $exception) {
            DB::rollBack();
            report($exception);
            Log::error($exception->getMessage());
            return redirect()->back()->withInput()->withErrors(['errors' => 'Gagal menambahkan data pengalaman Anda!']);
        }
    }

    public function edit(string $id): JsonResponse
    {
        try {
            $proyek = Proyek::findOrFail($id);
            return response()->json([
                'id_proyek'         => $proyek->id_proyek,
                'nama_proyek'       => $proyek->nama_proyek,
                'peran'             => $proyek->peran,
                'deskripsi'         => $proyek->deskripsi,
                'tautan'            => $proyek->tautan,
                'alat'              => $proyek->alat,
                'tanggal_mulai'     => $proyek->tanggal_mulai,
                'tanggal_selesai'   => $proyek->tanggal_selesai,
            ]);
        } catch (ModelNotFoundException $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'edit_nama_proyek'              => 'required|string|max:255',
                'edit_peran_proyek'             => 'required|string|max:100',
                'edit_deskripsi_proyek'         => 'required|string|max:255',
                'edit_tautan_proyek'            => 'required|url',
                'edit_alat_proyek'              => 'required|array',
                'edit_tanggal_mulai_proyek'     => 'required|date',
                'edit_tanggal_selesai_proyek'   => 'required|date',
            ]);

            $proyek = Proyek::findOrFail($id);

            $proyek->update([
                'nama_proyek'           => $request->input('edit_nama_proyek'),
                'peran'                 => $request->input('edit_peran_proyek'),
                'deskripsi'             => $request->input('edit_deskripsi_proyek'),
                'tautan'                => $request->input('edit_tautan_proyek'),
                'alat'                  => $request->input('edit_alat_proyek'),
                'tanggal_mulai'         => $request->input('edit_tanggal_mulai_proyek'),
                'tanggal_selesai'       => $request->input('edit_tanggal_selesai_proyek'),
            ]);

            DB::commit();
            return to_route('mahasiswa.profil')->with('success', 'Proyek berhasil diperbarui.');
        } catch (Exception $exception) {
            DB::rollBack();
            report($exception);
            Log::error($exception->getMessage());
            return redirect()->back()->withErrors(['errors' => 'Gagal memperbarui data proyek Anda!']);
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $proyek = Proyek::findOrFail($id);
            ProyekMahasiswaModel::where('id_proyek', $id)->delete();
            $proyek->delete();
            DB::commit();
            return to_route('mahasiswa.profil')->with('success', 'Proyek berhasil dihapus!');
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            report($exception);
            Log::error($exception->getMessage());
            return redirect()->back()->withInput()->withErrors(['errors' => 'Data proyek Anda tidak ditemukan!']);
        } catch (Exception $exception) {
            DB::rollBack();
            report($exception);
            Log::error($exception->getMessage());
            return redirect()->back()->withInput()->withErrors(['errors' => 'Gagal menghapus data proyek Anda!']);
        }
    }
}