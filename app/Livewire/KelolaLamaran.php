<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class KelolaLamaran extends Component
{
    public string $name, $period, $status;

    public function render(): View
    {
        return view('livewire.kelola-lamaran');
    }
}