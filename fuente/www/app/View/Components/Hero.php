<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * Class Hero
 *
 * Componente visual utilizado para mostrar una sección destacada en la interfaz,
 * generalmente ubicada en la parte superior de una página.  
 *
 * Permite definir un título, subtítulo y un botón opcional con texto y enlace,
 * facilitando la creación de bloques promocionales o de bienvenida sin duplicar
 * estructura ni estilos en múltiples vistas.
 *
 * @package App\View\Components
 */
class Hero extends Component
{
    /**
     * Título principal del bloque Hero.
     *
     * @var string|null
     */
    public $titulo;

    /**
     * Subtítulo o descripción secundaria del Hero.
     *
     * @var string|null
     */
    public $subtitulo;

    /**
     * Texto del botón opcional mostrado en el Hero.
     *
     * @var string|null
     */
    public $textoBoton;

    /**
     * Enlace asociado al botón del Hero.
     *
     * @var string|null
     */
    public $hrefBoton;

    /**
     * Crea una nueva instancia del componente Hero.
     *
     * @param string|null $titulo      Título principal del Hero.
     * @param string|null $subtitulo   Subtítulo o descripción secundaria.
     * @param string|null $textoBoton  Texto del botón opcional.
     * @param string|null $hrefBoton   Enlace del botón.
     *
     * @return void
     */
    public function __construct($titulo = null, $subtitulo = null, $textoBoton = null, $hrefBoton = null)
    {
        $this->titulo = $titulo;
        $this->subtitulo = $subtitulo;
        $this->textoBoton = $textoBoton;
        $this->hrefBoton = $hrefBoton;
    }

    /**
     * Obtiene la vista que representa el componente.
     *
     * Renderiza la plantilla Blade ubicada en:
     * `resources/views/components/hero.blade.php`.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.hero');
    }
}
