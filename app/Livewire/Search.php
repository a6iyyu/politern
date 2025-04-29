<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class Search extends Component
{
    public $query = '';

    public function __construct() {
        // Ivansyah
    }

    public function render(): View
    {
        return view('livewire.search');
    }
}