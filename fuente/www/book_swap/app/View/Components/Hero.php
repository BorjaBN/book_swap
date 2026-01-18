<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Hero extends Component
{
    public $titulo;
    public $subtitulo;
    public $textoBoton;
    public $hrefBoton;

    public function __construct($titulo = null, $subtitulo = null, $textoBoton = null, $hrefBoton = null)
    {
        $this->titulo = $titulo;
        $this->subtitulo = $subtitulo;
        $this->textoBoton = $textoBoton;
        $this->hrefBoton = $hrefBoton;
    }

    public function render()
    {
        return view('components.hero');
    }
}
