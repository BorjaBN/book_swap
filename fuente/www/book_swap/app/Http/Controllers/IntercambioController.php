<?php

namespace App\Http\Controllers;

use App\Models\Intercambio;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\IntercambioAceptadoSolicitante;
use App\Mail\IntercambioAceptadoPropietario;


class IntercambioController extends Controller
{
    public function mostrarFormulario(Libro $libro)
    {
        return view('formulario-solicitud-intercambio', compact('libro'));
    }

    public function solicitar(Request $request, Libro $libro)
    {
        $usuario = auth()->user();

        if (! $usuario->tieneCreditos(50)) {
            return back()->with('error', 'No tienes créditos suficientes.');
        }

        $usuario->restarCreditos(50);

        Intercambio::create([
            'libro_id'           => $libro->id_libro,
            'solicitante_id'     => $usuario->id_usuario_comun,
            'propietario_id'     => $libro->id_usuario_comun,
            'estado'             => 'pendiente',
            'libro_ofrecido_id'  => $request->libro_ofrecido_id,
        ]);

        return redirect()
            ->route('intercambios.misSolicitudes')
            ->with('success', 'Solicitud de intercambio enviada.');
    }

    public function aceptar($id)
    {
        $solicitud = Solicitud::findOrFail($id);

        // Cambiar estado de los libros
        $solicitud->libroSolicitante->update(['estado' => 'intercambiado']);
        $solicitud->libroReceptor->update(['estado' => 'intercambiado']);

        // Cambiar estado de la solicitud
        $solicitud->estado = 'aceptada';
        $solicitud->save();

        return back()->with('success', 'Intercambio aceptado.');
    }


    public function rechazar(Intercambio $intercambio)
    {
        $this->authorize('gestionar', $intercambio);

        $intercambio->rechazar();

        return back()->with('success', 'Intercambio rechazado y créditos devueltos.');
    }

    public function misSolicitudes()
    {
        $usuario = auth()->user();

        // Solicitudes recibidas
        $recibidas = Intercambio::where('propietario_id', $usuario->id_usuario_comun)
            ->with('libro', 'solicitante', 'libroOfrecido')
            ->orderBy('created_at', 'desc')
            ->get();

        // Solicitudes enviadas
        $enviadas = Intercambio::where('solicitante_id', $usuario->id_usuario_comun)
            ->with('libro', 'propietario', 'libroOfrecido')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mis-solicitudes', compact('recibidas', 'enviadas'));
    }
}
