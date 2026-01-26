<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\EventoCultural;
use App\Models\Libro;

/**
 * Controlador para mostrar las páginas de inicio
 * según el tipo de usuario autenticado.
 */
class InicioController extends Controller
{
    /**
     * Muestra la página de inicio del usuario común.
     *
     * Obtiene los tres eventos más recientes y los tres libros más recientes.
     *
     * @return \Illuminate\View\View
     */
    public function inicioUComun()
    {
        $eventos = EventoCultural::latest()->take(3)->get();
        $libros = Libro::latest()->take(3)->get();

        return view('inicio-u-comun', compact('libros', 'eventos'));
    }

    /**
     * Muestra la página de inicio de la entidad cultural autenticada.
     *
     * Obtiene todos los eventos creados por la entidad, ordenados
     * desde el más reciente al más antiguo.
     *
     * @return \Illuminate\View\View
     */
    public function inicioEEntidad()
    {
        $eventos = EventoCultural::where('id_entidad_cultural', Auth::id())
            ->latest()
            ->get();

        return view('inicio-e-cultural', compact('eventos'));
    }
}
