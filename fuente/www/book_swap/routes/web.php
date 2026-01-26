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

    Route::resource('usuarioComun', UsuarioComunController::class);

    Route::resource('eventos', EventoController::class)
        ->only(['index', 'show']);

    // FORMULARIO DE SOLICITUD
    Route::get('/libros/{libro}/solicitar', [IntercambioController::class, 'mostrarFormulario'])
        ->name('intercambios.formulario');

    // ENVIAR SOLICITUD
    Route::post('/libros/{libro}/intercambios', [IntercambioController::class, 'solicitar'])
        ->name('intercambios.solicitar');

    Route::post('/intercambios/{intercambio}/aceptar', [IntercambioController::class, 'aceptar'])
        ->name('intercambios.aceptar');

    Route::post('/intercambios/{intercambio}/rechazar', [IntercambioController::class, 'rechazar'])
        ->name('intercambios.rechazar');

    Route::get('/mis-solicitudes', [IntercambioController::class, 'misSolicitudes'])
        ->name('intercambios.misSolicitudes');
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

        // Perfil de la entidad
        Route::resource('perfil', EntidadCulturalController::class);

        // Eventos privados (CRUD completo)
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
})->name('prueba');
