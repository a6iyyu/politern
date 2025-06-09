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
    public string $category, $industry, $location, $logo,  $salary, $status, $type;
    public ?string $score, $url;
    public array $expertise;

    public function __construct(string $category, Carbon $createdAt, string $industry, string $location, string $logo, array $expertise, string $salary, string $status, string $type, ?string $score = null, ?string $url = null)
    {
        $this->category = $category;
        $this->createdAt = $createdAt;
        $this->industry = $industry;
        $this->location = $location;
        $this->logo = $logo;
        $this->expertise = $expertise;
        $this->salary = $salary;
        $this->score = $score;
        $this->status = $status;
        $this->type = $type;
        $this->url = $url;
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