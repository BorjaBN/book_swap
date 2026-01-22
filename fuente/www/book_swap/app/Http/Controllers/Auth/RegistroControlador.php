<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UsuarioComun;
use App\Models\EntidadCultural;
use App\Http\Requests\RegistroRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistroControlador extends Controller
{
    // Mostrar formulario de registro
    public function mostrarFormulario($tipo)
    {
        $titulo = $tipo === 'comun'
        ? 'Registro de usuario común'
        : 'Registro de entidad cultural';


        return view('formulario-registro', compact('tipo', 'titulo'));
    }

    // Mostrar formulario de registro
    public function mostrarDecisionRegistro()
    {
        return view('decision-registro');
    }


    // Procesar el registro
    public function registrar(RegistroRequest $peticion)
    {
        // Ya viene validado automáticamente

        if ($peticion->tipo_usuario === 'comun') {

            $user = UsuarioComun::create([
                'nombre_usuario_comun' => $peticion->nombre,
                'apellidos_usuario_comun' => $peticion->apellidos,
                'email_usuario_comun' => $peticion->email,
                'password' => Hash::make($peticion->password),
                'telefono_usuario_comun' => $peticion->telefono,
                'ciudad_usuario_comun' => $peticion->ciudad,
            ]);

            Auth::guard('web')->login($user);
        }

        else {

            $entidad = EntidadCultural::create([
                'nombre_entidad_cultural' => $peticion->nombre_entidad,
                'email_entidad_cultural' => $peticion->email,
                'password' => Hash::make($peticion->password),
                'telefono_entidad_cultural' => $peticion->telefono,
                'ciudad_entidad_cultural' => $peticion->ciudad,
                'nif_entidad_cultural' => $peticion->nif,
                'direccion_entidad_cultural' => $peticion->direccion,
                'web_entidad_cultural' => $peticion->web,
            ]);

            Auth::guard('entidad')->login($entidad);
        }

        return redirect('inicio');
    }

}