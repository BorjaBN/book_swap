<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarteraCreditos extends Model
{
    protected $table = 'cartera_creditos';
    protected $primaryKey = 'id_cartera';
    
    // Protegiendo campos de cartera
    protected $guarded = ['id_cartera'];

    
    // Relación inversa: Una cartera pertenece a UN usuario
    public function usuario()
    {
        return $this->belongsTo(UserComun::class, 'id_usuario_comun', 'id_usuario_comun');
    }
    
    // Relación:  Una cartera tiene MUCHOS movimientos
    public function movimientos()
    {
        return $this->hasMany(MovimientoCredito::class, 'id_cartera', 'id_cartera');
    }
}