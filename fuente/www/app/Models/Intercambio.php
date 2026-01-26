<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Intercambio
 *
 * Representa un proceso de intercambio entre dos usuarios dentro de la plataforma.
 * Cada intercambio involucra:
 * - un libro ofrecido por el propietario,
 * - un libro opcional ofrecido por el solicitante,
 * - un estado que indica el progreso del intercambio.
 *
 * Estados posibles:
 * - pendiente
 * - aceptado
 * - rechazado
 *
 * Este modelo también contiene la lógica de negocio para aceptar o rechazar
 * intercambios, actualizando estados de libros y gestionando créditos.
 * 
 * No solo representa datos, sino la entidad de dominio
 * responsable de gestionar el ciclo de vida completo de un intercambio.
 */
class Intercambio extends Model
{
    /**
     * Nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'intercambios';

    /**
     * Atributos que pueden asignarse masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'libro_id',
        'solicitante_id',
        'propietario_id',
        'libro_ofrecido_id',
        'estado'
    ];

    /**
     * Relación: el solicitante del intercambio.
     *
     * Usuario que inicia la solicitud de intercambio.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function solicitante()
    {
        return $this->belongsTo(UsuarioComun::class, 'solicitante_id', 'id_usuario_comun');
    }

    /**
     * Relación: el propietario del libro solicitado.
     *
     * Usuario que posee el libro principal del intercambio.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function propietario()
    {
        return $this->belongsTo(UsuarioComun::class, 'propietario_id', 'id_usuario_comun');
    }

    /**
     * Relación: libro solicitado al propietario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function libro()
    {
        return $this->belongsTo(Libro::class, 'libro_id', 'id_libro');
    }

    /**
     * Relación: libro ofrecido por el solicitante (opcional).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function libroOfrecido()
    {
        return $this->belongsTo(Libro::class, 'libro_ofrecido_id', 'id_libro');
    }

    /**
     * Acepta el intercambio.
     *
     * Acciones realizadas:
     * - Cambia el estado del intercambio a "aceptado".
     * - Marca ambos libros como "intercambiado".
     * - Devuelve 25 créditos simbólicos al solicitante.
     *
     * @return void
     */
    public function aceptar(): void
    {
        
        $this->update(['estado' => 'aceptado']);

       
        if ($this->libro) {
            $this->libro->update(['estado_intercambio' => 'intercambiado']);
        }

        if ($this->libroOfrecido) {
            $this->libroOfrecido->update(['estado_intercambio' => 'intercambiado']);
        }

        
        $this->solicitante->sumarCreditos(25);
    }

    /**
     * Rechaza el intercambio.
     *
     * Acciones realizadas:
     * - Cambia el estado del intercambio a "rechazado".
     * - Devuelve 50 créditos al solicitante.
     *
     * @return void
     */
    public function rechazar(): void
    {
        $this->update(['estado' => 'rechazado']);
        $this->solicitante->sumarCreditos(50);
    }
}
