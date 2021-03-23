<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    // Tabla donde se guardan las Especies
    /**
     * Undocumented variable
     *
     * @var string
     */
    protected $table = 'especies';

    use HasFactory;
}
