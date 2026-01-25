<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventoRequest extends FormRequest
{
    public function authorize()
    {
        // La entidad autenticada siempre puede crear eventos
        return true;
    }

    public function rules()
    {
        $evento = $this->route('evento'); // null en alta, objeto en edición

        return [
            'nombre_evento' => $evento ? 'nullable|max:150' : 'required|max:150',
            'fecha_evento' => $evento ? 'nullable|date' : 'required|date|after_or_equal:today',
            'descripcion_evento' => $evento ? 'nullable|max:300' : 'required|max:300',
            'ubicacion_evento' => $evento ? 'nullable|max:150' : 'required|max:150',
            'tipo_evento' => $evento
                ? 'nullable|in:encuentro con autor/a,club de lectura,feria del libro'
                : 'required|in:encuentro con autor/a,club de lectura,feria del libro',
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