<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    use HasFactory;

    protected $table = 'pruebas';

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'orden',
        'xp',
        'leccion_id',
    ];

    /**
     * Relación: Una prueba pertenece a una lección.
     */
    public function leccion()
    {
        return $this->belongsTo(Leccion::class);
    }
}
