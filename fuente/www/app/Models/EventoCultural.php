<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo EventoCultural
 *
 * Representa un evento cultural creado por una entidad dentro de la plataforma.
 * Cada evento contiene información relevante como nombre, fecha, ubicación,
 * descripción y tipo. Además, está asociado a una entidad cultural que actúa
 * como organizadora.
 *
 * Atributos principales:
 * - Datos descriptivos del evento.
 * - Fecha del evento (convertida automáticamente a Carbon).
 * - Relación con la entidad cultural que lo creó.
 */
class EventoCultural extends Model
{
    /**
     * Nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'evento_cultural';

    /**
     * Clave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'id_evento';

    /**
     * Atributos que pueden asignarse masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_evento',
        'fecha_evento',
        'descripcion_evento',
        'ubicacion_evento',
        'tipo_evento',
        'id_entidad_cultural',
    ];

    /**
     * Conversión automática de atributos.
     *
     * Convierte fecha_evento en un objeto Carbon para facilitar
     * operaciones como formateo, comparación o manipulación de fechas.
     *
     * @var array
     */
    protected $casts = [
        'fecha_evento' => 'datetime',
    ];

    /**
     * Relación: un evento pertenece a una entidad cultural.
     *
     * Cada evento está asociado a la entidad que lo organiza mediante
     * la clave foránea id_entidad_cultural.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entidad()
    {
        return $this->belongsTo(EntidadCultural::class, 'id_entidad_cultural', 'id_entidad_cultural');
    }
}
