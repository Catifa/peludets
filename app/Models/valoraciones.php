<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class valoraciones extends Model
{
    // Tabla donde se guarda el objeto Valoraciones
    protected $table = 'valoraciones';
    
    public $timestamps = true;

    protected $fillable = [
        'id_usuario',
        'id_usuario_remitente',
        'valoraciones'
    ];
    
    use HasFactory;
}
