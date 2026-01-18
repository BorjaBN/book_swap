<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\InicioSesionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InicioSesionControlador extends Controller
{
    // Mostrar el formulario de login
    public function mostrarFormulario()
    {
        return view('formulario-inicio-sesion');
    }

    // Procesar el inicio de sesión
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
                $peticion->session()->regenerate();
                return redirect()->intended('inicio');
            }
        }

        return back()
            ->withErrors(['email' => 'Las credenciales no son correctas.'])
            ->onlyInput('email');
    }





    // Cerrar sesión
    public function cerrarSesion(Request $request)
    {
        Auth::guard('web')->logout();
        Auth::guard('entidad')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}