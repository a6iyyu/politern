<?php

namespace App\Http\Controllers;

use App\Models\LowonganMagang;
use App\Models\Mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class Dasbor extends Controller
{
    public function index(): RedirectResponse|View
    {
        $pengguna = Auth::user();
        if (!$pengguna) return redirect()->route('masuk');
        if (!in_array($pengguna->tipe, ['ADMIN', 'MAHASISWA'])) abort(403, 'Anda tidak memiliki akses.');

        $prodi = Mahasiswa::with('program_studi')->where('id_pengguna', $pengguna->id_pengguna)->first()->program_studi;
        $mahasiswa = Mahasiswa::where('id_pengguna', $pengguna->id_pengguna)->first();

        $ipk = $mahasiswa->ipk;
        $jenjang = $prodi->jenjang;
        $nama_pengguna = $pengguna->nama_pengguna;
        $nama_prodi = $prodi->nama;
        $semester = ucfirst(strtolower($mahasiswa->semester));
        $lowongan = LowonganMagang::with('perusahaan')
            ->orderBy('tanggal_posting', 'desc')
            ->get();

        Log::info($lowongan);
        return match ($pengguna->tipe) {
            'ADMIN'         => view('pages.admin.dasbor'),
            'MAHASISWA'     => view('pages.student.dasbor', compact('ipk', 'jenjang', 'nama_pengguna', 'nama_prodi', 'semester', 'lowongan')),
            default         => abort(403),
        };
    }
}