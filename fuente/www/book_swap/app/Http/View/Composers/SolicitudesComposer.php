<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Intercambio;

class SolicitudesComposer
{
    public function compose(View $view)
    {
        $usuario = auth()->user();

        if (request()->routeIs('intercambios.misSolicitudes')) {
            $view->with('solicitudesPendientes', 0); 
            return; 
        }

        $notificaciones = 0;

        if ($usuario) {

            // 1. Solicitudes pendientes (como antes)
            $pendientes = Intercambio::where('propietario_id', $usuario->id_usuario_comun)
                ->where('estado', 'pendiente')
                ->count();

            // 2. Cambios de estado (aceptado o rechazado) que afecten al usuario
            $cambiosEstado = Intercambio::where(function ($q) use ($usuario) {
                    $q->where('solicitante_id', $usuario->id_usuario_comun)
                      ->orWhere('propietario_id', $usuario->id_usuario_comun);
                })
                ->whereColumn('updated_at', '!=', 'created_at') // hubo cambio
                ->where('updated_at', '>', now()->subDay())     // últimos 1 día
                ->count();

            $notificaciones = $pendientes + $cambiosEstado;
        }

        $view->with('solicitudesPendientes', $notificaciones);
    }
}
