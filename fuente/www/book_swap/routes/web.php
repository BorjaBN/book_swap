<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginControlador;
use App\Http\Controllers\Auth\RegistroControlador;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\EventoController;


// -------------------------------------------------------------
// RUTAS PÚBLICAS
// -------------------------------------------------------------

Route::get('/', function () {
    return view('welcome');
})->name('home');

// -------------------------------------------------------------
// LOGIN, REGISTRO Y LOGOUT
// -------------------------------------------------------------

// Login
Route::get('/login', [LoginControlador::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginControlador::class, 'login']);

// Registro
Route::get('/register', [RegistroControlador::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegistroControlador::class, 'register']);

// Logout
Route::post('/logout', [LoginControlador::class, 'logout'])->name('logout');

// -------------------------------------------------------------
// RUTAS PROTEGIDAS
// -------------------------------------------------------------

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth:web')->name('dashboard');

// Libros (solo usuarios comunes)
Route::resource('libros', LibroController::class)->middleware('auth:web');

// Eventos (solo entidades culturales)
Route::resource('eventos', EventoController::class)->middleware('auth:entidad');
