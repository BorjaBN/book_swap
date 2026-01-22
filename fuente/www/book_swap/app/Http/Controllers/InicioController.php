<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\EventoCultural;
use App\Models\Libro;

class InicioController extends Controller
{
    public function index()
    {

        // Usuario común
        if (Auth::guard('web')->check()) {
            $eventos = EventoCultural::latest()->take(3)->get();
            $libros = Libro::latest()->take(3)->get();

            return view('inicio', compact('libros', 'eventos'));
        }

        // Entidad cultural
        if (Auth::guard('entidad')->check()) {
            $eventos = EventoCultural::where('id_entidad_cultural', Auth::id())
                ->latest()
                ->take(3)
                ->get();

            return view('inicio', compact('eventos'));
        }
    
    }

}
