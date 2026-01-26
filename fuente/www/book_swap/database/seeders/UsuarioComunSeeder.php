<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UsuarioComun;
use Illuminate\Support\Facades\Hash;

class UsuarioComunSeeder extends Seeder
{
    public function run()
    {
        // Creamos 5 usuarios comunes
        UsuarioComun::create([
            'nombre_usuario_comun' => 'Laura',
            'apellidos_usuario_comun' => 'Infantes Corrales',
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
