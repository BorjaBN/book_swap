<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\UsuarioComun;
use App\Http\Requests\EditarUsuarioRequest;

class UsuarioComunController extends Controller
{
    /**
     * Muestra el perfil del usuario autenticado.
     */
    public function show(UsuarioComun $usuarioComun)
    {
        // Solo puede ver su propio perfil
        if ($usuarioComun->id_usuario_comun !== Auth::id()) {
            abort(403);
        }

        $usuarioComun->load('libros');

        return view('perfil-u-comun', [
            'usuario' => $usuarioComun,
        ]);
    }

    /**
     * Muestra el formulario para editar el perfil.
     */
    public function edit(UsuarioComun $usuarioComun)
    {
        if ($usuarioComun->id_usuario_comun !== Auth::id()) {
            abort(403);
        }

        return view('formulario-editar-u-comun', [
            'usuario' => $usuarioComun,
        ]);
    }

    /**
     * Actualiza el perfil del usuario autenticado.
     */
    public function update(EditarUsuarioRequest $request, UsuarioComun $usuarioComun)
    {
        if ($usuarioComun->id_usuario_comun !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validated();

        $usuarioComun->update($validated);

        return redirect()
            ->route('usuarioComun.show', $usuarioComun->id_usuario_comun)
            ->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Elimina la cuenta del usuario autenticado.
     */
    public function destroy(UsuarioComun $usuarioComun)
    {
        if ($usuarioComun->id_usuario_comun !== Auth::id()) {
            abort(403);
        }

        $usuarioComun->delete();

        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()
            ->route('bienvenida')
            ->with('success', 'Tu cuenta ha sido eliminada correctamente.');
    }
}
