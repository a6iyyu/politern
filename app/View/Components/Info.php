<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Info extends Component
{
    public string $background, $color, $icon, $info, $title, $total;

    public function __construct(string $background, string $color, string $icon, string $info, string $title, string $total)
    {
        $this->background = $background;
        $this->color = $color;
        $this->icon = $icon;
        $this->info = $info;
        $this->title = $title;
        $this->total = $total;
    }

    public function render(): View|Closure|string
    {
        return view('shared.ui.info');
    }
}