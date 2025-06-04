<?php

namespace App\Livewire;

use Illuminate\View\Factory;
use Illuminate\View\View;
use Livewire\Component;

class Search extends Component
{
    public array $results = [];
    public bool $required = false;
    public string $model, $query = '';
    public ?string $icon = null, $label = null, $name = null, $placeholder = null;

    public function search()
    {
        if (!class_exists($this->model)) {
            $this->results = [];
            return;
        }

        $this->results = app($this->model)::where('name', 'like', "%{$this->query}%")->limit(10)->get()->toArray();
    }

    public function updatedQuery()
    {
        $this->search();
    }

    public function render(): Factory|View
    {
        return view('livewire.search');
    }
}