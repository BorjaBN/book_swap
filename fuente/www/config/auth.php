<?php

/**
 * Configuración del sistema de autenticación de Laravel.
 *
 * Este archivo define:
 * - el guard por defecto
 * - los guards disponibles
 * - los user providers asociados a cada guard
 * - la configuración del reseteo de contraseñas
 * - el tiempo de expiración de la confirmación de contraseña
 *
 * En tu proyecto, esta configuración está adaptada para manejar
 * dos tipos de usuarios: usuarios comunes y entidades culturales.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | Define el guard y el broker de contraseñas que se utilizarán por defecto.
    | Estos valores pueden sobrescribirse mediante variables de entorno.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'usuario_comun'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Los guards determinan cómo se autentican los usuarios en cada contexto.
    | Cada guard utiliza un "driver" (normalmente session) y un "provider"
    | que indica cómo obtener los usuarios desde la base de datos.
    |
    | En este proyecto existen dos guards:
    | - web: para usuarios comunes
    | - entidad: para entidades culturales
    |
    */

    'guards' => [
        // Guard para usuarios comunes
        'web' => [
            'driver' => 'session',
            'provider' => 'usuario_comun',
        ],

        // Guard para entidades culturales
        'entidad' => [
            'driver' => 'session',
            'provider' => 'entidad_cultural',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Los providers definen cómo se obtienen los usuarios desde la base de datos.
    | Normalmente se usa Eloquent, indicando el modelo correspondiente.
    |
    | Aquí se definen dos providers:
    | - usuario_comun → App\Models\UsuarioComun
    | - entidad_cultural → App\Models\EntidadCultural
    |
    | Cada guard utiliza uno de estos providers.
    |
    */

    'providers' => [
        // Provider para usuario común
        'usuario_comun' => [
            'driver' => 'eloquent',
            'model' => App\Models\UsuarioComun::class,
        ],

        // Provider para entidad cultural
        'entidad_cultural' => [
            'driver' => 'eloquent',
            'model' => App\Models\EntidadCultural::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Configuración del sistema de reseteo de contraseñas.
    | Define:
    | - provider asociado
    | - tabla donde se guardan los tokens
    | - tiempo de expiración del token
    | - tiempo mínimo entre solicitudes
    |
    | Nota: actualmente solo está configurado el broker "users",
    | que no corresponde a tus providers personalizados.
    | Si quieres resetear contraseñas para usuario_comun o entidad_cultural,
    | deberías añadir brokers específicos.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Tiempo (en segundos) antes de que expire la confirmación de contraseña.
    | Por defecto son 10800 segundos (3 horas).
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
