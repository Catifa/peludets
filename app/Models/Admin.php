<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * Undocumented variable
     *
     * @var string
     */
    protected $table = 'admins';
    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $guarded = array();
}