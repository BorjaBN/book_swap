<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Class TarjetaMostrar
 *
 * Componente visual utilizado para mostrar información en formato de tarjeta.
 * Su propósito es centralizar la estructura y estilos de las tarjetas de
 * presentación, permitiendo mantener consistencia visual en todas las vistas
 * que utilicen este patrón.
 *
 * Este componente puede ampliarse en el futuro para incluir propiedades
 * dinámicas como título, imagen, descripción o acciones asociadas.
 *
 * @package App\View\Components
 */
class TarjetaMostrar extends Component
{
    /**
     * Inicializa una nueva instancia del componente TarjetaMostrar.
     *
     * Actualmente no recibe parámetros, pero sirve como punto de extensión
     * para futuras propiedades relacionadas con la tarjeta.
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
     * `resources/views/components/tarjeta-mostrar.blade.php`.
     *
     * @return View|Closure|string  Vista o contenido renderizable del componente.
     */
    public function render(): View|Closure|string
    {
        return view('components.tarjeta-mostrar');
    }
}
