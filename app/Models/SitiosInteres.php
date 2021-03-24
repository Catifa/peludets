<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SitiosInteres extends Model
{
    /**
     * Undocumented variable
     *
     * @var string
     */
    protected $table = 'sitios_interes';

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
