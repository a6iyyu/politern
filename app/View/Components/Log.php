<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Log extends Component
{
    public array $info;
    public ?string $comment, $description, $id, $name, $nim, $photo, $profile_photo, $status, $title, $week;
    public ?string $statusStr;
    public $confirmation_date;
    public string $context; 

    public function __construct(
        ?string $comment = null,
        $confirmation_date = null,
        ?string $description = null,
        ?string $id = null,
        ?string $name = null,
        ?string $nim = null,
        ?string $photo = null,
        ?string $profile_photo = null,
        ?string $status = null,
        ?string $title = null,
        ?string $week = null,
        ?string $statusStr = null,
        string $context = 'mahasiswa' 
    ) {
        $this->comment = $comment;
        $this->confirmation_date = $confirmation_date ;
        $this->description = $description;
        $this->id = $id;
        $this->name = $name;
        $this->nim = $nim;
        $this->photo = $photo;
        $this->profile_photo = $profile_photo;
        $this->status = is_string($status) ? trim(strtoupper($status)) : null;
        $this->title = $title;
        $this->week = $week;
        $this->statusStr = $status;
        $this->context = $context; 

        $this->info = [
            'DISETUJUI'    => 'bg-green-200 text-green-800',
            'DITOLAK'      => 'bg-red-200 text-red-800',
            'MENUNGGU'     => 'bg-yellow-200 text-yellow-800',
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
            'DISETUJUI'     => 'Disetujui',
            'DITOLAK'       => 'Ditolak',
            'MENUNGGU'      => 'Menunggu',
            default         => ucfirst(strtolower($this->status))
        };
    }

    public function render(): View|Closure|string
    {
        return view('shared.ui.log');
    }
}