<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public string $category, $industry, $location, $name, $status, $type;

    public function __construct(string $category, string $industry, string $location, string $name, string $status, string $type)
    {
        $this->category = $category;
        $this->industry = $industry;
        $this->location = $location;
        $this->name = $name;
        $this->status = $status;
        $this->type = $type;
    }

    public function render(): View|Closure|string
    {
        return view('shared.ui.card');
    }
}