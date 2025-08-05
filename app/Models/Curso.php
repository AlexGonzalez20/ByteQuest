<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function lecciones()
    {
        return $this->hasMany(Leccion::class, 'curso_id');
    }

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'curso_usuario')
            ->withPivot(['leccion_actual_id', 'pregunta_actual_id'])
            ->withTimestamps();
    }
 

}
