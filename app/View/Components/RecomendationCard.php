<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Carbon\Carbon;

class RecomendationCard extends Component
{
    /**
     * Create a new component instance.
     */
    //public array $expertise;
    public Carbon $createdAt;
    public string $category, $industry, $location, $logo,  $salary, $status, $type;
    public ?string $score, $url, $skill, $detail;

    public function __construct(string $category, Carbon $createdAt, string $industry, string $location, string $logo, string $salary, string $status, string $type, ?string $score = null, ?string $url = null, ?string $skill = null, ?string $detail = null)
    {
        $this->category = $category;
        $this->createdAt = $createdAt;
        $this->industry = $industry;
        $this->location = $location;
        $this->logo = $logo;
        $this->salary = $salary;
        $this->score = $score;
        $this->status = $status;
        $this->type = $type;
        $this->url = $url;
        $this->skill = $skill;
        $this->detail = $detail;
    }

    public function formattedDate(string $format = 'j F Y'): string
    {
        Carbon::setLocale('id');
        return $this->createdAt->translatedFormat($format);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('shared.ui.recomendation-card');
    }
}
