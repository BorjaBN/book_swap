<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para validar el registro de usuarios comunes
 * y entidades culturales.
 *
 * Aplica reglas comunes a ambos tipos de usuario y, según el valor
 * de "tipo_usuario", añade las validaciones específicas para cada caso.
 */
class RegistroRequest extends FormRequest
{
    /**
     * Autoriza siempre la petición.
     *
     * La verificación de permisos no es necesaria en el registro.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Reglas de validación para el registro.
     *
     * Incluye reglas comunes y reglas específicas según el tipo de usuario:
     * - Usuario común: nombre, apellidos y email único en usuario_comun.
     * - Entidad cultural: nombre de entidad, NIF único y email único en entidad_cultural.
     *
     * @return array
     */
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

    /**
     * Mensajes personalizados para los errores de validación.
     *
     * Incluye mensajes comunes y específicos para cada tipo de usuario.
     *
     * @return array
     */
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
