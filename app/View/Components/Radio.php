<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\View\View;

class Radio extends Component
{
    public array $options;
    public string $label, $name;
    public ?string $value;

    public function __construct(array $options, string $label, string $name, ?string $value)
    {
        $this->options = $options;
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
    }

    public function render(): View|Closure|string
    {
        return view('shared.form.radio');
    }
}