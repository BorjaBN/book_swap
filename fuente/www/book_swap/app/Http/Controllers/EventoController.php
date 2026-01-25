<?php

namespace App\Http\Controllers;

use App\Models\EventoCultural;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EventoRequest;


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

        return view('eventos', compact('eventos'));
    }

    /**
     * Muestra el formulario para crear un evento (crea el evento)
     */
    public function create()
    {
        return view('formulario-alta-evento');
    }

    /**
     * GUARDAR el evento nuevo (guarda los datos)
     * - Recibe petición de formulario.
     * - Valida que los datos de entrada sean correctos.
     * - Obtiene al entidad cultural autenticada que está creando el evento.
     * - Crea el evento asociandolo a la entidad.
     */
    public function store(EventoRequest $request)
    {
        $validated = $request->validated(); 
        $entidad = Auth::guard('entidad')->user();
        $entidad->eventos()->create($validated);

        return redirect() 
            ->route('entidad.inicio') 
            ->with('success', 'Evento publicado correctamente.');
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
    
        return view('formulario-editar-evento', compact('evento'));
    }

    /**
     * ACTUALIZAR el evento
     * - Recibe los datos del formulario.
     * - Obtiene a la entidad cultural autenticada.
     * - Verific que el evento pertenece a esa entidad.
     * - Valida que los datos sean correctos.
     * - Actualiza el evento en la base de datos.
     */
    public function update(EventoRequest $request, EventoCultural $evento)
    {
        // Validación flexible para edición
        $validated = $request->validate([
            'nombre_evento' => 'nullable|max:150',
            'fecha_evento' => 'nullable|date',
            'descripcion_evento' => 'nullable|max:300',
            'ubicacion_evento' => 'nullable|max:150',
            'tipo_evento' => 'nullable|in:encuentro con autor/a,club de lectura,feria del libro',
        ]);

        // Evitar que los campos vacíos borren los datos existentes
        foreach ($validated as $campo => $valor) {
            if ($valor === null || $valor === '') {
                unset($validated[$campo]); // No actualizar ese campo
            }
        }

        // Actualizar solo los campos modificados
        $evento->update($validated);

        return redirect()
            ->route('entidad.inicio')
            ->with('success', 'Evento actualizado correctamente.');
    }


    /**
     * ELIMINAR el evento
     * - Recibe el evento.
     * - Comprueba que el evento pertenece a la entidad cultural creadora de dicho evento.
     * - Elimina el evento de la base de datos.
     */
    public function destroy(EventoCultural $evento)
    {
        

        $evento->delete();

        return redirect()
            ->route('entidad.inicio')
            ->with('success', 'Evento eliminado correctamente');
    }
}
