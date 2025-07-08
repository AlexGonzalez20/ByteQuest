<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leccion extends Model
{
    use HasFactory;

    protected $table = 'lecciones';

    protected $fillable = [
        'nombre',
        'descripcion',
        'curso_id',
    ];

    /**
     * Una lección pertenece a un curso.
     */
    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }

    public function pruebas()
    {
            return $this->hasMany(Prueba::class, 'leccion_id');

    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
