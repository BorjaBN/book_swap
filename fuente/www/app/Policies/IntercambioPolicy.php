<?php

namespace App\Policies;

use App\Models\Intercambio;
use App\Models\UsuarioComun;

/**
 * Policy para gestionar la autorización sobre intercambios.
 *
 * Esta policy define qué usuarios pueden gestionar (aceptar o rechazar)
 * un intercambio. La regla es sencilla: únicamente el propietario del libro
 * solicitado puede tomar decisiones sobre el intercambio.
 *
 */
class IntercambioPolicy
{
    /**
     * Determina si el usuario puede gestionar (aceptar o rechazar)
     * un intercambio.
     *
     * Regla:
     * - Solo el propietario del libro solicitado puede gestionarlo.
     *
     * @param  \App\Models\UsuarioComun  $user
     * @param  \App\Models\Intercambio   $intercambio
     * @return bool
     */
    public function gestionar(UsuarioComun $user, Intercambio $intercambio): bool
    {
        return $user->id_usuario_comun === $intercambio->propietario_id;
    }
}
