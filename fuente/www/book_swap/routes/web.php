<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistroControlador;


//-----------------------------
//PARA USUARIOS NO REGISTRADOS
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





// Registro como entidad cultural
Route::get('/inicio', function () {
    return 'Inicio sesión';
})->name('inicio');

// Registro como entidad cultural
Route::get('/login', function () {
    return 'Inicio sesión';
})->name('inicioSesion');