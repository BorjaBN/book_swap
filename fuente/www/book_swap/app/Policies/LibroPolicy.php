<?php

namespace App\Policies;

use App\Models\Libro;
use App\Models\UsuarioComun;

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
     * @return bool  true si el usuario es el propietario, false en caso contrario
     */
    public function update(UsuarioComun $user, Libro $libro): bool
    {
        return $libro->id_usuario_comun === $user->id_usuario_comun;
    }

    /**
     * Determina si el usuario autenticado puede eliminar el libro.
     *
     * Solo el propietario del libro puede eliminarlo. Este método verifica
     * que el usuario autenticado coincida con el usuario que creó el libro.
     *
     * @param  \App\Models\UsuarioComun  $user   Usuario autenticado
     * @param  \App\Models\Libro         $libro  Libro que se desea eliminar
     * @return bool  true si el usuario es el propietario, false en caso contrario
     */
    public function delete(UsuarioComun $user, Libro $libro): bool
    {
        return $libro->id_usuario_comun === $user->id_usuario_comun;
    }
}
