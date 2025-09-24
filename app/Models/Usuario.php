<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'password',
        'vidas',
        'experiencia',
        'role_id',
        'imagen'
    ];

    protected $attributes = [
        'imagen' => 'amarillo.PNG',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'ultima_vida_perdida' => 'datetime',
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'role_id');
    }
    public function progresoPreguntas()
    {
        return $this->hasMany(ProgresoPregunta::class, 'usuario_id');
    }
    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_usuario')
            ->withPivot(['leccion_actual_id', 'prueba_actual_id'])
            ->withTimestamps();
    }


    public function actualizarVidas()
    {
        $maxVidas = 5;
        $tiempoRecuperacion = 30; // en segundos (usa 1800 para 30 min reales)

        // Si ya tiene todas las vidas, no hacemos nada
        if ($this->vidas >= $maxVidas) {
            return;
        }

        if ($this->ultima_vida_perdida) {
            // Segundos transcurridos desde la última vida perdida
            $segundosPasados = $this->ultima_vida_perdida->diffInSeconds(now());

            // Vidas recuperadas = cada X segundos (o minutos)
            $vidasRecuperadas = intdiv($segundosPasados, $tiempoRecuperacion);

            if ($vidasRecuperadas > 0) {
                // Sumamos vidas sin pasarnos del máximo
                $this->vidas = min($maxVidas, $this->vidas + $vidasRecuperadas);

                if ($this->vidas < $maxVidas) {
                    // Aún no tiene todas → dejamos un timestamp ajustado
                    $resto = $segundosPasados % $tiempoRecuperacion;
                    $this->forceFill([
                        'ultima_vida_perdida' => now()->subSeconds($resto),
                    ])->save();
                } else {
                    // Ya se recuperó al máximo → borramos el timestamp
                    $this->forceFill([
                        'ultima_vida_perdida' => null,
                    ])->save();
                }
            }
        }
    }



    protected static function boot()
    {
        parent::boot();

        static::saving(function ($usuario) {
            if ($usuario->vidas < 0) {
                $usuario->vidas = 0;
            }
        });
    }
}
