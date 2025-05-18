<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    public array $headers, $rows, $sortable;

    public function __construct(array $headers, array $rows, array $sortable)
    {
        $this->headers = $headers;
        $this->rows = $rows;
        $this->sortable = $sortable;
    }

    public function render(): View|Closure|string
    {
        return view('shared.ui.table');
    }
}