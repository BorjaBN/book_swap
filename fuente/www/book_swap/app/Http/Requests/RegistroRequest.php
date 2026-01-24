<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // Reglas comunes
        $rules = [
            'tipo_usuario' => 'required|in:comun,entidad',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'telefono' => ['required', 'regex:/^(6|7|8|9)[0-9]{8}$/'],
            'ciudad' => 'required',
        ];

        // Usuario común
        if ($this->tipo_usuario === 'comun') {
            $rules = array_merge($rules, [
                'nombre' => 'required',
                'apellidos' => 'required',
                'email' => 'unique:usuario_comun,email_usuario_comun',
            ]);
        }

        // Entidad cultural
        if ($this->tipo_usuario === 'entidad') {
            $rules = array_merge($rules, [
                'nombre_entidad' => 'required',
                'email' => 'unique:entidad_cultural,email_entidad_cultural',
                'nif' => 'required|unique:entidad_cultural,nif_entidad_cultural',
                'direccion' => 'required',
            ]);
        }

        return $rules;
    }

    public function messages()
    {
        return [
            /* -------------------------
             * VALIDACIONES COMUNES
             * ------------------------- */

            'tipo_usuario.required' => 'Debe seleccionar un tipo de usuario.',
            'tipo_usuario.in' => 'El tipo de usuario seleccionado no es válido.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe introducir un correo electrónico válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',

            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.regex' => 'El teléfono debe tener 9 dígitos y comenzar por 6, 7, 8 o 9.',

            'ciudad.required' => 'La ciudad es obligatoria.',


            /* -------------------------
             * USUARIO COMÚN
             * ------------------------- */

            'nombre.required' => 'El nombre es obligatorio.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'email.unique' => 'Este correo ya está registrado como usuario común.',


            /* -------------------------
             * ENTIDAD CULTURAL
             * ------------------------- */

            'nombre_entidad.required' => 'El nombre de la entidad es obligatorio.',

            'nif.required' => 'El NIF es obligatorio.',
            'nif.unique' => 'Este NIF ya está registrado.',

            'direccion.required' => 'La dirección es obligatoria.',
        ];
    }
}
