<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Menu extends Component
{
    public $menus;

    public function __construct($menus)
    {
        $this->menus = $menus;
    }

    public function render(): View|Closure|string
    {
        return view('dashboard.components.menu');
    }
}
