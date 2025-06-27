<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leccion extends Model
{
    use HasFactory;

    protected $table = 'lecciones';
    protected $fillable = ['nombre_leccion', 'descripcion',];


    // public function usuarios()
    // {
    //     return $this->belongsToMany(
    //         Usuario::class,
    //         'usuario_curso',    // tabla pivote
    //         'curso_id',         // FK de este modelo
    //         'usuario_id'        // FK del modelo contrario
    //     )->withTimestamps();
    // }
}

