<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected $table = 'chats';

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $fillable = [
        'idEmisor',
        'idRemitente',
        'leido',
        'mensaje',
    ];
}
