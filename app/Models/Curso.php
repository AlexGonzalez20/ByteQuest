<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';
    protected $fillable = ['nombre_curso', 'descripcion'];

    public function usuarios()
    {
        return $this->belongsToMany(
            Usuario::class,
            'usuario_curso',    // tabla pivote
            'curso_id',         // FK de este modelo
            'usuario_id'        // FK del modelo contrario
        )->withTimestamps();
    }
}
