<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    // Tabla donde se guarda el objeto Solicitud

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected $table = 'solicitudes';
    
    /**
     * Undocumented variable
     *
     * @var boolean
     */
    public $timestamps = true;

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $fillable = [
        'solicitud',
        'id_usuario_solicitado'
    ];
    
    use HasFactory;
}
