<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Input extends Component
{
    public ?bool $required;
    public string $icon, $name;
    public ?string $info, $label, $type, $value;

    public function __construct(?bool $required, string $icon, string $name, ?string $info = null, ?string $label = null, ?string $type = null, ?string $value = null)
    {
        $this->icon = $icon;
        $this->info = $info;
        $this->label = $label;
        $this->name = $name;
        $this->required = $required;
        $this->type = $type;
        $this->value = $value;
    }

    public function render(): View|Closure|string
    {
        return view('shared.form.input');
    }
}