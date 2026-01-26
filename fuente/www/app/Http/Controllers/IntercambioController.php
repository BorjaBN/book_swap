<?php

namespace App\Http\Controllers;

use App\Models\Intercambio;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\IntercambioAceptadoSolicitante;
use App\Mail\IntercambioAceptadoPropietario;

/**
 * Controlador para gestionar las solicitudes de intercambio de libros
 * entre usuarios comunes.
 */
class IntercambioController extends Controller
{
    /**
     * Muestra el formulario para solicitar un intercambio sobre un libro.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\View\View
     */
    public function mostrarFormulario(Libro $libro)
    {
        return view('formulario-solicitud-intercambio', compact('libro'));
    }

    /**
     * Registra una nueva solicitud de intercambio.
     *
     * Verifica que el usuario tenga créditos suficientes, descuenta los créditos
     * y crea el registro del intercambio en estado "pendiente".
     *
     * @param  \Illuminate\Http\Request  $peticion
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\RedirectResponse
     */
    public function solicitar(Request $peticion, Libro $libro)
    {
        $usuario = auth()->user();

        if (!$usuario->tieneCreditos(50)) {
            return back()->with('error', 'No tienes créditos suficientes.');
        }

        $usuario->restarCreditos(50);

        Intercambio::create([
            'libro_id'           => $libro->id_libro,
            'solicitante_id'     => $usuario->id_usuario_comun,
            'propietario_id'     => $libro->id_usuario_comun,
            'estado'             => 'pendiente',
            'libro_ofrecido_id'  => $peticion->libro_ofrecido_id,
        ]);

        return redirect()
            ->route('intercambios.misSolicitudes')
            ->with('success', 'Solicitud de intercambio enviada.');
    }

    /**
     * Acepta una solicitud de intercambio.
     *
     * Ejecuta la lógica definida en el modelo Intercambio.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function aceptar($id)
    {
        $intercambio = Intercambio::findOrFail($id);

        $intercambio->aceptar();

        return back()->with('success', 'Intercambio aceptado.');
    }

    /**
     * Rechaza una solicitud de intercambio.
     *
     * Autoriza la acción mediante policy y ejecuta la lógica de rechazo.
     *
     * @param  \App\Models\Intercambio  $intercambio
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rechazar(Intercambio $intercambio)
    {
        $this->authorize('gestionar', $intercambio);

        $intercambio->rechazar();

        return back()->with('success', 'Intercambio rechazado y créditos devueltos.');
    }

    /**
     * Muestra las solicitudes de intercambio enviadas y recibidas por el usuario.
     *
     * Actualiza la fecha de última revisión y carga las relaciones necesarias
     * para mostrar la información completa de cada intercambio.
     *
     * @return \Illuminate\View\View
     */
    public function misSolicitudes()
    {
        $usuario = auth()->user();

        $usuario->update([
            'ultima_revision_intercambios' => now(),
        ]);

        $recibidas = Intercambio::where('propietario_id', $usuario->id_usuario_comun)
            ->with('libro', 'solicitante', 'libroOfrecido')
            ->orderBy('created_at', 'desc')
            ->get();

        $enviadas = Intercambio::where('solicitante_id', $usuario->id_usuario_comun)
            ->with('libro', 'propietario', 'libroOfrecido')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mis-solicitudes', compact('recibidas', 'enviadas'));
    }
}
