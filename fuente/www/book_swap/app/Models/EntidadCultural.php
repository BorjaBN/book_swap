<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntidadCultural extends Model
{
    // Tabla que usa 
    protected $table = 'entidad_cultural';
    
    // Su pk
    protected $primaryKey = 'id_entidad_cultural';
    
    // Campos se pueden llenar masivamente
    protected $fillable = [
        'nombre_entidad_cultural',
        'email_entidad_cultural',
        'pass_entidad_cultural',
        'telefono_entidad_cultural',
        'ciudad_entidad_cultural',
        'nif_entidad_cultural',
        'direccion_entidad_cultural',
        'web_entidad_cultural',
    ];

    
    // Ocultar contraseña al convertir a JSON
    protected $hidden = ['pass_entidad_cultural'];
    
    // RELACIÓN: Una entidad tiene muchos eventos
    public function eventos()
    {
        return $this->hasMany(EventoCultural::class, 'id_entidad_cultural', 'id_entidad_cultural');
    }
}