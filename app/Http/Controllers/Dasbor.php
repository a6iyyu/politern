<?php

namespace App\Http\Controllers;

use App\Models\LowonganMagang;
use App\Models\Mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Dasbor extends Controller
{
    public function index(): callable|RedirectResponse|View
    {
        /**
         * @var mixed $pengguna
         *
         * Inisialisasi variabel $pengguna, bertujuan untuk menyimpan data
         * pengguna yang sedang masuk sistem dengan menggunakan fungsi
         * Auth::user().
         */
        $pengguna = Auth::user();
        if (!$pengguna) return redirect()->route('masuk');
        if (!in_array($pengguna->tipe, ['ADMIN', 'MAHASISWA'])) abort(403, 'Anda tidak memiliki akses.');

        /**
         * @return callable|RedirectResponse|View
         *
         * Fungsi ini bertujuan untuk menampilkan halaman dasbor berdasarkan
         * tipe pengguna yang sedang masuk ke dalam sistem.
         */
        return match ($pengguna->tipe) {
            'ADMIN' => (function () use ($pengguna): View {
                $jabatan = $pengguna->jabatan;
                $nama = $pengguna->admin->nama;
                $nip = $pengguna->admin->nip;
                return view('pages.admin.dasbor', compact('jabatan', 'nama', 'nip'));
            })(),
            'MAHASISWA' => (function () use ($pengguna): View {
                $mahasiswa = Mahasiswa::with('program_studi')->where('id_pengguna', $pengguna->id_pengguna)->first();
                if (!$mahasiswa || !$mahasiswa->program_studi) abort(404, 'Data mahasiswa tidak ditemukan.');
                $prodi = $mahasiswa->program_studi;
                $ipk = $mahasiswa->ipk;
                $jenjang = $prodi->jenjang;
                $lowongan = LowonganMagang::with('perusahaan')->orderBy('tanggal_posting', 'desc')->get();
                $nama_pengguna = $pengguna->nama_pengguna;
                $nama_prodi = $prodi->nama;
                $semester = ucfirst(strtolower($mahasiswa->semester));
                return view('pages.student.dasbor', compact('ipk', 'jenjang', 'lowongan', 'nama_pengguna', 'nama_prodi', 'semester'));
            })(),
            default => abort(403),
        };
    }
}