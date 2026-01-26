<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EntidadCultural;
use Illuminate\Support\Facades\Hash;

class EntidadCulturalSeeder extends Seeder
{
    public function run()
    {
        EntidadCultural::create([
            'nombre_entidad_cultural' => 'Biblioteca Central de Badajoz',
            'email_entidad_cultural' => 'central@badajoz.es',
            'password' => Hash::make('password123'),
            'telefono_entidad_cultural' => '924000111',
            'ciudad_entidad_cultural' => 'Badajoz',
            'direccion_entidad_cultural' => 'Av. Europa, 12',
            'web_entidad_cultural' => 'https://biblioteca-badajoz.es',
        ]);

        EntidadCultural::create([
            'nombre_entidad_cultural' => 'Asociación Cultural Letras Vivas',
            'email_entidad_cultural' => 'contacto@letrasvivas.es',
            'password' => Hash::make('password123'),
            'telefono_entidad_cultural' => '924111222',
            'ciudad_entidad_cultural' => 'Mérida',
            'direccion_entidad_cultural' => 'Calle Almendralejo, 5',
            'web_entidad_cultural' => null,
        ]);

        EntidadCultural::create([
            'nombre_entidad_cultural' => 'Centro Cultural Alcazaba',
            'email_entidad_cultural' => 'info@alcazaba.es',
            'password' => Hash::make('password123'),
            'telefono_entidad_cultural' => '924333444',
            'ciudad_entidad_cultural' => 'Mérida',
            'direccion_entidad_cultural' => 'Plaza España, 3',
            'web_entidad_cultural' => 'https://centroalcazaba.es',
        ]);

        EntidadCultural::create([
            'nombre_entidad_cultural' => 'Fundación Arte y Letras',
            'email_entidad_cultural' => 'fundacion@arteyletras.es',
            'password' => Hash::make('password123'),
            'telefono_entidad_cultural' => '924555666',
            'ciudad_entidad_cultural' => 'Cáceres',
            'direccion_entidad_cultural' => 'Calle Pintores, 22',
            'web_entidad_cultural' => null,
        ]);

        EntidadCultural::create([
            'nombre_entidad_cultural' => 'Casa de la Cultura de Don Benito',
            'email_entidad_cultural' => 'cultura@donbenito.es',
            'password' => Hash::make('password123'),
            'telefono_entidad_cultural' => '924777888',
            'ciudad_entidad_cultural' => 'Don Benito',
            'direccion_entidad_cultural' => 'Av. Constitución, 10',
            'web_entidad_cultural' => 'https://culturadonbenito.es',
        ]);
    }
}
