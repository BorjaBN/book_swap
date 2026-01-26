<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Intercambio;

/**
 * View Composer encargado de calcular el número de notificaciones
 * relacionadas con solicitudes de intercambio del usuario autenticado.
 *
 * Este valor se comparte automáticamente con las vistas que lo requieran,
 * permitiendo mostrar un contador global en la interfaz (por ejemplo,
 * en la barra de navegación).
 */
class SolicitudesComposer
{
    /**
     * Calcula y adjunta al View el número de solicitudes pendientes
     * o con cambios recientes para el usuario autenticado.
     *
     * @param  \Illuminate\View\View  $vista
     * @return void
     */
    public function compose(View $vista)
    {
        $usuario = auth()->user();

        // Evitar mostrar notificaciones dentro de la propia página de solicitudes
        if (request()->routeIs('intercambios.misSolicitudes')) {
            $vista->with('solicitudesPendientes', 0);
            return;
        }

        $notificaciones = 0;

        if ($usuario) {

            /**
             * 1. Solicitudes pendientes recibidas
             *
             * Intercambios donde el usuario es propietario y el estado es "pendiente".
             */
            $pendientes = Intercambio::where('propietario_id', $usuario->id_usuario_comun)
                ->where('estado', 'pendiente')
                ->count();

            /**
             * 2. Cambios de estado en solicitudes enviadas o recibidas
             *
             * Se cuentan los intercambios que:
             * - pertenecen al usuario (como solicitante o propietario)
             * - han sido modificados después de su última revisión
             * - han cambiado de estado (updated_at != created_at)
             */
            $cambiosEstado = 0;

            if ($usuario->ultima_revision_intercambios) {
                $cambiosEstado = Intercambio::where(function ($consulta) use ($usuario) {
                        $consulta->where('solicitante_id', $usuario->id_usuario_comun)
                          ->orWhere('propietario_id', $usuario->id_usuario_comun);
                    })
                    ->whereColumn('updated_at', '!=', 'created_at')
                    ->where('updated_at', '>', $usuario->ultima_revision_intercambios)
                    ->count();
            }

            $notificaciones = $pendientes + $cambiosEstado;
        }

        // Compartir el total con la vista
        $vista->with('solicitudesPendientes', $notificaciones);
    }
}
