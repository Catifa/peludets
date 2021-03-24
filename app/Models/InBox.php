<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InBox extends Model
{
    use HasFactory;
    /**
     * Undocumented variable
     *
     * @var string
     */
    protected $table = 'inbox';

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $fillable = [
            'idUser',
            'category',
            'data'
    ];
}
