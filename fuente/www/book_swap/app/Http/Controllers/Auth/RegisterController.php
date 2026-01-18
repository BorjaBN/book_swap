<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UsuarioComun;
use App\Models\EntidadCultural;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Mostrar formulario de registro
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Procesar el registro
    public function register(Request $request)
    {
        // Validación
        $request->validate([
            'tipo_usuario' => 'required|in:usuario,entidad',
            'email' => 'required|email',
            'password' => 'required|min: 6|confirmed',
            'telefono' => 'required',
            'ciudad' => 'required',
        ]);

        // ¿Es usuario común? 
        if ($request->tipo_usuario === 'usuario') {
            $request->validate([
                'nombre' => 'required',
                'apellidos' => 'required',
                'email' => 'unique:usuario_comun,email_usuario_comun',
            ]);

            $user = UsuarioComun:: create([
                'nombre_usuario_comun' => $request->nombre,
                'apellidos_usuario_comun' => $request->apellidos,
                'email_usuario_comun' => $request->email,
                'pass_usuario_comun' => Hash::make($request->password),
                'telefono_usuario_comun' => $request->telefono,
                'ciudad_usuario_comun' => $request->ciudad,
            ]);

            Auth::guard('web')->login($user);
        } 
        // ¿Es entidad cultural?
        else {
            $request->validate([
                'nombre_entidad' => 'required',
                'email' => 'unique:entidad_cultural,email_entidad_cultural',
                'nif' => 'required|unique:entidad_cultural,nif_entidad_cultural',
                'direccion' => 'required',
            ]);

            $entidad = EntidadCultural::create([
                'nombre_entidad_cultural' => $request->nombre_entidad,
                'email_entidad_cultural' => $request->email,
                'pass_entidad_cultural' => Hash::make($request->password),
                'telefono_entidad_cultural' => $request->telefono,
                'ciudad_entidad_cultural' => $request->ciudad,
                'nif_entidad_cultural' => $request->nif,
                'direccion_entidad_cultural' => $request->direccion,
                'web_entidad_cultural' => $request->web ?? null,
            ]);

            Auth::guard('entidad')->login($entidad);
        }

        return redirect('/dashboard');
    }
}