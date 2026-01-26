<?php

namespace App\View\Components;

use Illuminate\View\Component;

/**
 * Class ModalPregunta
 *
 * Componente reutilizable para mostrar un modal de confirmación o pregunta
 * al usuario. Permite personalizar título, mensaje, textos de los botones
 * y acciones asociadas al botón de aceptación.
 *
 * Este componente se utiliza para confirmar acciones importantes como
 * eliminaciones, envíos de formularios o decisiones críticas dentro de la
 * aplicación, evitando duplicar lógica y estructura en múltiples vistas.
 *
 * @package App\View\Components
 */
class ModalPregunta extends Component
{
    /**
     * Identificador único del modal (usado para toggles y accesibilidad).
     *
     * @var string
     */
    public $id;

    /**
     * Título principal mostrado en el modal.
     *
     * @var string
     */
    public $titulo;

    /**
     * Mensaje o descripción que se muestra al usuario.
     *
     * @var string
     */
    public $mensaje;

    /**
     * Texto del botón de cancelar.
     *
     * @var string|null
     */
    public $textoCancelar;

    /**
     * Texto del botón de aceptar.
     *
     * @var string|null
     */
    public $textoAceptar;

    /**
     * Acción o ruta que se ejecutará al aceptar.
     * Puede ser una URL, un método o un identificador JS.
     *
     * @var string|null
     */
    public $accionAceptar;

    /**
     * Evento o función JavaScript que se ejecutará al aceptar.
     *
     * @var string|null
     */
    public $onAceptar;

    /**
     * Crea una nueva instancia del componente ModalPregunta.
     *
     * @param string      $id              Identificador único del modal.
     * @param string      $titulo          Título del modal.
     * @param string      $mensaje         Mensaje mostrado al usuario.
     * @param string|null $textoCancelar   Texto del botón de cancelar.
     * @param string|null $textoAceptar    Texto del botón de aceptar.
     * @param string|null $accionAceptar   Acción asociada al botón aceptar.
     * @param string|null $onAceptar       Evento JS ejecutado al aceptar.
     *
     * @return void
     */
    public function __construct(
        $id,
        $titulo,
        $mensaje,
        $textoCancelar = null,
        $textoAceptar = null,
        $accionAceptar = null,
        $onAceptar = null
    ) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->mensaje = $mensaje;
        $this->textoCancelar = $textoCancelar;
        $this->textoAceptar = $textoAceptar;
        $this->accionAceptar = $accionAceptar;
        $this->onAceptar = $onAceptar;
    }

    /**
     * Obtiene la vista que representa el componente.
     *
     * Renderiza la plantilla Blade ubicada en:
     * `resources/views/components/modal-pregunta.blade.php`.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.modal-pregunta');
    }
}
