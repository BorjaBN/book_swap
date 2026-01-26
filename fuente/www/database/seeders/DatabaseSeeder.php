<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Seeder principal del proyecto.
 *
 * Este seeder ejecuta en orden todos los seeders necesarios para poblar
 * la base de datos con datos iniciales: usuarios comunes, entidades
 * culturales, libros y eventos culturales.
 *
 * Se ejecuta automáticamente cuando se usa el comando:
 *   php artisan db:seed
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Ejecuta los seeders registrados.
     *
     * Aquí se definen los seeders que deben ejecutarse para inicializar
     * la base de datos con datos de ejemplo o datos base del sistema.
     */
    public function run()
    {
        $this->call([
            UsuarioComunSeeder::class,
            EntidadCulturalSeeder::class,
            LibroSeeder::class,
            EventoCulturalSeeder::class,
        ]);
    }
}
