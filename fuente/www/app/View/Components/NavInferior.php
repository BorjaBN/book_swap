<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Class NavInferior
 *
 * Componente encargado de renderizar la barra de navegación inferior
 * utilizada en la aplicación.  
 *
 * Su propósito es centralizar la estructura y estilos de la navegación
 * inferior, permitiendo mantener consistencia visual y funcional en todas
 * las vistas que la utilicen.  
 *
 * Este componente puede ampliarse en el futuro para incluir elementos
 * dinámicos, estados activos o integración con datos del usuario.
 *
 * @package App\View\Components
 */
class NavInferior extends Component
{
    /**
     * Inicializa una nueva instancia del componente NavInferior.
     *
     * Actualmente no recibe parámetros, pero sirve como punto de extensión
     * para futuras propiedades relacionadas con la navegación.
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
     * `resources/views/components/nav-inferior.blade.php`.
     *
     * @return View|Closure|string  Vista o contenido renderizable del componente.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-inferior');
    }
}
