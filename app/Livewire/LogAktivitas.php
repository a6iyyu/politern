<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class LogAktivitas extends Component
{
    public array|Collection|string $mahasiswa, $perusahaan, $status;

    public function search()
    {
        $this->resetErrorBag();
        $query = Mahasiswa::query();

        if ($this->mahasiswa) $query->where('name', 'like', "%$this->mahasiswa%");
        if ($this->perusahaan) $query->where('perusahaan', 'like', "%$this->perusahaan%");
        if ($this->status) $query->where('status', 'like', "%$this->status%");
        $this->mahasiswa = $query->get();
    }

    public function render(): View
    {
        return view('livewire.log-aktivitas');
    }
}