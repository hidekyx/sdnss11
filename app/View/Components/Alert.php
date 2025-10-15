<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Alert extends Component
{
    public $type;
    public $title;
    public $icon;
    public $messages;
    public $display;
    
    public function __construct($type = '', $title = '', $icon = '', $messages = [], $display = '')
    {
        $this->type = $type;
        $this->title = $title;
        $this->icon = $icon;
        $this->messages = $messages;
        $this->display = $display;
    }

    public function render(): View|Closure|string
    {
        return view('dashboard.components.alert');
    }
}