<?php

use App\Http\Controllers\Auth\InicioSesionControlador;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistroControlador;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LibroController;


//------------------------------------
// RUTAS PÚBLICAS (NO AUTENTICADOS)
//------------------------------------

// Pantalla de bienvenida
Route::get('/', function () {
    return view('bienvenida');
})->name('bienvenida');

// Ruta que Laravel usa por defecto para redirigir cuando falla auth
Route::get('/login', function () {
    return redirect()->route('formularioInicioSesion');
})->name('login');

//------------------------------------
// REGISTRO
//------------------------------------

Route::get('/registro', [RegistroControlador::class, 'mostrardecisionRegistro'])
    ->name('decisionRegistro');

Route::get('/registro/{tipo}', [RegistroControlador::class, 'mostrarFormulario'])
    ->name('formularioRegistro');

Route::post('/registro/{tipo}/registrar', [RegistroControlador::class, 'registrar'])
    ->name('registrar');

//------------------------------------
// INICIO DE SESIÓN
//------------------------------------

Route::get('/inicioSesion', [InicioSesionControlador::class, 'mostrarFormulario'])
    ->name('formularioInicioSesion');

Route::post('/inicioSesion/entrar', [InicioSesionControlador::class, 'iniciarSesion'])
    ->name('iniciarSesion');

//------------------------------------
// USUARIO COMÚN (auth:web)
//------------------------------------

Route::middleware('auth:web')->group(function () {

    // Inicio del usuario común
    Route::get('/inicio', [InicioController::class, 'index'])
        ->name('inicio');

    // Rutas REST completas para libros 
    Route::resource('libros', LibroController::class);

    Route::get('/eventos/comun', function () {
        return 'Listado de eventos (dummy)';
    })->name('eventos.index');

    Route::get('/perfil', function () {
        return 'Perfil (dummy)';
    })->name('comun.index');
});

//------------------------------------
// ENTIDAD CULTURAL (auth:entidad)
//------------------------------------

Route::middleware('auth:entidad')->group(function () {

    // Inicio de entidad cultural
    Route::get('/inicio-entidad', function () {
        return view('inicio-e-cultural');
    })->name('inicio.entidad');

    Route::get('/eventos/crear', function () {
        return 'Crear evento (dummy)';
    })->name('entidad.eventos.create');

    Route::get('/eventos', function () {
        return 'Perfil entidad / eventos (dummy)';
    })->name('eventos.index');
});

//------------------------------------
// CIERRE DE SESIÓN
//------------------------------------

Route::post('/cierreSesion', [InicioSesionControlador::class, 'cerrarSesion'])
    ->name('cerrarSesion');


    Route::get('/prueba', function () {
    return 'Ruta de prueba funcionando correctamente';
})->name('intercambio');
