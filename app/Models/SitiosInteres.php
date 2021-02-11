<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SitiosInteres extends Model
{
    protected $table = 'sitios_interes';

    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
