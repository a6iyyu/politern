<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LogActivity extends Component
{
    public string $judul, $tanggal, $deskripsi, $gambar, $status;

    public function __construct(string $judul, string $tanggal, string $deskripsi, string $gambar, string $status)
    {
        $this->judul = $judul;
        $this->tanggal = $tanggal;
        $this->deskripsi = $deskripsi;
        $this->gambar = $gambar;
        $this->status = $status;
    }

    public function render(): View|Closure|string
    {
        return view('shared.ui.log-activity-card');
    }
}