<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public string $industry, $location, $name, $salary;

    public function __construct(string $industry, string $location, string $name, string $salary)
    {
        $this->industry = $industry;
        $this->location = $location;
        $this->name = $name;
        $this->salary = $salary;
    }

    public function render(): View|Closure|string
    {
        return view('shared.ui.card');
    }
}