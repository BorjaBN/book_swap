<?php

namespace App\Policies;

use App\Models\EntidadCultural;
use App\Models\EventoCultural;

class EventoCulturalPolicy
{
    public function viewAny($user): bool
    {
        return true;
    }

    public function view($user, EventoCultural $evento): bool
    {
        return true;
    }

    public function create($user): bool
    {
        return $user instanceof EntidadCultural;
    }

    public function update($user, EventoCultural $evento): bool
    {
        // Si NO es una entidad cultural → no puede editar
        if (!$user instanceof EntidadCultural) {
            return false;
        }

        // Si es entidad, solo puede editar sus propios eventos
        return $evento->id_entidad_cultural === $user->id_entidad_cultural;
    }

    public function delete($user, EventoCultural $evento): bool
    {
        if (!$user instanceof EntidadCultural) {
            return false;
        }

        return $evento->id_entidad_cultural === $user->id_entidad_cultural;
    }
}
