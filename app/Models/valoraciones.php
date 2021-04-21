<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class valoraciones extends Model
{
    // Tabla donde se guarda el objeto Valoraciones

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected $table = 'valoraciones';

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
        'id_usuario',
        'id_usuario_remitente',
        'nombre_id_usuario',
        'valoraciones',
        'puntuacion'
    ];

    use HasFactory;
}
