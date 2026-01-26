<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Libro
 *
 * Representa un libro registrado por un usuario dentro de la plataforma.
 * Cada libro pertenece a un usuario común y puede participar en uno o varios
 * intercambios, tanto como libro solicitado como libro ofrecido.
 *
 * Este modelo no solo almacena datos, sino que encapsula
 * comportamiento propio del dominio del libro dentro del sistema.
 */
class Libro extends Model
{
    /**
     * Nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'libro';

    /**
     * Clave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'id_libro';

    /**
     * Atributos que pueden asignarse masivamente.
     *
     * @var array
     */
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

    /**
     * Conversión automática de atributos.
     *
     * Convierte la fecha de publicación en un objeto Carbon.
     *
     * @var array
     */
    protected $casts = [
        'fecha_publicacion_libro' => 'date'
    ];

    /**
     * Relación: un libro pertenece a un usuario común.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function propietario()
    {
        return $this->belongsTo(UsuarioComun::class, 'id_usuario_comun', 'id_usuario_comun');
    }

    /**
     * Relación: un libro tiene muchos movimientos de crédito.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movimientos()
    {
        return $this->hasMany(MovimientoCredito::class, 'id_libro', 'id_libro');
    }

    /**
     * Relación: intercambios donde este libro es el solicitado.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function intercambiosSolicitados()
    {
        return $this->hasMany(Intercambio::class, 'libro_id', 'id_libro');
    }

    /**
     * Relación: intercambios donde este libro es el ofrecido.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function intercambiosOfrecidos()
    {
        return $this->hasMany(Intercambio::class, 'libro_ofrecido_id', 'id_libro');
    }

    /**
     * Determina si el libro está involucrado en algún intercambio pendiente.
     *
     * Esta lógica pertenece al modelo porque describe un estado derivado
     * del propio libro dentro del dominio. Permite saber si el libro está
     * bloqueado para nuevos intercambios.
     *
     * @return bool
     */
    public function estaPendienteDeIntercambio(): bool
    {
        return $this->intercambiosSolicitados()->where('estado', 'pendiente')->exists()
            || $this->intercambiosOfrecidos()->where('estado', 'pendiente')->exists();
    }
}
