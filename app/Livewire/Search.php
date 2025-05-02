<?php

namespace App\Livewire;

use Livewire\Component;

class Search extends Component
{
    public $search = '';

    public function updatedSearch()
    {
        $this->redirect(route('search.result', ['query' => $this->search]));
    }

    public function render()
    {
        return view('livewire.search');
    }
}
