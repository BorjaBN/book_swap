<?php

namespace App\Http\Controllers;

use App\Models\UsuarioComun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilUsuarioComunController extends Controller
{
    /**
     * Muestra el perfil del usuario autenticado.
     * - Obtiene el usuario autenticado del guard web(el de usuario comun).
     * - Si no hay usuario autenticado, redirige al login.
     * - Carga la relación con los libros de usuario.
     * - Pasa los datos a la vista.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show()
    {
    
        $usuario = Auth::guard('web')->user();

        if (! $usuario) {
            return redirect()
                ->route('formularioInicioSesion')
                ->with('error', 'Debes iniciar sesión para ver tu perfil.');
        }

        $usuario->load('libros');

        return view('perfil.usuario.show', [
            'usuario' => $usuario,
        ]);
    }

    /**
     * Muestra el formulario para editar el perfil del usuario autenticado.
     * - Obtiene los datos del usuario autenticado del guard web(el de usuario comun).
     * - Si no hay usuario autenticado, redirige al login.
     * -
     * - Pasa los datos a la vista.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit()
    {

        $usuario = Auth::guard('web')->user();

        if (! $usuario) {
            return redirect()
                ->route('formularioInicioSesion')
                ->with('error', 'Debes iniciar sesión para editar tu perfil.');
        }

        // (Más adelante) aquí irá la Policy: $this->authorize('update', $usuario);

        return view('perfil.usuario.edit', [
            'usuario' => $usuario,
        ]);
    }

    /**
     * Actualiza el perfil del usuario autenticado.
     * - Ve el usuario autenticado.
     * - Si no está, manda al login.
     * - Valida.
     * - Si se cambia la contraseña se hashea de neuvo, si no se toca no se hace nada.
     * - Actualizael usuario.
     *
     * @param  \App\Http\Requests\PerfilUsuarioRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PerfilUsuarioRequest $request)
    {

        $usuario = Auth::guard('web')->user();

        if (! $usuario) {
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

        $usuario->update($validated);

        return redirect()
            ->route('perfil.show')
            ->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Elimina la cuenta del usuario autenticado.
     * - Obtiene al usuario autenticado.
     * - Borra el usuario de la base de datos (los libros se borran automáticamente por CASCADE).
     * - Cierra la sesion enviando al login.
     * - E invalida la sesion.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        
        $usuario = Auth::guard('web')->user();

        if (! $usuario) {
            return redirect()
                ->route('formularioInicioSesion')
                ->with('error', 'Debes iniciar sesión para borrar tu cuenta.');
        }

        $usuario->delete();

        Auth::guard('web')->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()
            ->route('formularioInicioSesion')
            ->with('success', 'Tu cuenta ha sido eliminada correctamente.');
    }



}
