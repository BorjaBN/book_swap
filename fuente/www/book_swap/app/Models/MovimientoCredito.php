<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoCredito extends Model
{
    protected $table = 'movimiento_credito';
    protected $primaryKey = 'id_movimiento';
    
    protected $guarded = ['id_movimiento'];
    
    protected $casts = [
        'cantidad' => 'integer', 
        'fecha_movimiento' => 'datetime',
    ];
    
    // RELACIÓN: Un movimiento pertenece a una cartera
    public function cartera()
    {
        return $this->belongsTo(CarteraCreditos::class, 'id_cartera', 'id_cartera');
    }
    
    // RELACIÓN: Un movimiento puede estar relacionado con un libro
    public function libro()
    {
        return $this->belongsTo(Libro::class, 'id_libro', 'id_libro');
    }
}