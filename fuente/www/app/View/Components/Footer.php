<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Class Footer
 *
 * Componente encargado de renderizar el pie de página de la aplicación.
 * Centraliza la estructura y estilos del footer, permitiendo mantener
 * consistencia visual en todas las vistas que lo utilicen.
 *
 * Este componente sirve como punto único de mantenimiento para enlaces,
 * información legal, créditos u otros elementos comunes del pie de página.
 *
 * @package App\View\Components
 */
class Footer extends Component
{
    /**
     * Inicializa una nueva instancia del componente Footer.
     *
     * Actualmente no recibe parámetros, pero puede ampliarse en el futuro
     * para incluir configuraciones dinámicas del pie de página.
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
     * `resources/views/components/footer.blade.php`.
     *
     * @return View|Closure|string  Vista o contenido renderizable del componente.
     */
    public function render(): View|Closure|string
    {
        return view('components.footer');
    }
}
