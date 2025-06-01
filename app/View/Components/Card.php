<?php

declare(strict_types=1);

namespace App\View\Components;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public Carbon $createdAt;
    public float $salary;
    public string $category, $industry, $location, $logo, $name, $status, $type;
    public ?string $url;

    public function __construct(string $category, Carbon $createdAt, string $industry, string $location, string $logo, string $name, float $salary, string $status, string $type, ?string $url = null)
    {
        $this->category = $category;
        $this->createdAt = $createdAt;
        $this->industry = $industry;
        $this->location = $location;
        $this->logo = $logo;
        $this->name = $name;
        $this->salary = $salary;
        $this->status = $status;
        $this->type = $type;
        $this->url = $url;
    }

    public function formattedDate(string $format = 'j F Y'): string
    {
        Carbon::setLocale('id');
        return $this->createdAt->translatedFormat($format);
    }

    public function formattedSalary(): string
    {
        return 'Rp' . number_format($this->salary, 0, ',', '.');
    }

    public function render(): View|Closure|string
    {
        return view('shared.ui.card');
    }
}