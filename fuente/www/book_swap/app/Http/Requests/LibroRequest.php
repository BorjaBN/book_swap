<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // Detectar si estamos editando (update)
        // En rutas tipo eventos/{evento}, Laravel inyecta el modelo
        $evento = $this->route('evento'); // null en alta, EventoCultural en edición
        $eventoId = $evento->id_evento ?? null;

        return [
            'nombre_evento' => 'required|max:150',

            // En edición no exigimos que la fecha sea >= hoy (puede estar ya pasada)
            'fecha_evento' => $eventoId
                ? 'required|date'
                : 'required|date|after_or_equal:today',

            'descripcion_evento' => 'required|max:300',
            'ubicacion_evento' => 'required|max:150',

            'tipo_evento' => 'required|in:encuentro con autor/a,club de lectura,feria del libro',
        ];
    }

    public function messages()
    {
        return [
            'nombre_evento.required' => 'El nombre del evento es obligatorio.',
            'nombre_evento.max' => 'El nombre no puede superar los 150 caracteres.',

            'fecha_evento.required' => 'La fecha del evento es obligatoria.',
            'fecha_evento.date' => 'La fecha no es válida.',
            'fecha_evento.after_or_equal' => 'La fecha debe ser hoy o posterior.',

            'descripcion_evento.required' => 'La descripción es obligatoria.',
            'descripcion_evento.max' => 'La descripción no puede superar los 300 caracteres.',

            'ubicacion_evento.required' => 'La ubicación es obligatoria.',
            'ubicacion_evento.max' => 'La ubicación no puede superar los 150 caracteres.',

            'tipo_evento.required' => 'Debes seleccionar un tipo de evento.',
            'tipo_evento.in' => 'El tipo de evento seleccionado no es válido.',
        ];
    }
}
