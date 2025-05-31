<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public array $options;
    public bool $required;
    public string $label, $name;
    public ?string $selected;

    public function __construct(array $options = [], bool $required = false, string $label, string $name, string $selected = null) {
        $this->name = $name;
        $this->label = $label;
        $this->required = $required;
        $this->options = $options;
        $this->selected = $selected;
    }

    public function render(): View|Closure|string
    {
        // dd($this->options);
        return view('shared.form.select');
    }
}