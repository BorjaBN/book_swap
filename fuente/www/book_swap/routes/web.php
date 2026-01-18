<?php

use Illuminate\Support\Facades\Route;

// Pantalla de bienvenida
Route::get('/', function () {
    return view('bienvenida');
})->name('bienvenida');

// Pantalla de selección de tipo de registro
Route::get('/register', function () {
   return view('decision-registro');
})->name('decisionRegistro');

// Registro como usuario común
Route::get('/register/usuario', function () {
    return view('registro-u-comun');
})->name('registroUComun');

// Registro como usuario común
Route::post('/registro-ucomun', function () {
    return 'Ruta provisional funcionando';
})->name('registroUComun.store');


// Registro como entidad cultural
Route::get('/register/entidad', function () {
    return 'registro entidad cultural';
})->name('registroECultural');

// Registro como entidad cultural
Route::get('/login', function () {
    return 'Inicio sesión';
})->name('inicioSesion');
