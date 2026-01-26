<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para validar los datos del formulario de inicio de sesión.
 *
 * Verifica que el usuario introduzca un correo electrónico válido y una
 * contraseña antes de intentar autenticarse.
 */
class InicioSesionRequest extends FormRequest
{
    /**
     * Autoriza siempre la petición.
     *
     * La verificación de credenciales se realiza posteriormente en el controlador.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Reglas de validación para el inicio de sesión.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    /**
     * Mensajes personalizados para los errores de validación.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Introduce un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ];
    }
}
