<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request para validar la creación y edición de libros.
 *
 * Detecta automáticamente si la petición corresponde a un alta o a una edición
 * comprobando si existe un modelo Libro en la ruta. En función de ello, aplica
 * reglas más estrictas (required) o más flexibles (nullable), especialmente
 * para la imagen y el ISBN.
 */
class LibroRequest extends FormRequest
{
    /**
     * Autoriza siempre la petición.
     *
     * La verificación de permisos se realiza en el controlador mediante policies.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Reglas de validación para creación y edición de libros.
     *
     * Si la ruta contiene un modelo Libro, se interpreta como edición y la imagen
     * pasa a ser opcional. También se permite mantener el mismo ISBN ignorando
     * el del propio libro.
     *
     * @return array
     */
    public function rules()
    {
        $libro = $this->route('libro'); // null en alta, Libro en edición
        $libroId = $libro->id_libro ?? null;


        return [
            'titulo_libro' => 'required|string|max:150',
            'autor_libro' => 'required|string|max:150',

            'ISBN' => [
                'required',
                'string',
                'max:20',
                'unique:libro,ISBN',
                'regex:/^(?:\d[\d\- ]{8,12}[\dX])$/i'
            ],

            'estado_libro' => 'required|in:nuevo,seminuevo,usado',
            'genero_libro' => 'nullable|string|max:150',
            'fecha_publicacion_libro' => 'required|date',

            'imagen_libro' => 'nullable|image|max:2048',
            'imagen_url' => 'nullable|url',
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
            'titulo_libro.required' => 'El título del libro es obligatorio.',
            'titulo_libro.max' => 'El título no puede superar los 150 caracteres.',

            'autor_libro.required' => 'El autor del libro es obligatorio.',
            'autor_libro.max' => 'El nombre del autor no puede superar los 150 caracteres.',

            'ISBN.required' => 'El ISBN es obligatorio.',
            'ISBN.max' => 'El ISBN no puede superar los 20 caracteres.',
            'ISBN.unique' => 'Este ISBN ya está registrado en la base de datos.',
            'ISBN.regex' => 'El ISBN debe ser un ISBN-10 o ISBN-13 válido.',


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

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->hasFile('imagen_libro') && !$this->imagen_url) {
                $validator->errors()->add('imagen_libro', 'Debes subir una imagen o proporcionar una URL.');
            }
        });
    }

}
