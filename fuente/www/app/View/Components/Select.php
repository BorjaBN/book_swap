<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Class Select
 *
 * Componente genérico para representar un campo de selección (select)
 * dentro de formularios.  
 *
 * Su propósito es centralizar la estructura y estilos del elemento
 * `<select>`, permitiendo mantener consistencia visual y funcional
 * en toda la aplicación.
 *
 * Este componente puede ampliarse en el futuro para incluir opciones
 * dinámicas, etiquetas, valores seleccionados, validaciones o integración
 * con sistemas de formularios más complejos.
 *
 * @package App\View\Components
 */
class Select extends Component
{
    /**
     * Inicializa una nueva instancia del componente Select.
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
     * `resources/views/components/select.blade.php`.
     *
     * @return View|Closure|string  Vista o contenido renderizable del componente.
     */
    public function render(): View|Closure|string
    {
        return view('components.select');
    }
}
