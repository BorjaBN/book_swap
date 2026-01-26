<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * Class Button
 *
 * Componente reutilizable para la representación de botones en la interfaz.
 * Permite generar tanto botones estándar como enlaces estilizados, según
 * los parámetros proporcionados.
 *
 * Este componente centraliza la lógica visual de los botones, evitando
 * duplicación de estilos y facilitando la consistencia en toda la aplicación.
 *
 * @package App\View\Components
 */
class Button extends Component
{
    /**
     * URL destino cuando el botón actúa como enlace.
     *
     * Si es null, el componente se renderiza como un botón estándar.
     *
     * @var string|null
     */
    public $href;

    /**
     * Variante visual del botón (por ejemplo: 'primary', 'secondary', etc.).
     *
     * Permite aplicar estilos condicionales desde la vista Blade.
     *
     * @var string|null
     */
    public $variant;

    /**
     * Tipo del botón HTML (button, submit, reset).
     *
     * Solo se aplica cuando el componente se renderiza como <button>.
     *
     * @var string
     */
    public $type;

    /**
     * Crea una nueva instancia del componente Button.
     *
     * @param string|null $href    URL destino si el botón actúa como enlace.
     * @param string|null $variant Variante visual del botón.
     * @param string      $type    Tipo del botón HTML (por defecto 'button').
     *
     * @return void
     */
    public function __construct($href = null, $variant = null, $type = 'button')
    {
        $this->href = $href;
        $this->variant = $variant;
        $this->type = $type;
    }

    /**
     * Obtiene la vista que representa el componente.
     *
     * Renderiza la plantilla Blade ubicada en:
     * `resources/views/components/button.blade.php`.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.button');
    }
}
