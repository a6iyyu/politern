<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\PengajuanMagang;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LogAktivitas extends Controller
{
    public function index(Request $request): View
    {
        $dospem = $this->dospem();
        $periode = $this->periode();
        $perusahaan = $this->perusahaan();
        $posisi = $this->posisi();
        $status = $this->status();
        return view('pages.student.log-aktivitas', compact('dospem', 'periode', 'perusahaan', 'posisi', 'status'));
    }

    public function create() {}

    public function edit() {}

    public function update() {}

    public function destroy() {}

    private function dospem()
    {
        return 0;
    }

    private function periode()
    {
        return 0;
    }

    private function perusahaan(): string
    {
        $mahasiswa = Mahasiswa::where('id_pengguna', Auth::user()->id_pengguna)->first();
        if (!$mahasiswa) return '';

        $pengajuan = PengajuanMagang::with('lowongan_magang.perusahaan')
            ->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->first();

        return $pengajuan?->lowongan_magang?->perusahaan?->nama_perusahaan ?? "N/A";
    }

    private function posisi()
    {
        return 0;
    }

    private function status()
    {
        return 0;
    }
}