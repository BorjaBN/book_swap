<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $href;
    public $variant;
    public $type;

    public function __construct($href = null, $variant = null, $type = 'button')
    {
        $this->href = $href;
        $this->variant = $variant;
        $this->type = $type;
    }

    public function render()
    {
        return view('components.button');
    }
}
