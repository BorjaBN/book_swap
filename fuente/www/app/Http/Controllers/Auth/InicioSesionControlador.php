<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\InicioSesionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controlador encargado de gestionar el inicio y cierre de sesión
 * para usuarios comunes y entidades culturales.
 */
class InicioSesionControlador extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     *
     * @return \Illuminate\View\View
     */
    public function mostrarFormulario()
    {
        return view('formulario-inicio-sesion');
    }

    /**
     * Procesa el intento de inicio de sesión para ambos tipos de usuarios.
     *
     * Intenta autenticar al usuario en los guards "web"(usuario común) y "entidad"
     * utilizando el campo de email correspondiente en cada caso.
     *
     * @param  \App\Http\Requests\InicioSesionRequest  $peticion
     * @return \Illuminate\Http\RedirectResponse
     */
    public function iniciarSesion(InicioSesionRequest $peticion)
    {
        $email = $peticion->email;
        $password = $peticion->password;

        $intentos = [
            'web' => 'email_usuario_comun',
            'entidad' => 'email_entidad_cultural',
        ];

        foreach ($intentos as $guard => $campoEmail) {

            $credenciales = [
                $campoEmail => $email,
                'password' => $password,
            ];

            if (Auth::guard($guard)->attempt($credenciales)) {
                return $guard === 'web'
                    ? redirect()->route('inicio')
                    : redirect()->route('entidad.inicio');
            }
        }

        return back()
            ->withErrors(['email' => 'Las credenciales no son correctas.'])
            ->onlyInput('email');
    }

    /**
     * Cierra la sesión del usuario autenticado en cualquiera de los guards.
     *
     * @param  \Illuminate\Http\Request  $peticion
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cerrarSesion(Request $peticion)
    {
        Auth::guard('web')->logout();
        Auth::guard('entidad')->logout();

        $peticion->session()->invalidate();
        $peticion->session()->regenerateToken();

        return redirect()->route('bienvenida');
    }
}
