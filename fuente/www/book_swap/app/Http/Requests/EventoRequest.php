<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventoRequest extends FormRequest
{
    public function authorize()
    {
        // La entidad autenticada siempre puede crear eventos
        return true;
    }

    public function rules()
    {
        return [
            'nombre_evento' => 'required|max:150',
            'fecha_evento' => 'required|date|after_or_equal:today',
            'descripcion_evento' => 'required|max:300',
            'ubicacion_evento' => 'required|max:150',
            'tipo_evento' => 'required|in:encuentro con autor/a,club de lectura,feria del libro',
        ];
    }

    public function messages()
    {
        return [
            'nombre_evento.required' => 'El nombre del evento es obligatorio.',
            'fecha_evento.after_or_equal' => 'La fecha debe ser hoy o posterior.',
            'tipo_evento.in' => 'El tipo de evento no es válido.',
        ];
    }
}
