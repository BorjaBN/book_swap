<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventoCultural;
use App\Models\EntidadCultural;
use Carbon\Carbon;

class EventoCulturalSeeder extends Seeder
{
    public function run()
    {
        $entidades = EntidadCultural::all();

        $eventos = [
            [
                'nombre_evento' => 'Encuentro con autor local',
                'descripcion_evento' => 'Un encuentro íntimo con escritores de la región.',
                'tipo_evento' => 'encuentro con autor/a',
            ],
            [
                'nombre_evento' => 'Club de lectura mensual',
                'descripcion_evento' => 'Debate abierto sobre la obra seleccionada del mes.',
                'tipo_evento' => 'club de lectura',
            ],
            [
                'nombre_evento' => 'Feria del libro de primavera',
                'descripcion_evento' => 'Stands, firmas y actividades para todas las edades.',
                'tipo_evento' => 'feria del libro',
            ],
            [
                'nombre_evento' => 'Presentación de novela histórica',
                'descripcion_evento' => 'Un viaje literario al pasado con su autora invitada.',
                'tipo_evento' => 'encuentro con autor/a',
            ],
            [
                'nombre_evento' => 'Taller de escritura creativa',
                'descripcion_evento' => 'Ejercicios prácticos para estimular la imaginación.',
                'tipo_evento' => 'club de lectura',
            ],
            [
                'nombre_evento' => 'Feria del libro solidaria',
                'descripcion_evento' => 'Recaudación de fondos mediante venta de libros donados.',
                'tipo_evento' => 'feria del libro',
            ],
            [
                'nombre_evento' => 'Lectura dramatizada',
                'descripcion_evento' => 'Interpretación teatral de fragmentos literarios.',
                'tipo_evento' => 'encuentro con autor/a',
            ],
            [
                'nombre_evento' => 'Club de lectura juvenil',
                'descripcion_evento' => 'Espacio dedicado a jóvenes lectores.',
                'tipo_evento' => 'club de lectura',
            ],
        ];

        foreach ($eventos as $evento) {
            $entidad = $entidades->random();

            EventoCultural::create([
                'nombre_evento' => $evento['nombre_evento'],
                'fecha_evento' => Carbon::now()->addDays(rand(5, 60)),
                'descripcion_evento' => $evento['descripcion_evento'],
                'ubicacion_evento' => $entidad->ciudad_entidad_cultural,
                'tipo_evento' => $evento['tipo_evento'],
                'id_entidad_cultural' => $entidad->id_entidad_cultural,
            ]);
        }
    }
}
