<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    // Tabla donde se guarda el objeto Solicitud
    protected $table = 'solicitudes';
    
    public $timestamps = true;

    protected $fillable = [
        'solicitud',
        'id_usuario_solicitado'
    ];
    
    use HasFactory;
}
