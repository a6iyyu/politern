<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Log extends Component
{
    public array $info;

    public ?string $comment, $confirmation_date, $description, $id, $name, $nim, $photo, $profile_photo, $status, $title, $week;

    /**
     * Constructor yang jelas dan lebih aman
     */
    public function __construct(
        ?string $comment = null,
        ?string $confirmation_date = null,
        ?string $description = null,
        ?string $id = null,
        ?string $name = null,
        ?string $nim = null,
        ?string $photo = null,
        ?string $profile_photo = null,
        ?string $status = null,
        ?string $title = null,
        ?string $week = null,
    ) {
        $this->comment = $comment;
        $this->confirmation_date = $confirmation_date;
        $this->description = $description;
        $this->id = $id;
        $this->name = $name;
        $this->nim = $nim;
        $this->photo = $photo;
        $this->profile_photo = $profile_photo;
        $this->status = is_string($status) ? trim(strtoupper($status)) : null;
        $this->title = $title;
        $this->week = $week;

        $this->info = [
            'DISETUJUI'    => 'border border-green-500 text-green-500 hover:bg-green-500 hover:text-white',
            'DIKONFIRMASI' => 'border border-green-500 text-green-500 hover:bg-green-500 hover:text-white',
            'DITOLAK'      => 'border border-red-500 text-red-500 hover:bg-red-500 hover:text-white',
            'MENUNGGU'     => 'border border-yellow-500 text-yellow-500 hover:bg-yellow-500 hover:text-white',
        ];
    }

    public function status(): string
    {
        if (!is_string($this->status) || empty($this->status)) return 'border text-[var(--secondary-text)]';
        $status = trim(strtoupper($this->status));

        return $this->info[$status] ?? 'border text-[var(--secondary-text)]';
    }

    public function format(): string
    {
        if (!is_string($this->status) || empty($this->status)) return 'N/A';
        $status = trim(strtoupper($this->status));
        return match ($status) {
            'DIKONFIRMASI' => 'Dikonfirmasi',
            'DISETUJUI' => 'Disetujui',
            'DITOLAK' => 'Ditolak',
            'MENUNGGU' => 'Menunggu',
            default => ucfirst(strtolower($this->status))
        };
    }

    public function render(): View|Closure|string
    {
        return view('shared.ui.log');
    }
}