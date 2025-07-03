<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $fillable = [
        'pregunta',
        'imagen',
        'prueba_id',
    ];

    /**
     * Una pregunta pertenece a una prueba.
     */
    public function prueba()
    {
        return $this->belongsTo(Prueba::class);
    }

    /**
     * Una pregunta tiene muchas respuestas.
     */
    public function respuestas()
    {
        return $this->hasMany(Respuesta::class);
    }
}
