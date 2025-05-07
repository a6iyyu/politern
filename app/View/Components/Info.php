<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Info extends Component
{
    public int $total;
    public string $background, $color, $icon, $info, $title;

    public function __construct(int $total, string $background, string $color, string $icon, string $info, string $title)
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