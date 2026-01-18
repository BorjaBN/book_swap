<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginControlador;
use App\Http\Controllers\Auth\RegistroControlador;
use App\Http\Controllers\LibroControlador; 
use App\Http\Controllers\EventoControlador;


// Rutas públicas
Route::get('/', function () {
    return view('welcome');
})->name('home');

// -------------------------------------------------------------
// A PARTIR DE AQUÍ login, registro y logout
// -------------------------------------------------------------

// Login
Route::get('/login', [LoginControlador::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginControlador::class, 'login']);

// Registro
Route::get('/register', [RegistroControlador::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegistroControlador::class, 'register']);

// Logout
Route::post('/logout', [LoginControlador::class, 'logout'])->name('logout');

// Dashboard (protegido)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');


// -------------------------------------------------------------
// A PARTIR DE AQUÍ libros y eventos
// -------------------------------------------------------------

// Libros (público)
Route::get('/libros', [LibroControlador::class, 'listarLibros'])->name('libros.index');
Route::get('/libros/{libro}', [LibroControlador::class, 'verLibro'])->name('libros.show');

// Eventos (público)
Route::get('/eventos', [EventoControlador::class, 'listarEventos'])->name('eventos.index');
Route::get('/eventos/{evento}', [EventoControlador::class, 'verEvento'])->name('eventos.show');

// RUTAS PROTEGIDAS (solo usuarios comunes)
Route::middleware('auth:web')->group(function () {

    // Gestión de libros
    Route::get('/mis-libros/crear', [LibroControlador::class, 'formularioCrearLibro'])->name('libros.create');
    Route::post('/mis-libros', [LibroControlador::class, 'guardarLibro'])->name('libros.store');
    Route::get('/mis-libros/{libro}/editar', [LibroControlador::class, 'formularioEditarLibro'])->name('libros.edit');
    Route::put('/mis-libros/{libro}', [LibroControlador::class, 'actualizarLibro'])->name('libros.update');
    Route::delete('/mis-libros/{libro}', [LibroControlador::class, 'eliminarLibro'])->name('libros.destroy');
});

// RUTAS PROTEGIDAS (solo entidades culturales)
Route::middleware('auth:entidad')->group(function () {

    // Gestión de eventos
    Route::get('/mis-eventos/crear', [EventoControlador::class, 'formularioCrearEvento'])->name('eventos.create');
    Route::post('/mis-eventos', [EventoControlador::class, 'guardarEvento'])->name('eventos.store');
    Route::get('/mis-eventos/{evento}/editar', [EventoControlador::class, 'formularioEditarEvento'])->name('eventos.edit');
    Route::put('/mis-eventos/{evento}', [EventoControlador::class, 'actualizarEvento'])->name('eventos.update');
    Route::delete('/mis-eventos/{evento}', [EventoControlador::class, 'eliminarEvento'])->name('eventos.destroy');
});
