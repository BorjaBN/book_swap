<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class EventoCultural extends Model
{

    protected $table = 'evento_cultural';
    protected $primaryKey = 'id_evento';
    
    protected $fillable = [
        'nombre_evento',
        'fecha_evento',
        'descripcion_evento',
        'ubicacion_evento',
        'tipo_evento',
        'id_entidad_cultural',
    ];
    
    // Convertir fecha_evento a objeto Carbon (más fácil de manipular)
    protected $casts = [
        'fecha_evento' => 'date',
    ];
    
    // RELACIÓN: Un evento pertenece a una entidad
    public function entidad()
    {
        return $this->belongsTo(EntidadCultural:: class, 'id_entidad_cultural', 'id_entidad_cultural');
    }
}