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
    
    use HasFactory;
}
