<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public array $choices;

    public function __construct(array $choices)
    {
        $this->choices = $choices;
    }

    public function render(): View|Closure|string
    {
        return view('components.select');
    }
}