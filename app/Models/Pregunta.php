<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $fillable = ['leccion_id', 'pregunta', 'imagen'];

    public function leccion()
    {
        return $this->belongsTo(Leccion::class);
    }

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class);
    }
}
