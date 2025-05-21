<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\LowonganMagang;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

/**
 * @method void emit(string $event, mixed ...$params)
 */
class FilterLowongan extends Component
{
    public Collection $hasil;
    public ?int $gajiMaksimal = null, $gajiMinimal = null;
    public string $lokasi = '', $namaPerusahaan = '', $tipe = '', $waktuPosting = '';

    public function mount(): void
    {
        $this->hasil = collect();
    }

    public function search(): void
    {
        $this->resetErrorBag();
        $query = LowonganMagang::query();

        if ($this->gajiMaksimal && $this->gajiMinimal && $this->gajiMinimal > $this->gajiMaksimal) {
            $this->addError('gajiMinimal', 'Gaji minimal tidak boleh lebih besar dari gaji maksimal.');
            return;
        }

        if ($this->gajiMaksimal) $query->where('gaji_max', '<=', $this->gajiMaksimal);
        if ($this->gajiMinimal) $query->where('gaji_min', '>=', $this->gajiMinimal);
        if ($this->lokasi) $query->where('lokasi', 'like', "%$this->lokasi%");
        if ($this->namaPerusahaan) $query->where('nama_perusahaan', 'like', "%$this->namaPerusahaan%");
        if ($this->tipe) $query->where('tipe', 'like', "%$this->tipe%");
        if ($this->waktuPosting) $query->where('created_at', '>=', Carbon::now()->subDays((int) $this->waktuPosting));
        $this->hasil = $query->get();
    }

    public function render(): View
    {
        return view('livewire.filter-lowongan');
    }
}