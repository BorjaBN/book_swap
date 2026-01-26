<?php

namespace App\Policies;

use App\Models\EntidadCultural;
use App\Models\EventoCultural;

/**
 * Policy para gestionar la autorización sobre eventos culturales.
 *
 * Esta policy define qué usuarios pueden ver, crear, actualizar o eliminar
 * eventos culturales dentro de la plataforma. La lógica se basa en el hecho
 * de que únicamente las entidades culturales pueden gestionar sus propios
 * eventos, mientras que cualquier usuario (registrado) puede visualizar
 * el catálogo público.
 *
 */
class EventoCulturalPolicy
{
    /**
     * Determina si el usuario puede ver el listado de eventos.
     *
     * Cualquier usuario (o visitante) puede ver los eventos culturales.
     *
     * @param mixed $user
     * @return bool
     */
    public function viewAny($user): bool
    {
        return true;
    }

    /**
     * Determina si el usuario puede ver un evento concreto.
     *
     * Los eventos son públicos, por lo que siempre se permite.
     *
     * @param mixed $user
     * @param EventoCultural $evento
     * @return bool
     */
    public function view($user, EventoCultural $evento): bool
    {
        return true;
    }

    /**
     * Determina si el usuario puede crear un evento.
     *
     * Solo las entidades culturales pueden crear eventos, ya que representan
     * organizaciones autorizadas dentro del sistema.
     *
     * @param mixed $user
     * @return bool
     */
    public function create($user): bool
    {
        return $user instanceof EntidadCultural;
    }

    /**
     * Determina si el usuario puede actualizar un evento.
     *
     * Reglas:
     * - Debe ser una entidad cultural.
     * - Solo puede modificar eventos que ella misma haya creado.
     *
     * @param mixed $user
     * @param EventoCultural $evento
     * @return bool
     */
    public function update($user, EventoCultural $evento): bool
    {
        
        if (!$user instanceof EntidadCultural) {
            return false;
        }

        return $evento->id_entidad_cultural === $user->id_entidad_cultural;
    }

    /**
     * Determina si el usuario puede eliminar un evento.
     *
     * Reglas idénticas a update():
     * - Debe ser una entidad cultural.
     * - Solo puede eliminar eventos que ella misma haya creado.
     *
     * @param mixed $user
     * @param EventoCultural $evento
     * @return bool
     */
    public function delete($user, EventoCultural $evento): bool
    {
        if (!$user instanceof EntidadCultural) {
            return false;
        }

        return $evento->id_entidad_cultural === $user->id_entidad_cultural;
    }
}
