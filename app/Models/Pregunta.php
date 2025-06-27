<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $fillable = [
        'curso_id',
        'pregunta',
        'leccion_id',
        'img'
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
