<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Class BaseFormulario
 *
 * Componente base para la construcción de formularios en la aplicación.
 * Este componente actúa como contenedor genérico para vistas de formulario,
 * permitiendo unificar estilos, estructura y comportamiento común entre
 * diferentes formularios del sistema.
 *
 * Su propósito principal es ofrecer un punto centralizado para extender
 * formularios más complejos sin duplicar código en cada vista.
 *
 * @package App\View\Components
 */
class BaseFormulario extends Component
{
    /**
     * Inicializa una nueva instancia del componente.
     *
     * Este constructor no recibe parámetros, pero sirve como punto de extensión
     * para futuros atributos o dependencias que puedan necesitar los formularios.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Obtiene la vista que representa el componente.
     *
     * Devuelve la plantilla Blade asociada al componente base de formularios,
     * ubicada en `resources/views/components/base-formulario.blade.php`.
     *
     * @return View|Closure|string  Vista o contenido renderizable del componente.
     */
    public function render(): View|Closure|string
    {
        return view('components.base-formulario');
    }
}
