<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\UsuarioComun;
use App\Models\EntidadCultural;

class EditarUsuarioRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $usuario = $this->user();

        // -----------------------------------------
        // USUARIO COMÚN
        // -----------------------------------------
        if ($usuario instanceof UsuarioComun) {

            return [
                'nombre_usuario_comun' => 'sometimes|required|string|max:100',
                'apellidos_usuario_comun' => 'sometimes|required|string|max:100',

                'email_usuario_comun' => [
                    'sometimes',
                    'required',
                    'email',
                    'max:100',
                    Rule::unique('usuario_comun', 'email_usuario_comun')
                        ->ignore($usuario->id_usuario_comun, 'id_usuario_comun'),
                ],

                'telefono_usuario_comun' => 'sometimes|required|string|max:100',
                'ciudad_usuario_comun' => 'sometimes|required|string|max:100',

                'password' => 'nullable|min:6|confirmed',
            ];
        }

        // -----------------------------------------
        // ENTIDAD CULTURAL
        // -----------------------------------------
        if ($usuario instanceof EntidadCultural) {

            return [
                'email_entidad_cultural' => [
                    'sometimes',
                    'required',
                    'email',
                    Rule::unique('entidad_cultural', 'email_entidad_cultural')
                        ->ignore($usuario->id_entidad_cultural, 'id_entidad_cultural'),
                ],

                'password' => 'nullable|min:6',

                'telefono_entidad_cultural' => 'sometimes|required|string|max:100',
                'ciudad_entidad_cultural' => 'sometimes|required|string|max:100',

                'nombre_entidad_cultural' => 'sometimes|required|string|max:255',
                'direccion_entidad_cultural' => 'sometimes|required|string|max:255',
                'web_entidad_cultural' => 'nullable|url',
            ];
        }

        return [];
    }

    public function messages()
    {
        return [
            
            // -------------------------
            // USUARIO COMÚN
            // -------------------------
            'nombre_usuario_comun.required' => 'El nombre es obligatorio.',
            'apellidos_usuario_comun.required' => 'Los apellidos son obligatorios.',

            'email_usuario_comun.required' => 'El email es obligatorio.',
            'email_usuario_comun.email' => 'El email no es válido.',
            'email_usuario_comun.unique' => 'Este email ya está registrado.',

            'telefono_usuario_comun.required' => 'El teléfono es obligatorio.',
            'ciudad_usuario_comun.required' => 'La ciudad es obligatoria.',

            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',

            // -------------------------
            // ENTIDAD CULTURAL
            // -------------------------
            'email_entidad_cultural.required' => 'El correo electrónico es obligatorio.',
            'email_entidad_cultural.email' => 'Debe introducir un correo electrónico válido.',
            'email_entidad_cultural.unique' => 'Este correo ya está registrado.',

            'telefono_entidad_cultural.required' => 'El teléfono es obligatorio.',
            'ciudad_entidad_cultural.required' => 'La ciudad es obligatoria.',

            'nombre_entidad_cultural.required' => 'El nombre de la entidad es obligatorio.',
            'direccion_entidad_cultural.required' => 'La dirección es obligatoria.',
            'web_entidad_cultural.url' => 'Debe introducir una URL válida.',
        ];
    }
}
