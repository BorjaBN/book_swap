<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Http\Requests\LibroRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LibroController extends Controller
{
    /**
     * Muestra un listado paginado de libros publicados.
     *
     * Carga la relación con el propietario, ordena los libros por fecha
     * descendente y los divide en páginas de 12 elementos.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $libros = Libro::with('propietario')
            ->latest()
            ->paginate(12);

        return view('libros', compact('libros'));
    }

    /**
     * Muestra el formulario para crear un nuevo libro.
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
     * Valida los datos mediante LibroRequest, asigna el propietario
     * autenticado y almacena la imagen en el disco público.
     *
     * @param  \App\Http\Requests\LibroRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LibroRequest $request)
    {
        $validated = $request->validated();

        $user = Auth::guard('web')->user();

        $rutaImagen = $request->file('imagen_libro')->store('libros', 'public');

        $validated['imagen_libro'] = $rutaImagen;
        $validated['id_usuario_comun'] = $user->id_usuario_comun;

        Libro::create($validated);

        return redirect()
            ->route('libros.index')
            ->with('success', 'Libro registrado correctamente.');
    }

    /**
     * Muestra el detalle de un libro concreto. Redirige a la vista principal de los libros.
     *
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return redirect()->route('libros.index');
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
     * Valida los datos mediante LibroRequest, verifica permisos con
     * LibroPolicy y actualiza la imagen si se ha modificado.
     *
     * @param  \App\Http\Requests\LibroRequest  $request
     * @param  \App\Models\Libro                $libro
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(LibroRequest $request, Libro $libro)
    {
        $this->authorize('update', $libro);

        $validated = $request->validated();

        if ($request->hasFile('imagen_libro')) {

            if ($libro->imagen_libro && Storage::disk('public')->exists($libro->imagen_libro)) {
                Storage::disk('public')->delete($libro->imagen_libro);
            }

            $rutaImagen = $request->file('imagen_libro')->store('libros', 'public');
            $validated['imagen_libro'] = $rutaImagen;
        }

        $libro->update($validated);

        return redirect()
            ->route('libros.index')
            ->with('success', 'Libro actualizado correctamente.');
    }

    /**
     * Elimina un libro de la base de datos.
     *
     * Solo el propietario puede eliminarlo. Se elimina también la imagen
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
            ->route('libros.index')
            ->with('success', 'Libro eliminado correctamente.');
    }
}
