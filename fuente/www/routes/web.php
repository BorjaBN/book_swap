<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\InicioSesionControlador;
use App\Http\Controllers\Auth\RegistroControlador;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\UsuarioComunController;
use App\Http\Controllers\EntidadCulturalController;
use App\Http\Controllers\IntercambioController;

/**
 * Página de bienvenida del sistema.
 *
 * Ruta: GET /
 * Nombre: bienvenida
 */
Route::get('/', function () {
    return view('bienvenida');
})->name('bienvenida');

/**
 * Redirección al formulario de inicio de sesión.
 *
 * Ruta: GET /login
 * Nombre: login
 */
Route::get('/login', function () {
    return redirect()->route('formularioInicioSesion');
})->name('login');

/**
 * Muestra la pantalla para elegir tipo de registro.
 *
 * Ruta: GET /registro
 * Nombre: decisionRegistro
 */
Route::get('/registro', [RegistroControlador::class, 'mostrardecisionRegistro'])
    ->name('decisionRegistro');

/**
 * Muestra el formulario de registro según el tipo de usuario.
 *
 * Ruta: GET /registro/{tipo}
 * Nombre: formularioRegistro
 */
Route::get('/registro/{tipo}', [RegistroControlador::class, 'mostrarFormulario'])
    ->name('formularioRegistro');

/**
 * Procesa el registro de un usuario según su tipo.
 *
 * Ruta: POST /registro/{tipo}/registrar
 * Nombre: registrar
 */
Route::post('/registro/{tipo}/registrar', [RegistroControlador::class, 'registrar'])
    ->name('registrar');

/**
 * Muestra el formulario de inicio de sesión.
 *
 * Ruta: GET /inicioSesion
 * Nombre: formularioInicioSesion
 */
Route::get('/inicioSesion', [InicioSesionControlador::class, 'mostrarFormulario'])
    ->name('formularioInicioSesion');

/**
 * Procesa el inicio de sesión del usuario.
 *
 * Ruta: POST /inicioSesion/entrar
 * Nombre: iniciarSesion
 */
Route::post('/inicioSesion/entrar', [InicioSesionControlador::class, 'iniciarSesion'])
    ->name('iniciarSesion');

/**
 * Cierra la sesión del usuario autenticado.
 *
 * Ruta: POST /cierreSesion
 * Nombre: cerrarSesion
 */
Route::post('/cierreSesion', [InicioSesionControlador::class, 'cerrarSesion'])
    ->name('cerrarSesion');



/**
 * Grupo de rutas para usuarios autenticados como "web" (usuarios comunes).
 *
 * Middleware: auth:web
 */
Route::middleware('auth:web')->group(function () {

    /**
     * Página de inicio del usuario común.
     *
     * Ruta: GET /inicio
     * Nombre: inicio
     */
    Route::get('/inicio', [InicioController::class, 'inicioUComun'])
        ->name('inicio');

    /**
     * CRUD de libros.
     *
     * Rutas: /libros/*
     */
    Route::resource('libros', LibroController::class);

    /**
     * Gestión del perfil del usuario común.
     *
     * Rutas: /usuarioComun/*
     */
    Route::resource('usuarioComun', UsuarioComunController::class);

    /**
     * Visualización de eventos (solo index y show).
     *
     * Rutas: /eventos/*
     */
    Route::resource('eventos', EventoController::class)
        ->only(['index', 'show']);

    /**
     * Muestra el formulario para solicitar un intercambio.
     *
     * Ruta: GET /libros/{libro}/solicitar
     * Nombre: intercambios.formulario
     */
    Route::get('/libros/{libro}/solicitar', [IntercambioController::class, 'mostrarFormulario'])
        ->name('intercambios.formulario');

    /**
     * Envía una solicitud de intercambio.
     *
     * Ruta: POST /libros/{libro}/intercambios
     * Nombre: intercambios.solicitar
     */
    Route::post('/libros/{libro}/intercambios', [IntercambioController::class, 'solicitar'])
        ->name('intercambios.solicitar');

    /**
     * Acepta una solicitud de intercambio.
     *
     * Ruta: POST /intercambios/{intercambio}/aceptar
     * Nombre: intercambios.aceptar
     */
    Route::post('/intercambios/{intercambio}/aceptar', [IntercambioController::class, 'aceptar'])
        ->name('intercambios.aceptar');

    /**
     * Rechaza una solicitud de intercambio.
     *
     * Ruta: POST /intercambios/{intercambio}/rechazar
     * Nombre: intercambios.rechazar
     */
    Route::post('/intercambios/{intercambio}/rechazar', [IntercambioController::class, 'rechazar'])
        ->name('intercambios.rechazar');

    /**
     * Muestra las solicitudes enviadas por el usuario.
     *
     * Ruta: GET /mis-solicitudes
     * Nombre: intercambios.misSolicitudes
     */
    Route::get('/mis-solicitudes', [IntercambioController::class, 'misSolicitudes'])
        ->name('intercambios.misSolicitudes');
});



/**
 * Grupo de rutas para entidades culturales autenticadas.
 *
 * Middleware: auth:entidad
 * Prefijo: /entidad
 * Nombre base: entidad.*
 */
Route::middleware('auth:entidad')
    ->prefix('entidad')
    ->name('entidad.')
    ->group(function () {

        /**
         * Página de inicio de la entidad cultural.
         *
         * Ruta: GET /entidad/inicio
         * Nombre: entidad.inicio
         */
        Route::get('/inicio', [InicioController::class, 'inicioEEntidad'])
            ->name('inicio');

        /**
         * Gestión del perfil de la entidad cultural.
         *
         * Rutas: /entidad/perfil/*
         */
        Route::resource('perfil', EntidadCulturalController::class);

        /**
         * CRUD de eventos para entidades culturales.
         *
         * Rutas: /entidad/eventos/*
         * Excepto: index, show
         */
        Route::resource('eventos', EventoController::class)
            ->except(['index', 'show']);
    });
