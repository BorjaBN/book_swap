<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Class Input
 *
 * Componente genérico para representar campos de entrada en formularios.
 * Su propósito es centralizar la estructura y estilos de los inputs,
 * permitiendo mantener consistencia visual y funcional en toda la aplicación.
 *
 * Este componente puede ampliarse en el futuro para incluir atributos como
 * tipo de input, etiqueta, valor por defecto, validaciones o mensajes de error.
 *
 * @package App\View\Components
 */
class Input extends Component
{
    /**
     * Inicializa una nueva instancia del componente Input.
     *
     * Actualmente no recibe parámetros, pero sirve como punto de extensión
     * para futuras propiedades relacionadas con la configuración del campo.
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
     * Renderiza la plantilla Blade ubicada en:
     * `resources/views/components/input.blade.php`.
     *
     * @return View|Closure|string  Vista o contenido renderizable del componente.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
