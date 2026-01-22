<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public $mostrarNav;

    public function __construct($mostrarNav = false)
    {
        $this->mostrarNav = $mostrarNav;
    }

    public function render(): View|Closure|string
    {
        return view('components.header');
    }
}
