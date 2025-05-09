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
    public string $category, $industry, $location, $maxSalary, $minSalary, $name, $status, $type;

    public function __construct(string $category, Carbon $createdAt, string $industry, string $location, string $maxSalary, string $minSalary, string $name, string $status, string $type)
    {
        $this->category = $category;
        $this->createdAt = $createdAt;
        $this->industry = $industry;
        $this->location = $location;
        $this->maxSalary = $maxSalary;
        $this->minSalary = $minSalary;
        $this->name = $name;
        $this->status = $status;
        $this->type = $type;
    }

    public function formattedDate(string $format = 'j F Y'): string
    {
        Carbon::setLocale('id');
        return $this->createdAt->translatedFormat($format);
    }

    public function render(): View|Closure|string
    {
        return view('shared.ui.card');
    }
}