<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Class File
 *
 * Componente encargado de representar un campo de subida de archivos
 * dentro de los formularios de la aplicación.  
 *
 * Su propósito es centralizar la estructura y estilos del input tipo "file",
 * permitiendo mantener consistencia visual y funcional en todos los formularios
 * que requieran carga de documentos o imágenes.
 *
 * Este componente puede ampliarse en el futuro para incluir validaciones,
 * restricciones de tipo MIME, tamaños máximos o integración con previsualizaciones.
 *
 * @package App\View\Components
 */
class File extends Component
{
    /**
     * Inicializa una nueva instancia del componente.
     *
     * Actualmente no recibe parámetros, pero sirve como punto de extensión
     * para futuras propiedades relacionadas con la configuración del input.
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
     * `resources/views/components/file.blade.php`.
     *
     * @return View|Closure|string  Vista o contenido renderizable del componente.
     */
    public function render(): View|Closure|string
    {
        return view('components.file');
    }
}
