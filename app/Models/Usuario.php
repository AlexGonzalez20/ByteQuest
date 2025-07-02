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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'role_id');
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_usuario')
            ->withPivot(['leccion_actual_id', 'pregunta_actual_id'])
            ->withTimestamps();
    }

    public function lecciones()
    {
        return $this->belongsToMany(\App\Models\Leccion::class, 'leccion_usuario')
            ->withPivot('xp_reclamada')
            ->withTimestamps();
    }
}
