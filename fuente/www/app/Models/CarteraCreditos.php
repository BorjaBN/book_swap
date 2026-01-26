<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo CarteraCreditos
 *
 * Representa la cartera de créditos asociada a un usuario común.
 * Cada cartera almacena el saldo total del usuario y mantiene un
 * historial de movimientos (cargos, abonos, devoluciones, etc.).
 *
 * Relaciones principales:
 * - Una cartera pertenece a un usuario común.
 * - Una cartera tiene muchos movimientos de crédito.
 */
class CarteraCreditos extends Model
{
    /**
     * Nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'cartera_creditos';

    /**
     * Clave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'id_cartera';

    /**
     * Campos protegidos contra asignación masiva.
     *
     * Se protege la clave primaria para evitar modificaciones accidentales.
     *
     * @var array
     */
    protected $guarded = ['id_cartera'];

    /**
     * Relación inversa: una cartera pertenece a un usuario común.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(UserComun::class, 'id_usuario_comun', 'id_usuario_comun');
    }

    /**
     * Relación: una cartera tiene muchos movimientos de crédito.
     *
     * Cada movimiento representa una operación que afecta al saldo:
     * - abonos por intercambios aceptados
     * - cargos por solicitudes enviadas
     * - devoluciones o ajustes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movimientos()
    {
        return $this->hasMany(MovimientoCredito::class, 'id_cartera', 'id_cartera');
    }
}
