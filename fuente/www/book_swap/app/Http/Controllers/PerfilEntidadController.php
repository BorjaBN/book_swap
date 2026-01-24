<?php

namespace App\Http\Controllers;

use App\Models\EntidadCultural;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PerfilEntidadRequest;

class PerfilEntidadController extends Controller
{
    /**
     * Muestra el perfil de la entidad autenticada.
     * - Obtiene el usuario autenticado del guard entidad(el de entidad cultural).
     * - Si no hay entidad autenticada, redirige al login.
     * - Carga la relacion con los eventos de la entidad.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show()
    {
        $entidad = Auth::guard('entidad')->user();

        if (! $entidad) {
            return redirect()
                ->route('formularioInicioSesion')
                ->with('error', 'Debes iniciar sesión para ver tu perfil.');
        }

        $entidad->load('eventos');

        return view('perfil.entidad.show', [
            'entidad' => $entidad,
        ]);
    }

    /**
     * Muestra el formulario para editar el perfil de la entidad autenticada.
     * - Obtiene los datos de la entidad autenticada del guard entidad(el de entidad cultural).
     * - Si no hay entidad autenticada, redirige al login.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit()
    {
        $entidad = Auth::guard('entidad')->user();

        if (! $entidad) {
            return redirect()
                ->route('formularioInicioSesion')
                ->with('error', 'Debes iniciar sesión para editar tu perfil.');
        }

        return view('perfil.entidad.edit', [
            'entidad' => $entidad,
        ]);
    }

    /**
     * Actualiza el perfil del entidad autenticada.
     * - Ve la entidad autenticada.
     * - Si no está, manda al login.
     * - Valida.
     * - Si se cambia la contraseña se hashea de neuvo, si no se toca no se hace nada.
     * - Como el NIF NO es editable se saca del array por seguridad.
     * - Actualiza la entidad.
     *
     * @param  \App\Http\Requests\PerfilEntidadRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PerfilEntidadRequest $request)
    {
        $entidad = Auth::guard('entidad')->user();

        if (! $entidad) {
            return redirect()
                ->route('formularioInicioSesion')
                ->with('error', 'Debes iniciar sesión para actualizar tu perfil.');
        }

        $validated = $request->validated();

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']); 
        }

        
        unset($validated['nif_entidad_cultural']); 

        $entidad->update($validated);

        return redirect()
            ->route('perfil.entidad.show')
            ->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Elimina la cuenta del entidad autenticado.
     * - Obtiene a la entidad autenticada.
     * - Borra la entidad de la base de datos (los eventos se borran automáticamente por CASCADE).
     * - Cierra la sesion enviando al login.
     * - E invalida la sesion.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        $entidad = Auth::guard('entidad')->user();

        if (! $entidad) {
            return redirect()
                ->route('formularioInicioSesion')
                ->with('error', 'Debes iniciar sesión para borrar tu cuenta.');
        }

        // Borrar entidad (los eventos se borran automáticamente)
        $entidad->delete();

        // Cerrar sesión
        Auth::guard('entidad')->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()
            ->route('formularioInicioSesion')
            ->with('success', 'Tu cuenta ha sido eliminada correctamente.');
    }
}
