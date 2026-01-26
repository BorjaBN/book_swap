<?php

namespace App\Http\Controllers;

use App\Models\EntidadCultural;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EditarUsuarioRequest;

class EntidadCulturalController extends Controller
{
    /**
     * Muestra el perfil de la entidad autenticada.
     */
    public function show(EntidadCultural $perfil)
    {
        // Solo puede ver su propio perfil
        if ($perfil->id_entidad_cultural !== Auth::guard('entidad')->id()) {
            abort(403);
        }

        $perfil->load('eventos');

        return view('perfil-e-cultural', [
            'entidad' => $perfil,
        ]);
    }

    /**
     * Muestra el formulario para editar el perfil.
     */
    public function edit(EntidadCultural $perfil)
    {
        if ($perfil->id_entidad_cultural !== Auth::guard('entidad')->id()) {
            abort(403);
        }

        return view('formulario-editar-e-cultural', [
            'entidad' => $perfil,
        ]);
    }

    /**
     * Actualiza el perfil de la entidad autenticada.
     */
    public function update(EditarUsuarioRequest $request, EntidadCultural $perfil)
    {
        if ($perfil->id_entidad_cultural !== Auth::guard('entidad')->id()) {
            abort(403);
        }

        $validated = $request->validated();


        $perfil->update($validated);

        return redirect()
            ->route('entidad.perfil.show', $perfil->id_entidad_cultural)
            ->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Elimina la cuenta de la entidad autenticada.
     */
    public function destroy(EntidadCultural $perfil)
    {
        if ($perfil->id_entidad_cultural !== Auth::guard('entidad')->id()) {
            abort(403);
        }

        $perfil->delete();

        Auth::guard('entidad')->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()
            ->route('formularioInicioSesion')
            ->with('success', 'Tu cuenta ha sido eliminada correctamente.');
    }
}
