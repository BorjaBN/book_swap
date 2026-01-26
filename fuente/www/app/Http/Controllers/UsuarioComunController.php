<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\UsuarioComun;
use App\Http\Requests\EditarUsuarioRequest;

/**
 * Controlador para gestionar el perfil del usuario común autenticado.
 */
class UsuarioComunController extends Controller
{
    /**
     * Muestra el perfil del usuario autenticado.
     *
     * Verifica que el usuario solo pueda ver su propio perfil y carga
     * únicamente los libros que estén en estado "libre".
     *
     * @param  \App\Models\UsuarioComun  $usuarioComun
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function show(UsuarioComun $usuarioComun)
    {
        if ($usuarioComun->id_usuario_comun !== Auth::id()) {
            abort(403);
        }

        $usuarioComun->load([
            'libros' => function ($consulta) {
                $consulta->where('estado_intercambio', 'libre');
            }
        ]);

        return view('perfil-u-comun', [
            'usuario' => $usuarioComun,
        ]);
    }

    /**
     * Muestra el formulario para editar el perfil del usuario.
     *
     * Solo el propio usuario puede acceder a esta vista.
     *
     * @param  \App\Models\UsuarioComun  $usuarioComun
     * @return \Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
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
     * Actualiza los datos del perfil del usuario autenticado.
     *
     * Valida los datos mediante EditarUsuarioRequest y actualiza el modelo.
     *
     * @param  \App\Http\Requests\EditarUsuarioRequest  $peticion
     * @param  \App\Models\UsuarioComun                 $usuarioComun
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function update(EditarUsuarioRequest $peticion, UsuarioComun $usuarioComun)
    {
        if ($usuarioComun->id_usuario_comun !== Auth::id()) {
            abort(403);
        }

        $datosValidados = $peticion->validated();

        $usuarioComun->update($datosValidados);

        return redirect()
            ->route('usuarioComun.show', $usuarioComun->id_usuario_comun)
            ->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Elimina la cuenta del usuario autenticado.
     *
     * Elimina el registro, cierra la sesión y reinicia la sesión para
     * evitar reutilización de tokens.
     *
     * @param  \App\Models\UsuarioComun  $usuarioComun
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
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
