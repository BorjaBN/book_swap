<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\InicioSesionControlador;
use App\Http\Controllers\Auth\RegistroControlador;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\EventoController;

//------------------------------------
// RUTAS PÚBLICAS
//------------------------------------

Route::get('/', function () {
    return view('bienvenida');
})->name('bienvenida');

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

    Route::get('/inicio', [InicioController::class, 'inicioUComun'])
        ->name('inicio');

    Route::resource('libros', LibroController::class);

    // Eventos públicos (solo ver)
    Route::resource('eventos', EventoController::class)
        ->only(['index', 'show']);
});

//------------------------------------
// ENTIDAD CULTURAL (auth:entidad)
//------------------------------------

Route::middleware('auth:entidad')
    ->prefix('entidad')
    ->name('entidad.')
    ->group(function () {

        Route::get('/inicio', [InicioController::class, 'inicioEEntidad'])
            ->name('inicio');

       

        // Eventos privados de la entidad (CRUD completo excepto index/show)
        Route::resource('eventos', EventoController::class)
            ->except(['index', 'show']);
    });

//------------------------------------
// CIERRE DE SESIÓN
//------------------------------------

Route::post('/cierreSesion', [InicioSesionControlador::class, 'cerrarSesion'])
    ->name('cerrarSesion');


    Route::get('/prueba-eventos', function () {
    return 'Ruta dummy de prueba funcionando correctamente';
})->name('prueba.eventos');


    Route::get('/intercambio', function () {
    return 'Ruta dummy de prueba funcionando correctamente';
})->name('intercambio');


    Route::get('/prueba.eventos', function () {
    return 'Ruta dummy de prueba funcionando correctamente';
})->name('comun.index');