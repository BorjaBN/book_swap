<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PerfilUsuarioComunRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        $usuario = $this->user('web'); // usuario autenticado

        return [
            'nombre_usuario_comun' => 'required|string|max:100',
            'apellidos_usuario_comun' => 'required|string|max:100',

            'email_usuario_comun' => [
                'required',
                'email',
                'max:100',
                Rule::unique('usuario_comun', 'email_usuario_comun')
                    ->ignore($usuario->id_usuario_comun, 'id_usuario_comun'),
            ],

            'telefono_usuario_comun' => 'required|string|max:100',
            'ciudad_usuario_comun' => 'required|string|max:100',

            // Contraseña opcional (ya me diras que te parece)
            'password' => 'nullable|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'nombre_usuario_comun.required' => 'El nombre es obligatorio.',
            'apellidos_usuario_comun.required' => 'Los apellidos son obligatorios.',

            'email_usuario_comun.required' => 'El email es obligatorio.',
            'email_usuario_comun.email' => 'El email no es válido.',
            'email_usuario_comun.unique' => 'Este email ya está registrado.',

            'telefono_usuario_comun.required' => 'El teléfono es obligatorio.',
            'ciudad_usuario_comun.required' => 'La ciudad es obligatoria.',

            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ];
    }
}
