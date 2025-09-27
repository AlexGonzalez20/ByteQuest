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
        $tiempoRecuperacion = 30;

        if ($this->vidas >= $maxVidas) {
            $this->ultima_vida_perdida = null;
            $this->save();
            return;
        }

        if (!$this->ultima_vida_perdida) {
            $this->ultima_vida_perdida = now();
            $this->save();
            return;
        }

        $segundosPasados = $this->ultima_vida_perdida->diffInSeconds(now());

        if ($segundosPasados >= $tiempoRecuperacion) {
            // 🔹 Solo 1 vida por vez
            $this->vidas = min($maxVidas, $this->vidas + 1);

            if ($this->vidas < $maxVidas) {
                $this->ultima_vida_perdida = now();
            } else {
                $this->ultima_vida_perdida = null;
            }

            $this->save();
        }
    }

    // Usuario.php
    public function puedeRecuperarVida()
    {
        $maxVidas = 5;
        $tiempoRecuperacion = 30; // o 1800 para 30 min

        if ($this->vidas >= $maxVidas) {
            return false;
        }

        if (!$this->ultima_vida_perdida) {
            // Iniciamos el timestamp
            $this->ultima_vida_perdida = now();
            $this->save();
            return false; // aún no ha pasado el tiempo
        }

        $segundosPasados = $this->ultima_vida_perdida->diffInSeconds(now());

        return $segundosPasados >= $tiempoRecuperacion;
    }

    public function recuperarVida()
    {
        if ($this->puedeRecuperarVida()) {
            $this->vidas = min(5, $this->vidas + 1);
            $this->ultima_vida_perdida = $this->vidas < 5 ? now() : null;
            $this->save();
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
