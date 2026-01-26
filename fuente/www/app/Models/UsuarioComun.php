<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Modelo UsuarioComun
 *
 * Representa a un usuario estándar dentro de la plataforma. Este modelo extiende
 * de Authenticatable para permitir autenticación propia, utilizando su tabla y
 * credenciales específicas.
 *
 * Este modelo encapsula el comportamiento natural del usuario dentro del
 * sistema, manteniendo la lógica de dominio cohesionada y evitando controladores inflados.
 */
class UsuarioComun extends Authenticatable
{
    use Notifiable;

    /**
     * Nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'usuario_comun';

    /**
     * Clave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'id_usuario_comun';

    /**
     * Atributos que pueden asignarse masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_usuario_comun',
        'apellidos_usuario_comun',
        'email_usuario_comun',
        'password',
        'telefono_usuario_comun',
        'ciudad_usuario_comun',
        'ultima_revision_intercambios',
    ];

    /**
     * Atributos ocultos al convertir el modelo a JSON.
     *
     * @var array
     */
    protected $hidden = ['password'];

    /**
     * Conversión automática de atributos.
     *
     * @var array
     */
    protected $casts = [
        'ultima_revision_intercambios' => 'datetime',
    ];

    /**
     * Devuelve la contraseña utilizada por el sistema de autenticación.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Relación: un usuario tiene una cartera de créditos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cartera()
    {
        return $this->hasOne(CarteraCreditos::class, 'id_usuario_comun', 'id_usuario_comun');
    }

    /**
     * Relación: un usuario tiene muchos libros.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function libros()
    {
        return $this->hasMany(Libro::class, 'id_usuario_comun', 'id_usuario_comun');
    }

    /**
     * Determina si el usuario tiene suficientes créditos.
     *
     * Esta lógica pertenece al modelo porque describe una propiedad derivada
     * del propio usuario dentro del dominio.
     *
     * @param int $cantidad
     * @return bool
     */
    public function tieneCreditos(int $cantidad = 50): bool
    {
        return $this->cartera && $this->cartera->saldo_total >= $cantidad;
    }

    /**
     * Resta créditos de la cartera del usuario.
     *
     * @param int $cantidad
     * @return void
     */
    public function restarCreditos(int $cantidad = 50): void
    {
        $this->cartera->decrement('saldo_total', $cantidad);
    }

    /**
     * Suma créditos a la cartera del usuario.
     *
     * @param int $cantidad
     * @return void
     */
    public function sumarCreditos(int $cantidad = 50): void
    {
        $this->cartera->increment('saldo_total', $cantidad);
    }

    /**
     * Relación: libros del usuario que están disponibles para intercambio.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function librosLibres()
    {
        return $this->hasMany(Libro::class, 'id_usuario_comun')
            ->where('estado_intercambio', 'libre');
    }

    /**
     * Evento del modelo: al crear un usuario, se crea automáticamente su cartera.
     *
     * Esta lógica pertenece al modelo porque garantiza que cada usuario tenga
     * una cartera válida desde el primer momento, evitando duplicación en controladores.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($usuario) {
            CarteraCreditos::create([
                'id_usuario_comun' => $usuario->id_usuario_comun,
                'saldo_total' => 500, 
            ]);
        });
    }
}
