<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LibroRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        // Detectar si estamos editando (update)
        $libro = $this->route('libro'); // null en alta, Libro en edición
        $libroId = $libro->id_libro ?? null;

        return [
            'titulo_libro' => 'required|max:150',
            'autor_libro' => 'required|max:150',

            // ISBN único excepto para el propio libro en edición
            'ISBN' => 'required|max:20|unique:libro,ISBN,' . $libroId . ',id_libro',

            'estado_libro' => 'required|in:nuevo,seminuevo,usado',
            'genero_libro' => 'nullable|string|max:150',
            'fecha_publicacion_libro' => 'nullable|date',

            // Imagen obligatoria solo en alta
            'imagen_libro' => $libroId
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }


    public function messages()
    {
        return [
            'titulo_libro.required' => 'El título del libro es obligatorio.',
            'titulo_libro.max' => 'El título no puede superar los 150 caracteres.',

            'autor_libro.required' => 'El autor del libro es obligatorio.',
            'autor_libro.max' => 'El nombre del autor no puede superar los 150 caracteres.',

            'ISBN.required' => 'El ISBN es obligatorio.',
            'ISBN.max' => 'El ISBN no puede superar los 20 caracteres.',
            'ISBN.unique' => 'Este ISBN ya está registrado en la base de datos.',

            'estado_libro.required' => 'Debes seleccionar el estado del libro.',
            'estado_libro.in' => 'El estado seleccionado no es válido.',

            'genero_libro.string' => 'El género debe ser un texto válido.',
            'genero_libro.max' => 'El género no puede superar los 150 caracteres.',

            'fecha_publicacion_libro.date' => 'La fecha de publicación no es válida.',

            'imagen_libro.required' => 'La imagen del libro es obligatoria.',
            'imagen_libro.image' => 'El archivo debe ser una imagen.',
            'imagen_libro.mimes' => 'La imagen debe ser de tipo JPG, JPEG, PNG o WEBP.',
            'imagen_libro.max' => 'La imagen no puede superar los 2 MB.',
        ];
    }

}
