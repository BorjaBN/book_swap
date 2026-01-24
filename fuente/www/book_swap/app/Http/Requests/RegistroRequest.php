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
            'telefono' => 'required',
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
            // Comunes
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe introducir un correo electrónico válido.',
            'email.unique' => 'Este correo ya está registrado.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',

            'telefono.required' => 'El teléfono es obligatorio.',
            'ciudad.required' => 'La ciudad es obligatoria.',

            // Usuario común
            'nombre.required' => 'El nombre es obligatorio.',
            'apellidos.required' => 'Los apellidos son obligatorios.',

            // Entidad cultural
            'nombre_entidad.required' => 'El nombre de la entidad es obligatorio.',
            'nif.required' => 'El NIF es obligatorio.',
            'nif.unique' => 'Este NIF ya está registrado.',
            'direccion.required' => 'La dirección es obligatoria.',
        ];
    }
}
