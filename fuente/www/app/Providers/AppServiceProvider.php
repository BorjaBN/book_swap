<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\SolicitudesComposer;

/**
 * Class AppServiceProvider
 *
 * Proveedor de servicios principal de la aplicación.  
 * Se utiliza para registrar servicios globales y ejecutar lógica
 * de inicialización durante el arranque del framework.
 *
 * En este proyecto, este provider registra un View Composer encargado
 * de inyectar datos relacionados con las solicitudes del usuario en la
 * vista `components.nav-inferior`, permitiendo que el componente muestre
 * información dinámica sin duplicar lógica en controladores.
 *
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Registra servicios de la aplicación.
     *
     * Este método se ejecuta antes del arranque del framework y es el lugar
     * adecuado para enlazar clases en el contenedor de servicios o registrar
     * configuraciones globales.  
     *
     * En este caso no se realiza ningún registro adicional.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Inicializa servicios de la aplicación.
     *
     * Este método se ejecuta después de que todos los servicios hayan sido
     * registrados. Aquí se definen los View Composers, listeners u otra lógica
     * que deba ejecutarse durante el arranque.
     *
     * Registra el View Composer `SolicitudesComposer` para la vista
     * `components.nav-inferior`, permitiendo que el componente reciba datos
     * automáticamente cada vez que se renderiza.
     *
     * @return void
     */
    public function boot(): void
    {
        View::composer('components.nav-inferior', SolicitudesComposer::class);
    }
}
