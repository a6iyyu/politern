<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LogActivity extends Component
{
    public string $judul, $tanggal, $deskripsi, $gambar, $status, $detailUrl, $editUrl, $hapusUrl;

    public function __construct(string $judul, string $tanggal, string $deskripsi, string $gambar, string $status, string $detailUrl = "#", string $editUrl = "#", string $hapusUrl = "#")
    {
        $this->judul = $judul;
        $this->tanggal = $tanggal;
        $this->deskripsi = $deskripsi;
        $this->gambar = $gambar;
        $this->status = $status;
        $this->detailUrl = $detailUrl;
        $this->editUrl = $editUrl;
        $this->hapusUrl = $hapusUrl;
    }

    public function render(): View|Closure|string
    {
        return view('shared.ui.log-activity-card');
    }
}