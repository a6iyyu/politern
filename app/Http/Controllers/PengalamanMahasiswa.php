<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Pengalaman;
use App\Models\PengalamanMahasiswa as PengalamanMahasiswaModel;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PengalamanMahasiswa extends Controller
{
    public function create(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'tambah_posisi_pengalaman'          => 'required|string|max:255',
                'tambah_nama_lembaga_pengalaman'    => 'required|string|max:255',
                'tambah_jenis_pengalaman'           => 'required|in:kerja,magang,organisasi,relawan',
                'tambah_deskripsi_pengalaman'       => 'required|string|max:255',
                'tambah_tanggal_mulai_pengalaman'   => 'required|date',
                'tambah_tanggal_selesai_pengalaman' => 'required|date',
                'tambah_bukti_pendukung_pengalaman' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            DB::beginTransaction();

            $file = $request->file('tambah_bukti_pendukung_pengalaman');
            $path = $file->storeAs('experience', time() . '.' . $file->getClientOriginalExtension(), 'public');

            $pengalaman = Pengalaman::create([
                'posisi'            => $request->input('tambah_posisi_pengalaman'),
                'nama_lembaga'      => $request->input('tambah_nama_lembaga_pengalaman'),
                'jenis_pengalaman'  => $request->input('tambah_jenis_pengalaman'),
                'deskripsi'         => $request->input('tambah_deskripsi_pengalaman'),
                'tanggal_mulai'     => $request->input('tambah_tanggal_mulai_pengalaman'),
                'tanggal_selesai'   => $request->input('tambah_tanggal_selesai_pengalaman'),
                'bukti_pendukung'   => $path,
            ]);

            $mahasiswa = Mahasiswa::where('id_pengguna', Auth::id())->firstOrFail();

            PengalamanMahasiswaModel::create([
                'id_mahasiswa'   => $mahasiswa->id_mahasiswa,
                'id_pengalaman'  => $pengalaman->id_pengalaman,
            ]);

            DB::commit();
            return to_route('mahasiswa.profil')->with('success', 'Pengalaman berhasil ditambahkan!');
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
            $pengalaman = Pengalaman::findOrFail($id);
            return response()->json([
                'id_pengalaman'    => $pengalaman->id_pengalaman,
                'posisi'           => $pengalaman->posisi,
                'nama_lembaga'     => $pengalaman->nama_lembaga,
                'jenis_pengalaman' => $pengalaman->jenis_pengalaman,
                'deskripsi'        => $pengalaman->deskripsi,
                'tanggal_mulai'    => $pengalaman->tanggal_mulai,
                'tanggal_selesai'  => $pengalaman->tanggal_selesai,
                'bukti_pendukung'  => asset("storage/{$pengalaman->bukti_pendukung}"),
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
            $request->validate([
                'edit_posisi_pengalaman'          => 'required|string|max:255',
                'edit_nama_lembaga_pengalaman'    => 'required|string|max:255',
                'edit_jenis_pengalaman'           => 'required|in:kerja,magang,organisasi,relawan',
                'edit_deskripsi_pengalaman'       => 'required|string|max:255',
                'edit_tanggal_mulai_pengalaman'   => 'required|date',
                'edit_tanggal_selesai_pengalaman' => 'required|date',
                'edit_bukti_pendukung_pengalaman' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            DB::beginTransaction();

            $pengalaman = Pengalaman::findOrFail($id);

            if ($request->hasFile('edit_bukti_pendukung_pengalaman')) {
                if ($pengalaman->bukti_pendukung && Storage::disk('public')->exists($pengalaman->bukti_pendukung)) Storage::disk('public')->delete($pengalaman->bukti_pendukung);
                $file = $request->file('edit_bukti_pendukung_pengalaman');
                $path = $file->storeAs('experience', time() . '.' . $file->getClientOriginalExtension(), 'public');
            } else {
                $path = $pengalaman->bukti_pendukung;
            }

            $pengalaman->update([
                'posisi'           => $request->input('edit_posisi_pengalaman'),
                'nama_lembaga'     => $request->input('edit_nama_lembaga_pengalaman'),
                'jenis_pengalaman' => $request->input('edit_jenis_pengalaman'),
                'deskripsi'        => $request->input('edit_deskripsi_pengalaman'),
                'tanggal_mulai'    => $request->input('edit_tanggal_mulai_pengalaman'),
                'tanggal_selesai'  => $request->input('edit_tanggal_selesai_pengalaman'),
                'bukti_pendukung'  => $path,
            ]);

            DB::commit();
            return to_route('mahasiswa.profil')->with('success', 'Pengalaman berhasil diperbarui.');
        } catch (Exception $exception) {
            DB::rollBack();
            report($exception);
            Log::error($exception->getMessage());
            return redirect()->back()->withErrors(['errors' => 'Gagal memperbarui data pengalaman Anda!']);
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $pengalaman = Pengalaman::findOrFail($id);
            PengalamanMahasiswaModel::where('id_pengalaman', $id)->delete();

            if ($pengalaman->bukti_pendukung && Storage::disk('public')->exists($pengalaman->bukti_pendukung)) Storage::disk('public')->delete($pengalaman->bukti_pendukung);
            $pengalaman->delete();

            DB::commit();
            return to_route('mahasiswa.profil')->with('success', 'Pengalaman berhasil dihapus!');
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            report($exception);
            Log::error($exception->getMessage());
            return redirect()->back()->withErrors(['errors' => 'Data pengalaman Anda tidak ditemukan!']);
        } catch (Exception $exception) {
            DB::rollBack();
            report($exception);
            Log::error($exception->getMessage());
            return redirect()->back()->withErrors(['errors' => 'Gagal menghapus data pengalaman Anda!']);
        }
    }
}