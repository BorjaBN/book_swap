<?php

namespace App\Http\Controllers;

use App\Models\EventoCultural;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EventoRequest;

/**
 * Controlador para gestionar los eventos culturales publicados por las entidades.
 */
class EventoController extends Controller
{
    /**
     * Muestra un listado paginado de los eventos futuros o del día actual.
     *
     * Obtiene los eventos con la entidad cultural organizadora, los ordena por fecha
     * y los divide en páginas de 9 elementos.
     *
     * @return \Illuminate\View\View
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
     * Muestra el formulario para crear un nuevo evento.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('formulario-alta-evento');
    }

    /**
     * Guarda un nuevo evento asociado a la entidad cultural autenticada.
     *
     * @param  \App\Http\Requests\EventoRequest  $peticion
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EventoRequest $peticion)
    {
        $datosValidados = $peticion->validated();
        $entidad = Auth::guard('entidad')->user();

        $entidad->eventos()->create($datosValidados);

        return redirect()
            ->route('entidad.inicio')
            ->with('success', 'Evento publicado correctamente.');
    }

    /**
     * Muestra el detalle de un evento.
     *
     * @param  \App\Models\EventoCultural  $evento
     * @return \Illuminate\View\View
     */
    public function show(EventoCultural $evento)
    {
        $evento->load('entidad');

        return view('eventos.show', compact('evento'));
    }

    /**
     * Muestra el formulario para editar un evento.
     *
     * @param  \App\Models\EventoCultural  $evento
     * @return \Illuminate\View\View
     */
    public function edit(EventoCultural $evento)
    {
        return view('formulario-editar-evento', compact('evento'));
    }

    /**
     * Actualiza los datos de un evento existente.
     *
     * Solo se actualizan los campos que hayan sido modificados y no estén vacíos.
     *
     * @param  \App\Http\Requests\EventoRequest  $request
     * @param  \App\Models\EventoCultural  $evento
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EventoRequest $peticion, EventoCultural $evento)
    {
        $datosValidados = $peticion->validated();

        foreach ($datosValidados as $campo => $valor) {
            if ($valor === null || $valor === '') {
                unset($datosValidados[$campo]);
            }
        }

        $evento->update($datosValidados);

        return redirect()
            ->route('entidad.inicio')
            ->with('success', 'Evento actualizado correctamente.');
    }


    /**
     * Elimina un evento de la base de datos.
     *
     * @param  \App\Models\EventoCultural  $evento
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(EventoCultural $evento)
    {
        $evento->delete();

        return redirect()
            ->route('entidad.inicio')
            ->with('success', 'Evento eliminado correctamente');
    }
}
