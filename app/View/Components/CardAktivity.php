<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardAktivity extends Component
{
    public $minggu;
    public $judul;
    public $status;
    public $deskripsi;
    public $foto;
    public $komentar;
    public $id_log;
    public $nama;
    public $nim;
    public $foto_profil;
    public $tanggal_konfirmasi;

    public $info;

    public function __construct(
        $minggu = null,
        $judul = null,
        $status = null,
        $deskripsi = null,
        $foto = null,
        $komentar = null,
        $idLog = null,
        $nama = null,
        $nim = null,
        $fotoProfil = null,
        $tanggalKonfirmasi = null
    ) {
        $this->minggu = $minggu;
        $this->judul = $judul;
        $this->status = $status;
        $this->deskripsi = $deskripsi;
        $this->foto = $foto;
        $this->komentar = $komentar;
        $this->id_log = $idLog;
        $this->nama = $nama;
        $this->nim = $nim;
        $this->foto_profil = $fotoProfil;
        $this->tanggal_konfirmasi = $tanggalKonfirmasi;

        $this->info = [
            'DISETUJUI' => 'border border-green-500 text-green-500 hover:bg-green-500 hover:text-white',
            'DIKONFIRMASI' => 'border border-green-500 text-green-500 hover:bg-green-500 hover:text-white',
            'DITOLAK'   => 'border border-red-500 text-red-500 hover:bg-red-500 hover:text-white',
            'MENUNGGU'  => 'border border-yellow-500 text-yellow-500 hover:bg-yellow-500 hover:text-white',
        ];
    }

    public function render(): View|Closure|string
    {
        return view('shared.ui.card-aktivitas');
    }
}