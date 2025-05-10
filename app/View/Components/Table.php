<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    public function __construct()
    {
        /** Ayleen */
    }

    public function render(): View|Closure|string
    {
        return view('shared.ui.table');
    }
}