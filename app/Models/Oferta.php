<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    protected $table = 'ofertas';
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}