<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    use HasFactory;

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected $table = 'notificaciones';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idDestinatario',
        'idRemitente',
        'categoria',
        'contenido'
    ];
}
