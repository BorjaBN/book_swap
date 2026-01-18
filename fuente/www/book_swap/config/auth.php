<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'usuarios_comun'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */

    'guards' => [
        // Guard para usuarios comunes
        'web' => [
            'driver' => 'session',
            'provider' => 'usuarios_comun',
        ],

        // Guard para entidades culturales
        'entidad' => [
            'driver' => 'session',
            'provider' => 'entidades_culturales',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */

    'providers' => [
        // Provider para usuario común
        'usuarios_comun' => [
            'driver' => 'eloquent',
            'model' => App\Models\UsuarioComun::class,
        ],

        // Provider para entidad cultural
        'entidades_culturales' => [
            'driver' => 'eloquent',
            'model' => App\Models\EntidadCultural::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    */

    'passwords' => [
        'usuarios_comun' => [
            'provider' => 'usuarios_comun',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],

        // Si más adelante quieres reset para entidades, se puede activar:
        // 'entidades_culturales' => [
        //     'provider' => 'entidades_culturales',
        //     'table' => 'password_reset_tokens',
        //     'expire' => 60,
        //     'throttle' => 60,
        // ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
