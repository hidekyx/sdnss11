<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Alert extends Component
{

    public $type;
    public $title;
    public $messages;
    public $display;
    
    public function __construct($type = '', $title = '', $messages = [], $display = '')
    {
        $this->type = $type;
        $this->title = $title;
        $this->messages = $messages;
        $this->display = $display;
    }

    public function render(): View|Closure|string
    {
        return view('dashboard.components.alert');
    }
}