<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    // Tabla donde se guarda el objeto Anuncio
    /**
     * Undocumented variable
     *
     * @var string
     */
    protected $table = 'anuncios';

    use HasFactory;
}
