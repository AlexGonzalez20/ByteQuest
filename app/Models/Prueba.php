<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    use HasFactory;

    protected $fillable = [
        'orden',
        'xp',
        'leccion_id',
    ];

    /**
     * Cada prueba pertenece a una lección.
     */
    public function leccion()
    {
        return $this->belongsTo(Leccion::class);
    }

    /**
     * Cada prueba tiene muchas preguntas.
     */
    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }
}
