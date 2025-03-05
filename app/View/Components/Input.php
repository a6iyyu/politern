<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Input extends Component
{
    public string $name, $label, $icon;
    public ?string $info, $type, $value;
    public ?bool $required;

    public function __construct(string $name, string $label, ?string $info, ?string $type, string $icon, ?string $value, ?bool $required)
    {
        $this->name = $name;
        $this->label = $label;
        $this->info = $info;
        $this->type = $type;
        $this->icon = $icon;
        $this->value = $value;
        $this->required = $required;
    }

    public function render(): View|Closure|string
    {
        return view('shared.form.input');
    }
}