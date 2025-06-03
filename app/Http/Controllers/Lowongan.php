<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\LowonganMagang;
use App\Models\Perusahaan;
use App\Models\Bidang;
use App\Models\JenisLokasi;
use App\Models\Keahlian;
use App\Models\PeriodeMagang;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class Lowongan extends Controller
{
    public function index(): View
    {
        $pengguna = Auth::user()->tipe;
        if ($pengguna === "ADMIN") {
            $total_lowongan = LowonganMagang::count();

            $paginasi = LowonganMagang::paginate(request('per_page', 10));
            $data = collect($paginasi->items())->map(fn(LowonganMagang $lowongan): array => [
                $lowongan->bidang->nama_bidang ?? '-',
                $lowongan->perusahaan->nama ?? '-',
                $lowongan->kuota ?? '-',
                $lowongan->periode_magang->nama_periode ?? '-',
                $lowongan->status ?? '-',
                view('components.admin.lowongan-magang.aksi', compact('lowongan'))->render(),
            ])->toArray();
            return view('pages.admin.lowongan-magang', compact('data', 'paginasi', 'total_lowongan'));
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }

    public function create(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'nama'                          => 'required|string|max:100|unique:perusahaan_mitra,nama',
                'nama_bidang'                   => 'required|string|max:100|unique:bidang,nama_bidang',
                'nama_keahlian'                 => 'required|email|unique:keahlian,nama_keahlian',
                'durasi'                        => 'required|string|max:50|unique:periode_magang,durasi',
                'nama_jenis_lokasi'             => 'required|string|max:100|unique:jenis_lokasi,nama_jenis_lokasi',
                'dekripsi'                      => 'required|string|max:255',
                'gaji'                          => 'required|numeric|min:0',
                'nilai_minimal'                 => 'required|numeric|min:0',
                'kuota'                         => 'required|integer|min:10',
                'status'                        => 'required|in:AKTIF,TIDAK AKTIF',
                'tanggal_mulai_pendaftaran'     => 'required|date',
                'tanggal_selesai_pendaftaran'   => 'required|date|after_or_equal:tanggal_mulai_pendaftaran',
            ]);

            $perusahaan = Perusahaan::create([
                'id_lokasi'     => $request->id_lokasi,
                'nama'          => $request->nama,
                'nib'           => $request->nib,
                'nomor_telepon' => $request->nomor_telepon,
                'email'         => $request->email,
                'website'       => $request->website,
                'logo'          => $request->logo,
            ]);

            $keahlian = Keahlian::create([
                'nama_keahlian' => $request->nama_keahlian,
            ]);

            $bidang = Bidang::create([
                'nama_bidang' => $request->nama_bidang,
            ]);

            $jenis_lokasi = JenisLokasi::create([
                'nama_jenis_lokasi' => $request->nama_jenis_lokasi,
            ]);

            $periode = PeriodeMagang::create([
                'nama_periode'      => $request->nama_periode,
                'durasi'            => $request->durasi,
                'tanggal_mulai'     => $request->tanggal_mulai_pendaftaran,
                'tanggal_selesai'   => $request->tanggal_selesai_pendaftaran,
                'status'            => 'AKTIF',
            ]);

            LowonganMagang::create([
                'id_perusahaan_mitra'           => $perusahaan->id_perusahaan_mitra,
                'id_keahlian'                   => $keahlian->id_keahlian,
                'id_bidang'                     => $bidang->id_bidang,
                'id_jenis_lokasi'               => $jenis_lokasi->id_jenis_lokasi,
                'id_periode'                    => $periode->id_periode,
                'deskripsi'                     => $request->dekripsi,
                'kuota'                         => $request->kuota,
                'gaji'                          => $request->gaji,
                'nilai_minimal'                 => $request->nilai_minimal,
                'ipk'                           => $request->ipk,
                'tanggal_mulai_pendaftaran'     => $request->tanggal_mulai_pendaftaran,
                'tanggal_selesai_pendaftaran'   => $request->tanggal_selesai_pendaftaran,
                'status' => $request->status,
            ]);

            return to_route('admin.data-dosen')->with('success', 'Data dosen berhasil ditambahkan');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors($exception->getMessage());
        }
    }

    public function detail(string $id): array
    {
        $lowongan = LowonganMagang::with(['bidang', 'perusahaan_mitra.lokasi', 'jenis_lokasi', 'periode_magang', 'keahlian'])->findOrFail($id);
        return compact('lowongan');
    }

    public function destroy(string $id): RedirectResponse
    {
        $lowongan = LowonganMagang::findOrFail($id);
        $lowongan->delete();
        return to_route('admin.lowongan-magang')->with('success', 'Lowongan magang berhasil dihapus');
    }
}