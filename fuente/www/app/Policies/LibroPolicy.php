<?php

namespace App\Policies;

use App\Models\Libro;
use App\Models\UsuarioComun;

/**
 * Policy para gestionar la autorización sobre libros.
 *
 * Esta policy define qué usuarios pueden actualizar o eliminar un libro.
 * La lógica se basa en un principio fundamental del dominio: cada libro
 * pertenece a un usuario concreto, y solo ese usuario puede modificarlo
 * o eliminarlo.
 *
 * Razones de diseño:
 * - La Policy garantiza que la seguridad sea coherente en toda la aplicación.
 *
 */
class LibroPolicy
{
    /**
     * Determina si el usuario autenticado puede actualizar el libro.
     *
     * Un libro solo puede ser actualizado por su propietario. Este método
     * compara el ID del usuario autenticado con el ID del usuario asociado
     * al libro para garantizar que solo el dueño pueda editarlo.
     *
     * @param  \App\Models\UsuarioComun  $user   Usuario autenticado
     * @param  \App\Models\Libro         $libro  Libro que se desea actualizar
     * @return bool
     */
    public function update(UsuarioComun $user, Libro $libro): bool
    {
        return $libro->id_usuario_comun === $user->id_usuario_comun;
    }

    /**
     * Determina si el usuario autenticado puede eliminar el libro.
     *
     * Reglas:
     * 1. Solo el propietario del libro puede eliminarlo.
     * 2. Un libro no puede eliminarse si está involucrado en un intercambio,
     *    ya sea como libro solicitado o como libro ofrecido.
     *
     * Esta restricción evita inconsistencias en el historial de intercambios
     * y garantiza la integridad del sistema.
     *
     * @param  \App\Models\UsuarioComun  $user   Usuario autenticado
     * @param  \App\Models\Libro         $libro  Libro que se desea eliminar
     * @return bool
     */
    public function delete(UsuarioComun $user, Libro $libro): bool
    {
        
        if ($libro->id_usuario_comun !== $user->id_usuario_comun) {
            return false;
        }

        
        $estaEnIntercambio =
            $libro->intercambiosSolicitados()->exists() ||
            $libro->intercambiosOfrecidos()->exists();

        return !$estaEnIntercambio;
    }
}
