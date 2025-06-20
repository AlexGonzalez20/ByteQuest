<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    //
    protected $table = 'cursos';

    protected $fillable = [
        'id',
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

// Archivo renombrado a Course.php y clase a Course. Eliminar este archivo si ya no es necesario.
