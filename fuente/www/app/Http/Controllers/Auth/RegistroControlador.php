<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UsuarioComun;
use App\Models\EntidadCultural;
use App\Http\Requests\RegistroRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Controlador encargado de gestionar el registro
 * de usuarios comunes y entidades culturales.
 */
class RegistroControlador extends Controller
{
    /**
     * Muestra el formulario de registro según el tipo de usuario.
     *
     * @param  string  $tipo  Tipo de usuario: 'comun' o 'entidad'
     * @return \Illuminate\View\View
     */
    public function mostrarFormulario($tipo)
    {
        $titulo = $tipo === 'comun'
            ? 'Registro de usuario común'
            : 'Registro de entidad cultural';

        return view('formulario-registro', compact('tipo', 'titulo'));
    }

    /**
     * Muestra la vista donde el usuario elige el tipo de registro.
     *
     * @return \Illuminate\View\View
     */
    public function mostrarDecisionRegistro()
    {
        return view('decision-registro');
    }

    /**
     * Procesa el registro de un usuario común o una entidad cultural.
     *
     * @param  \App\Http\Requests\RegistroRequest  $peticion
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registrar(RegistroRequest $peticion)
    {
        $datosValidados = $peticion->validated();

        if ($datosValidados['tipo_usuario'] === 'comun') {

            $user = UsuarioComun::create([
                'nombre_usuario_comun' => $datosValidados['nombre'],
                'apellidos_usuario_comun' => $datosValidados['apellidos'],
                'email_usuario_comun' => $datosValidados['email'],
                'password' => Hash::make($datosValidados['password']),
                'telefono_usuario_comun' => $datosValidados['telefono'],
                'ciudad_usuario_comun' => $datosValidados['ciudad'],
            ]);

            Auth::guard('web')->login($user);

            return redirect()->route('inicio');
        }

        $entidad = EntidadCultural::create([
            'nombre_entidad_cultural' => $datosValidados['nombre_entidad'],
            'email_entidad_cultural' => $datosValidados['email'],
            'password' => Hash::make($datosValidados['password']),
            'telefono_entidad_cultural' => $datosValidados['telefono'],
            'ciudad_entidad_cultural' => $datosValidados['ciudad'],
            'nif_entidad_cultural' => $datosValidados['nif'],
            'direccion_entidad_cultural' => $datosValidados['direccion'],
            'web_entidad_cultural' => $datosValidados['web'],
        ]);

        Auth::guard('entidad')->login($entidad);

        return redirect()->route('entidad.inicio');
    }
}
