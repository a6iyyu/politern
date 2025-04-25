<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Input extends Component
{
    public ?bool $required;
    public string $icon, $label, $name;
    public ?string $info, $placeholder, $type, $value;

    public function __construct(string $icon = '', ?string $info = null, string $label, string $name, ?string $placeholder = null, ?bool $required = false, ?string $type = 'text', ?string $value = null) {
        $this->icon = $icon;
        $this->info = $info;
        $this->label = $label;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->type = $type;
        $this->value = $value;
    }

    public function render(): View|Closure|string
    {
        return view('shared.form.input');
    }
}