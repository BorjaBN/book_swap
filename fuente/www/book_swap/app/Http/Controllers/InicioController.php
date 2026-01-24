<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\EventoCultural;
use App\Models\Libro;

class InicioController extends Controller
{

    public function inicioUComun()
    {
        $eventos = EventoCultural::latest()->take(3)->get();
        $libros = Libro::latest()->take(3)->get();

        return view('inicio-u-comun', compact('libros', 'eventos'));
    }

    public function inicioEEntidad()
    {
        $eventos = EventoCultural::where('id_entidad_cultural', Auth::id())
            ->latest()
            ->take(3)
            ->get();

        return view('inicio-e-cultural', compact('eventos'));
    }


}
