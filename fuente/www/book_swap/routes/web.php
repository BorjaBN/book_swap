<?php

use App\Http\Controllers\Auth\InicioSesionControlador;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistroControlador;
use App\Http\Controllers\InicioController;


//-----------------------------
//PARA USUARIOS NO AUTENTICADOS
//-----------------------------

// Pantalla de bienvenida
Route::get('/', function () {
    return view('bienvenida');
})->name('bienvenida');

// Pantalla de selección de tipo de registro
Route::get('/registro',[RegistroControlador::class, 'mostrardecisionRegistro'])->name('decisionRegistro');

// Formulario de registro
Route::get('/registro/{tipo}',[RegistroControlador::class, 'mostrarFormulario'])->name('formularioRegistro');

//Hacer el registro en la BD
Route::post('/registro/{tipo}/registrar',[RegistroControlador::class, 'registrar'])->name('registrar');

//Formulario de inicio de sesión
Route::get('/inicioSesion',[InicioSesionControlador::class, 'mostrarFormulario'])->name('formularioInicioSesion');

//Hacer el inicio de sesión
Route::post('/inicioSesion/entrar',[InicioSesionControlador::class, 'iniciarSesion'])->name('iniciarSesion');

// Pantalla de Inicio
Route::get('/inicio', [InicioController::class, 'index'])->name('inicio');

Route::get('/intercambio', function () {
    return 'intercambio';
})->name('intercambio');

Route::get('/logout', function () {
    return 'logout';
})->name('logout');
