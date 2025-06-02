<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public array $options;
    public bool $required;
    public string $label, $name ;
    public ?string $selected, $placeholder;

    public function __construct(string $label, string $name, ?string $placeholder = null, array $options = [], bool $required = false, ?string $selected = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->options = $options;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->selected = $selected;
    }

    public function render(): View|Closure|string
    {
        return view('shared.form.select');
    }
}