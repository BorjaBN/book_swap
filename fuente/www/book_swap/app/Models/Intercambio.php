<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Intercambio extends Model
{
    protected $table = 'intercambios';

    protected $fillable = [
        'libro_id',
        'solicitante_id',
        'propietario_id',
        'libro_ofrecido_id',
        'estado'
    ];

    public function solicitante()
    {
        return $this->belongsTo(UsuarioComun::class, 'solicitante_id', 'id_usuario_comun');
    }

    public function propietario()
    {
        return $this->belongsTo(UsuarioComun::class, 'propietario_id', 'id_usuario_comun');
    }

    public function libro()
    {
        return $this->belongsTo(Libro::class, 'libro_id', 'id_libro');
    }

    public function libroOfrecido()
    {
        return $this->belongsTo(Libro::class, 'libro_ofrecido_id', 'id_libro');
    }


    public function aceptar(): void
    {
        $this->update(['estado' => 'aceptado']);

        // Borrar libro solicitado
        if ($this->libro) {
            $this->libro->delete();
        }

        // Borrar libro ofrecido (si existe)
        if ($this->libroOfrecido) {
            $this->libroOfrecido->delete();
        }
    }


    public function rechazar(): void
    {
        $this->update(['estado' => 'rechazado']);
        $this->solicitante->sumarCreditos(50);
    }


}

