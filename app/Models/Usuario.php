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
        if ($this->vidas >= 5) {
            return;
        }

        if ($this->ultima_vida_perdida) {
            // Asegura que siempre sea entero
            $minutosPasados = (int) $this->ultima_vida_perdida->diffInMinutes(now());

            $vidasRecuperadas = intdiv($minutosPasados, 5);

            if ($vidasRecuperadas > 0) {
                $this->vidas = min(5, $this->vidas + $vidasRecuperadas);

                $resto = max(0, (int) round($minutosPasados % 5));

                if ($this->vidas < 5) {
                    $this->ultima_vida_perdida = now()->subMinutes($resto);
                } else {
                    $this->ultima_vida_perdida = null;
                }

                $this->save();
            }
        }
    }
}
