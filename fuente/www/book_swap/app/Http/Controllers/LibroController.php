<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LibroController extends Controller
{
    /**
     * Muestra todos los libros publicados, con su propietario, ordenados por fecha, y los muestra en un listado paginado
     * - Consulta todos los libros de la base de datos.
     * - Carga también la información del propietario.
     * - Ordena los libros de más recientes a más antiguos.
     * - Divide el resultado en páginas de 12 libros.
     * - Saca los libros por la vista
     * 
     * @param  \App\Models\Libro  $libro
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
     * Muestra el formulario para crear un libro (crea el libro)
     * 
     * @return \Illuminate\View\View
     */ 
    public function create()
    {
        return view('formulario-alta-libro');
    }

    /**
     * GUARDAR el libro nuevo (guarda los datos)
     * - Recibe petición de formulario.
     * - Valida que los datos de entrada sean correctos.
     * - Obtiene al usuario autenticado que está creando el libro.
     * - Guarda la iamgen en el servidor.
     * 
     * @param  \App\Http\Requests\LibroRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
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
     * VER detalle de un libro
     * - Recibe un libro.
     * - Carga la relación con el propietario.
     * - Envía el libro a la vista.
     * 
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return redirect()->route('libros.index');
    }

    /**
     * FORMULARIO para editar libro (solo el propietario)
     * - Recibe el libro.
     * - Obtiene el usuario autenticado también.
     * - Comprueba que el libro pertenece al usuario.
     * - Muestra la vista de edición (el formulario).
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
     * ACTUALIZAR el libro
     * - Recibe los datos del formulario.
     * - Valida que los datos sean correctos.
     * - Obtiene al usuario autenticado.
     * - Si se cambia la imagen, la guarda en el servidor.
     * - Crea el libro en la base de datos.
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
     * ELIMINAR el libro
     * - Comprueba que el libro pertenece al usuario.
     * - Elimina la imagen del servidor.
     * - Elimina el libro de la base de datos.
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