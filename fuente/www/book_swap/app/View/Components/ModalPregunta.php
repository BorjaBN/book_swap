<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ModalPregunta extends Component
{
    public $id;
    public $titulo;
    public $mensaje;
    public $textoCancelar;
    public $textoAceptar;
    public $accionAceptar;
    public $onAceptar;

    public function __construct($id, $titulo, $mensaje, $textoCancelar = null, $textoAceptar = null, $accionAceptar = null, $onAceptar = null)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->mensaje = $mensaje;
        $this->textoCancelar = $textoCancelar;
        $this->textoAceptar = $textoAceptar;
        $this->accionAceptar = $accionAceptar;
        $this->onAceptar = $onAceptar;
    }

    public function render()
    {
        return view('components.modal-pregunta');
    }
}
