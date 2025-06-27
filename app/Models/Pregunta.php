<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $fillable = [
        'pregunta',
        'leccion_id',
        'img'
    ];
public function leccion()
{
    return $this->belongsTo(\App\Models\Leccion::class);
}
    public function respuestas()
{
    return $this->hasMany(\App\Models\Respuesta::class);
}
}
