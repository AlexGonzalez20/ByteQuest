<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;

    protected $fillable = [
        'texto',
        'es_correcta',
        'pregunta_id',
    ];

    /**
     * Una respuesta pertenece a una pregunta.
     */
    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }
}
