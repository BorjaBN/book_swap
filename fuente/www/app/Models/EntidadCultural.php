<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Modelo EntidadCultural
 *
 * Representa a una entidad cultural registrada en la plataforma.
 * Este modelo extiende de Authenticatable para permitir que las
 * entidades puedan autenticarse igual que los usuarios comunes,
 * pero utilizando su propia tabla y credenciales.
 *
 * Atributos principales:
 * - Datos de contacto y localización de la entidad.
 * - Credenciales de acceso (email + password).
 *
 * Relaciones:
 * - Una entidad cultural puede crear muchos eventos culturales.
 */
class EntidadCultural extends Authenticatable
{
    use Notifiable;

    /**
     * Nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'entidad_cultural';

    /**
     * Clave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'id_entidad_cultural';

    /**
     * Atributos que pueden asignarse masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_entidad_cultural',
        'email_entidad_cultural',
        'password',
        'telefono_entidad_cultural',
        'ciudad_entidad_cultural',
        'nif_entidad_cultural',
        'direccion_entidad_cultural',
        'web_entidad_cultural',
    ];

    /**
     * Atributos ocultos al convertir el modelo a JSON.
     *
     * @var array
     */
    protected $hidden = ['password'];

    /**
     * Devuelve la contraseña utilizada por el sistema de autenticación.
     *
     * Laravel utiliza este método internamente para validar credenciales.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Relación: una entidad cultural tiene muchos eventos culturales.
     *
     * Cada evento creado por la entidad queda asociado mediante la clave
     * foránea id_entidad_cultural.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eventos()
    {
        return $this->hasMany(EventoCultural::class, 'id_entidad_cultural', 'id_entidad_cultural');
    }
}
