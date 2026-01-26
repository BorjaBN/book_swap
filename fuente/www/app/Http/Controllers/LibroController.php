<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Http\Requests\LibroRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * Controlador para gestionar el catálogo de libros publicados
 * por los usuarios comunes.
 */
class LibroController extends Controller
{
    /**
     * Carga la relación con el propietario, filtra por libros en estado "libre",
     * los ordena por fecha descendente y los divide en páginas de 12 elementos.
     *
     *  @return \Illuminate\View\View
     */
    public function index()
    {
        $libros = Libro::with('propietario')
            ->where('estado_intercambio', 'libre')
            ->latest()
            ->paginate(12);

        return view('catalogo', compact('libros'));
    }

    /**
     * Muestra el formulario para registrar un nuevo libro.
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('formulario-alta-libro');
    }

    /**
     * Guarda un nuevo libro en la base de datos.
     *
     * Valida los datos mediante LibroRequest, asigna el propietario autenticado
     * y almacena la imagen en el disco público.
     *
     * @param  \App\Http\Requests\LibroRequest  $peticion
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LibroRequest $peticion)
    {
        $datosValidados = $peticion->validated();
        $user = Auth::guard('web')->user();

        if ($peticion->hasFile('imagen_libro')) {
            $rutaImagen = $peticion->file('imagen_libro')->store('libros', 'public');
            $datosValidados['imagen_libro'] = $rutaImagen;

        } elseif ($peticion->imagen_url) {
            $datosValidados['imagen_libro'] = $peticion->imagen_url;
        }

        $datosValidados['id_usuario_comun'] = $user->id_usuario_comun;

        Libro::create($datosValidados);

        return redirect()
            ->route('libros.index')
            ->with('success', 'Libro registrado correctamente.');
    }

    /**
     * Muestra el formulario de edición de un libro.
     *
     * Solo el propietario del libro puede acceder a esta vista.
     * La autorización se gestiona mediante LibroPolicy.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\View\View
     */
    public function edit(Libro $libro)
    {
        $this->authorize('update', $libro);

        return view('formulario-editar-libro', compact('libro'));
    }

    /**
     * Actualiza un libro existente.
     *
     * Valida los datos mediante LibroRequest, verifica permisos con LibroPolicy
     * y actualiza la imagen si se ha modificado.
     *
     * @param  \App\Http\Requests\LibroRequest  $peticion
     * @param  \App\Models\Libro                $libro
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(LibroRequest $peticion, Libro $libro)
    {
        $this->authorize('update', $libro);

        $datosValidados = $peticion->validated();

        if ($peticion->hasFile('imagen_libro')) {

            if ($libro->imagen_libro && Storage::disk('public')->exists($libro->imagen_libro)) {
                Storage::disk('public')->delete($libro->imagen_libro);
            }

            $rutaImagen = $peticion->file('imagen_libro')->store('libros', 'public');
            $datosValidados['imagen_libro'] = $rutaImagen;

        } elseif ($peticion->imagen_url) {

            if ($libro->imagen_libro && Storage::disk('public')->exists($libro->imagen_libro)) {
                Storage::disk('public')->delete($libro->imagen_libro);
            }

            $datosValidados['imagen_libro'] = $peticion->imagen_url;
        }

        $libro->update($datosValidados);

        return redirect()
            ->route('usuarioComun.show', auth('web')->user()->id_usuario_comun)
            ->with('success', 'Libro actualizado correctamente.');
    }

    /**
     * Elimina un libro de la base de datos.
     * 
     * Solo el propietario puede eliminarlo. También se elimina la imagen
     * asociada del almacenamiento público.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Libro $libro)
    {
        $this->authorize('delete', $libro);

        if ($libro->imagen_libro && Storage::disk('public')->exists($libro->imagen_libro)) {
            Storage::disk('public')->delete($libro->imagen_libro);
        }

        $libro->delete();

        return redirect()
            ->route('usuarioComun.show', auth('web')->user()->id_usuario_comun)
            ->with('success', 'Libro eliminado correctamente.');
    }
}
