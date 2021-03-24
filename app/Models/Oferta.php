<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    /**
     * Undocumented variable
     *
     * @var string
     */
    protected $table = 'ofertas';
    use HasFactory;
/**
 * Undocumented variable
 *
 * @var array
 */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
