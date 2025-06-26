<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $fillable = ['nombre', 'apellido', 'email', 'password', 'role'];
    protected $hidden   = ['password', 'remember_token'];

    public function cursos()
    {
        return $this->belongsToMany(
            Curso::class,
            'usuario_curso',
            'usuario_id',
            'curso_id'
        )->withTimestamps();
    }
}
