<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesion extends Model
{
    // Tabla donde se guarda el objeto Profesion
    protected $table = 'profesiones';
    
    use HasFactory;
}
