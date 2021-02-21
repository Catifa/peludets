<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    // Tabla donde se guardan las Especies
    protected $table = 'especies';

    use HasFactory;
}
