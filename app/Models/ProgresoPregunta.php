<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgresoPregunta extends Model
{
    use HasFactory;

    protected $table = 'progreso_preguntas';

    protected $fillable = [
        'usuario_id',
        'prueba_id',
        'pregunta_id',
        'respondida',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function prueba()
    {
        return $this->belongsTo(Prueba::class);
    }

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }
}
