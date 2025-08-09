<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    /**
     * Un curso tiene muchas lecciones.
     */
    public function lecciones()
    {
        return $this->hasMany(Leccion::class);
    }

    /**
     * Relación muchos a muchos con usuarios (tabla pivote curso_usuario).
     */
    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'curso_usuario')
                    ->withPivot('leccion_actual_id', 'prueba_actual_id', 'xp_reclamada')
                    ->withTimestamps();
    }
 

}
