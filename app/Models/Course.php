<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'cursos'; // Usar la tabla en español
    protected $fillable = [
        'nombre_curso',
        'descripcion',
    ];

    public function lecciones()
    {
        return $this->hasMany(Leccion::class);
    }
    
    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }
}
