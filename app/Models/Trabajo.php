<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    // Tabla donde se guarda el objeto Trabajo

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected $table = 'trabajos';

    protected $fillable = [
    'id_remitente',
    'id_destinatario',
    'solicitud',
    'check_remitente',
    'check_desitnatario'
    ];


    
    use HasFactory;
}
