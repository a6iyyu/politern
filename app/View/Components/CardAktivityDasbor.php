<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class CardAktivityDasbor extends Component
{
    public function __construct(
        public string $minggu,
        public string $judul,
        public string $deskripsi,
        public string $nama,
        public string $nim,
    ) {}

    public function render(): View
    {
        return view('shared.ui.card-aktivitas-dasbor');
    }
}

