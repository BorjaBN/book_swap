<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Class Header
 *
 * Componente encargado de renderizar la cabecera de la aplicación.
 * Permite mostrar u ocultar distintos elementos del header según
 * las propiedades recibidas: bienvenida, créditos, perfil y cierre de sesión.
 *
 * Este componente centraliza la estructura del encabezado, facilitando
 * la consistencia visual y el mantenimiento en todas las vistas que lo utilicen.
 *
 * @package App\View\Components
 */
class Header extends Component
{
    /**
     * Indica si debe mostrarse el bloque de bienvenida
     * para usuarios no autenticados.
     *
     * @var bool
     */
    public $mostrarBienvenida;

    /**
     * Indica si deben mostrarse los créditos del usuario autenticado.
     *
     * @var bool
     */
    public $mostrarCreditos;

    /**
     * Indica si debe mostrarse el botón de cerrar sesión.
     *
     * @var bool
     */
    public $mostrarCerrarSesion;

    /**
     * Indica si debe mostrarse el botón de perfil.
     *
     * @var bool
     */
    public $mostrarPerfil;

    /**
     * Crea una nueva instancia del componente Header.
     *
     * @param bool $mostrarBienvenida     Muestra opciones de registro/inicio de sesión.
     * @param bool $mostrarCreditos       Muestra los créditos del usuario autenticado.
     * @param bool $mostrarCerrarSesion   Muestra el botón de cerrar sesión.
     * @param bool $mostrarPerfil         Muestra el botón de perfil del usuario.
     *
     * @return void
     */
    public function __construct(

    ) {

    }

    /**
     * Obtiene la vista que representa el componente.
     *
     * Renderiza la plantilla Blade ubicada en:
     * `resources/views/components/header.blade.php`.
     *
     * @return View|Closure|string  Vista o contenido renderizable del componente.
     */
    public function render(): View|Closure|string
    {
        return view('components.header');
    }
}
