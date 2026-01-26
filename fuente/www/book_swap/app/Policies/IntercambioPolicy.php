<?php

namespace App\Policies;

use App\Models\Intercambio;
use App\Models\UsuarioComun;
use Illuminate\Auth\Access\Response;

class IntercambioPolicy
{
    public function gestionar(UsuarioComun $user, Intercambio $intercambio): bool
    {
        return $user->id_usuario_comun === $intercambio->propietario_id;
    }

}
