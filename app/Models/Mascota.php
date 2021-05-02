<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    // Tabla donde se guarda el objeto Mascota
    /**
     * Undocumented variable
     *
     * @var string
     */
    /**
     * Undocumented variable
     *
     * @var string
     */
     protected $table = 'mascotas';

    use HasFactory;
    
    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $fillable = [
        'id_usuario',
        'nombre',
        'especie',
        'raza',
        'edad',
        'peso',
        'photo',
        'photo_paseo'
    ];
}
