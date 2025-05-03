<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class Select extends Component
{
    public array $options;
    public string $name;
    public ?string $label, $selected, $value;

    public function __construct(array $options, string $name, ?string $label = null, ?string $selected = null, ?string $value = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->options = $options;
        $this->selected = $selected;
        $this->value = $value;
    }

    public function render(): View
    {
        return view('livewire.select');
    }
}