<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    // Tabla donde se guarda el objeto Mascota
    protected $table = 'mascotas';

    use HasFactory;
    
    protected $fillable = [
        'nombre',
        'especie',
        'raza',
        'edad',
        'peso'
    ];
}
