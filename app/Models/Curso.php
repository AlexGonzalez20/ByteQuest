<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    // Tabla asociada
    protected $table = 'cursos';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre_curso',
        'descripcion',
    ];
}
