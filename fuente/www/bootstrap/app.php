<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

/**
 * Bootstrap de la aplicación Laravel 12.
 *
 * Este archivo inicializa y configura la instancia principal de la aplicación,
 * utilizando el nuevo sistema declarativo introducido en Laravel 11 y
 * consolidado en Laravel 12.
 *
 * Aquí se definen:
 * - Rutas principales (web, consola, health check)
 * - Middleware globales
 * - Configuración del manejo de excepciones
 *
 * Laravel 12 elimina la necesidad de archivos como Kernel.php o Handler.php,
 * centralizando toda la configuración en este bootstrap.
 *
 * @return \Illuminate\Foundation\Application  Instancia configurada de la aplicación.
 */
return Application::configure(basePath: dirname(__DIR__))

    /**
     * Configuración de rutas de la aplicación.
     *
     * - web: rutas HTTP principales.
     * - commands: comandos Artisan personalizados.
     * - health: endpoint de estado para monitorización.
     */
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    /**
     * Registro de middleware globales.
     *
     * Este callback permite añadir, modificar o eliminar middleware
     * que se ejecutarán en todas las peticiones HTTP.
     *
     * @param Middleware $middleware  Administrador de middleware globales.
     */
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })

    /**
     * Configuración del manejo de excepciones.
     *
     * Aquí pueden definirse reportes personalizados, renderizado de errores
     * o excepciones que deben ignorarse.
     *
     * @param Exceptions $exceptions  Administrador de excepciones de la aplicación.
     */
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })

    /**
     * Crea y devuelve la instancia final de la aplicación.
     */
    ->create();
