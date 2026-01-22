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
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo_libro' => 'required|max:150',
            'autor_libro' => 'required|max:150',
            'ISBN' => 'required|max:20|unique:libro,ISBN',
            'estado_libro' => 'required|in:nuevo,seminuevo,usado',
            'genero_libro' => 'nullable|string|max:150',
            'fecha_publicacion_libro' => 'nullable|date',
            'imagen_libro' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = Auth::guard('web')->user();

        // Guarda la imagen y obtiene la ruta relativa (libros/xxxxxx.jpg)
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
     */
    public function show(Libro $libro)
    {
        
        $libro->load('propietario');

        return view('libros.show', compact('libro'));
    }

    /**
     * FORMULARIO para editar libro (solo el propietario)
     * - Recibe el libro.
     * - Obtiene el usuario autenticado también.
     * - Comprueba que el libro pertenece al usuario.
     * - Muestra la vista de edición (el formulario).
     */ 
    public function edit(Libro $libro)
    {
        $user = Auth::guard('web')->user();

        if ($libro->id_usuario_comun !== $user->id_usuario_comun) {
            abort(403, 'No puedes editar este libro');
        }

        return view('libros.edit', compact('libro'));
    }

    /**
     * ACTUALIZAR el libro
     * - Recibe los datos del formulario.
     * - Valida que los datos sean correctos.
     * - Obtiene al usuario autenticado.
     * - Si se cambia la imagen, la guarda en el servidor.
     * - Crea el libro en la base de datos.
     */  
    public function update(Request $request, Libro $libro)
    {
        $user = Auth::guard('web')->user();
 
        if ($libro->id_usuario_comun !== $user->id_usuario_comun) {
            abort(403, 'No puedes editar este libro');
        }
 
        $validated = $request->validate([
            'titulo_libro' => 'required|max:150',
            'autor_libro' => 'required|max:150',
            'ISBN' => 'required|max:20|unique:libro,ISBN,' . $libro->id_libro . ',id_libro',
            'estado_libro' => 'required|in:nuevo,seminuevo,usado',
            'genero_libro' => 'nullable|string|max:150',
            'fecha_publicacion_libro' => 'nullable|date',
            'imagen_libro' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

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
     */
    public function destroy(Libro $libro)
    {
        $user = Auth::guard('web')->user();
 
        if ($libro->id_usuario_comun !== $user->id_usuario_comun) {
            abort(403, 'No puedes eliminar este libro');
        }

        if ($libro->imagen_libro && Storage::disk('public')->exists($libro->imagen_libro)) {
            Storage::disk('public')->delete($libro->imagen_libro); 
        }

        $libro->delete();

        return redirect()
            ->route('libros.index')
            ->with('success', 'Libro eliminado corréctamente.');
    }

   
}