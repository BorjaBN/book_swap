<?php

namespace App\Http\Controllers;

use App\Models\EventoCultural;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    /**
     * Muestra todos los eventos publicados, con su propietario, ordenados por fecha, y los muestra en un listado paginado
     * - Consulta todos los eventos de la base de datos.
     * - Filtra los eventos para mostrar solo los futuros o del día actual.
     * - Ordena los eventos por fecha.
     * - Divide el resultado en páginas de 9 eventos.
     * - Saca los eventos por la vista
     */ 
    public function index()
    {
        $eventos = EventoCultural::with('entidad')
            ->where('fecha_evento', '>=', now()->toDateString())
            ->orderBy('fecha_evento')
            ->paginate(9);

        return view('eventos.index', compact('eventos'));
    }

    /**
     * Muestra el formulario para crear un evento (crea el evento)
     */
    public function create()
    {
        return view('eventos.create');
    }

    /**
     * GUARDAR el evento nuevo (guarda los datos)
     * - Recibe petición de formulario.
     * - Valida que los datos de entrada sean correctos.
     * - Obtiene al entidad cultural autenticada que está creando el evento.
     * - Crea el evento asociandolo a la entidad.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_evento' => 'required|max:150',
            'fecha_evento' => 'required|date|after:today',
            'descripcion_evento' => 'required',
            'ubicacion_evento' => 'required|max:150',
            'tipo_evento' => 'required|in:encuentro con autor/a,club de lectura,feria del libro',
        ]);

        $entidad = Auth::guard('entidad')->user();

        $entidad->eventos()->create($validated);

        return redirect()
            ->route('eventos.index')
            ->with('success', '¡Evento publicado exitosamente!');
    }

    /**
     * VER detalle de un evento
     * - Recibe un evento.
     * - Carga la relación con entidad que lo "organiza".
     * - Envía el evento a la vista.
     */
    public function show(EventoCultural $evento)
    {
        $evento->load('entidad');

        return view('eventos.show', compact('evento'));
    }

    /**
     * FORMULARIO para editar evento (solo el propietario)
     * - Recibe el evento.
     * - Obtiene la entidad cultural autenticada también.
     * - Comprueba que el evento pertenece a la entidad cultural.
     * - Muestra la vista de edición (el formulario).
     */
    public function edit(EventoCultural $evento)
    {
        $entidad = Auth::guard('entidad')->user();

        if ($evento->id_entidad_cultural !== $entidad->id_entidad_cultural) {
            abort(403, 'No puedes editar este evento');
        }

        return view('eventos.edit', compact('evento'));
    }

    /**
     * ACTUALIZAR el evento
     * - Recibe los datos del formulario.
     * - Obtiene a la entidad cultural autenticada.
     * - Verific que el evento pertenece a esa entidad.
     * - Valida que los datos sean correctos.
     * - Actualiza el evento en la base de datos.
     */
    public function update(Request $request, EventoCultural $evento)
    {
        $entidad = Auth::guard('entidad')->user();

        if ($evento->id_entidad_cultural !== $entidad->id_entidad_cultural) {
            abort(403, 'No puedes editar este evento');
        }

        $validated = $request->validate([ 
            'nombre_evento' => 'required|max:150',
            'fecha_evento' => 'required|date',
            'descripcion_evento' => 'required',
            'ubicacion_evento' => 'required|max:150',
            'tipo_evento' => 'required|in:encuentro con autor/a,club de lectura,feria del libro',
        ]);

        $evento->update($validated);

        return redirect()
            ->route('eventos.show', $evento)
            ->with('success', 'Evento actualizado');
    }

    /**
     * ELIMINAR el evento
     * - Recibe el evento.
     * - Comprueba que el evento pertenece a la entidad cultural creadora de dicho evento.
     * - Elimina el evento de la base de datos.
     */
    public function destroy(EventoCultural $evento)
    {
        $entidad = Auth::guard('entidad')->user();

        if ($evento->id_entidad_cultural !== $entidad->id_entidad_cultural) {
            abort(403, 'No puedes eliminar este evento');
        }

        $evento->delete();

        return redirect()
            ->route('eventos.index')
            ->with('success', 'Evento eliminado');
    }
}

