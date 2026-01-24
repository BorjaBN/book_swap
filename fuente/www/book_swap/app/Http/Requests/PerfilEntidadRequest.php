<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PerfilEntidadRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // Entidad autenticada
        $entidad = $this->user('entidad');

        // Reglas comunes (igual filosofía que RegistroRequest)
        $rules = [
            'email_entidad_cultural' => [
                'required',
                'email',
                Rule::unique('entidad_cultural', 'email_entidad_cultural')
                    ->ignore($entidad->id_entidad_cultural, 'id_entidad_cultural'),
            ],

            'password' => 'nullable|min:6',

            'telefono_entidad_cultural' => 'required',
            'ciudad_entidad_cultural' => 'required',
        ];

        // Reglas específicas de entidad (igual que RegistroRequest)
        $rules = array_merge($rules, [
            'nombre_entidad_cultural' => 'required',
            'direccion_entidad_cultural' => 'required',
            'web_entidad_cultural' => 'nullable',
        ]);

        return $rules;
    }

    public function messages()
    {
        return [
            // Comunes
            'email_entidad_cultural.required' => 'El correo electrónico es obligatorio.',
            'email_entidad_cultural.email' => 'Debe introducir un correo electrónico válido.',
            'email_entidad_cultural.unique' => 'Este correo ya está registrado.',

            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',

            'telefono_entidad_cultural.required' => 'El teléfono es obligatorio.',
            'ciudad_entidad_cultural.required' => 'La ciudad es obligatoria.',

            // Específicos de entidad
            'nombre_entidad_cultural.required' => 'El nombre de la entidad es obligatorio.',
            'direccion_entidad_cultural.required' => 'La dirección es obligatoria.',
        ];
    }
}
