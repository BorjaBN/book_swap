<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UsuarioComun;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder para poblar la tabla "usuario_comun".
 *
 * Inserta un conjunto de usuarios comunes de ejemplo, con datos básicos
 * de identificación, contacto y credenciales. Estos registros sirven como
 * datos iniciales para pruebas, desarrollo o demostraciones del sistema.
 */
class UsuarioComunSeeder extends Seeder
{
    /**
     * Ejecuta el seeder.
     *
     * Crea varios usuarios comunes con información mínima necesaria para
     * autenticación y pruebas funcionales dentro de la aplicación.
     */
    public function run()
    {
        UsuarioComun::create([
            'nombre_usuario_comun' => 'Laura',
            'apellidos_usuario_comun' => 'Pérez Delgado',
            'email_usuario_comun' => 'laura@example.com',
            'password' => Hash::make('password123'),
            'telefono_usuario_comun' => '600123456',
            'ciudad_usuario_comun' => 'Badajoz',
        ]);

        UsuarioComun::create([
            'nombre_usuario_comun' => 'Carlos',
            'apellidos_usuario_comun' => 'García Romero',
            'email_usuario_comun' => 'carlos@example.com',
            'password' => Hash::make('password123'),
            'telefono_usuario_comun' => '611987654',
            'ciudad_usuario_comun' => 'Mérida',
        ]);

        UsuarioComun::create([
            'nombre_usuario_comun' => 'María',
            'apellidos_usuario_comun' => 'Santos Delgado',
            'email_usuario_comun' => 'maria@example.com',
            'password' => Hash::make('password123'),
            'telefono_usuario_comun' => '622456789',
            'ciudad_usuario_comun' => 'Cáceres',
        ]);

        UsuarioComun::create([
            'nombre_usuario_comun' => 'Javier',
            'apellidos_usuario_comun' => 'López Martín',
            'email_usuario_comun' => 'javier@example.com',
            'password' => Hash::make('password123'),
            'telefono_usuario_comun' => '633112233',
            'ciudad_usuario_comun' => 'Badajoz',
        ]);

        UsuarioComun::create([
            'nombre_usuario_comun' => 'Elena',
            'apellidos_usuario_comun' => 'Ruiz Sánchez',
            'email_usuario_comun' => 'elena@example.com',
            'password' => Hash::make('password123'),
            'telefono_usuario_comun' => '644998877',
            'ciudad_usuario_comun' => 'Don Benito',
        ]);
    }
}
