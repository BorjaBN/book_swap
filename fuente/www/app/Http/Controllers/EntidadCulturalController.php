<?php

namespace App\Http\Controllers;

use App\Models\EntidadCultural;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EditarUsuarioRequest;

/**
 * Controlador para gestionar el perfil de la entidad cultural autenticada.
 */
class EntidadCulturalController extends Controller
{
    /**
     * Muestra el perfil de la entidad autenticada.
     *
     * @param  \App\Models\EntidadCultural  $perfil
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function show(EntidadCultural $perfil)
    {
        if ($perfil->id_entidad_cultural !== Auth::guard('entidad')->id()) {
            abort(403);
        }

        $perfil->load('eventos');

        return view('perfil-e-cultural', [
            'entidad' => $perfil,
        ]);
    }

    /**
     * Muestra el formulario para editar el perfil de la entidad.
     *
     * @param  \App\Models\EntidadCultural  $perfil
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
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
     * Actualiza los datos del perfil de la entidad cultural autenticada.
     *
     * @param  \App\Http\Requests\EditarUsuarioRequest  $peticion
     * @param  \App\Models\EntidadCultural  $perfil
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function update(EditarUsuarioRequest $peticion, EntidadCultural $perfil)
    {
        if ($perfil->id_entidad_cultural !== Auth::guard('entidad')->id()) {
            abort(403);
        }

        $datosValidados = $peticion->validated();

        $perfil->update($datosValidados);

        return redirect()
            ->route('entidad.perfil.show', $perfil->id_entidad_cultural)
            ->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Elimina la cuenta de la entidad cultural autenticada.
     *
     * @param  \App\Models\EntidadCultural  $perfil
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
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
            ->route('bienvenida')
            ->with('success', 'Tu cuenta ha sido eliminada correctamente.');
    }
}
