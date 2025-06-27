<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;

    // Usa el nombre plural de la tabla
    protected $table = 'respuestas';

    protected $fillable = [
        'pregunta_id',
        'texto_opcion',
        'es_correcta',
    ];

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }
}