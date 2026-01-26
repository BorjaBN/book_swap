<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Class Toast
 *
 * Componente encargado de renderizar notificaciones tipo "toast" en la aplicación.
 * Estas notificaciones se utilizan para mostrar mensajes breves al usuario, como
 * confirmaciones, advertencias o errores, sin interrumpir el flujo de navegación.
 *
 * Este componente centraliza la estructura y estilos de los toasts, permitiendo
 * mantener consistencia visual y funcional en todas las vistas que los utilicen.
 *
 * @package App\View\Components
 */
class Toast extends Component
{
    /**
     * Inicializa una nueva instancia del componente Toast.
     *
     * Actualmente no recibe parámetros, pero sirve como punto de extensión
     * para futuras propiedades como tipo de mensaje, duración o variantes visuales.
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
     * `resources/views/components/toast.blade.php`.
     *
     * @return View|Closure|string  Vista o contenido renderizable del componente.
     */
    public function render(): View|Closure|string
    {
        return view('components.toast');
    }
}
