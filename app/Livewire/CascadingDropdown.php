<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class CascadingDropdown extends Component
{
    public function __construct()
    {
        // Ivansyah
    }

    public function render(): View
    {
        return view('livewire.cascading-dropdown');
    }
}