<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class UsuarioComun extends Authenticatable
{
    // Tabla usa este modelo
    protected $table = 'usuario_comun';
    
    // La clave primaria
    protected $primaryKey = 'id_usuario_comun';
    
    // Campos se pueden llenar masivamente
    protected $fillable = [
        'nombre_usuario_comun',
        'apellidos_usuario_comun',
        'email_usuario_comun',
        'password',
        'telefono_usuario_comun',
        'ciudad_usuario_comun',
    ];


    // Ocultar contraseña al convertir a JSON
    protected $hidden = ['password'];


    // Laravel busca "password" pero nosotros usamos "pass_usuario_comun"
    public function getAuthPassword()
    {
        return $this->password;
    }

    
    // Relación:  Un usuario tiene UNA cartera
    public function cartera()
    {
        return $this->hasOne(CarteraCreditos::class, 'id_usuario_comun', 'id_usuario_comun');
    }
    
    // Relación: Un usuario tiene MUCHOS libros
    public function libros()
    {
        return $this->hasMany(Libro::class, 'id_usuario_comun', 'id_usuario_comun');
    }


    public function tieneCreditos(int $cantidad = 50): bool
    {
        return $this->cartera && $this->cartera->saldo_total >= $cantidad;
    }

    public function restarCreditos(int $cantidad = 50): void
    {
        $this->cartera->decrement('saldo_total', $cantidad);
    }

    public function sumarCreditos(int $cantidad = 50): void
    {
        $this->cartera->increment('saldo_total', $cantidad);
    }

    public function librosLibres()
    {
        return $this->hasMany(Libro::class, 'id_usuario_comun')
            ->where('estado', 'libre');
    }



    // Cuando se crea un usuario crea una cartera de creditos nuevita
    protected static function boot()
    {
        parent::boot();
        
        static::created(function ($usuario) {
            // Crear cartera con 100 créditos de bienvenida
            CarteraCreditos::create([
                'id_usuario_comun' => $usuario->id_usuario_comun,
                'saldo_total' => 100,
            ]);
        });
    }

}
