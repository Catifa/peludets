<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InBox extends Model
{
    use HasFactory;
    protected $table = 'inbox';

    protected $fillable = [
            'idUser',
            'category',
            'data'
    ];
}
