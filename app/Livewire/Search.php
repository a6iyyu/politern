<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Livewire\Component;

class Search extends Component
{
    public $search = '';

    public function render(): Factory|View
    {
        return view('livewire.search');
    }
}