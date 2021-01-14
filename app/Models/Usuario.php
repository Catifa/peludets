<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    // Tabla donde se guarda el objeto Usuario
    protected $table = 'usuarios';
    
    use HasFactory, Notifiable;

    /**
     * Atributos que se asignan a la tabla.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'email',
        'contrasena',
    ];

    /**
     * Atributos que se ocultaran en el array.
     *
     * @var array
     */
    protected $hidden = [
        'contrasena',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
