<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table = 'libro';
    protected $primaryKey = 'id_libro';
    
    protected $fillable = [
        'titulo_libro',
        'autor_libro',
        'ISBN',
        'estado_libro',
        'genero_libro',
        'fecha_publicacion_libro',
        'imagen_libro',
        'id_usuario_comun',
        'estado_intercambio'
    ];
    
    protected $casts = [
        'fecha_publicacion_libro' => 'date'
    ];
    
    // RELACIÓN: Un libro pertenece a un usuario
    public function propietario()
    {
        return $this->belongsTo(UsuarioComun::class, 'id_usuario_comun', 'id_usuario_comun');
    }
    
    // RELACIÓN: Un libro tiene muchos movimientos de crédito
    public function movimientos()
    {
        return $this->hasMany(MovimientoCredito::class, 'id_libro', 'id_libro');
    }

    public function intercambiosSolicitados()
    {
        return $this->hasMany(Intercambio::class, 'libro_id', 'id_libro');
    }

    public function intercambiosOfrecidos()
    {
        return $this->hasMany(Intercambio::class, 'libro_ofrecido_id', 'id_libro');
    }

    public function estaPendienteDeIntercambio(): bool
    {
        return $this->intercambiosSolicitados()->where('estado', 'pendiente')->exists()
            || $this->intercambiosOfrecidos()->where('estado', 'pendiente')->exists();
    }


}

